<link href="<?=base_url()?>/assets/css/event/landing.css" rel="stylesheet">

<?php echo view('event/common/menu'); ?>
<?php echo view('event/common/event_details'); ?>
<style>
    body {
        line-height: 1.6;
    }
    .topic-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin: 20px 0;
    }
    .topic-item {
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    .deadline-box {
        background-color: #e9ecef;
        padding: 20px;
        border-radius: 5px;
        margin: 20px 0;
    }
    .award-card {
        margin-bottom: 15px;
    }
    .guideline-list {
        counter-reset: guideline-counter;
        list-style-type: none;
        padding-left: 0;
    }
    .guideline-list li {
        counter-increment: guideline-counter;
        margin-bottom: 10px;
        padding-left: 30px;
        position: relative;
    }
    .guideline-list li:before {
        content: counter(guideline-counter) ".";
        position: absolute;
        left: 0;
        font-weight: bold;
    }
    /* Enhanced Typography & Styling */
    :root {
        --light: #11659b;
        --primary: #105174;
        --secondary: #024464;
        --accent: #e74c3c;
        --light-bg: #f8f9fa;
        --dark-text: #2c3e50;
        --muted-text: #7f8c8d;
    }

    .btn-login{
        background-color: var(--light);
        color: var(--light-bg);
        border: 4px  #dd4814;
    }

    .btn-login:hover{
        background-color: var(--light);
        color: var(--light-bg);
        transform: translateY(-10px);
    }

    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.7;
        color: var(--dark-text);
        background-color: #fff;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Montserrat', 'Helvetica Neue', Arial, sans-serif;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1.2rem;
    }

    h1 {
        font-size: 2.5rem;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    h2 {
        font-size: 2rem;
        border-bottom: 2px solid var(--secondary);
        padding-bottom: 0.5rem;
        display: inline-block;
    }

    h3 {
        font-size: 1.75rem;
        color: var(--secondary);
    }

    a {
        color: var(--secondary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    a:hover {
        color: var(--accent);
        text-decoration: underline;
    }

    /* Header Styling */
    header {
        padding: 3rem 0;
        background: linear-gradient(90deg,rgba(0, 66, 98, 1) 0%, rgba(87, 150, 199, 1) 50%, rgba(0, 66, 98, 1) 100%);
        color: white;
        margin-bottom: 2rem;
        border-radius: 10px;
    }

    header h1 {
        color: white;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }

    header h2 {
        color: rgba(255,255,255,0.9);
        border-bottom: none;
    }

    /* Topic Grid Enhancement */
    .topic-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
        margin: 2rem 0;
    }

    .topic-item {
        padding: 15px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 4px solid var(--secondary);
        font-weight: 500;
    }

    .topic-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Deadline Box Styling */
    .deadline-box {
        background: linear-gradient(to right, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
        border-radius: 10px;
        margin: 2.5rem 0;
        border-left: 5px solid var(--accent);
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .deadline-box h4 {
        color: var(--accent);
        font-size: 1.5rem;
    }

    .deadline-box .lead {
        font-size: 1.3rem;
        font-weight: 500;
    }

    /* Guidelines List Styling */
    .guideline-list {
        counter-reset: guideline-counter;
        list-style-type: none;
        padding-left: 0;
        margin: 2rem 0;
    }

    .guideline-list li {
        counter-increment: guideline-counter;
        margin-bottom: 1.2rem;
        padding-left: 3rem;
        position: relative;
        font-size: 1.05rem;
    }

    .guideline-list li:before {
        content: counter(guideline-counter) ".";
        position: absolute;
        left: 0;
        font-weight: bold;
        color: var(--secondary);
        font-size: 1.2rem;
        top: 0;
    }

    /* Card Enhancements */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: var(--secondary);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 1.2rem;
    }

    .card-header h4 {
        color: white;
        margin-bottom: 0;
    }

    .award-card {
        height: 100%;
        border-left: 4px solid var(--primary);
    }

    .award-card .card-title {
        color: var(--primary);
        font-size: 1.2rem;
    }

    .award-card .card-text {
        color: var(--muted-text);
    }

    /* Button Styling */
    .btn-outline-primary {
        border-color: var(--secondary);
        color: var(--secondary);
    }

    .btn-outline-primary:hover {
        background-color: var(--secondary);
        border-color: var(--secondary);
    }

    /* Footer Styling */
    footer {
        background-color: var(--primary);
        color: white;
        padding: 2rem;
        border-radius: 10px;
        margin-top: 3rem;
    }

    footer .lead {
        color: white;
        font-weight: 500;
        margin-bottom: 0;
    }

    .landing-footer{
        background-color: var(--primary);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.7rem;
        }

        .topic-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }

        .guideline-list li {
            padding-left: 2.5rem;
        }
    }
</style>
<main class="light-white">
    <div class="container py-4 shadow-lg glass-container container-landing">
        <header class="text-center mb-5">
            <h1 class="display-4">ABSTRACT SUBMISSION GUIDELINES</h1>
            <h2 class="">PRiSM 13<sup>th</sup> Annual Meeting</h2>
        </header>

        <div class="m-auto text-center mb-5">
            <a href="<?=base_url()?>/login">
            <button class="btn btn-lg w-75 m-auto p-4 fw-bolder btn-login shadow-lg" type="button">Submit Or Update Abstract</button>
            </a>
        </div>

        <section class="mb-5">
            <h3 class="mb-3">INSTRUCTIONS TO SUBMITTERS</h3>
            <p>The Scientific Program Committee invites you to contribute to the scientific program for the 13<sup>th</sup> Annual Meeting with this call for submissions of original scientific abstracts.</p>
            <p>Submissions must be relevant to the field of pediatric sports medicine and may cover topics including (but not limited to):</p>

            <div class="topic-grid">
                <div class="topic-item">Adapted Sports</div>
                <div class="topic-item">Bone Injuries and Conditions</div>
                <div class="topic-item">Concussion and Head Injuries</div>
                <div class="topic-item">Diagnostic Imaging</div>
                <div class="topic-item">Epidemiology and Public Health</div>
                <div class="topic-item">Female Athlete</div>
                <div class="topic-item">Illness and Injury Prevention</div>
                <div class="topic-item">Joint Injuries and Conditions</div>
                <div class="topic-item">Motion Analysis and Biomechanics</div>
                <div class="topic-item">Physical Activity / Physical Literacy</div>
                <div class="topic-item">Rehabilitation and Return to Sport</div>
                <div class="topic-item">Social Issues in Sport</div>
                <div class="topic-item">Soft Tissue Injuries and Conditions</div>
                <div class="topic-item">Spine Injuries and Conditions</div>
                <div class="topic-item">Sports Nutrition and Performance</div>
                <div class="topic-item">Sport Specialization</div>
                <div class="topic-item">Sport Psychology / Mental Health</div>
                <div class="topic-item">Treatment Techniques and Outcomes</div>
            </div>

            <p class="mt-3">Notifications of acceptance will be delivered to submitting authors via email by <strong>October 15, 2025.</strong> Thank you for your patience. The PRiSM Scientific Program Committee reserves the right to decline any abstract that does not meet the requirements outlined below.</p>
        </section>

        <section class="mb-5">
            <div class="deadline-box">
                <h4 class="text-center">Abstract Submission Deadline</h4>
                <p class="text-center lead">The deadline for abstract submission for the PRiSM 13<sup>th</sup> Annual Meeting is <strong>Monday, June 30, 2025 at 5 pm ET.</strong></p>
            </div>
        </section>

        <section class="mb-5">
            <h3 class="mb-3">ABSTRACT SUBMISSION GUIDELINES</h3>
            <ol class="guideline-list">
                <li>Abstracts must be written in English.</li>
                <li>Abstract titles must be written in ALL CAPITAL letters.</li>
                <li>Abstracts are limited to 400 words (including the headings Background, Hypothesis, Methods, Results, and Conclusions). Author names and affiliate institutions are not included in the word count.</li>
                <li>Generic drug and device names may be used, but commercial (product and/or brand) drug and device names are not permitted in the abstract or presentation.</li>
                <li>Abstract submissions may be edited until the abstract submission deadline of <strong>Monday, June 30, 2025</strong>.</li>
                <li>All abstracts submitted must be original science, not previously presented as peer-reviewed original material at any other regional, national, or international scientific conference.</li>
                <li>Abstracts derived from articles published before the submission deadline are not eligible for presentation at the PRiSM Annual Meeting.</li>
                <li>The Scientific Program Committee will make the final decision as to an abstract's acceptance and presentation format (podium, poster, or e-poster).</li>
                <li>There is no limit to the number of abstracts an author can submit, but presenters are limited to one (1) podium presentations and one (1) poster presentation at the 2026 Annual Meeting.</li>
                <li>You may upload two associated jpg files that are 750 pixels wide. If you have no images to include then proceed to option two. Image Requirements: JPEG only and 750 pixels wide.</li>
            </ol>
        </section>

        <section class="mb-5">
            <h3 class="mb-3">ABSTRACT SUBMISSION PROCESS</h3>
            <p>Abstracts will be submitted online.</p>
            <p>Abstracts will be submitted online in a text box, with only the body of the abstract included (no author names or institutions). It is very important that you only submit the body of the abstract in the text box, as this will be used for the blinded review process. You may upload two associated jpg files that are 750 pixels wide. Any graphic tables need to be saved as jpgs.</p>
        </section>

        <section class="mb-5">
            <h3 class="mb-3">ABSTRACT REVIEW AND SELECTION</h3>
            <p>A multi-disciplinary panel of PRiSM members will blindly review and score each abstract submission. Average numerical scores are used to inform the committee's acceptance decisions. Abstracts are scored based on the following criteria:</p>
            <ul>
                <li>Scientific quality and objectivity</li>
                <li>Topic originality and desirability</li>
                <li>Writing clarity and organization</li>
                <li>Subject matter relevance and contribution to pediatric sports medicine</li>
            </ul>
            <p>The Scientific Program Committee will issue acceptance notifications via email by October 15, 2025.</p>
            <p>The presenting author for podium and poster presentations must register, pay all applicable registration fees, and attend the 13<sup>th</sup> Annual Meeting.</p>
        </section>

        <section class="mb-5">
            <h3 class="mb-3">ABSTRACT AWARDS</h3>
            <p>Abstracts accepted for presentation at the 13<sup>th</sup> Annual Meeting may qualify for the following awards:</p>

            <div class="row">
                <div class="col-md-6">
                    <div class="card award-card">
                        <div class="card-body">
                            <h5 class="card-title">Hank Chambers Award</h5>
                            <p class="card-text">For Best Scientific Presentation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card award-card">
                        <div class="card-body">
                            <h5 class="card-title">Kevin G. Shea Award</h5>
                            <p class="card-text">For Best Scientific Poster</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card award-card">
                        <div class="card-body">
                            <h5 class="card-title">Mininder S. Kocher Award</h5>
                            <p class="card-text">For Most Promising Career</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card award-card">
                        <div class="card-body">
                            <h5 class="card-title">Cordelia W. Carter Award</h5>
                            <p class="card-text">For Inclusion and Equity</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h3 class="mb-3">TRAINEE TRAVEL GRANT AWARDS</h3>
            <p>The PRiSM Annual Meeting is an opportunity for researchers and clinicians from varied professional backgrounds to come together to present and discuss a wide variety of pediatric sports medicine topics. The PRiSM Trainee Travel Grant Awards provide trainees across multiple disciplines with the opportunity to present their research to meeting attendees during a dedicated scientific session. Additionally, award recipients will receive complimentary registration to the 13<sup>th</sup> Annual Meeting and reimbursement of travel and lodging expenses (up to $1000.00). <a href="<?=base_url()?>/assets/documents/TravelGrantInstructions.pdf" class="btn btn-sm btn-outline-primary">Click here for Trainee Travel Grant Instructions.</a></p>

            <p>The Trainee Travel Grant Awards are made possible through donations to the PRiSM Research Fund. These awards aim to foster an environment of collaboration among a diverse set of students and trainees involved in pediatric sports medicine research.</p>

            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Award Eligibility Requirements</h4>
                </div>
                <div class="card-body">
                    <p>To qualify for these awards, trainees must be enrolled in an academic or clinical training program that involves pediatric sports medicine research. Additionally, applicants must be an active PRiSM member or have submitted a membership application.</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Award Application Submission Process</h4>
                </div>
                <div class="card-body">
                    <p>The Trainee Travel Grant Award application is part of the abstract submission process. If you indicate that you are a trainee, you will be prompted to complete the award application. Please read the instructions carefully before completing the application and answer all questions. Inquiries about this application may be addressed to the PRiSM Society's administrative staff at <a href="mailto:info@prismsports.org">info@prismsports.org</a>.</p>
                    <p><strong>Along with all abstract submissions, Trainee Travel Grant Award applications are due June 30, 2025.</strong> All applications will be reviewed and scored by the Scientific Program Committee. Notifications of acceptance will be delivered to submitting authors via email by October 15, 2025.</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Award Selection Criteria</h4>
                </div>
                <div class="card-body">
                    <p>A multi-disciplinary panel of PRiSM members will blindly review and score each Trainee Travel Grant Award application with the goal of optimizing the diversity of presenters at the PRiSM Annual Meeting. Award scoring is based upon the overall merit of the application (as outlined in the abstract guidelines above) and the following applicant-specific criteria used to help identify underrepresented persons in science and medicine:</p>
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
                </div>
            </div>
        </section>

        <div class="m-auto text-center mb-5">
            <a href="<?=base_url()?>/login">
            <button class="btn btn-lg w-75 m-auto p-4 fw-bolder btn-login" type="button">Submit Or Update Abstract</button>
            </a>
        </div>

        <footer class="text-center mt-5 landing-footer">
            <p class="lead"><strong>All submissions are due Monday, June 30, 2025.</strong></p>
        </footer>


    </div>
</main>