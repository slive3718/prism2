
<!--<script  type="text/javascript" src="--><?php //=base_url('assets/js/submissionFunction.js?v=4')?><!--"></script>-->


<?php echo view('event/common/menu'); ?>
<?php echo view('event/common/event_details'); ?>
<?php // print_R($paper);exit;?>
<main>
    <div class="container pb-5">
        <?php echo view('event/common/shortcut_link'); ?>
        <div class="card p-lg-5 p-md-2 p-sm-1 p-xs-1 shadow">
            <?php
            if (session('user_type') == 'admin' && !empty($paper_id)) {
                $actionUrl = base_url('admin/update_abstract_ajax');
            } elseif (!empty($paper_id)) {
                $actionUrl = base_url('user/update_paper_ajax');
            } else {
                $actionUrl = base_url('user/submit_paper_ajax');
            }
            ?>

            <form id="abstractSubmissionForm"  action="<?= $actionUrl ?>" method="post">
                <input type="hidden" value="<?=(isset($paper_id) && !empty($paper_id))? $paper_id : ''?>" name="paper_id">
                <div class="row">
                    <div class="col mt-4">
                        <div id="questionDiv_division">
                            <h5 class="title">
                                <span class="text-danger">*</span>
                                Session Types
                            </h5>
                            <strong class="fw-bolder">All completed abstract submissions will be reviewed and considered for all session types.</strong>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 1: Previous Presentation ############### -->


<!--                <div class="row previous-presentation">
                    <div class="col mt-4">
                        <div id="previous-presentation-container">
                            <h5 class="title">
                                <span class="text-danger">*</span>
                                Previous Presentation
                            </h5>
                            <p>Was this paper previously presented at an SRS IMAST or Annual Meeting?</p>
                            <input type="radio" name="previous_presentation" id="previous_presentation_yes" value="Yes" class="form-input" <?php /*=(!empty($paper) && $paper['previous_presentation'] == "Yes" ? 'checked' : '')*/?>>
                            <label for="previous_presentation_yes"> Yes, this paper has previously been presented at SRS IMAST or Annual Meeting </label> <br>
                            <input type="radio" name="previous_presentation" id="previous_presentation_no" value="No" class="form-input" <?php /*=(!empty($paper) && $paper['previous_presentation'] == "No" ? 'checked' : '')*/?>>
                            <label for="previous_presentation_no"> No, this paper has not been previously presented at SRS IMAST or Annual Meeting </label>
                        </div>
                    </div>
                </div>-->

                <!-- ##########   Question 2: Basic Science Proposal Format ############### -->
                <div class="row basic-science-format">
                    <div class="col mt-4">
                        <div id="basic-science-format-container">
                            <h5 class="title">
                                <span class="text-danger">*</span>
                                This Abstract is:
                            </h5>
                            <input type="radio" name="basic_science_format" id="basic_science_format_yes" value="Yes" <?=(!empty($paper) && $paper['basic_science_format'] == "Yes" ? 'checked' : '')?>>
                            <label for="basic_science_format_yes"> Quantitative</label> <br>
                            <input type="radio" name="basic_science_format" id="basic_science_format_no" value="No" <?=(!empty($paper) && $paper['basic_science_format'] == "No" ? 'checked' : '')?>>
                            <label for="basic_science_format_no"> Qualitative</label>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 3: Abstract Category ############### -->
<!--                <div class="row abstract-category">-->
<!--                    <div class="col mt-4">-->
<!--                        <div id="abstract-category-container">-->
<!--                            <h5 class="title">-->
<!--                                <span class="text-danger">*</span>-->
<!--                                Abstract Category-->
<!--                            </h5>-->
<!--                            <label for="abstract_category">Please choose a category:</label>-->
<!--                            <select name="abstract_category" id="abstract_category" class="form-control">-->
<!--                                <option id="abstract_category_default" value=""> -- Select Category --</option>-->
<!--                                --><?php //if(!empty($categories)): ?>
<!--                                    --><?php //foreach ($categories as $category) : ?>
<!--                                        <option id="abstract_category_--><?php //=$category['category_id']?><!--" value="--><?php //=$category['category_id']?><!--" --><?php //=(!empty($paper) && $paper['abstract_category'] == $category['category_id'] ? 'selected' : '')?><!--  >--><?php //=$category['name']?><!--</option>-->
<!--                                    --><?php //endforeach; ?>
<!--                                --><?php //endif ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="mt-4 primary_topic">
                    <h5 class="fw-bolder">Primary Topic (please select 1)</h5>
                    <?php if (isset($abstract_topics)): ?>
                        <?php foreach($abstract_topics as $topics): ?>
                            <div class="form-check">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" name="primary_topic[]" value="<?= $topics['value'] ?>"
                                        <?= isset($paper['primary_topic'])  && in_array($topics['value'], json_decode($paper['primary_topic'], true) ?: []) ? 'checked' : ''; ?>>
                                    <?= $topics['name'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php endif ?>
                    <div class="otherPrimaryTopicDiv" style="display: <?= (isset($paper) && $paper['primary_topic'] && in_array(26, json_decode($paper['primary_topic'] ?? []))) ? 'block' : 'none' ?>">
                        <label for="otherPrimaryTopic">Other Primary Topic</label>
                        <input type="text" class="form-control" name="other_primary_topic" id="otherPrimaryTopic" value="<?= isset($paper) ? $paper['other_primary_topic'] : '' ?>">

                    </div>
                </div>

                <div class="mt-4 secondary_topic">
                    <h5 class="fw-bolder">Secondary Topic (please select 1)</h5>
                    <?php if (isset($abstract_topics)): ?>
                        <?php foreach($abstract_topics as $topics): ?>
                            <div class="form-check">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" name="secondary_topic[]" value="<?= $topics['value'] ?>"
                                        <?= isset($paper['secondary_topic']) && in_array($topics['value'], json_decode($paper['secondary_topic'], true) ?: []) ? 'checked' : ''; ?>>
                                    <?= $topics['name'] ?>
                                </label>
                            </div>

                        <?php endforeach; ?>
                    <?php endif ?>
                    <div class="otherSecondaryTopicDiv" style="display:  <?= (isset($paper) && $paper['primary_topic'] && in_array(26, json_decode($paper['primary_topic'] ?? []))) ? 'block' : 'none' ?>">
                        <label for="otherSecondaryTopic">Other Secondary Topic</label>
                        <input type="text" class="form-control" name="other_secondary_topic" id="otherSecondaryTopic" value="<?= isset($paper) ? $paper['other_secondary_topic'] : '' ?>">

                    </div>
                </div>

                <!-- ##########   Abstract Body Section ############### -->
                <div class="row abstract-body">
                    <div class="col mt-4">
                        <div id="abstract-body-container">
                            <h5 class="title">
                                <span class="text-danger">*</span>
                                Abstract Body
                            </h5>
                            <p>Abstract body is limited to 400 words which includes a Background, Hypothesis, Methods, Results and Conclusion.</p>
                            <div class="text-center m-auto p-4" style="width: 600px; border:4px dotted black">
                                Total Abstract Body Count: <span id="abstract_body_count">0 characters</span> <br>
<!--                                --><?php //if(!empty($paper) && trim($paper['image_caption']) !== ''): ?>
<!--                                Image Caption Body Count: <span id="image_caption_body_count" >0 characters</span><br>-->
<!--                                --><?php //endif ?>
                                Limit: 400
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 4: Abstract Title ############### -->
                <div class="row abstract-title">
                    <div class="col mt-4">
                        <div id="abstract-title-container">
                            <h5 class="title">
                                <span class="text-danger">*</span>
                                Abstract Title
                            </h5>
                            <p>Abstract titles must be written in ALL CAPITAL letters.</p>
                            <label for="abstract_title"> <span class="text-success">CORRECT </span> - THIS IS THE TITLE OF MY ABSTRACT</label>
                            <textarea name="abstract_title" id="abstract_title" class="form-control mt-2" rows="1" placeholder="Abstract Title" ><?=(!empty($paper) ? $paper['title'] : '')?></textarea>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 6: Study Design ############### -->
                <div class="row study-design">
                    <div class="col mt-4">
                        <div id="study-design-container">
                            <label for="study_design" class="title">
                                <span class="text-danger">*</span>
                                Background
                            </label>
                            <textarea name="study_design" id="study_design" class="form-control countWords" rows="4" placeholder="Describe the study design..."><?=(!empty($paper) ? $paper['study_design'] : '')?></textarea>
                             <label class="counted_words fw-bolder"></label>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 5: Hypothesis ############### -->
                <div class="row hypothesis">
                    <div class="col mt-4">
                        <div id="hypothesis-container">
                            <label for="hypothesis" class="title">
                                <span class="text-danger">*</span>
                                Hypothesis
                            </label>
                            <textarea name="hypothesis" id="hypothesis" class="form-control countWords" rows="4" placeholder="Enter your hypothesis..."><?=(!empty($paper) ? $paper['hypothesis'] : '')?></textarea>
                             <label class="counted_words fw-bolder"></label>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 8: Methods ############### -->
                <div class="row methods">
                    <div class="col mt-4">
                        <div id="methods-container">
                            <label for="methods" class="title">
                                <span class="text-danger">*</span>
                                Methods
                            </label>
                            <textarea name="methods" id="methods" class="form-control countWords" rows="4" placeholder="Explain the methods used..."><?=(!empty($paper) ? $paper['methods'] : '')?></textarea>
                             <label class="counted_words fw-bolder"></label>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 9: Results ############### -->
                <div class="row results">
                    <div class="col mt-4">
                        <div id="results-container">
                            <label for="results" class="title">
                                <span class="text-danger">*</span>
                                Results
                            </label>
                            <textarea name="results" id="results" class="form-control countWords" rows="4" placeholder="Summarize the results..."><?=(!empty($paper) ? $paper['results'] : '')?></textarea>
                             <label class="counted_words fw-bolder"></label>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 10: Conclusions ############### -->
                <div class="row conclusions">
                    <div class="col mt-4">
                        <div id="conclusions-container">
                            <label for="conclusions" class="title">
                                <span class="text-danger">*</span>
                                Conclusions
                            </label>
                            <textarea name="conclusions" id="conclusions" class="form-control countWords" rows="4" placeholder="Provide the conclusions..."><?=(!empty($paper) ? $paper['conclusions'] : '')?></textarea>
                             <label class="counted_words fw-bolder"></label>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 7: Introduction ############### -->
                <div class="row introduction">
                    <div class="col mt-4">
                        <div id="introduction-container">
                            <label for="introduction" class="title">
                                <span class="text-danger">*</span>
                                Reference
                            </label>
                            <textarea name="introduction" id="introduction" class="form-control" rows="4" placeholder="Write the introduction..."><?=(!empty($paper) ? $paper['introduction'] : '')?></textarea>
                        </div>
                    </div>
                </div>

                <!-- ##########   Question 11: Additional Notes ############### -->
<!--                <div class="row additional-notes">-->
<!--                    <div class="col mt-4">-->
<!--                        <div id="additional-notes-container">-->
<!--                            <label for="additional_notes" class="title">-->
<!--                                Additional Notes-->
<!--                            </label>-->
<!--                            <textarea name="additional_notes" id="additional_notes" class="form-control" rows="4" placeholder="Enter any additional notes...">--><?php //=(!empty($paper) ? $paper['additional_notes'] : '')?><!--</textarea>-->
<!--                            <label class="counted_words fw-bolder"></label> -->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

                <!-- ##########   Question 11: Image Caption : for counting purposes only ############### -->
<!--                <div class="row image_caption" style="display: none">-->
<!--                    <div class="col mt-4">-->
<!--                        <div id="image-caption-container">-->
<!--                            <textarea name="image_caption" id="image_caption" class="form-control countWordsCaption" rows="4" placeholder="Enter any additional notes...">--><?php //=(!empty($paper) ? $paper['image_caption'] : '')?><!--</textarea>-->
<!--                            <label class="counted_words_caption fw-bolder"></label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->


                <!--<div>
                    <label class="title mt-4">Image/Table Caption</label>
                    <p>If you are adding an image Or table to your abstract submission, the caption for this will count to your total 2500 characters. Please add your caption on the upload page you have <span id="remaining_caption_count" class="fw-bolder">0</span>/2500 characters left for your caption.</p>
                </div>-->

                <div class="mt-4">
                    <h5 class="fw-bold"><required class="text-danger">*</required> Inclusion and Equity Award</h5>
                    <p>Does this abstract meet any of the following diversity award requirements?</p>
                    <ul style="list-style-type: lower-alpha">
                        <li>Identify, analyze or seek solution for healthcare disparities</li>
                        <li>Focus on underserved, underrepresented or understudied populations; or</li>
                        <li>Promote the values of diversity, inclusion and equity as prioritize by the PRiSM Board of Directors and Diversity Committee</li>
                    </ul>
                    <div class="form-group">
                        <input type="radio" class="form-check-input" name="diversity"  value="yes" id="diversity_yes" <?=(isset($paper)? ($paper['diversity'] == 'yes')? 'checked':'':'' )?>><label for="diversity_yes">Yes</label>
                        <input type="radio" class="form-check-input ms-5" name="diversity" value="no" id="diversity_no" <?=(isset($paper)? ($paper['diversity'] == 'no')? 'checked':'':'' )?>><label for="diversity_no">No</label>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold"><required class="text-danger">*</required> Abstract Award </h5>
                    <p>This abstract focuses on:</p>

                    <div class="form-check">
                        <input type="radio" class="form-check-input form-inline" name="award_information" value="msk" id="MSK"
                            <?= isset($paper) && $paper['award_information'] === 'msk' ? 'checked' : '' ?>>
                        <label for="msk" class="form-check-label">
                            <strong>Diagnosis, Treatment, Management of Medical Conditions (MSK rad/US)</strong>
                            Abstracts related to diagnosis of a condition (including radiologic studies), medical treatments, non-surgical management of injuries, outcomes.
                            Includes concussion (as it relates to diagnosis, treatment, management), bone health, rehab (from a non-surgical treatment)
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="award_information" value="surgical" id="surgical"
                            <?= isset($paper) && $paper['award_information'] === 'surgical' ? 'checked' : '' ?>>
                        <label for="surgical" class="form-check-label">
                            <strong>Surgical Treatments and Outcomes (pain mgmt, rehab, technique/cadaver)</strong>
                            Surgical treatments and any topic relating to surgical management, such as pain management, rehabilitation after surgery, technique papers, and cadaver studies
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="award_information" value="injury" id="injury"
                            <?= isset($paper) && $paper['award_information'] === 'injury' ? 'checked' : '' ?>>
                        <label for="injury" class="form-check-label">
                            <strong>Injury Prevention and Motion Analysis</strong>
                            Abstracts related to injury prevention strategies, sports specialization, motion analysis
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="award_information" value="mental" id="mental"
                            <?= isset($paper) && $paper['award_information'] === 'mental' ? 'checked' : '' ?>>
                        <label for="mental" class="form-check-label">
                            <strong>Mental Health and Wellness</strong>
                            Abstracts related to patient and athlete mental health, sleep, identity, wellness
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="award_information" value="n/a" id="not_applicable"
                            <?= isset($paper) && $paper['award_information'] === 'n/a' ? 'checked' : '' ?>>
                        <label for="not_applicable" class="form-check-label">
                            <strong>Not Applicable</strong>
                        </label>
                    </div>
                </div>

                <div class="mt-5">
                    <p>Abstracts accepted for presentation at the Annual Meeting may qualify for the following awards:</p>
                    <ul>
                        <li>Hank Chambers: Best Scientific Presentation</li>
                        <li>Kevin Shea: for Best Scientific Poster</li>
                        <li>Mininder Kocher: Most Promising Career</li>
                        <li>Cordelia Carter: Inclusion and Equity Award</li>
                    </ul>
                </div>


                <hr>
                <hr>
                <div class="row">
                    <div class="col">
                        <?php if(isset($is_edit) && $is_edit == 1): ?>
                            <div>
                                <input type="submit" id="updatePapers" value="Save" class="btn btn-primary">
                                <input type="submit" id="updateContinuePapers" value="Save and Continue" class="btn btn-primary">
                            </div>
                        <?php else:?>
                            <div>
                                <input type="submit" id="savePapers" value="Save" class="btn btn-primary">
                                <input type="submit" id="saveContinuePapers" value="Save and Continue" class="btn btn-primary">
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </form>
<!--            #########################           -->
        </div>
    </div>
</main>
<script src="<?=base_url()?>assets/js/helpers.js"></script>
<script>
    let totalWordsCount = 0;
    let userID = `<?=session('user_id')??''?>`;
    let previousUrl = "<?= $previous_url ?? ''?>"
    let previousPage = "<?= $previous_page ?? '' ?>"

    let topic1_limit = 1;
    let topic2_limit = 1;
    let population_limit = 2;

    $(function(){
        // $('.summernote').summernote({
        //     tabsize: 2,
        //     height: 120,
        //     toolbar: [
        //         ['font', ['bold', 'italic', 'underline', 'clear', 'superscript', 'subscript']],
        //     ]
        //     ,callbacks: {
        //         onKeyup: function(e) {
        //             let idProp = $(this).attr('id');
        //             let limit =  $(this).attr('limit');
        //             if( parseInt(countWords($(this).val())) > parseInt(limit) ){
        //                 $('#'+idProp+'WordsCountExceeded').removeClass('d-none').html(limit+' words limit exceeded!!')
        //             }else{
        //                 $('#'+idProp+'WordsCountExceeded').addClass('d-none').html('')
        //             }
        //             $('#'+idProp+'WordsCount').html(countWords($(this).val()))
        //             $('#totalWordsCount').html(countTotalWords())
        //         }
        //     },
        //     disableEnter: true,
        //     enterHtml: '',
        // });

        abstract_body_counter();


        $('.primary_topic input[type=checkbox]').on('change', function (e) {
            if ($('.primary_topic input[type=checkbox]:checked').length > topic1_limit) {
                $(this).prop('checked', false);
                swal.fire(
                    'Please note',
                    'Please choose one item per topic',
                    'warning'
                )
            }
        });

        $('.secondary_topic input[type=checkbox]').on('change', function (e) {
            if ($('.secondary_topic input[type=checkbox]:checked').length > topic2_limit) {
                $(this).prop('checked', false);
                swal.fire(
                    'Please note',
                    'Please choose one item per topic',
                    'warning'
                )
            }
        });

        $("input[name='primary_topic[]']").on('change', function() {
            if ($(this).val() == '26' && $(this).is(':checked')) {
                $('.otherPrimaryTopicDiv').css('display', 'block');
            } else {
                $('.otherPrimaryTopicDiv').css('display', 'none');
            }
        });


        $("input[name='secondary_topic[]']").on('change', function() {
            if ($(this).val() == '26' && $(this).is(':checked')) {
                $('.otherSecondaryTopicDiv').css('display', 'block');
            } else {
                $('.otherSecondaryTopicDiv').css('display', 'none');
            }
        });

        $("input[name='primary_topic[]").change();
        $("input[name='secondary_topic[]").change();
    })


    function abstract_body_counter(){
        WordCounterHelper.init(
            'textarea.countWords',  // Textarea selector
            '.counted_words',       // Word count display
            '#abstract_body_count' // Total word count display
        );

        WordCounterHelper.init(
            'textarea.countWordsCaption',  // Textarea selector
            '.counted_words_caption',       // Word count display
            '#image_caption_body_count' // Total word count display
        );


        $('textarea.countWords').on('input', function(){
            let total_body_count = parseInt($('#abstract_body_count').text())
            let remaining = 400 - total_body_count;
            $('#remaining_caption_count').text(remaining)
        })


        $('textarea.countWords').on('input', function(){
            let abstract_body_count = $('#abstract_body_count').text();
            let image_caption_body_count = $('#image_caption_body_count').text();

            if(parseInt(abstract_body_count) + parseInt(image_caption_body_count) > 400){
                toastr.error('Total of description already exceed 400 words!')
                $('#abstract_body_count').closest('div').addClass('text-danger')
                $('#abstract_body_count').closest('div').removeClass('text-success')
            }else{
                $('#abstract_body_count').closest('div').addClass('text-success')
                $('#abstract_body_count').closest('div').removeClass('text-danger')
            }
        })

        $('textarea.countWords').trigger('input');
        $('textarea.countWordsCaption').trigger('input');
    }


</script>
