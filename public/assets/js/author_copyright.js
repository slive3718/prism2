
$(function(){

    let selected_user_id = [];
    let selected_user_info = [];

    getPaperAuthors(paper_id);
    $('.addAuthorBtn').on('click',function(){
        $('#searchAuthorModal').modal('hide')
        $('#addAuthorModal').find('form')[0].reset();
        $('#addAuthorModal').modal('show');
        $('#saveAuthorBtn').removeClass('updateAuthorBtn')
        $('#saveAuthorBtn').addClass('saveAuthorBtn').text('Save author')
        $('#formSaveAuthor').attr('action', base_url+'/user/add_author_ajax');
        $('#formSaveAuthor').attr('isedit', 0);
    })

    // Show searchAuthorModal modal after closing the addAuthorModal
    $('#addAuthorModal').on('hide.bs.modal', function (e) {
        let isEdit = $(this).attr('isEdit');
        if(isEdit !== "1"){
            $('#searchAuthorModal').modal('show')
        }
    });

    $('.customInstitutionOption').on('click', function(){

    })

    $('.addNewInstitution').on('click', function(){
        $('#addInstitutionModal').modal('show');
    })

//
//
    $('.showSearchAuthorModal').on('click', function(e){
        e.preventDefault();
        $('#searchAuthorModal').modal('show');
        $('#searchAuthorModal .addMarkedAuthor').show();
        $('#searchAuthorModal .addMarkedPanel').hide();
    })

    $('#searchAuthorModal').on('keypress', '#authorName', function(e){
        if (e.keyCode === 13) {
            $('#searchAuthorModal .searchAuthorBtn').click();
        }
    })


    $('#searchAuthorModal').on('click', '.searchAuthorBtn', function(){
        let authorName = $('#authorName').val();

        let requiredAuthorDetails = '';
        requiredAuthorDetails = {
            'authorName': authorName
        }

        if( authorName ==='' ){
            Swal.fire(
                'info',
                'Empty search',
                'info'
            )
            return false;
        }else{
            $('#authorResults').css('display', 'block');
            searchAuthor(requiredAuthorDetails)
        }

    })

    function searchAuthor(searchValue){
        $.post(base_url+'/user/search_author_ajax',
            {
                'searchValue' : searchValue
            },
            function(response) {
                if (response.status === "200") {
                    $('#authorResultTableBody').html('<option> </option');
                    $.each(response.data, function(i, val) {
                        $('#authorResultTableBody').append(
                            '<tr>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '"><input type="checkbox"  name="author_checkbox" class="authorCheckbox" user-info="' + val.name + ' ' + val.surname + ' ( ' + val.institution + ' )" user-id="' + val.user_id + '"></td>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '">' + val.name + '</td>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '">' + val.surname + '</td>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '">' + val.email + '</td>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '">' + val.institution_name + '</td>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '">' + val.institution_city + '</td>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '">' + val.institution_country + '</td>' +
                            '<td user-id="' + val.user_id + '" class="authorDataList" value="' + val.name + '">' + val.is_study_group + '</td>' +
                            '</tr>'
                        );
                    });
                } else {
                    $('#authorResultTableBody').html(
                        "<tr>" +
                        "<td class='text-center' colspan='7'>No result found.</td>" +
                        "</tr>"
                    );
                }
            }, 'json');
    }

//
    $('.addMarkedAuthor').on('click', function(){
        let user_id = '';
        let user_info = '';
        selected_user_id = [];
        selected_user_info = [];
        $('.authorCheckbox').each(function(){
            let user_id = $(this).attr('user-id');
            let  user_info = $(this).attr('user-info');
            if($(this).prop('checked')===true){
                selected_user_id.push(user_id);
                selected_user_info.push(user_info);
            }
        })

        selected_user_info = selected_user_info.join('<br>');

        if($.isEmptyObject(selected_user_id)){
            toastr.warning('no author assigned')
            return false;
        }

        Swal.fire({
            title: 'Confirm to add:',
            html: selected_user_info,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm, add it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: base_url+'/user/assign_abstract_author',
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    data: {
                        'author_ids':selected_user_id,
                        'paper_id': paper_id
                    },
                    method: "POST",
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please Wait !',
                            html: 'Loading...',// add html attribute if you want or remove
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function(response, status ) {
                        // console.log((response.data == null)?'null':'not null');return false;
                        if(response.status == "200"){
                            console.log(response.data.duplicate.length);
                            swal.close();
                            if(response.data.duplicate.length == 0){
                                Swal.fire(
                                    'Success',
                                    response.message,
                                    'success'
                                )
                            }else if(response.data.duplicate.length > 0){
                              /*  let auhtors = '';
                                $.each(response.data.duplicate, function(i, val){
                                    auhtors += val.name+' '+val.surname +'<br>'
                                })
                                Swal.fire(
                                    'Updated',
                                    'Authors added! <br> <span class="fw-bolder">'+ response.data.duplicate.length+' Duplicate author(s): </span>: <br>'+auhtors,
                                    'success'
                                )*/
                            }

                            $('#authorResultModal').modal('hide');
                            $('#searchAuthorModal').modal('hide');
                        }else{
                            Swal.fire(
                                'error',
                                response.reason,
                                'error'
                            )
                        }
                        getPaperAuthors(paper_id);
                    }
                });
            }
        })
    })

//
//
    $('#formSaveAuthor').on('submit', function (e) {
        e.preventDefault();
        let $this = $(this);
        let missing_fields = [];

        // Email validation
        if ($('#authorEmail').val() !== $('#authorConfirmEmail').val()) {
            toastr.error('Email does not match');
            return false;
        }

        // Check for required fields
        $('#formSaveAuthor .required').each(function () {
            if ($(this).val() == '') {
                missing_fields.push($(this).attr('title'));
                required_field_missing($(this).attr('title'));
            }
        });

        if ($("input[name='designations[]']:checked").length === 0) {
            toastr.error("Please select at least one designation.");
            return false;
        }

        if (missing_fields.length > 0) {
            return false;
        }

        let formData = new FormData($(this)[0]);
        formData.append('paper_id', paper_id);

        $.ajax({
            url: $this.attr("action"), // Ensure the form has an action attribute
            data: formData,
            method: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function () {
                Swal.fire({
                    title: "Please Wait!",
                    html: "Saving changes...",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (response) {
                if (!response) {
                    toastr.error("Unexpected response from the server.");
                    return;
                }

                if (response.status === "400") {
                    Swal.fire({
                        icon: "info",
                        html:
                            "This Author is already in the system.<br>" +
                            "Name: <label class='text-info'>" +
                            response.data.name +
                            " " +
                            response.data.surname +
                            "</label> <br>" +
                            "<a href='#' onclick='addSearchedAuthor(" + paper_id + ", [" +
                            response.data.id + "])'>Add this author</a>"
                    });
                    return;
                }

                if (response.status !== "200") {
                    Swal.fire({
                        icon: "info",
                        html:"Something went wrong. Please contact admin or support. Thank you! "
                    });
                    console.error(response? response.data : 'error 500')
                    return false;
                }

                $('#addAuthorModal').attr('isEdit', 1);
                Swal.fire("Success", response.message, "success");
                $("#authorResultModal, #addAuthorModal, #searchAuthorModal").modal("hide");

                if ($this.attr("isEdit") == "0") {
                    addSearchedAuthor(paper_id, [response.data]);
                }

                getPaperAuthors(paper_id);
            },
            error: function (xhr) {
                console.error(xhr.responseText); // Log error for debugging
                toastr.error("An error occurred: " + (xhr.responseJSON?.message || xhr.statusText));
            }
        });

    });




//
    $('#savePaperAuthors').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get form and prepare FormData
        const authorAdditionalInfoForm = document.getElementById('author_additional_info_form');
        const formData = new FormData(authorAdditionalInfoForm);

        // Get author data
        const selectedCorrespondents = $('.markedCorrespondent:checked').map(function() {
            return $(this).attr('author-id');
        }).get();

        const presentingAuthors = $('.presentingAuthor:checked').map(function() {
            return $(this).attr('author-id');
        }).get();

        const authorOrders = $('.author_order').map(function() {
            return $(this).attr('author_id');
        }).get();

        // Validate required fields
        if (authorOrders.length === 0) {
            toastr.error('Please add at least one author');
            return false;
        }

        if (presentingAuthors.length === 0) {
            toastr.error('Please select a presenting author');
            return false;
        }

        if (selectedCorrespondents.length === 0) {
            toastr.error('Please select at least one correspondent');
            return false;
        }

        // Check if any author information is incomplete
        const incompleteAuthors = $('.tdCompleteStatus[status="0"]').length;
        if (incompleteAuthors > 0) {
            Swal.fire({
                title: 'Incomplete Information',
                text: 'Please complete all author details before saving',
                icon: 'warning'
            });
            return false;
        }

        // Add additional data to FormData
        formData.append('presenting_authors', JSON.stringify(presentingAuthors));
        formData.append('selectedCorrespondents', JSON.stringify(selectedCorrespondents));
        formData.append('author_orders', JSON.stringify(authorOrders));
        formData.append('paper_id', paper_id);

        // Validate FormData isn't empty
        let formDataEmpty = true;
        for (let value of formData.values()) {
            if (value) {
                formDataEmpty = false;
                break;
            }
        }

        if (formDataEmpty) {
            toastr.error('No data to submit. Please fill out the form.');
            return false;
        }

        // Show loading state
        const $saveBtn = $(this);
        const originalBtnText = $saveBtn.html();
        $saveBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        // Make AJAX request
        $.ajax({
            url: base_url + '/user/update_paper_authors',
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (!response) {
                    throw new Error('Empty response from server');
                }

                if (response.status === 200) {
                    // Successful save
                    toastr.success(response.message || 'Authors saved successfully');

                    // Handle redirect if coming from specific pages
                    if ((previousPage === 'finalize_paper' || previousPage === 'submission_menu') && previousUrl) {
                        window.location.href = previousUrl;
                        return;
                    }

                    window.location.href = base_url + '/user/presentation_upload/' + paper_id;

                } else if (response.status === 500) {
                    Swal.fire('Error', response.message || 'Server error occurred', 'error');
                } else {
                    Swal.fire('Error', response.message || 'Something went wrong', 'error');
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = 'An error occurred while saving authors';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.statusText) {
                    errorMessage = xhr.statusText;
                }

                toastr.error(errorMessage);
                console.error('AJAX Error:', error);
            },
            complete: function() {
                // Restore button state
                $saveBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    });


    $('.authorList').on('click','.moveUp', function(){
        let row = $(this).parents("tr:first");
        let rftd = row.find('.order_num'),
            id = row.find('.order_num').text(),
            tar, tftd;
        if ($(this).is(".moveUp")) {
            tar = row.prev();
            row.insertBefore(row.prev());
        } else {
            tar = row.next();
            row.insertAfter(row.next());
        }
        if (tar.length) {
            tftd = tar.find('.order_num');
            rftd.text(tftd.text());
            tftd.text(id)
        }
    })
//
    $('.authorList').on('click','.moveDown', function(){
        let row = $(this).parents("tr:first");
        let rftd = row.find('.order_num'),
            id = row.find('.order_num').text(),
            tar, tftd;
        if ($(this).is(".moveDown")) {
            tar = row.next();
            row.insertAfter(row.next());
        } else {
            tar = row.prev();
            row.insertBefore(row.prev());
        }
        if (tar.length) {
            tftd = tar.find('.order_num');
            rftd.text(tftd.text());
            tftd.text(id)
        }
    })
//
    $('.authorList').on('click','.editAuthorListedBtn', function(){

        let paper_id = $(this).attr('paper_id');
        let author_id = $(this).attr('author_id')
        $('#formSaveAuthor').attr('action', base_url+'user/update_author_details');
        $('#formSaveAuthor').attr('update', 1);
        $('#addAuthorModal').find('form')[0].reset();
        $('#addAuthorModal').attr('isEdit', 1);

        $.ajax({
            url: base_url + '/user/get_author_info',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {
                'author_id': author_id
            },
            method: "POST",
            dataType: "json",
            success: async function (response, status) {
                console.log(response)

                if(response.status == 200){
                    $('#addAuthorModal').modal('show');
                    $('#author_id').val(response.data.author_id)
                    $('#authorFName').val(response.data.name)
                    $('#authorMName').val(response.data.middle_name)
                    $('#authorLName').val(response.data.surname)
                    $('#authorEmail').val(response.data.email)
                    $('#authorConfirmEmail').val(response.data.email)

                    // Affiliation
                    $('#authorPosition').val(response.data.position)
                    $('#authorTitle').val(response.data.title)
                    $('#authorInstitution').val(response.data.institution_name)
                    $('#searchId').val(response.data.institution_id)
                    $('#authorPhone').val((response.data.phone) ?response.data.phone:'' )

                    // Address
                    $('#authorAddress').val(response.data.address)
                    $('#authorCountry').val(response.data.country)
                    $('#authorCity').val(response.data.city)
                    $('#authorProvince').val(response.data.province)
                    $('#authorZipcode').val(response.data.zipcode)
                    $('#designations').prepend('<option value=""> -- Select Designation -- </option>')

                    fetchDesignations().then(function(){
                        assignDesignations(response.data);
                    })
                    $('#other_designation').val(response.data.other_designation)

                    // Set the checkbox based on status
                    $('#studyGroupAffiliatedSwitch').prop('checked', response.data.study_group_affiliation_status == 1);

                    // call to fetch dropdown
                    await toggleStudyGroupDropdown()

// Show/hide and set dropdown based on affiliation status
                    if (response.data.study_group_affiliation_status == 1) {
                        $('.studyGroupDropDownDiv').show();
                        $('#studyGroupDropDown').val(response.data.study_group_affiliation);
                        $('#studyGroupSwitch').prop('checked', false); // optional, if needed
                    } else {
                        $('.studyGroupDropDownDiv').hide();
                        $('#studyGroupDropDown').val('');
                    }

                    (response.data.is_study_group == 1 ?  $('#studyGroupSwitch').prop('checked', true) : $('#studyGroupSwitch').prop('checked', false))


                }else{
                    swal.fire(
                        'info',
                        'Sorry you cannot edit this author',
                        'info',
                    )
                }
            },error(){
                toastr.error('Something went wrong, please contact administrator')
            }
        })
    })

    function assignDesignations(data) {
        let selectedDesignations = data.designations ? JSON.parse(data.designations) : [];

        console.log(selectedDesignations);

        if (selectedDesignations.length) {
            // Uncheck all checkboxes
            $('input[name="designations"]').prop('checked', false);

            // Check the selected ones
            $.each(selectedDesignations, function (i, designation) {
                $('#designation_' + parseInt(designation)).prop('checked', true);
            });
        }
    }

    $('.authorList').on('click', '.removePaperAuthor', function(){
        let paper_author_id = $(this).attr('paper_authors_id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This author will be removed",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                removePaperAuthor(paper_author_id);
            }
        })
    })
//
    $('.authorList').on('click', '.resendEmailBtn', function(){
        let paper_id = $(this).attr('paper_id')
        Swal.fire({
            title: 'Are you sure?',
            text: "An email will be sent to this author",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Continue'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: base_url + '/user/resend_disclosure_email',
                    data: {
                        'user_id': $(this).attr('user_id'),
                        'paper_id': paper_id,
                        'author_id': $(this).attr('author_id'),
                        'paper_authors_id': $(this).attr('paper_authors_id'),
                    },
                    method: "POST",
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please Wait !',
                            html: 'Sending email to author...',// add html attribute if you want or remove
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function (response, status) {
                        if(response.status == 200){
                            swal.close();
                            swal.fire(
                                'success',
                                'Email sent successfully',
                                'success',
                            )
                            getPaperAuthors(paper_id)
                        }else{
                            swal.fire(
                                'info',
                                'Sorry you cannot edit this author, reason: '+ response.reason,
                                'info',
                            )
                        }
                    },error(){
                        toastr.error('Something went wrong, please contact administrator')
                    }
                });
            }
        })

    })
//

    $('.quickAddAuthorTable').on('click', '.quickAddAuthorBtn', function(e){
        e.preventDefault();

        let author_id = $(this).attr('author_id');
        $.ajax({
            url: base_url+'user/quick_add_author',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {
                'author_id':author_id,
                'paper_id': paper_id
            },
            method: "POST",
            dataType: "json",
            beforeSend: function() {
                Swal.fire({
                    title: 'Please Wait !',
                    html: 'Loading...',// add html attribute if you want or remove
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            },
            success: function(response, status ) {
                // console.log((response.data == null)?'null':'not null');return false;
                if(response.status === 200){
                    swal.close();
                    if(response.data !== null){
                        Swal.fire(
                            'Updated',
                            response.message,
                            'success'
                        )
                    }
                    Swal.fire(
                        'Updated',
                        'Author added successfully',
                        'success'
                    )
                    $('#authorResultModal').modal('hide');
                    $('#searchAuthorModal').modal('hide');
                }else{
                    swal.close()
                   /* Swal.fire(
                        'Please note',
                        response.message,
                        'warning'
                    )*/
                }
                getPaperAuthors(paper_id);
            }
        });

    })

    $('.authorList').on('click','.discloseNowBtn', function(){
        let abstract_id = $(this).attr('abstract_id');
        window.location.href = base_url + '/author/view_copyright';
    })

    $('.authorList').on('click', '.presentingAuthor', function(){
        let id = $(this).attr('author-id')
        $('#correspondent_' + id).prop('checked', true);
    })


})
function getPaperAuthors(paper_id = null) {
    $('.authorList').html('');

    $.post(`${base_url}/user/get_paper_authors`, { paper_id }, function(response) {
        $('.authorList').html('');

        $.each(response.data, async function(index, author) {
            console.log(author)
            let completeStatus = checkCompleteStatus(author);
            let presenting = author.is_presenting_author === 'Yes' ? 'checked' : '';
            let senior_author = author.is_senior_author === 'Yes' ? 'checked' : '';
            let correspondent = author.is_correspondent === 'Yes' ? 'checked' : '';

            let copyrightStatus = getCopyrightStatus(author);
            let emailed = getEmailStatus(author);
            let actionButton = getActionButton(author, emailed);

            $('.authorList').append(await getAuthorRow(index, author, presenting, senior_author, correspondent, completeStatus, copyrightStatus, emailed, actionButton));
            $('.presentingAuthor').each(function(){
                if($(this).prop('checked')){
                    let presentingAuthorFullName = author.name +' '+ author.surname
                    $('.presentingAuthorName').html('<span class="text-primary presentingAuthorNameValue">'+presentingAuthorFullName+'</span>')
                    $('.cvUploadBtn').attr('presenting_author', presentingAuthorFullName);
                    $('.presentingAuthorSubInfo').show();
                }
            })
        });
    }, 'json');
}

function checkCompleteStatus(author) {
    const requiredFields = ['email', 'institution_id'];
    return requiredFields.every(field => author[field]);
}

function getCopyrightStatus(author) {
    if (!author.signature_signed_date) {
        return `<small class="text-warning">none</small>`;
    }

    let signedDate = formatDate(author.signature_signed_date);
    let isCurrent = new Date(signedDate) > new Date(disclosure_current_date);

    return isCurrent
        ? `<small class="text-success">current : <br>${signedDate}</small>`
        : `<small class="text-danger">expired : <br>${signedDate}</small>`;
}

function getEmailStatus(author) {
    if (!author.mailLogs) return 'none';

    return author.mailLogs.updated_at?.split(' ')[0] ||
        author.mailLogs.created_at?.split(' ')[0] ||
        'none';
}

function getActionButton(author, emailed) {
    let isCurrent = author.signature_signed_date
        ? new Date(formatDate(author.signature_signed_date)) > new Date(disclosure_current_date)
        : false;

    // If the agreement is current, show a success icon
    if (isCurrent) {
        return `<i class="fa-sharp fa-solid fa-circle-check text-success"></i>`;
    }

    // If the user is the current user
    if (author.author_id === current_user_id) {
        // If signature is present but not current, show Resend/Email button
        if (author.signature_signed_date) {
            let actionType = emailed !== 'none' ? 'Resend' : 'Email Now';
            return `
                <a class="btn btn-sm btn-primary text-white resendEmailBtn" 
                   author_id="${author.author_id}" 
                   paper_authors_id="${author.id}" 
                   paper_id="${author.paper_id}" 
                   user_id="${author.user_id}">
                   <i class="fa-solid fa-square-envelope"></i> ${actionType}
                </a>`;
        } else {
            // If no signature, allow disclosure
            return `
                <a class="btn btn-sm btn-info text-white discloseNowBtn"
                   author_id="${author.author_id}"
                   paper_authors_id="${author.id}"
                   paper_id="${author.paper_id}"
                   user_id="${author.user_id}">
                   <i class="fa-solid fa-square-envelope"></i> Disclose Now
                </a>`;
        }
    }

    // Default case — show Resend/Email Now for other users
    let actionType = emailed !== 'none' ? 'Resend' : 'Email Now';
    return `
        <a class="btn btn-sm btn-primary text-white resendEmailBtn" 
           author_id="${author.author_id}" 
           paper_authors_id="${author.id}" 
           paper_id="${author.paper_id}" 
           user_id="${author.user_id}">
           <i class="fa-solid fa-square-envelope"></i> ${actionType}
        </a>`;
}


async function getAuthorRow(index, author, presenting, senior_author, correspondent, completeStatus, copyrightStatus, emailed, actionButton) {
    return `
        <tr class="author_order" author_id="${author.author_id}" order="${author.author_order}" name="${author.name}" paper_authors_id="${author.id}" paper_id="${author.paper_id}">
            <td><span class="order_num">${index + 1}.</span></td>
            <td class="text-nowrap">${author.name} ${author.surname}</td>
            <td class="text-nowrap">
                <input id="correspondent_${author.author_id}" type="checkbox" class="correspondent markedCorrespondent" author-id="${author.author_id}" ${correspondent}>
                <label for="correspondent_${author.author_id}"> Correspondent</label>
            </td>
            <td class="text-nowrap">
                <input name="presentingAuthor" id="presentingAuthor_${author.author_id}" type="radio" class="presentingAuthor" author-id="${author.author_id}" ${presenting} author_name="${author.name}"  author_surname="${author.surname}">
                <label for="presentingAuthor_${author.author_id}"> Lead Presenter</label>
            </td>
           <!-- <td class="text-nowrap">
                <input id="senior_author${author.author_id}" type="radio" class="senior_author" name="senior_author" author-id="${author.author_id}" ${senior_author}>
                <label for="senior_author${author.author_id}"> Senior Author</label>
            </td> -->
            <td class="text-nowrap">
                <a class="btn btn-sm btn-primary text-white moveUp"><i class="fa-solid fa-arrow-up"></i></a>
            </td>
            <td class="text-nowrap">
                <a class="btn btn-sm btn-primary text-white moveDown"><i class="fa-solid fa-arrow-down"></i></a>
            </td>
            <td class="text-nowrap">
                <a class="btn btn-sm btn-info text-white editAuthorListedBtn" 
                   author_id="${author.author_id}" 
                   paper_authors_id="${author.id}" 
                   paper_id="${author.paper_id}">
                   <i class="fa-solid fa-user-pen"></i>
                </a>
            </td>
            <td class="text-nowrap">
                <a class="btn btn-sm btn-danger text-white removePaperAuthor" 
                   author_id="${author.author_id}" 
                   paper_authors_id="${author.id}" 
                   paper_id="${author.paper_id}">
                   <i class="fa-solid fa-user-xmark"></i>
                </a>
            </td>
            <!-- <td class="tdCompleteStatus" status="${completeStatus ? 1 : 0}">
                ${completeStatus ? `<span class="text-success small">Completed</span>` : `<span class="text-danger small">Incomplete</span>`}
            </td>
            <td style="text-align:center" class="copyrightStatus text-wrap">${copyrightStatus}</td>
            <td class="text-nowrap"><span class="small">${emailed}</span></td>
            <td class="text-nowrap">${actionButton}</td> -->
        </tr>`;
}

function formatDate(date) {
    return new Date(date).toISOString().split('T')[0].replace(/-/g, '/');
}

function removePaperAuthor(paper_author_id){
    $.ajax(
        {
            url: base_url + '/user/remove_paper_author',
            dataType: 'json', // type of response data
            type: 'POST',
            data: {
                paper_author_id: paper_author_id
            },
            success: function(response){
                if(response.status === 200){
                    swal.fire(
                        'Removed',
                        'Author has been removed',
                        'success'
                    )
                    getPaperAuthors(paper_id)
                    console.log(getPaperAuthors(paper_id))
                }
            }
        });
}
//
function required_field_missing(field){
    Swal.fire({
        title: '',
        html: 'Please fill all required fields, <span class="text-danger">'+ field +'</span> is empty',// add html attribute if you want or remove
        allowOutsideClick: true,
        icon:'info'
    });
    return false;
}
//
// function countWords(inputText){
//     let wordCount = inputText.trim().split(/\s+/).length;
//
//     return wordCount;

function saveCommentToUpload(review_id, comment, paper_id){  //Saving Submitter Comment/Response on reviewers re-upload
    $.ajax(
        {
            url: base_url + '/user/saveCommentToUpload',
            dataType: 'json', // type of response data
            type: 'POST',
            data: {
                review_id: review_id,
                comment:comment,
                paper_id:paper_id
            },
            success: function(response){
                if(response.status === "200"){
                    swal.fire(
                        'Saved',
                        'Comment has been saved',
                        'success'
                    )
                }

                $('#collapseExample_'+review_id).collapse('hide')
            }
        });
}

function addSearchedAuthor(paper_id, selected_user_id){
    $.ajax({
        url: base_url+'/user/assign_abstract_author',
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        data: {
            'author_ids':selected_user_id,
            'paper_id': paper_id
        },
        method: "POST",
        dataType: "json",
        beforeSend: function() {
            Swal.fire({
                title: 'Please Wait !',
                html: 'Loading...',// add html attribute if you want or remove
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        },
        success: function(response, status ) {
            // console.log((response.data == null)?'null':'not null');return false;
            if(response.status == "200"){
                console.log(response.data.duplicate.length);
                swal.close();
                if(response.data.duplicate.length == 0){

                    //task: remove the popup
                    // Swal.fire(
                    //     'Success',
                    //     response.message,
                    //     'success'
                    // )
                }else if(response.data.duplicate.length > 0){
                    let auhtors = '';
                    $.each(response.data.duplicate, function(i, val){
                        auhtors += val.name+' '+val.surname +'<br>'
                    })
                    Swal.fire(
                        'Updated',
                        'Authors added! <br> <span class="fw-bolder">'+ response.data.duplicate.length+' Duplicate author(s): </span>: <br>'+auhtors,
                        'success'
                    )
                }

                $('#authorResultModal').modal('hide');
                $('#searchAuthorModal').modal('hide');
            }else{
                Swal.fire(
                    'error',
                    response.reason,
                    'error'
                )
            }
            getPaperAuthors(paper_id);
        }
    });
}

function uploadCV($this) {
    let presenting_author = $this.attr('presenting_author');
    let fileInput = $('input[name="cv_upload"]')[0];

    if (!fileInput.files.length) {
        toastr.error('Please choose a file to upload!');
        return false;
    }

    let file = fileInput.files[0];
    let fileName = file.name;

    if (!presenting_author) {
        toastr.error('Please Select Presenting Author First!');
        return false;
    }

    let extension = file.name.split('.').pop().toLowerCase();
    let valid_upload_filter = ['pdf'];

    if ($.inArray(extension, valid_upload_filter) === -1) {
        Swal.fire({
            title: 'Invalid file',
            text: 'CV must be a PDF file',
            icon: 'info'
        });
        return false;
    }

    presenting_author = presenting_author.replace(/ /g, '_');
    let newFileName = presenting_author + '_' + fileName;

    Swal.fire({
        title: "Are you sure?",
        text: "Your file will be renamed to " + newFileName,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, upload it!"
    }).then((result) => {
        if (result.isConfirmed) {
            let abstract_id = $this.attr('abstract_id');
            let formUpload = new FormData();
            formUpload.append('cv_upload', file);
            formUpload.append('abstract_id', abstract_id);
            formUpload.append('upload_save_name', newFileName);

            $.ajax({
                url: base_url + '/user/cv_upload',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                data: formUpload,
                method: "POST",
                processData: false,
                contentType: false,
                beforeSend: function () {
                    Swal.fire({
                        title: 'Please Wait!',
                        html: 'Uploading...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function (response) {
                    console.log(response);
                    if (response.status === "success" && response.data && response.data.cv_file_path) {
                        Swal.fire({
                            title: 'Success',
                            text: 'CV uploaded successfully',
                            icon: 'success'
                        });

                        $('#cv_preview')
                            .html(`<a href="${response.data.cv_file_path}" target="_blank">${newFileName}</a>`)
                            .attr('has_val', '1');
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong uploading the CV. Please contact administrator.',
                            icon: 'error'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Server error occurred. Please try again later.',
                        icon: 'error'
                    });
                }
            });
        }
    });

    return false;
}


