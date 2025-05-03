<link href="<?=base_url()?>/assets/css/event/landing.css" rel="stylesheet">

<?php echo view('event/common/menu'); ?>
<?php echo view('event/common/event_details'); ?>
<style>
    .header-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 3rem;
        flex-wrap: wrap;
    }
    .header-logo {
        width: 200px;
        height: auto;
        margin: 0 1rem;
    }
    .header-title {
        flex: 1;
        text-align: center;
    }

    .container-landing{
        font-size:16px
    }
</style>
<main class="light-white">
    <div class="container shadow-lg glass-container container-landing">
        <div class="card">
            <div class="container p-5 ">
                <p class="text-center mb-3 fw-bolder">PRiSM 2026 Meeting</p>
<!--                <p class="text-center fw-bolder">Fukuoka, Japan<br>February 2026</p>-->
<!--                <p class="text-center fw-bolder">Abstract Submission: May 1, 2025 – June 30, 2025</p>-->

                <div class="row mt-4">
                    <div class="text-center ">
                        <label class="alert alert-success text-center glass-content submissionBtn w-700" role="alert">
                            The submission site is now open!
                        </label>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col justify-content-center text-center ">
                        <button onClick="window.location.href='<?=base_url()?>login'" class="glass-button w-700  btn btn-primary btn-lg align-center" type="button">Please click here to submit / edit  your submission</button>
                    </div>
                </div>

                <div>
                    <p align="center"><strong>ABSTRACT SUBMISSION GUIDELINES</strong></p>
                </div>

                <p><strong>INSTRUCTIONS TO SUBMITTERS</strong></p>
                <p>The Scientific Program Committee invites you to contribute to the scientific program for the 12<sup>th</sup> Annual Meeting with this call for submissions of original scientific abstracts.</p>
                <p>Submissions must be relevant to the field of pediatric sports medicine and may cover topics including (but not limited to):</p>
                <!--                    <p>The PRiSM 11<sup>th</sup> Annual Meeting welcomes the submission of abstracts for original contribution to the field of pediatric sports medicine. To be considered for presentation, your abstract should involve or relate to a pediatric/adolescent population, either explicitly or primarily. Topics of specific interest include, but are not limited to, the following:</p>-->
                <!--                    <p>&nbsp;</p>-->
                <div class=" shadow-sm my-5">
                    <table class="table table-bordered" cellspacing="0" cellpadding="0" border="1">
                        <tbody>
                        <tr>
                            <td>Adapted Sports</td>
                            <td>Bone Injuries and Conditions</td>
                            <td>Concussion and Head Injuries</td>
                        </tr>
                        <tr>
                            <td>Diagnostic Imaging</td>
                            <td>Epidemiology and Public Health</td>
                            <td>Female Athlete</td>
                        </tr>
                        <tr>
                            <td>Illness and Injury Prevention</td>
                            <td>Joint Injuries and Conditions</td>
                            <td>Motion Analysis and Biomechanics</td>
                        </tr>
                        <tr>
                            <td>Physical Activity / Physical Literacy</td>
                            <td>Rehabilitation and Return to Sport</td>
                            <td>Social Issues in Sport</td>
                        </tr>
                        <tr>
                            <td>Soft Tissue Injuries and Conditions</td>
                            <td>Spine Injuries and Conditions</td>
                            <td>Sports Nutrition and Performance</td>
                        </tr>
                        <tr>
                            <td>Sport Specialization</td>
                            <td>Sport Psychology / Mental Health</td>
                            <td>Treatment Techniques and Outcomes</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p>Notifications of acceptance will be delivered to submitting authors via email before October 11th. Thank you for your patience.  The Scientific Program Committee reserves the right to decline any abstract that does not meet all submission requirements.</p>

                <br>
                <!--                    <p><strong>ABSTRACT SUBMISSION GUIDELINES</strong></p><br>-->
                <!--                    <ul>-->
                <!--                        <li>All submitters MUST begin by creating a new account.</li>-->
                <!--                        <li>For each author you will need: full name, designation/degree, email, and institution/affiliation name.</li>-->
                <!--                        <li>Please ensure all email addresses for all participants are correct.</li>-->
                <!--                        <li>For technical assistance, please click on the &apos;Support Form&apos; icon located on the top right hand of each page for support. Support requests are answered within a 24-hour period.</li>-->
                <!--                        <li>Browser back and forward arrows have been disabled. Users must use the page progress bar located at the top left of each page.</li>-->
                <!--                        <li>Submitters may revisit the site as often as necessary to edit the submission (finalized or not) at any time before the submission deadline.</li>-->
                <!--                        <li>Please use one of the following browsers: Mozilla Firefox 4+, Safari 5+, Chrome 14+, or Edge. We do not recommend Internet Explorer.</li>-->
                <!--                        <li>Inactivity of more than 90 minutes on system pages will result in a session time out. Please save your pages intermittently to avoid loss of data.</li>-->
                <!--                        <li><strong>Please note</strong>: In order to successfully receive emails regarding your submission, you must add &apos;@owpm2.com&apos; as a safe sender in your email client. <a href="https://speakerready.com/abstracts/safe_sender_how_to.pdf" target="_blank">Click here</a> for help adding safe senders. Mail client examples include Microsoft Outlook, IBM Lotus Notes, Pegasus Mail, Mozilla&apos;s Thunderbird.</li>-->
                <!--                    </ul>-->
                <!--                    <p><strong></strong></p>-->

                <!--                    <p>Please review this information carefully and submit your abstract in accordance with these guidelines.</p>-->
                <p>The PRiSM Scientific Program Committee reserves the right to decline any abstract that does not meet the requirements outlined below.&nbsp;</p>
                <p>&nbsp;</p>
                <p><strong>Abstract Submission Deadline</strong></p>
                <p>The deadline for abstract submission for the PRiSM 12<sup>th</sup> Annual Meeting is <strong>Monday</strong><strong>, July 8, 2024 at 5 pm ET.&nbsp;</strong></p>
                <p>&nbsp;</p>
                <p><strong>ABSTRACT SUBMISSION GUIDELINES</strong></p><br>
                <ol>
                    <li>Abstracts must be written in English.</li>
                    <li>Abstract titles must be written in ALL CAPITAL letters.</li>
                    <li>Abstracts are limited to 400 words (including the headings Background, Hypothesis, Methods, Results, and Conclusions). Author names and affiliate institutions are not included in the word count. </li>
                    <li>Generic drug and device names may be used, but commercial (product and/or brand) drug and device names are not permitted in the abstract or presentation. </li>
                    <li>Abstract submissions may be edited until the abstract submission deadline of July 8, 2024.</li>
                    <li>All abstracts submitted must be original science, not previously presented as peer-reviewed original material at any other regional, national, or international scientific conference.</li>
                    <li>Abstracts derived from articles published before the submission deadline are not eligible for presentation at the PRiSM Annual Meeting.</li>
                    <li>The Scientific Program Committee will make the final decision as to an abstract’s acceptance and presentation format (podium, poster, or e-poster).</li>
                    <li>There is no limit to the number of abstracts an author can submit, but presenters are limited to two (2) podium presentations and one (1) poster presentation at the 2025 Annual Meeting. </li>
                    <li>You may upload two associated jpg files that are 750 pixels wide. If you have no images to include then proceed to option two. Image Requirements: JPEG only and 750 pixels wide.</li>
                </ol>

                <br>
                <p><strong>ABSTRACT SUBMISSION PROCESS</strong></p>
                <p>Abstracts will be submitted online.</p>
                <p>Abstracts will be submitted online in a text box, with only the body of the abstract included (no author names or institutions). It is very important that you only submit the body of the abstract in the text box, as this will be used for the blinded review process. You may upload two associated jpg files that are 750 pixels wide. Any graphic tables need to be saved as jpgs.</p>

                <br>

                <!--                    <div class="row">-->
                <!--                        <a href="--><?php //=base_url()?><!--/--><?php //=$event->uri?><!--/login">-->
                <!--                            <div class="d-grid gap-2">-->
                <!--                                <button class="btn btn-primary btn-lg" type="button">Submit Or Update Abstract</button>-->
                <!--                            </div>-->
                <!--                        </a>-->
                <!--                    </div>-->
                <!--                    <br>-->


                <p><strong>ABSTRACT REVIEW AND SELECTION</strong></p>
                <p>A multi-disciplinary panel of PRiSM members will blindly review and score each abstract submission. Average numerical scores are used to inform the committee’s acceptance decisions. Abstracts are scored based on the following criteria:</p>

                <ul>
                    <li>Scientific quality and objectivity</li>
                    <li>Topic originality and desirability</li>
                    <li>Writing clarity and organization</li>
                    <li>Subject matter relevance and contribution to pediatric sports medicine </li>
                </ul>

                <p>The Scientific Program Committee will issue acceptance notifications via email in September 2024.</p>
                <p>The presenting author for podium and poster presentations must register, pay all applicable registration fees, and attend the 12<sup>th</sup> Annual Meeting.</p>
                <br>
                <p><strong>ABSTRACT AWARDS</strong></p>
                <p>Abstracts accepted for presentation at the 12<sup>th</sup> Annual Meeting may qualify for the following awards:</p>
                <ul>
                    <li>Hank Chambers Award for Best Scientific Presentation</li>
                    <li>Kevin G. Shea Award for Best Scientific Poster</li>
                    <li>Mininder S. Kocher Award for Most Promising Career</li>
                    <li>Inclusion and Equity Award</li>
                </ul>

                <p><strong>TRAINEE TRAVEL GRANT AWARDS</strong></p>
                <p>The PRiSM Annual Meeting is an opportunity for researchers and clinicians from varied professional backgrounds to come together to present and discuss a wide variety of pediatric sports medicine topics.
                    The PRiSM Trainee Travel Grant Awards provide trainees across multiple disciplines with the opportunity to present their research to meeting attendees during a dedicated scientific session.
                    Additionally, award recipients will receive complimentary registration to the 12<sup>th</sup> Annual Meeting and reimbursement of travel and lodging expenses (up to $1000.00).
                    <a href="<?=base_url().'assets/documents/2024_Travel_Grant_Instructions.pdf'?>" target="_blank">Click here for Trainee Travel Grant Instructions.</a></p>
                <p class="xmsonormal">The Trainee Travel Grant Awards are made possible through a NIH R13 grant that aims to foster an environment of collaboration among a diverse set of students and trainees involved in pediatric sports medicine research.</p>

                <p><strong>Award Eligibility Requirements </strong></p>
                <p>To qualify for these awards, trainees must be enrolled in an academic or clinical training program that involves pediatric sports medicine research.
                    Additionally, applicants must be an active PRiSM member or have submitted a membership application. </p>

                <p><strong>Award Application Submission Process </strong></p>
                <p>The Trainee Travel Grant Award application is part of the abstract submission process. If you indicate that you are a trainee, you will be prompted to complete the award application. Please read the instructions carefully before completing the application and answer all questions.
                    Inquiries about this application may be addressed to the PRiSM Society’s administrative staff at <a href="mailto:info@prismsports.org">info@prismsports.org</a>.</p>

                <p><strong>Along with all abstract submissions, Trainee Travel Grant Award applications are due July 8, 2024.</strong> All applications will be reviewed and scored by the Scientific Program Committee. Notifications of acceptance will be delivered to submitting authors via email in September 2024.</p>

                <p><strong>Award Selection Criteria </strong></p>
                <p>A multi-disciplinary panel of PRiSM members will blindly review and score each Trainee Travel Grant Award application with the goal of optimizing the diversity of presenters at the PRiSM Annual Meeting.
                    Award scoring is based upon the overall merit of the application (as outlined in the abstract guidelines above) and the following applicant-specific criteria used to help identify
                    underrepresented persons in science and medicine:</p>

                <ul>
                    <li>Academic degree and/or clinical specialty</li>
                    <li>Number of years in training</li>
                    <li>Type of training</li>
                    <li>Geographic location</li>
                    <li>Financial need</li>
                    <li>Race/Ethnicity</li>
                    <li>Gender</li>
                    <li>Sexual Orientation</li>
                </ul>

                <p>Please use <a href="https://diversity.nih.gov/about-us/population-underrepresented" target="_blank">this link</a> to access additional information about underrepresented persons in science and medicine as defined by the National Institutes of Health. </p>

                <div class="text-center"><h1>All submissions are due Monday, July 8, 2024. </h1></div>

                <div class="row mt-4">
                    <div class="text-center ">
                        <label class="alert alert-success text-center glass-content submissionBtn w-700" role="alert">
                            The submission site is now open!
                        </label>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col justify-content-center text-center ">
                        <button onClick="window.location.href='<?=base_url()?>login'" class="glass-button w-700  btn btn-primary btn-lg align-center" type="button">Please click here to submit / edit  your submission</button>
                    </div>
                </div>

                <div>
                    <h6>QUESTIONS?</h6>
                    <p>For further instructions and details on abstract submission, please click <a href="">here</a>.</p>
                    <p>For questions regarding your submission or technical issues, please contact <a href="education@srs.org">education@srs.org</a> </p>
                </div>
            </div>


        </div>
    </div>
</main>