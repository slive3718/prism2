<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Controllers\User;

use App\Models\AbstractReviewModel;
use App\Models\CitiesModel;
use App\Models\DesignationsModel;
use App\Models\DivisionsModel;
use App\Models\EmailLogsModel;
use App\Models\InstitutionModel;
use App\Models\PaperAssignedReviewerModel;
use App\Models\PapersModel;
use App\Models\UserModel;
use App\Models\UsersProfileModel;

use App\Controllers\ExcelController;
use CodeIgniter\Controller;

class UserManagerController extends Controller
{

    protected $helpers = ['form'];
    private $db;
    public function __construct()
    {

        $this->db = \Config\Database::connect();
    }

    public function index(){


    }

    public function importReviewers()
    {
        $file = $this->request->getFile('reviewerImportFile');

        $UserModel = new UserModel();
        $UserProfileModel = new UsersProfileModel();
        $DivisionModel = new DivisionsModel();
        $duplicate = [];
        $insertedCount = 0;
        $updatedCount = 0;
        $count = 0;

        session()->set('import_progress', 0);
        // Check if file is uploaded successfully
        try {
            if ($file->isValid() && ($file->getExtension() === 'xlsx' || $file->getExtension() === 'xls')) {
                // Load necessary libraries/helpers
                helper('excel');

                // Load the Excel file
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

                // Get the first worksheet
                $worksheet = $spreadsheet->getActiveSheet();
                $totalRows = $worksheet->getHighestDataRow();

                // Iterate through rows
                foreach ($worksheet->getRowIterator() as $index => $row) {
                    if ($index === 1) {
                        continue; // Skip header row
                    }

                    $count++;
                    $cellValue = []; // Reset cell values for each row

                    // Iterate through cells in the row
                    foreach ($row->getCellIterator() as $cell) {
                        $cellValue[] = $cell->getValue();
                    }

                    // Assuming the order of fields in the Excel file is: First Name, Last Name, User, Password, E-Mail, Company, Division
                    $importData = [
                        'name' => $cellValue[0],
                        'surname' => $cellValue[1],
                        'username' => $cellValue[2],
                        'password' => password_hash($cellValue[3], PASSWORD_DEFAULT),
                        'email' => $cellValue[4]
                    ];


                    $division = $DivisionModel->like('LOWER(name)', strtolower(trim($cellValue[6])))->first();
                    $division_id = (!empty($division->division_id) ? $division->division_id : '');

                    $user = $UserModel->where('email', trim($importData['email']))->first();

                    if (empty($user)) {
                        // Insert new user
                        $insertedCount++;
                        $user_id = $UserModel->insert($importData);

                        if ($user_id) {
                            $profileData = $this->createProfileData($user_id, $cellValue[5], $division_id);
                            $UserProfileModel->insert($profileData);
                        }
                    } else {
                        // Update existing user
                        $updatedCount++;
                        $user_id = $user['id'];

                        // Update main user data
                        $UserModel->update($user_id, $importData);

                        // Update or create profile data
                        $existingProfile = $UserProfileModel->where('author_id', $user_id)->first();
                        $profileData = $this->updateProfileData($existingProfile, $cellValue[5], $division_id);
                        if ($existingProfile) {
                            $UserProfileModel->update($existingProfile['id'], $profileData);
                        } else {
                            $UserProfileModel->insert($profileData);
                        }

                        // Update reviewer roles
                        $reviewerData = $this->setReviewerRole([], trim($cellValue[7]));
                        if (!empty($reviewerData)) {
                            $UserModel->update($user_id, $reviewerData);
                        }
                    }

                    $progress = ($count / $totalRows) * 100;
                    session()->set('import_progress', $progress);
                }

                return json_encode(['status' => 200, 'message' => "Reviewers imported successfully! Inserted Count: " . $insertedCount . " Updated Count: " . $updatedCount, 'data' => '']);
            } else {
                return json_encode(['status' => 500, 'message' => "Invalid file format. Please upload a valid Excel file.", 'data' => '']);
            }
        } catch (\Exception $e) {
            return json_encode(['status' => 500, 'message' => $e->getMessage(), 'data' => '']);
        }
    }

    public function importUsers()
    {
        $file = $this->request->getFile('user_import_file');

        $UserModel = new UserModel();
        $UserProfileModel = new UsersProfileModel();
        $duplicate = [];
        $insertedCount = 0;
        $updatedCount = 0;
        $count = 0;

        session()->set('import_progress', 0);

        try {
            if ($file->isValid() && in_array($file->getExtension(), ['xlsx', 'xls'])) {
                // Load Excel library
                helper('excel');
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
                $worksheet = $spreadsheet->getActiveSheet();
                $totalRows = $worksheet->getHighestDataRow();

                foreach ($worksheet->getRowIterator() as $index => $row) {
                    if ($index === 1) continue; // Skip header row

                    $count++;
                    $cellValue = []; // Reset cell values for each row

                    foreach ($row->getCellIterator() as $cell) {
                        $cellValue[] = $cell->getValue();
                    }

                    $importData = [
                        'name'        => trim($cellValue[0]) ?: '',
                        'middle_name' => trim($cellValue[1]) ?: '',
                        'surname'     => trim($cellValue[2]) ?: '',
                        'email'       => trim($cellValue[3]) ?: '',
                        'username'    => trim($cellValue[4]) ?: '',
                        'password'    => $cellValue[5] ? password_hash(trim($cellValue[5]), PASSWORD_DEFAULT) : '',
                    ];

                    // Validate email and username before inserting
                    if (empty($importData['email'])) {
                        continue;
                    }

                    $user = $UserModel->where('email', $importData['email'])->first();

                    if (empty($user)) {
                        // ✅ Insert new user
                        $user_id = $UserModel->insert($importData);

                        if ($user_id) {
                            $this->create_user_profile_data($user_id, $cellValue);
                            $insertedCount++;
                        }
                    } else {
                        // ✅ Update existing user
                        $user_id = $user['id'];
                        $UserModel->update($user_id, $importData);

                        $existingProfile = $UserProfileModel->where('author_id', $user_id)->first();

                        $this->update_imported_profile_data($existingProfile, $user_id, $cellValue);

                        // ✅ Handle reviewer roles
                        $reviewerData = $this->setReviewerRole([], trim($cellValue[7]));
                        if (!empty($reviewerData)) {
                            $UserModel->update($user_id, $reviewerData);
                        }

                        $updatedCount++;
                    }

                    // ✅ Update import progress
                    $progress = ($count / $totalRows) * 100;
                    session()->set('import_progress', $progress);
                }

                return $this->response->setJSON([
                    'status'  => 200,
                    'message' => "Users imported successfully! Inserted Count: {$insertedCount}, Updated Count: {$updatedCount}",
                    'data'    => ''
                ]);
            } else {
                return $this->response->setJSON([
                    'status'  => 500,
                    'message' => "Invalid file format. Please upload a valid Excel file.",
                    'data'    => ''
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'  => 500,
                'message' => $e->getMessage(),
                'data'    => ''
            ]);
        }
    }

   private function create_user_profile_data($user_id, $cellValue) {
        $InstitutionModel = new InstitutionModel();
        $UserProfileModel = new UsersProfileModel();

        $searchInstitution = strtolower(trim($cellValue[10]));

        // Try to find the institution
        $institution = $InstitutionModel
            ->like("REPLACE(LOWER(name), ' ', '')", str_replace(' ', '', $searchInstitution))
            ->asArray()
            ->first();

        if (empty($institution)) {
            $institution_id = $this->create_institution($cellValue);
        } else {
            $institution_id = $institution['id'];
        }

       $designation_ids = $this->set_designations($cellValue[6]);
        $profileData = [
            'author_id'      => $user_id,
            'institution_id' => $institution_id,
            'designations'   => !empty(json_encode($designation_ids)) ? json_encode($designation_ids): NULL,
            'other_designation'   => trim($cellValue[7]),
            'phone'          => trim($cellValue[8]) ?: '',
            'cellphone'          => trim($cellValue[9]) ?: '',
        ];

        $UserProfileModel->insert($profileData);
        return $UserProfileModel->insertID(); // Return inserted profile ID
    }

    private function update_imported_profile_data($existingProfile, $user_id, $cellValue) {
        $InstitutionModel = new InstitutionModel();
        $UserProfileModel = new UsersProfileModel();

        $searchInstitution = strtolower(trim($cellValue[10]));

        $institution = $InstitutionModel
            ->like("REPLACE(LOWER(name), ' ', '')", str_replace(' ', '', $searchInstitution))
            ->asArray()
            ->first();

        $institution_id = $institution ? $institution['id'] : $this->create_institution($cellValue);

        if (empty($institution_id)) {
            $institution_id = null;
        }

        $designation_ids = $this->set_designations($cellValue[6]);
        $profileData = [
            'institution_id' => $institution_id,
            'designations'   => !empty(json_encode($designation_ids)) ? json_encode($designation_ids): NULL,
            'other_designation'   => trim($cellValue[7]),
            'phone'          => trim($cellValue[8]) ?: '',
            'cellphone'          => trim($cellValue[9]) ?: '',
        ];

        if ($existingProfile) {
            $updateData = [];

            foreach ($profileData as $key => $value) {
                if ($existingProfile[$key] != $value) {
                    $updateData[$key] = $value;
                }
            }

            if (!empty($updateData)) {
                $UserProfileModel->update($existingProfile['id'], $updateData);
                return $existingProfile['id'];
            }
        } else {
            $profileData['author_id'] = $user_id;
            $UserProfileModel->insert($profileData);
            return $UserProfileModel->insertID();
        }

        return true;
    }

    private function create_institution($cellValue) {
        $InstitutionModel = new InstitutionModel();
        $cityModel = new CitiesModel();

        $searchCity = trim($cellValue[11]);
        $searchCountry = trim($cellValue[12]);

        $city = $cityModel
            ->select('cities.*')
            ->join('countries', 'countries.id = cities.country_id', 'left')
            ->where('LOWER(cities.name)', strtolower($searchCity))
            ->where('LOWER(countries.name)', strtolower($searchCountry))
            ->first();

        if (empty($city)) {
            return null; // Return null if city is not found
        }

        $city_id = $city['id'];
        $country_id = $city['country_id'];
        $state_id = $city['state_id'];

        $institution_fields = [
            'name'       => trim($cellValue[10]),
            'country_id' => $country_id,
            'state_id'   => $state_id,
            'city_id'    => $city_id,
        ];

        // Insert institution and return the ID
        if ($InstitutionModel->insert($institution_fields)) {
            return $InstitutionModel->insertID();
        }

        return null;
    }

    function set_designations($designation_cell){
        if(!$designation_cell)
            return NULL;
        $designations_import = array_filter(array_map('trim', explode(',', $designation_cell))); // Trim and remove empty values
        $designation_ids = [];

        if (!empty($designations_import)) {
            $designationModel = new DesignationsModel();

            foreach ($designations_import as $designation) {
                $designation_result = $designationModel->where('LOWER(name)', strtolower($designation))->first();

                if ($designation_result) { // Only add if found
                    $designation_ids[] = $designation_result['id']; // Assuming 'id' is the primary key
                }
            }
        }
        return $designation_ids;
    }

    private function setReviewerRole($importData, $role)
    {
        if ($role == 'Program Chair') {
            $importData['is_deputy_reviewer'] = 1;
        } elseif ($role == 'Reviewer') {
            $importData['is_regular_reviewer'] = 1;
        }
        return $importData;
    }

    private function createProfileData($user_id)
    {
        return [
            'author_id' => $user_id,
            'company' => !empty($company) ? $company : "",
            'division_id' => json_encode(!empty($division_id) ? [$division_id] : null)
        ];
    }

    private function updateProfileData($existingProfile, $company, $division_id)
    {
        $mergedDivisions = [];
        if ($existingProfile) {
            $existingDivisions = json_decode($existingProfile['division_id'], true);
            if (is_array($existingDivisions)) {
                $mergedDivisions = array_unique(array_merge($existingDivisions, [$division_id]));
            }
            return [
                'company' => !empty($company) ? $company : "",
                'division_id' => json_encode($mergedDivisions)
            ];
        } else {
            return $this->createProfileData($existingProfile['author_id'], $company, $division_id);
        }
    }

    public function createUser()
    {
        $post = $this->request->getPost();

        $rules = [
            'password' => 'required|min_length[6]|max_length[255]',
            'email' => 'required|valid_email|max_length[255]|is_unique[users.email]',
            'name' => 'required|max_length[255]',
            'surname' => 'required|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $userFields = $this->prepareUserFields($post, true);

        try {
            $this->db->transStart();

            $userId = $this->userModel->insert($userFields);

            $this->createUserProfile($userId, $post);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => ['Failed to create user!'],
                ]);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User Created!',
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error creating user: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => ['An unexpected error occurred. Please try again.'],
            ]);
        }
    }

    public function updateUser()
    {
        $post = $this->request->getPost();

        if (empty($post['user_id'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => ['User ID is required for update!'],
            ]);
        }

        $rules = [
            'email' => 'required|valid_email|max_length[255]|is_unique[users.email,id,' . $post['user_id'] . ']',
            'name' => 'required|max_length[255]',
            'surname' => 'required|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $userFields = $this->prepareUserFields($post, false);

        try {
            $this->db->transStart();

            (new UserModel())->update($post['user_id'], $userFields);

            $this->updateUserProfile($post['user_id'], $post);


            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => ['Failed to update user!'],
                ]);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User Updated!',
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error updating user: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => ['An unexpected error occurred. Please try again.'],
            ]);
        }
    }

    private function prepareUserFields($post, $isCreate = true)
    {
        $fields = [
            'name' => $post['name'],
            'surname' => $post['surname'],
            'middle_name' => $post['middle_name'] ?? '',
            'prefix' => $post['prefix'] ?? '',
            'suffix' => $post['suffix'] ?? '',
            'email' => $post['email'],
            'is_regular_reviewer' => isset($post['is_regular_reviewer']) ? 1 : 0,
            'is_deputy_reviewer' => isset($post['is_deputy_reviewer']) ? 1 : 0,
            'is_session_moderator' => isset($post['is_session_moderator']) ? 1 : 0,
        ];

        if (!empty($post['password']) ) {
            if($post['password'] !== '******') {
                $fields['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
            }
        }

        return $fields;
    }

    private function createUserProfile($userId, $post)
    {
        $profileFields = [
            'author_id' => $userId
        ];

        if ($userId && !empty($post['divisions'])) {
            $profileFields['division_id'] = $post['divisions'] ? json_encode($post['divisions']) : [];
        }

        if(isset($post['institution']) ){
            $profileFields['institution'] = ($post['institution']);
        }

        if(!$this->userProfileModel->where('author_id', $userId)->first()){
            $this->userProfileModel->insert($profileFields);
        }
    }

    private function updateUserProfile($userId, $post)
    {
        $profileFields = [
            'institution' => isset($post['institution']) ? trim($post['institution']):'',
        ];

        if(!empty($post['divisions'])){
            $profileFields['division_id'] = !empty($post['divisions']) ? json_encode( $post['divisions']):[];
        }

        $profileFields['study_group_affiliation_status'] =  isset($post['study_group_affiliation_status']) ? 1 : 0 ;
        $profileFields['study_group_affiliation'] =  isset($post['study_group_affiliation']) ? $post['study_group_affiliation'] : NULL;

        if(!(new UsersProfileModel())->where('author_id', $userId)->first())
            $this->createUserProfile($userId, $post);
        else
            (new UsersProfileModel())->where('author_id', $userId)->set($profileFields)->update();
    }

}
