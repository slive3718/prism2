
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox.min.js" integrity="sha512-KbRFbjA5bwNan6DvPl1ODUolvTTZ/vckssnFhka5cG80JVa5zSlRPCr055xSgU/q6oMIGhZWLhcbgIC0fyw3RQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.min.css" integrity="sha512-xtV3HfYNbQXS/1R1jP53KbFcU9WXiSA1RFKzl5hRlJgdOJm4OxHCWYpskm6lN0xp0XtKGpAfVShpbvlFH3MDAA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php echo view('event/common/menu'); ?>
<?php //print_r($learning_objectives); exit;?>
<style>
    .table td {
        vertical-align: middle;
    }
    .table .text-end {
        width: 250px;
    }
</style>
<main >
        <div class="container pb-5 ">
            <?php echo view('event/common/shortcut_link'); ?>
                <div class="card p-4">
                    <div class="col-md-12">
                        <button class="btn btn-success finalizePaperBtn" style="max-width:200px"> Finalize</button>
                        <button class="btn btn-primary" onclick="printDiv('printSection')">Print</button>
                    </div>
                </div>
            <div id="printSection">
                <div class="card shadow">
                    <div class="card-header fw-bold"> General Information  <a href="<?=base_url()?>/user/edit_papers_submission/<?=$paper_id?>" class="btn btn-sm btn-primary float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a></div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-end">Abstract ID : </td>
                                    <td ><?=$papers->custom_id?></td>
                                </tr>
                                <tr>
                                    <td style="width:250px" class="text-end">Abstract Title : </td>
                                    <td><?=$papers->title?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header fw-bold"> Author Information <?=(isset($incomplete['author'])? '<span class="text-danger text-sm badge " title="Please complete requirements before finalizing abstract."><i class="fas fa-exclamation-circle" > INCOMPLETE </i></span>' :'')?>  <a href="<?=base_url()?>/user/authors_and_copyright/<?=$paper_id?>" class="btn btn-sm btn-primary float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a></div>
                    <div class="card-body">
                        <table class="table" style="margin-bottom:0px !important">
                            <tbody>
                                <tr>
                                    <td class="text-end" style="width:250px;">
                                        Author List:
                                    </td>
                                    <td>
                                        <?php if(!empty($authors)):
                                            foreach ($authors as $author): ?>
                                            <?=($author['is_presenting_author'] == "Yes")? '<strong> Lead Presenter </strong>: ':'<strong> Co-Presenter </strong>: '?>
                                            <?=$author['author_order'] ? '('.$author['author_order']. ')' : ''?>
                                            <?=$author['name'].' '.$author['surname']?>  <br>
                                        <?php endforeach; endif; ?>
                                    </td>
                                </tr>
                                <?php if(!empty($authors)):
                                foreach ($authors as $index => $author):
                                    $designations = '';
                                    if (is_array($author['designations'])) {
                                        foreach ($author['designations'] as $i => $designation){
                                            $designationCount = count($author['designations']);
                                            $designations = '';

                                            foreach ($author['designations'] as $i => $designation) {
                                                if($designation['name'] == 'Other')
                                                    $designation['name'] = $author['other_designation'];
                                                if($designation['name'] == 'None')
                                                    $designation['name'] = '';
                                                $designations .= $designation['name'];

                                                if ($designationCount > 1 && $i > 0 && $i < ($designationCount - 1)) {

                                                    $designations .= ', ';
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                <tr >
                                    <td class="text-end">(<?=($index+1)?>) <?=($author['is_presenting_author'] == "Yes")? 'Presenting Author :':'Co-Author :'?></td>
                                    <td><strong><?=UcFirst($author['name']).' '.UcFirst($author['middle_name']).' '.UcFirst($author['surname']) ?><?= ($designations ? ', '. $designations : '')?> </strong></td>
                                </tr>
                                    <tr>
                                        <td class="text-end" style="vertical-align: top">Author Info: </td>
                                        <td >
                                        Email: <?=$author['email']?><br>
                                        Institution: <?=$author['institution_name'].($author['institution_city'] ? ', '.$author['institution_city']: '')  . ($author['institution_country'] ? ', '.$author['institution_country'] : '')?><br>
                                        Work Phone: <?=$author['phone']?><br>
                                        Cell Phone: <?=$author['cellphone']?><br>

                                        <?php if(!empty($study_groups) && !empty($author['study_group_affiliation'])): ?>
                                        <?php foreach ($study_groups as $study_group): ?>
                                        <?php if($author['study_group_affiliation'] == $study_group['id']): ?>
                                        Study Group: <?=$study_group['surname']?>
                                        <?php endif ?>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        Study Group: None
                                        <?php endif; ?>


                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">Correspondence :</td>
                                    <td><?=($author['is_correspondent'] == 'Yes' ? 'Yes':'No')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><br></td>
                                </tr>

                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header fw-bold"> Paper Information <?=(!isset($papers)? '<span class="text-danger text-sm badge " title="Please complete requirements before finalizing abstract."><i class="fas fa-exclamation-circle" > INCOMPLETE </i></span>' :'')?> <a href="<?=base_url()?>/user/edit_papers_submission/<?=$paper_id?>" class="btn btn-sm btn-primary float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a></div>
                    <div class="card-body">
                        <table class="table" style="border-bottom-width:4px !important">
                            <tbody>
                            <?php if ($papers): ?>
                                <tr>
                                    <td class="text-end"  style="width:250px;">Session Types : </td>
                                    <td>Consider for Podium Presentation</td>
                                    <td style="width: 100px;"><a class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td style="width:250px" class="text-end">Primary Topic:</td>
                                    <td>
                                        <?php
                                        $primaryTopics = json_decode($papers->primary_topic) ?? [];
                                        $primaryOutput = [];

                                        foreach($abstract_topics as $topic) {
                                            if(in_array($topic['value'], $primaryTopics)) {
                                                $display = $topic['name'];
                                                if($topic['value'] == "26" && !empty($papers->other_primary_topic)) {
                                                    $display .= " (" . htmlspecialchars($papers->other_primary_topic) . ")";
                                                }
                                                $primaryOutput[] = $display;
                                            }
                                        }

                                        echo implode(', ', $primaryOutput) ?: 'None selected';
                                        ?>
                                    </td>
                                    <td style="width: 100px;">
                                        <a href="<?= base_url('user/edit_papers_submission/'.$paper_id) ?>" class="float-end btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:250px" class="text-end">Secondary Topic:</td>
                                    <td>
                                        <?php
                                        $secondaryTopics = json_decode($papers->secondary_topic) ?? [];
                                        $secondaryOutput = [];

                                        foreach($abstract_topics as $topic) {
                                            if(in_array($topic['value'], $secondaryTopics)) {
                                                $display = $topic['name'];
                                                if($topic['value'] == "26" && !empty($papers->other_secondary_topic)) {
                                                    $display .= " (" . htmlspecialchars($papers->other_secondary_topic) . ")";
                                                }
                                                $secondaryOutput[] = $display;
                                            }
                                        }

                                        echo implode(', ', $secondaryOutput) ?: 'None selected';
                                        ?>
                                    </td>
                                    <td style="width: 100px;">
                                        <a href="<?= base_url('user/edit_papers_submission/'.$paper_id) ?>" class="float-end btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">This abstract is :</td>
                                    <td><?= $papers->basic_science_format === 'Yes' ? 'Quantitative' : 'Qualitative'?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
<!---->
<!--                                <tr>-->
<!--                                    <td class="text-end">Abstract Category :</td>-->
<!--                                    <td>--><?php //= htmlspecialchars(!empty($categories) ? isset(($categoriesById = array_column($categories, 'name', 'category_id'))[$papers->abstract_category]) ? $categoriesById[$papers->abstract_category] : 'N/A' : '') ?><!--</td>-->
<!--                                    <td style="width: 100px;"><a href="--><?php //=base_url().'user/edit_papers_submission/'.$paper_id?><!--" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>-->
<!--                                </tr>-->
                                <tr>
                                    <td class="text-end">Abstract Title :</td>
                                    <td><?= htmlspecialchars($papers->title) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td class="text-end">Background :</td>
                                    <td><?= htmlspecialchars($papers->study_design) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td class="text-end">Hypothesis :</td>
                                    <td><?= htmlspecialchars($papers->hypothesis) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td class="text-end">Methods :</td>
                                    <td><?= htmlspecialchars($papers->methods) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td class="text-end">Results :</td>
                                    <td><?= htmlspecialchars($papers->results) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td class="text-end">Conclusion :</td>
                                    <td><?= htmlspecialchars($papers->conclusions) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td class="text-end">References :</td>
                                    <td><?= htmlspecialchars($papers->introduction) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                                <tr>
                                    <td class="text-end">Diversity :</td>
                                    <td><?= htmlspecialchars(ucFirst($papers->diversity)) ?></td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>

                                <tr>
                                    <td style="width:250px" class="text-end ">Award Information : </td>
                                    <td>
                                        This abstract focuses on:
                                        <?php if(isset($papers->award_information) && $papers->award_information == 'surgical'): ?>
                                            Surgical Treatments and Outcomes (pain mgmt, rehab, technique/cadaver) Surgical treatments and any topic relating to surgical management, such as pain management, rehabilitation after surgery, technique papers, and cadaver studies
                                        <?php endif ?>
                                        <?php if(isset($papers->award_information) && $papers->award_information == 'msk'): ?>
                                            Diagnosis, Treatment, Management of Medical Conditions (MSK rad/US) Abstracts related to diagnosis of a condition (including radiologic studies), medical treatments, non-surgical management of injuries, outcomes. Includes concussion (as it relates to diagnosis, treatment, management), bone health, rehab (from a non-surgical treatment)
                                        <?php endif ?>
                                        <?php if(isset($papers->award_information) && $papers->award_information == 'injury'): ?>
                                            Injury Prevention and Motion Analysis Abstracts related to injury prevention strategies, sports specialization, motion analysis
                                        <?php endif ?>
                                        <?php if(isset($papers->award_information) && $papers->award_information == 'mental'): ?>
                                            Mental Health and Wellness Abstracts related to patient and athlete mental health, sleep, identity, wellness
                                        <?php endif ?>
                                        <?php if(isset($papers->award_information) && $papers->award_information == 'n/a'): ?>
                                            Not Applicable
                                        <?php endif ?>
                                    </td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/edit_papers_submission/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header fw-bold"> Permissions <?=(isset($incomplete['author'])? '<span class="text-danger text-sm badge " title="Please complete requirements before finalizing abstract."><i class="fas fa-exclamation-circle" > INCOMPLETE </i></span>' :'')?>  <a href="<?=base_url()?>/user/authors_and_copyright/<?=$paper_id?>" class="btn btn-sm btn-primary float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a></div>
                    <div class="card-body">
                        <table class="table" style="margin-bottom:0px !important">
                            <tbody>
                            <?php if ($papers): ?>
                                <tr>
                                    <td class="text-end align-top" style="width: 250px;">
                                        <input type="checkbox" class=" mt-2" <?= ($papers->permission_1 == '1') ? 'checked' : '' ?> disabled>
                                    </td>
                                    <td>
                                        <p class="mb-2">
                                            I agree to allow the audio and digital recording of my presentation in connection with my participation in the PRISM Annual Meeting.
                                        </p>
                                        <p class="mb-0">
                                            <strong>Electronic Signature:</strong> <?= ($papers->signature_1 !== '') ? $papers->signature_1 : '' ?>
                                        </p>
                                    </td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/permissions/'.$paper_id?>/#signature_1" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>

                                <tr>
                                    <td class="text-end align-top" style="width: 250px;">
                                        <input type="checkbox" class="mt-2" <?= ($papers->permission_2 == '1') ? 'checked' : '' ?> disabled>
                                    </td>
                                    <td>
                                        <p class="mb-2">
                                            I agree to allow PRISM, in partnership with the Orthopaedic Journal of Sports Medicine, to publish my written abstract,
                                            along with all supporting images, tables, and files, in an open access, electronic supplement following the PRISM Annual Meeting.
                                        </p>
                                        <p class="mb-0">
                                            <strong>Electronic Signature:</strong> <?= ($papers->signature_2 !== '') ? $papers->signature_2 : '' ?>
                                        </p>
                                    </td>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/permissions/'.$paper_id?>/#signature_2" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header fw-bold"> Image Uploads <?=(isset($incomplete['image_uploads'])? '<span class="text-danger text-sm badge " title="Please complete requirements before finalizing abstract."><i class="fas fa-exclamation-circle" > INCOMPLETE </i></span>' :'')?>  <a href="<?=base_url()?>/user/presentation_upload/<?=$paper_id?>" class="btn btn-sm btn-primary float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a></div>
                    <div class="card-body">
                        <table class="table" style="margin-bottom:0px !important">
                            <tbody>
                            <?php if ($paper_uploads): ?>
                                <tr>
                                    <td class="text-end align-top" style="width: 250px;">
                                        Uploaded Files:
                                    </td>
                                <?php foreach ($paper_uploads as $upload): ?>
                                    <td>
                                        <a href="<?= base_url().$upload['file_path'].$upload['file_name']?>" target="_blank" download="">
                                            <img class="img-thumbnail" style="max-width: 200px; max-height: 100px"  src="<?= base_url().$upload['file_path'].$upload['file_name']?>">
                                            <br>
                                            <?= $upload['file_name']?>
                                        </a>
                                    </td>
                                <?php endforeach; ?>
                                    <td style="width: 100px;"><a href="<?=base_url().'user/presentation_upload/'.$paper_id?>" class="float-end btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header fw-bold"> User Information </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-end"  style="width:250px;"><strong>User/Submitter Name:</strong></td>
                                    <td class="text-start"><?=$userInfo['name']. ' ' . $userInfo['surname']?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><strong>User/Submitter Email: 	</strong></td>
                                    <td class="text-start"><?=$userInfo['email'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card p-4">
                <div class="col-md-12">
                      <button class="btn btn-success finalizePaperBtn" id="finalizePaperBtn" style="max-width:200px"> Finalize</button>
                    <button class="btn btn-primary" onclick="printDiv('printSection')">Print</button>
                </div>
            </div>
        </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
    $(function(){



        $('.finalizePaperBtn').on('click', function(){
            let authors =  `<?=isset($authors)? (count($authors)):''?>`;
            let incomplete = `<?=isset($incompleteStatus)? (json_encode($incompleteStatus)):''?>`;
            incomplete = JSON.parse(incomplete);

            authors = JSON.parse(authors)

            if(authors < 0){
                toastr.warning("Missing or Incomplete Authors")
                return false;
            }

            if(Object.keys(incomplete).length !== 0){
                $.each(incomplete, function(i ,val){
                    toastr.warning(val[0].required)
                })

                return false;
            }
            // Get the content of the 'printSection'
            const htmlContent = document.getElementById('printSection').innerHTML;

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = htmlContent;

            const editButtons = tempDiv.querySelectorAll('a');
            editButtons.forEach(button => {
                button.remove()
            });

            const updatedHtmlContent = tempDiv.innerHTML;

            sendDivAsImage('printSection').then(function(response){
                $.ajax({
                    url: base_url + 'user/save_finalize_paper',
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    data: {
                        'paper_id': paper_id,
                        'html': updatedHtmlContent,
                        'preview_image': response
                    },
                    method: "POST",
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please Wait !',
                            html: 'Finalizing...',// add html attribute if you want or remove
                            allowOutsideClick: false,
                            onOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function (response, status) {
                        if (response.status == "200") {
                            swal.fire({
                                title:"Submitted",
                                text: "Your submission has been finalized and a confirmation email has been sent out",
                                type: "success",
                                icon: "success",
                                confirmButtonText: 'Ok',
                            }).then((result)=> {
                                if(result.isConfirmed){
                                    window.location.href = base_url+'home';
                                }
                            });
                        }else{
                            Swal.fire(
                                'Sorry',
                                'Something went wrong, please contact administrator',
                                'warning'
                            )
                        }
                    }
                });
            })
        })
    })


    function printDiv(divId) {
        window.onbeforeprint = function() {
            $('a:has(i.fas.fa-edit)').hide();
        };
        window.onafterprint = function() {
            $('a:has(i.fas.fa-edit)').show();
        };


        let printContents = document.getElementById(divId).innerHTML;
        let originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // Reload to restore original content
    }

    function sendDivAsImage(divId) {
        const targetDiv = document.getElementById(divId);

        // Hide edit buttons before capture
        const editButtons = $(targetDiv).find('a:has(i.fas.fa-edit)');
        editButtons.hide();

        return html2canvas(targetDiv, {
            useCORS: true,
            allowTaint: false,
            ignoreElements: (element) => {
                // You can further customize this if needed
                return false;
            }
        }).then(canvas => {
            editButtons.show();
            return canvas.toDataURL('image/png');
        }).catch(err => {
            console.error('html2canvas failed:', err);
            editButtons.show();
            // ❌ Terminate process (throw error up the chain)
            throw new Error("Capture failed due to cross-origin or rendering error.");
        });
    }



</script>