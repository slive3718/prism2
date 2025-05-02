<?php

namespace App\Controllers\acceptance;

use App\Controllers\admin\Abstracts\SchedulerController;
use App\Libraries\PhpMail;
use App\Models\AdminAcceptanceModel;
use App\Models\EmailLogsModel;
use App\Models\EmailTemplatesModel;
use App\Models\EventsModel;
use App\Models\LogsModel;
use App\Models\ModeratorAcceptanceModel;
use App\Models\PaperAuthorsModel;
use App\Models\RoomsModel;
use App\Models\SchedulerModel;
use App\Models\SchedulerSessionTalksModel;
use App\Models\UsersProfileModel;
use CodeIgniter\Controller;
use App\Models\Core\Api;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\BaseConnection;

use App\Models\UserModel;
use App\Models\PapersModel;
use App\Models\PopulationModel;
use App\Models\AbstractReviewModel;
use App\Models\AuthorAcceptanceModel;
use App\Models\InstitutionModel;
use App\Models\UserDetailsModel;
use App\Models\RemovedPaperAuthorModel;
use App\Models\InstitutionCitiesModel;
use App\Models\InstitutionCountriesModel;
use App\Models\InstitutionStatesModel;
use App\Models\AuthorPresentationUploadModel;

use App\Controllers\admin\Abstracts\AbstractController;
class AcceptanceController extends Controller
{
    private Api $api;
    private BaseConnection $db;

    public function __construct()
    {
       
        $this->db = db_connect();
        if(session('user_id')){
            $this->user_id = session('user_id');
        }else{
            header('Location:'.base_url().'acceptance/logout');
            exit;
        }

        if(empty(session('user_type')) || session('user_type') !== 'acceptance'){
            header('Location:'.base_url().'acceptance/logout');
            exit;
        }
      
        $this->api = new Api();
        if(empty(session('email')) || session('email') == ''){
            header('Location:'.base_url().'acceptance');
            exit;
        }

        helper('general_helpers');
    }


    public function index(){

        $event = (new EventsModel())->first();
        $header_data = [
            'title' => 'My Meeting Activity'
        ];

        $data['event']= $event;
        return
            view('acceptance/common/header', $header_data).
            view('acceptance/abstract_list', $data).
            view('acceptance/common/footer')
            ;
    }

    public function get_accepted_abstracts(){
        $result = (new AuthorAcceptanceModel())->get_merged_papers();
        return $this->response->setJSON(['status'=>'success', 'data'=>$result]);
    }



    public function acceptance_menu($abstract_id){
        $event = (new EventsModel())->first();
        if(!$event)
            exit;

        $removed_author  = (new RemovedPaperAuthorModel())->get();

        $removed_author_ids = array();
        if(!empty($removed_author)){
            foreach($removed_author as $removed){
                $removed_author_ids[] = $removed['paper_author_id'];
            }
        }
        $authors = (new PaperAuthorsModel())->whereNotIn('id', $removed_author_ids)->where('paper_id', $abstract_id)->orderBy('author_order', 'asc')->orderBy('date_time', 'asc')->asArray()->findALl();

        foreach($authors as $index => &$author){
            $removed_author  = (new RemovedPaperAuthorModel())->where('paper_author_id', $author['id'])->first();
            if($removed_author == null){
                $author['info'] = (new UserModel())->find($author['author_id']);
                $author['profile'] = (new UsersProfileModel())->where('author_id', $author['author_id'])->first();
            }
        }


        $abstract_details= (new PapersModel())->find($abstract_id);
        $author_acceptance = (new AuthorAcceptanceModel())->where(['abstract_id'=>$abstract_id, 'author_id'=>session('user_id')])->first();
        $abstract_preference =  (new AdminAcceptanceModel())->where('abstract_id', $abstract_id)->first();
        $header_data = [
            'title' => 'Acceptance Finalize'
        ];
        // print_R($abstract_details);exit;
        $header_data = [
            'title' => 'Acceptance Menu'
        ];

        $data = [
            'event'=> $event,
            'abstract_id' => $abstract_id,
            'author_acceptance' => $author_acceptance,
            'authors' => $authors,
            'abstract_details' => $abstract_details,
            'abstract_preference' => $abstract_preference,
            'presentation_data_view' => $this->presentation_data_view($abstract_id)
        ];


        return
            view('acceptance/common/header', $header_data).
            view('acceptance/acceptance_menu', $data).
            view('acceptance/common/footer')
            ;
    }

    public function speaker_acceptance($abstract_id){
        if(!$this->validate_abstract_id($abstract_id))
            exit;

        $event = (new EventsModel())->first();
        $acceptanceDetails = (new AuthorAcceptanceModel())->where(['abstract_id'=>$abstract_id, 'author_id'=>session('user_id')])->asArray()->first();
        $header_data = [
            'title' => 'Speaker Acceptance'
        ];
        $data = [
            'event'=> $event,
            'abstract_id' => $abstract_id,
            'acceptanceDetails' => $acceptanceDetails,
            'abstract_preference' => presentation_preferences(),
            'presentation_data_view' => $this->presentation_data_view($abstract_id)
        ];
        return
            view('acceptance/common/header', $header_data).
            view('acceptance/speaker_acceptance', $data).
            view('acceptance/common/footer')
            ;
    }

    public function presentation_data_view($abstract_id){
//        print_R($abstract_id);exit;
        $removed_author  = (new RemovedPaperAuthorModel())->get();
        $removed_paper_author_ids = array();
        if(!empty($removed_author)){
            foreach($removed_author as $removed){
                $removed_paper_author_ids[] = $removed['paper_author_id'];
            }
        }

        $removed_paper_author_ids = array();
        if(!empty($removed_author)){
            foreach($removed_author as $removed){
                $removed_paper_author_ids[] = $removed['paper_author_id'];
            }
        }

        $authors = (new PaperAuthorsModel())
            ->whereNotIn('id', $removed_paper_author_ids)
            ->where('paper_id', $abstract_id)
            ->orderBy('author_order', 'asc')
            ->orderBy('date_time', 'asc')->findAll();

        foreach ($authors as &$item) {
            $item['user'] = (new UserModel())->find($item['author_id']);
            $item['user']['profile'] = (new UsersProfileModel())->where('author_id', $item['author_id'])->first();
        }

        $abstract_details = (new PapersModel())->asArray()->find($abstract_id);
        $abstract_schedule = (new SchedulerSessionTalksModel())
            ->where('abstract_id', $abstract_id)->first();


//        print_R($abstract_schedule);exit;
        if($abstract_schedule){
            $abstract_schedule['event'] = (new SchedulerModel())->find($abstract_schedule['scheduler_event_id']) ?? [];
            $abstract_schedule['room']  = (new RoomsModel())->find($abstract_schedule['event']['room_id']);
        }

        $data = [
            'abstract_id' => $abstract_id,
            'abstract_details' => $abstract_details,
            'abstract_preference' => presentation_preferences(),
            'authors' => $authors,
            'abstract_schedule' => $abstract_schedule
        ];

        return  view('acceptance/common/presentation_details', $data);

    }

    public function presentation_do_upload(){
        $file = $this->request->getFile('presentation_file');
        return $this->response->setJSON((new AuthorAcceptanceModel())->presentation_do_upload($file));
    }

    public function presentation_upload_delete(){
        $post = $this->request->getPost();
        $author_id = session('user_id');
        $abstract_id = $post['abstract_id'];

        $update_array = [
            'presentation_original_name'=> '',
            'presentation_saved_name'=> '',
            'presentation_save_path'=> '',
            'presentation_file_path'=> '',
        ];

        // Check if a record exists for the given author and abstract
        $authorAcceptanceModel = new AuthorAcceptanceModel();
        $existingRecord = $authorAcceptanceModel->where('author_id', $author_id)
            ->where('abstract_id', $abstract_id)
            ->asArray()->first();

        if(!$existingRecord){
            exit;
        }

        if ($existingRecord) {
            // Construct the absolute file path
            $filePath = FCPATH . $existingRecord['presentation_file_path'] . '/' . $existingRecord['presentation_saved_name'];

            // Check if the file exists
            if (file_exists($filePath)) {
                // Attempt to delete the file
                if($authorAcceptanceModel->update($existingRecord['id'], $update_array)){
                    if (unlink($filePath)) {
                        return $this->response->setJSON(['status'=> 'success', 'message' => 'Upload Deleted successfully']);
                    }
                }
            }else{
                $authorAcceptanceModel->update($existingRecord['id'], $update_array);
                return $this->response->setJSON(['status'=> 'success', 'message' => 'Upload Deleted successfully']);
            }
        }
    }

    public function presentation_upload($abstract_id){
        $event = (new EventsModel())->first();

        $header_data = [
            'title' => 'CV Upload'
        ];

        $acceptanceDetails = (new AuthorAcceptanceModel())->where(['abstract_id'=>$abstract_id, 'author_id'=>session('user_id')])->asArray()->first();
        $data = [
            'event'=> $event,
            'abstract_id' => $abstract_id,
            'acceptanceDetails' => $acceptanceDetails,
            'presentation_data_view' => $this->presentation_data_view($abstract_id)
        ];

        return
            view('acceptance/common/header', $header_data).
            view('acceptance/presentation_upload', $data).
            view('acceptance/common/footer')
            ;
    }


    public function save_acceptance_confirmation() {
        $post = $this->request->getPost();
        $author_id = session('user_id');
        $abstract_id = $post['abstract_id'];
        $acceptance_confirmation = $post['participation'];

        define('ACCEPTED', 1);
        define('REJECTED', 0);

        // Prepare the data for insertion or update
        $date_now = date("Y-m-d H:i:s");
        $data = [
            'acceptance_confirmation' => $acceptance_confirmation,
            'acceptance_confirmation_date' => $date_now,
            'author_id' => $author_id,
            'abstract_id' => $abstract_id
        ];

        // Check if a record already exists for the given author and abstract
        $authorAcceptanceModel = new AuthorAcceptanceModel();
        $existingRecord = $authorAcceptanceModel->where('author_id', $author_id)
            ->where('abstract_id', $abstract_id)
            ->asArray()->first();

        try {
            if ($existingRecord) {
                // If the record exists, update it
                $authorAcceptanceModel->update($existingRecord['id'], $data);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Updated successfully']);
            } else {
                // If the record does not exist, insert a new one
                $authorAcceptanceModel->insert($data);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Inserted successfully']);
            }
        }catch (\Exception $e){
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function breakfast_attendance($abstract_id){
        if(!$this->validate_abstract_id($abstract_id))
            exit;

        $event = (new EventsModel())->first();
        $acceptanceDetails = (new AuthorAcceptanceModel())->where(['abstract_id'=>$abstract_id, 'author_id'=>session('user_id')])->asArray()->first();
        $header_data = [
            'title' => 'Breakfast Attendance'
        ];
        $data = [
            'event'=> $event,
            'abstract_id' => $abstract_id,
            'acceptanceDetails' => $acceptanceDetails,
            'abstract_preference' => presentation_preferences(),
            'presentation_data_view' => $this->presentation_data_view($abstract_id)
        ];
        return
            view('acceptance/common/header', $header_data).
            view('acceptance/breakfast_attendance', $data).
            view('acceptance/common/footer')
            ;
    }

    public function biography($abstract_id){
        if(!$this->validate_abstract_id($abstract_id))
            exit;

        $event = (new EventsModel())->first();
        $acceptanceDetails = (new AuthorAcceptanceModel())->where(['abstract_id'=>$abstract_id, 'author_id'=>session('user_id')])->asArray()->first();
        $header_data = [
            'title' => 'Biography'
        ];
        $data = [
            'event'=> $event,
            'abstract_id' => $abstract_id,
            'acceptanceDetails' => $acceptanceDetails,
            'abstract_preference' => presentation_preferences(),
            'presentation_data_view' => $this->presentation_data_view($abstract_id)
        ];
        return
            view('acceptance/common/header', $header_data).
            view('acceptance/biography', $data).
            view('acceptance/common/footer')
            ;
    }


    public function update_acceptance(){
        $post = $this->request->getPost();
        $author_id = session('user_id');
        $abstract_id = $post['abstract_id'];

        $update_array = [];

        if(!empty($post['breakfast_attendance'])){
            $update_array['breakfast_attendance'] = $post['breakfast_attendance'];
        }

        if(!empty($post['author_bio'])){
            $update_array['author_bio'] = $post['author_bio'];
        }

        // Check if a record already exists for the given author and abstract
        $authorAcceptanceModel = new AuthorAcceptanceModel();
        $existingRecord = $authorAcceptanceModel->where('author_id', $author_id)
            ->where('abstract_id', $abstract_id)
            ->asArray()->first();

        if(!$existingRecord){
            exit;
        }

        $authorAcceptanceModel->update($existingRecord['id'], $update_array);
        return $this->response->setJSON(['status'=> 'success', 'message' => 'Updated successfully']);

    }

    public function speaker_acceptance_finalize($abstract_id){
        $event = (new EventsModel())->first();
        $removed_author  = (new RemovedPaperAuthorModel())->get();

        $removed_author_ids = array();
        if(!empty($removed_author)){
            foreach($removed_author as $removed){
                $removed_author_ids[] = $removed['paper_author_id'];
            }
        }
        $authors = (new PaperAuthorsModel())->whereNotIn('id', $removed_author_ids)->where('paper_id', $abstract_id)->orderBy('author_order', 'asc')->orderBy('date_time', 'asc')->asArray()->findALl();

        foreach($authors as $index => &$author){
            $removed_author  = (new RemovedPaperAuthorModel())->where('paper_author_id', $author['id'])->first();
            if($removed_author == null){
                $author['info'] = (new UserModel())->find($author['author_id']);
                $author['profile'] = (new UsersProfileModel())->where('author_id', $author['author_id'])->first();
            }
        }
        if(!$event){
            exit;
        }
        $abstract_details= (new PapersModel())->find($abstract_id);
        $author_acceptance = (new AuthorAcceptanceModel())->where(['abstract_id'=>$abstract_id, 'author_id'=>session('user_id')])->asArray()->first();
        $abstract_preference =  (new AdminAcceptanceModel())->where('abstract_id', $abstract_id)->first();
        $header_data = [
            'title' => 'Acceptance Finalize'
        ];

        $data = [
            'event'=> $event,
            'abstract_id' => $abstract_id,
            'author_acceptance' => $author_acceptance,
            'authors' => $authors,
            'abstract_details' => $abstract_details,
            'abstract_preference' => $abstract_preference,
            'presentation_data_view' => $this->presentation_data_view($abstract_id)
        ];

//        print_r($data);exit;
        return
            view('acceptance/common/header', $header_data).
            view('acceptance/speaker_acceptance_finalize', $data).
            view('acceptance/common/footer')
            ;

    }

    public function send_acceptance_confirmation($abstract_id){
        $sendMail = new PhpMail();
        $email = (new UserModel())->find(session('user_id'));
        try {
            $from = ['name'=>'AFS', 'email'=>'afs@owpm2.com'];
            $addTo = [$email['email']];
            $subject = 'AFS 2025 Participation Confirmation.';
            $addContent = "Thank you for confirming participation in the 129th AFS Metalcasting Congress held in Atlanta, Georgia, April 12-15, 2025. We look forward to seeing you in Atlanta! If you have any questions, please contact Kimberly Perna at <a href='mailto:kperna@afsinc.org'>kperna@afsinc.org </a>. ";

            $response = $sendMail->send($from, $addTo, $subject, $addContent);

            $email_logs_array = [
                'user_id' => session('user_id'),
                'add_to' => ($addTo),
                'subject' => $subject,
                'add_content' => $addContent,
                'send_from' => "Submitter",
                'send_to' => "Author",
                'level' => "Info",
                'template_id' => null,
                'paper_id' => $abstract_id,
                'user_agent' => $this->request->getUserAgent()->getBrowser(),
                'ip_address' => $this->request->getIPAddress(),
            ];

            if ($response->statusCode == 200) {
                $logs = new LogsModel();
                $emailLogs = [
                    'user_id' => session('user_id'),
                    'ref_1' => session('user_id'),
                    'action' => 'email',
                    'ip_address' => $this->request->getIPAddress(),
                    'user_agent' => $this->request->getUserAgent()->getBrowser(),
                    'level'=> 'INFO',
                    'message' => 'sent',
                    'context' => 'copyright'
                ];

                ($logs->save($emailLogs));

                $email_logs_array['status'] = 'Success';
                $emailLogsModel = (new EmailLogsModel())->saveToMailLogs($email_logs_array);

                return $this->response->setJSON(['status' => 'success', 'msg'=> 'Acceptance Email Sent Successfully, <br> We look forward to seeing you in Atlanta!.']);
            } else {
                // Email sending failed
                $email_logs_array['status'] = 'Failed';
                $emailLogsModel = (new EmailLogsModel())->saveToMailLogs($email_logs_array);
                return $this->response->setJSON(['status' => 'failed', 'msg'=> 'Failed to send email']);
            }
            // Send the email
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    
    public function acceptance_message($abstract_id){
        $acceptanceModel =  (new AuthorAcceptanceModel())->where(['abstract_id'=>$abstract_id, 'author_id'=>session('user_id')])->get();
        if($acceptanceModel[0]->acceptance_confirmation == '1'){
            $acceptance_status = "Acceptance Form Successfully Submitted";
            $acceptance_message = "Thank you for confirming your participation in AFS 129th Annual Meeting, 
            being held in Denver, Colorado For more information regarding the AFS 129th Annual Meeting ,
            please visit our website.
            <br>AFS Acceptance <a href=".base_url()."/acceptance> Login Page. </a> ";
            $data['acceptance_status'] = $acceptance_status;
            $data['acceptance_message'] = $acceptance_message;
        }else{
            $acceptance_status = "Acceptance Form Successfully Submitted";
            $acceptance_message = "It is unfortunate that you cannot participate in the year's meeting. We look forward to receiving your proposal again next year.
            <br>AFS Acceptance <a href=".base_url()."/acceptance> Login Page. </a> ";
            $data['acceptance_status'] = $acceptance_status;
            $data['acceptance_message'] = $acceptance_message;
        }
        return view('acceptance/email_templates/acceptance_agree', $data);
    }
    
    public function getAuthorAcceptance($abstract_id){
        return $this->response->setJSON((new AuthorAcceptanceModel())->where(['abstract_id'=> $abstract_id, 'author_id'=>session('user_id')])->get());
    }

    public function check_finalize_acceptance($abstract_id){
        $checkAcceptance = (new AuthorAcceptanceModel())->checkAcceptance($abstract_id);
        if($checkAcceptance['status'] == 'success'){
            return $this->save_finalized_acceptance($abstract_id);
        }else{
            return $checkAcceptance;
        }
    }

    public function save_finalized_acceptance($abstract_id){
        $acceptanceModel = (new AuthorAcceptanceModel());
        try{
            $acceptanceModel->where(['abstract_id'=> $abstract_id, 'author_id'=>session('user_id')])->set(['is_finalized'=>1])->update();
        }catch(\Exception $e){
            return $this->response->setJSON(['status'=>'failed', 'msg'=>$e->getMessage()]);
        }

        return $this->send_acceptance_confirmation($abstract_id);

    }

    public function validate_abstract_id($abstract_id){ // this will validate if the abstract id is belong to the logged in person
        $paper_authors = (new PaperAuthorsModel())->where('paper_id', $abstract_id)->where('author_id', session('user_id'))->findALl();
        if($paper_authors){
            return true;
        }
        return false;
    }
}
