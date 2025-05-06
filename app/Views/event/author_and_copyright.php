
<link href="<?=base_url()?>/assets/css/jquery_ui_style.css" rel="stylesheet">




<?php echo view('event/common/menu'); ?>
<!-- --><?php //print_R($author);exit;?>
<style>
    .table > :not(caption) > * > * {
        padding: 0;
    }
</style>
<main>
    <div class="container pb-5">
        <?php echo view('event/common/shortcut_link'); ?>
        <div class="card p-lg-5 p-md-2 p-sm-1 p-xs-1 shadow">
            <h5>Please read these instructions first:</h5>
            <h5>Adding/Editing Authors:</h5>
            <ol>
                <li>
                    Please add all authors by first searching the database by clicking on the
                    <button type="button" class="showSearchAuthorModal btn btn-primary btn-sm">Add/Search for an Author</button>
                    button as their data may already be entered in the system. If this person is not already in the database, you may add them as a new author.
                </li>
                <li>
                    You must select one presenting author. The presenting author will receive all notifications regarding this submission.
                </li>
                <li>
                    The presenting author or senior author must be from the Asia/Oceania region.
                </li>
                <li>
                    Please check "Correspondent" for each author that should receive communication about this submission. The presenting author will automatically be a correspondent.
                </li>
                <li>
                    If your author data is INCOMPLETE or needs editing, please click on the <i class="fas fa-user-edit"></i> icon to fill out required fields and edit your information.
                </li>
                <li>
                    You can add up to <strong>40 authors</strong>.
                </li>
                <li>
                    To adjust the author order, use the <i class="fas fa-arrow-up"></i> and <i class="fas fa-arrow-down"></i> arrows.
                </li>
                <li>
                    A Relevant Financial Relationships Disclosure is required for each author.
                </li>
            </ol>

            <h5>Author Disclosures:</h5>
            <ol>
                <li>
                    Disclosures are required for each author before the submission deadline. Your abstract cannot be finalized until all authors have completed their disclosures.
                </li>
                <li>
                    If you are the submitter and an author, your disclosures will automatically be checked in the system.
                </li>
                <li>
                    For other authors, the system will automatically check their disclosures once the author name is added. If the co-author’s disclosure is not current, you can email them by clicking <strong>'Email Author Now'</strong> displayed beside their name. This author will receive an email to complete their disclosures, and their status will be updated here.
                </li>
                <li>
                    As a submitter, you will receive an email confirmation each time an author completes their disclosure. At any time before the submission deadline, you may return to the abstract submission system to check the status of your authors’ disclosures.
                </li>
                <li>
                    You will receive an email when all authors on the submission have submitted disclosures.
                </li>
            </ol>

            <div class="row mt-5">
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="mb-5 justify-content-end">
                        <button class="btn btn-primary btn-sm showSearchAuthorModal" style="min-width:100px; width:200px; max-width:200px; height:38px"> Add/Search for an Author</button>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="card">
                    <div class="card-header"style="background-color:#FFCC99">
                        Author List
                    </div>
                    <div class="card-body" style="min-height:120px;overflow-x:scroll">
                        <table class="table p-0">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Author Name</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
<!--                                <th>Author Info</th>-->
<!--                                <th>Disclosure Status</th>-->
<!--                                <th>Email Info</th>-->
<!--                                <th>Action</th>-->
                            </tr>
                            </thead>
                            <tbody class="authorList">

                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
            </div>
            <form id="author_additional_info_form">
<!--            <div class="row container">-->
<!--                <h5>  <span class="text-danger"> *</span>Is the presenting author or senior author of this paper from Asia or Oceania?</h5>-->
<!--                <div class="form-check">-->
<!--                    <input class="form-check-input" type="radio" name="author_q_1" id="author_q_1_yes" value="1" --><?php //=!empty($paper) && !empty($paper['author_q_1']) && $paper['author_q_1'] == 1 ? 'checked' : ''?><!-- required>-->
<!--                    <label class="form-check-label" for="author_q_1_yes">-->
<!--                        Yes, the presenting author and/or senior author of this paper is from Asia or Oceania-->
<!--                    </label>-->
<!--                </div>-->
<!--                <div class="form-check">-->
<!--                    <input class="form-check-input" type="radio" name="author_q_1" id="author_q_1_no" value="0" --><?php //=!empty($paper) && !empty($paper['author_q_1']) && $paper['author_q_1'] == 0 ? 'checked' : ''?><!-- >-->
<!--                    <label class="form-check-label" for="author_q_1_no">-->
<!--                        No, the presenting author and/or senior author is <span class="fw-bolder">not</span> from Asia or Oceania-->
<!--                    </label>-->
<!--                </div>-->
<!---->
<!--                <h5 class="mt-4">  <span class="text-danger"> *</span>Are the majority of co-authors on this paper from Asia or Oceania?</h5>-->
<!--                <div class="form-check">-->
<!--                    <input class="form-check-input" type="radio" name="author_q_2" id="author_q_2_yes" value="1" --><?php //=!empty($paper) && !empty($paper['author_q_2']) && $paper['author_q_2'] == 1 ? 'checked' : ''?><!-- required>-->
<!--                    <label class="form-check-label" for="author_q_2_yes">-->
<!--                        Yes, the majority of co-authors on this paper are from Asia or Oceania-->
<!--                    </label>-->
<!--                </div>-->
<!--                <div class="form-check">-->
<!--                    <input class="form-check-input" type="radio" name="author_q_2" id="author_q_2_no" value="0" --><?php //=!empty($paper) && !empty($paper['author_q_2']) && $paper['author_q_2'] == 0 ? 'checked' : ''?><!-- >-->
<!--                    <label class="form-check-label" for="author_q_2_no">-->
<!--                        No, the majority of co-authors on this paper are from other continents (Europe, North America, South America)-->
<!--                    </label>-->
<!--                </div>-->
<!--            </div>-->

            <div class="row mt-4">
                <div class="row mt-4">
                    <div class="col-8">
                        <div>
                            <div class="form-group  form-control">
                                <p><span class="text-danger presentingAuthorName">*</span><strong> CV Upload</strong> (PDF and no more than 2 pages)</p>

                                <input type="file" class="input-group-inline" name="cv_upload" accept=".pdf,.PDF">
                                <button class="btn btn-primary cvUploadBtn input-group-inline " title="CV" abstract_id="<?=(isset($paper['id'])?$paper['id']:'')?>">Upload </button>

                                <br>
                                <div><strong>Current cv uploaded:</strong> <span id="cv_preview" has_val="<?=((isset($paper) && $paper['cv_rand_name']) ? '1' :'0')?>" ><a href="<?=base_url()?>/uploads/cv/<?=((isset($paper) && $paper['cv_rand_name']) ? $paper['cv_rand_name'] :'')?>" target="_blank"><?=((isset($paper) && $paper['cv_name']) ? $paper['cv_name'] :'')?></a></span></div>
                            </div>
                        </div>

                        <div class="presentingAuthorSubInfo mt-3">
                            <p> Is <span class="presentingAuthorName"></span> a Student ?</p>
                            <input type="radio" class="form-check-input" name="is_presenting_student" id="is_presenting_studentYes" value="1" <?=(isset($paper) && $paper['is_presenting_student'] == '1')?'checked':'' ?> required> <label><span class="text-danger">*</span>Yes</label>
                            <input type="radio" class="form-check-input ms-5" name="is_presenting_student" id="is_presenting_studentNo" value="0" <?=(isset($paper) && $paper['is_presenting_student'] == '0')?'checked':'' ?>> <label><span class="text-danger">*</span>No</label>
                            <br><br>
                            <p>
                                PRISM Annual Meeting Trainee Travel Grant seeks applicants who are PRISM student trainee members or are applicants for membership
                                to apply for this Travel Grant. You will need to be a member or a member applicant before you are able to access the award application.
                                Click here  to view the <a href="<?=base_url()?>public/assets/documents/2024_Travel_Grant_Instructions.pdf" target="_blank"> Travel Grant Instructions </a>.
                            </p>
                            <div id="eligibilityDiv"><br>
                                <p> Is <span class="presentingAuthorName"></span></span> eligible for Trainee Travel Grant ?</p>
                                <input type="radio" class="form-check-input" name="is_eligible_grant" id="is_eligible_grantYes" value="1" <?=(isset($paper) && $paper['is_eligible_grant'] == '1')?'checked':'' ?> required> <label><span class="text-danger">*</span>Yes</label>
                                <input type="radio" class="form-check-input ms-5" name="is_eligible_grant" id="is_eligible_grantNo" value="0" <?=(isset($paper) && $paper['is_eligible_grant'] == '0')?'checked':'' ?>> <label><span class="text-danger">*</span>No</label>

                                <br>
                            </div>
                        </div>
                        <br>
                        <div id="grantAddedInfoDiv">
                            <form id="grantAddedInfo" method="post" action="" enctype="multipart/form-data">
                                <div>
                                    <p>PRISM Annual Meeting Trainee Grant Application for <span class="presentingAuthorName"></span></p>
                                    <p><span class="text-danger">*</span><strong>Letter of Intent</strong> (max. 400 words)</p>
                                    <p>Briefly explain your need for a travel grant and how you would benefit from receiving a travel grant</p>
                                    <textarea  class="form-control required" name="letter_of_intent" title="Letter of intent" rows="10" required><?=(isset($paper) && $paper['letter_of_intent'] !== '')?$paper['letter_of_intent']:'' ?></textarea>
                                    <div class="mb-5 ms-3 mt-2"><span class="letterOfIntentWordCount fw-bolder"></span> <span>word(s)</span></div>
                                </div>
                                <div>
                                    <p><span class="text-danger">*</span><strong>Explanation of contribution (max. 200 words)</strong></p>
                                    <p>Briefly explain how your attendance or the presentation of your research abstract will specifically contribute
                                        to the research and education initiatives upheld by PRiSM at the annual meeting. </p>
                                    <textarea  class="form-control required" name="explanation_of_contribution" title="Explanation of contribution" rows="5" required><?=(isset($paper) && $paper['explanation_of_contribution'] !== '')?$paper['explanation_of_contribution']:'' ?></textarea>
                                    <div class="mb-5 ms-3 mt-2"><span class="contributionWordCount fw-bolder"></span> <span>word(s)</span></div>
                                </div>
                                <br>
                                <br>
                                <div>
                                    <div class="form-group form-control">
                                        <div class="form-input-inline"><span class="text-danger">*</span><strong>Please indicate the degree or specialty that you are working toward:</strong></d>
                                            <input type="text" class="form-input-inline required" name="grant_specialty" title="Specialty" value="<?=(isset($paper) && $paper['specialty_working_toward'] !== '')?$paper['specialty_working_toward']:'' ?>" required >
                                            <div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="text-danger form-input-inline">*</label><strong>Years in training at the current level:</strong>
                                                    <select class="form-input-inline required" name="years_of_training" title="Years of training" required >
                                                        <option value="">Select </option>
                                                        <option value="1" <?=(isset($paper) && $paper['years_of_training'] == '1')?'selected':'' ?>>1 year </option>
                                                        <option value="2" <?=(isset($paper) && $paper['years_of_training'] == '2')?'selected':'' ?>>2 years </option>
                                                        <option value="3" <?=(isset($paper) && $paper['years_of_training'] == '3')?'selected':'' ?>>3 years </option>
                                                        <option value="4" <?=(isset($paper) && $paper['years_of_training'] == '4')?'selected':'' ?>>4 years </option>
                                                        <option value="5" <?=(isset($paper) && $paper['years_of_training'] == '5')?'selected':'' ?>>5 years </option>
                                                        <option value="6" <?=(isset($paper) && $paper['years_of_training'] == '6')?'selected':'' ?>>6 years </option>
                                                        <option value="7" <?=(isset($paper) && $paper['years_of_training'] == '7')?'selected':'' ?>>7 years </option>
                                                        <option value="8" <?=(isset($paper) && $paper['years_of_training'] == '8')?'selected':'' ?>>8 years </option>
                                                        <option value="9" <?=(isset($paper) && $paper['years_of_training'] == '9')?'selected':'' ?>>9 years </option>
                                                        <option value="10" <?=(isset($paper) && $paper['years_of_training'] == '19')?'selected':'' ?>>10 years </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <p><span class="text-danger">*</span><strong>Type of Training (check all that apply)</strong></p>
                                <div class="row row-cols-2">
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Athletic" class="form-check-input" value="Athletic-Training"  <?=(isset($paper) && in_array('Athletic-Training', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Athletic">Athletic Training</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Biomechanics" class="form-check-input" value="Biomechanics" <?=(isset($paper) && in_array('Biomechanics', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Biomechanics">Biomechanics</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Kinesiology" class="form-check-input" value="Kinesiology" <?=(isset($paper) && in_array('Kinesiology', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Kinesiology">Kinesiology</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Medicine-Surgery" class="form-check-input" value="Medicine-Surgery" <?=(isset($paper) && in_array('Medicine-Surgery', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Medicine-Surgery">Medicine-Surgery</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Medicine-Primary" class="form-check-input" value="Medicine-Primary" <?=(isset($paper) && in_array('Medicine-Primary', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Medicine-Primary">Medicine-Primary</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Medicine-Radiology" class="form-check-input" value="Medicine-Radiology" <?=(isset($paper) && in_array('Medicine-Radiology', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Medicine-Radiology">Medicine-Radiology</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Medicine-Other" class="form-check-input" value="Medicine-Other" <?=(isset($paper) && in_array('Medicine-Other', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Medicine-Other">Medicine-Other</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Nursing" class="form-check-input" value="Nursing" <?=(isset($paper) && in_array('Nursing', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Nursing">Nursing</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Nutrition" class="form-check-input" value="Nutrition" <?=(isset($paper) && in_array('Nutrition', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Nutrition">Nutrition</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Physical-Therapy" class="form-check-input" value="Physical-Therapy" <?=(isset($paper) && in_array('Physical-Therapy', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Physical-Therapy">Physical Therapy</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Psychology"  class="form-check-input" value="Psychology" <?=(isset($paper) && in_array('Psychology', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Psychology">Psychology</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Radiology" class="form-check-input"  value="Radiology" <?=(isset($paper) && in_array('Radiology', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Radiology">Radiology</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="type_of_training[]" id="Research" class="form-check-input" value="Research" <?=(isset($paper) && in_array('Research', explode(',', $paper['type_of_training'])) )?'checked':'' ?>>
                                        <label class="form-check-label" for="Research">Research</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-check-label" for="Other">Other</label>
                                        <input type="text" name="other_training" id="Other" class="form-control-inline "  value="">
                                    </div>
                                </div>


                                <div>
                                    <div class="form-group ">
                                        <div class="form-input-inline"><span class="text-danger">*</span>Grant City:</div>
                                        <input type="text" class="form-input-inline form-control required" name="grantCity" title="City" value="<?=(isset($paper) &&  $paper['grant_city'] !== '' )?  $paper['grant_city'] :'' ?>" required>
                                    </div>
                                    <div class="form-group ">
                                        <div class="form-input-inline"><span class="text-danger">*</span>Grant State:</div>
                                        <input type="text" class="form-input-inline form-control required" name="grantState" title="State"  value="<?=(isset($paper) &&  $paper['grant_state'] !== '' )?  $paper['grant_state'] :'' ?>" required>
                                    </div>
                                    <div class="form-group ">
                                        <div class="form-input-inline"><span class="text-danger">*</span>Grant Country:</div>
                                        <input type="text" class="form-input-inline form-control required" name="grantCountry" title="Country"  value="<?=(isset($paper) &&  $paper['grant_country'] !== '' )?  $paper['grant_country'] :'' ?>" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="race">Race</label>
                                    <select class="form-control" id="race" name="grant_race">
                                        <option value="">-- Select Race --</option>
                                        <option value="asian" <?=(isset($paper) && $paper['grant_race'] == 'asian')?'selected':'' ?> >Asian</option>
                                        <option value="black" <?=(isset($paper) && $paper['grant_race'] == 'black')?'selected':'' ?>>Black or African American</option>
                                        <option value="latino" <?=(isset($paper) && $paper['grant_race'] == 'latino')?'selected':'' ?>>Hispanic or Latino</option>
                                        <option value="white" <?=(isset($paper) && $paper['grant_race'] == 'white')?'selected':'' ?>>White</option>
                                        <option value="native" <?=(isset($paper) && $paper['grant_race'] == 'native')?'selected':'' ?>>Native American or Alaska Native</option>
                                        <option value="hawaiian" <?=(isset($paper) && $paper['grant_race'] == 'hawaiian')?'selected':'' ?>>Native Hawaiian or Pacific Islander</option>
                                        <option value="other" <?=(isset($paper) && $paper['grant_race'] == 'other')?'selected':'' ?>>Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="grant_gender">
                                        <option value="">-- Select Gender --</option>
                                        <option value="male" <?=(isset($paper) && $paper['grant_gender'] == 'male')?'selected':'' ?>>Male</option>
                                        <option value="female" <?=(isset($paper) && $paper['grant_gender'] == 'female')?'selected':'' ?>>Female</option>
                                        <option value="nonbinary" <?=(isset($paper) && $paper['grant_gender'] == 'nonbinary')?'selected':'' ?>>Non-binary</option>
                                        <option value="other" <?=(isset($paper) && $paper['grant_gender'] == 'other')?'selected':'' ?>>Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sexual-orientation">Sexual Orientation</label>
                                    <select class="form-control" id="sexual-orientation" name="grant_sexual_orientation">
                                        <option value="">-- Select Sexual Orientation --</option>
                                        <option value="heterosexual" <?=(isset($paper) && $paper['grant_sexual_orientation'] == 'heterosexual')?'selected':'' ?>>Heterosexual</option>
                                        <option value="homosexual" <?=(isset($paper) && $paper['grant_sexual_orientation'] == 'homosexual')?'selected':'' ?>>Homosexual</option>
                                        <option value="bisexual" <?=(isset($paper) && $paper['grant_sexual_orientation'] == 'bisexual')?'selected':'' ?>>Bisexual</option>
                                        <option value="asexual" <?=(isset($paper) && $paper['grant_sexual_orientation'] == 'asexual')?'selected':'' ?>>Asexual</option>
                                        <option value="other" <?=(isset($paper) && $paper['grant_sexual_orientation'] == 'other')?'selected':'' ?>>Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="other-details">Other Relevant Applicant-Specific Details</label>
                                    <textarea class="form-control" id="other-details" name="grant_other_relevant_details" rows="3" title="Other relevant info" ><?=(isset($paper) && $paper['grant_other_relevant_details'] !== '')?$paper['grant_other_relevant_details']:'' ?></textarea>
                                </div>

                            </form>
                        </div>
                    </div>

                <div class="col-4">
                    <fieldset class="card p-3">
                        <legend>My Recent Author</legend>
                        <p> Quick add author to Submissions </p>
                        <table class="table table-striped table-responsive table-bordered table-border-success table-responsive quickAddAuthorTable " >
                            <tbody class="">
                            <?php if(isset($recentAuthors) && !empty($recentAuthors)) :
                                foreach($recentAuthors as $recentAuthor):
                                    ?>
                                    <tr class="">
                                        <td class="shadow-sm"><?=$recentAuthor['name'].' '.$recentAuthor['surname']?></td>
                                        <td class="shadow-sm" style="width: 30px;"><a class="btn btn-success btn-sm quickAddAuthorBtn" href="" author_id="<?=$recentAuthor['id']?>"><i class="fa fa-plus"></i></a></td>
                                    </tr>
                                <?php endforeach; endif;?>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
            </form>
            <div class="row mt-5">
                <div class="col-8"><button class="btn btn-success" id="savePaperAuthors" style="max-width:200px"> Save and Continue</button></div>
            </div>
        </div>
    </div>
</main>

<?= view('event/common/searchAuthorModal'); ?>
<?= view('event/common/addAuthorModal'); ?>
<?= view('event/common/addInstitutionModal'); ?>
<script>
    let current_user_id = "<?=session('user_id')?>"
    let basic_science_format_status = "<?= !empty($paper) && $paper['basic_science_format'] == 'Yes' ? 1 : 0?>"
    let disclosure_current_date = `<?= $disclosure_current_date ?? ''?>`
    let previousUrl = "<?= $previous_url ?? ''?>"
    let previousPage = "<?= $previous_page ?? '' ?>"

</script>
<script>
    $(function(){
        // $(document).on('change', '.presentingAuthor', function() {
        //     let selectedPresenter = $('.presentingAuthor:checked').length; // Count checked checkboxes
        //
        //     if (selectedPresenter > 1) {
        //         toastr.info('Only one presenter is allowed.');
        //         $(this).prop('checked', false); // Uncheck the last clicked checkbox
        //     }
        // });
    })
</script>

<script>

    $(function(){
        $('.presentingAuthorSubInfo').hide();


        $('.authorList').on('change', 'input[name="presentingAuthor"]', function() {
            const isChecked = $(this).is(':checked');
            $('.presentingAuthorSubInfo').toggle(isChecked);
            if (isChecked) {
                try {
                    const authorName = $(this).attr('author_name') || '';
                    const authorSurname = $(this).attr('author_surname') || '';

                    if (!authorName || !authorSurname) {
                        console.error('Missing author name or surname attributes');
                        return;
                    }

                    const presentingAuthorFullName = `${capitalizeFirstLetter(authorName)} ${capitalizeFirstLetter(authorSurname)}`;

                    $('.presentingAuthorName').html(`<span class="text-primary">${presentingAuthorFullName}</span>`);
                    $('.cvUploadBtn').attr('presenting_author', presentingAuthorFullName);

                } catch (error) {
                    console.error('Error processing presenting author change:', error);
                    toastr.error('An error occurred while selecting the presenting author');
                }
            } else {
                // Optional: Handle the case when a presenting author is deselected
                $('.cvUploadBtn').removeAttr('presenting_author');
            }
        });

        $('input[name="is_eligible_grant"]').on('change', function(){
            if($('input[name="is_eligible_grant"]:checked').val() == '1' && $('input[name="is_presenting_student"]:checked').val() == '1'){
                $('#grantAddedInfoDiv').show();
            }else{
                $('#grantAddedInfoDiv').hide();
            }
        })

        $('input[name="is_presenting_student"]').on('change', function(){
            if($('input[name="is_eligible_grant"]:checked').val() == '1' && $('input[name="is_presenting_student"]:checked').val() == '1'){
                $('#grantAddedInfoDiv').show();
            }else{
                $('#grantAddedInfoDiv').hide();
            }
        })

        $('input[name="is_presenting_student"]').on('change', function(){
            if($('input[name="is_presenting_student"]:checked').val() == '1'){
                $('#eligibilityDiv').show();
            }else{
                $('#eligibilityDiv').hide();
            }
        })

        var lotIntitial = $('textarea[name="letter_of_intent"]').val();
        $('.letterOfIntentWordCount').text((lotIntitial !== '') ? countWords(lotIntitial) : 0);

        $('textarea[name="letter_of_intent"]').on('input change keyup load', function(){
            if($(this).val() == ''){
                $('.letterOfIntentWordCount').text(0)
            }else {
                if((countWords($(this).val())) > 400){
                    $('.letterOfIntentWordCount').addClass('text-danger')
                }else
                    $('.letterOfIntentWordCount').removeClass('text-danger')
                $('.letterOfIntentWordCount').text(countWords($(this).val()))
            }
        })

        var contributionInitial = $('textarea[name="explanation_of_contribution"]').val();
        $('.contributionWordCount').text((contributionInitial) ? countWords(contributionInitial) : 0);

        $('textarea[name="explanation_of_contribution"]').on('input change keyup load', function(){
            if($(this).val() == ''){
                $('.contributionWordCount').text(0)
            }else {
                if((countWords($(this).val())) > 200){
                    $('.contributionWordCount').addClass('text-danger')
                }else
                    $('.contributionWordCount').removeClass('text-danger')
                $('.contributionWordCount').text(countWords($(this).val()))
            }
        })
    })

    $('.cvUploadBtn').on('click', function(e){
        e.preventDefault()
        $this = $(this)
        uploadCV($this);
    })


    window.onload = function(){
        if( $('input[name="is_eligible_grant"]:checked').val() == '1' && $('input[name="is_presenting_student"]:checked').val() == '1'){
            $('#grantAddedInfoDiv').show();
        }else{
            $('#grantAddedInfoDiv').hide();
        }


        if($('input[name="is_presenting_student"]:checked').val() == '1'){
            $('#eligibilityDiv').show();
        }else{
            $('#eligibilityDiv').hide();
        }
    }

    function countWords(str) {
        str = str.replace(/<[^>]*>/g, ' ');
        // Remove leading and trailing white spaces
        str = str.trim();

        // Replace multiple spaces with a single space
        str = str.replace(/\s+/g, ' ');

        if (str === '') {
            return 0;
        }

        // Split the string by space
        var words = str.split(' ');

        // Count the number of words
        var wordCount = words.length;

        return wordCount;
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>
<script  type="text/javascript" src="<?=base_url('assets/js/author_copyright.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/js/addressAutoComplete.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/js/institution.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/js/institution_autocomplete.js')?>"></script>

