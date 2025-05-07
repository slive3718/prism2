
<link href="<?=base_url()?>/assets/css/jquery_ui_style.css" rel="stylesheet">
<?php echo view('event/common/menu'); ?>
<?php  //print_r($paper['permission_1']);exit;?>
<main>
    <div class="container-fluid pb-5">
        <?php echo view('event/common/shortcut_link'); ?>
        <div class="card p-lg-5 p-md-2 p-sm-1 p-xs-1">
            <h6 class="fw-bold"> Permissions <span class="show_error1 text-danger" hidden> * Required</span></h6>
            <hr style="height: 5px; color:red" class="m-0">
            <div>

                <form id="permissionsForm" method="post">
                    <div class="mt-5">
                        <div class="row mt-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission_1" id="permission_digital_recording" value="1" <?=(isset($paper['permission_1']) && $paper['permission_1']) == '1' ? 'checked':''?>>
                                <label class="form-check-label" for="permission"><required class="text-danger">*</required>
                                    I agree to allow the audio and digital recording of my presentation in connection with my participation in the PRISM
                                    Annual Meeting. | consent to the recording and use of my audio presentation and PowerPoint presentation slides by
                                    PRISM as part of the enduring online educational material. My execution of this Permission Form does not transfer my
                                    ownership rights of the presentation materials and does not prohibit me from using materials in the future. | agree to
                                    obtain permission from the patient in the case that | use photos, video, or other identifiable patient information in my
                                    presentation.
                                </label>
                            </div>

                            <div class="form-control my-2">
                                <label><required class="text-danger">*</required>Electronic Signature</label>
                                <input type="text" class="form-control" name="signature_1" id="signature_1" value="<?=(isset($paper['signature_1']) && !empty($paper['signature_1']))?$paper['signature_1']:''?>">
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="permission_2" id="permission_allow_prism" value="1" <?=(isset($paper['permission_2']) && $paper['permission_2']) == '1' ? 'checked':''?>>
                                <label class="form-check-label" for="permission"><required class="text-danger">*</required>
                                    I agree to allow PRISM, in partnership with the Orthopaedic Journal of Sports Medicine, to publish my written abstract,
                                    along with all supporting image, tables and files, in an open access, electronic supplement following the PRISM Annual
                                    Meeting.
                                </label>
                            </div>
                            <div class="form-control mb-5">
                                <label><required class="text-danger">*</required>Electronic Signature</label>
                                <input type="text" class="form-control" name="signature_2" id="signature_2" value="<?=(isset($paper['signature_2']) && !empty($paper['signature_2']))?$paper['signature_2']:'' ?>" >
                            </div>

                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Save and continue">
                </form>
            </div>
        </div>
</main>

<script>
    let previousUrl = "<?= $previous_url ?? ''?>"
    let previousPage = "<?= $previous_page ?? ''?>"

    $(function(){
        $('#permissionsForm').on('submit', function(e){
            e.preventDefault();
            if (
                !$('#permission_digital_recording').is(':checked') ||
                !$('#permission_allow_prism').is(':checked') ||
                $('#signature_1').val().trim() === '' ||
                $('#signature_2').val().trim() === ''
            ) {
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'Please check all required fields.'
                });
                return false;
            }

            let frmData= $('#permissionsForm').serializeArray();
            frmData.push({'name':"paper_id", 'value':<?=$paper_id?>});
            $.ajax({
                url: base_url+'user/update_paper_ajax',
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                data: frmData,
                method: "POST",
                dataType: "json",
                success:
                    function(response){
                        if(response.status == 200){
                            Swal.fire(
                                { icon: 'success', title: 'Changes saved', text: 'success'}
                            ).then(function(){
                                if((previousPage === 'finalize_paper' || previousPage === 'submission_menu') && previousUrl) {
                                    return window.location.href = previousUrl
                                }
                                window.location.href = "<?= base_url() ?>/user/finalize_paper/<?= $paper_id ?>";
                            });
                        }else{
                            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong: ' + e.message, });
                        }

                    }
            })
        })
    })

</script>