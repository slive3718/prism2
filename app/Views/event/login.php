<link href="<?=base_url()?>/assets/css/event/login.css" rel="stylesheet">

<?php echo view('event/common/menu'); ?>
<style>
    :root {
        --primary-color: #024464;
        --secondary-color: #00948b;
        --primary-hover: #0b5ed7;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    main {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 20px 0;
    }

    body .container-fluid{
        /*background-color: var(--primary-color);*/
    }

    .login-container {
        max-width: 750px;
        margin: 0 auto;
        animation: fadeIn 0.6s ease-in-out;
        background-color: var(--primary-color);
        padding: 20px;
        border-radius: 10px;
    }

    .login-header {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        /*color: var(--primary-color);*/
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        letter-spacing: 1px;
        color: white;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: var(--secondary-color);
        color: white;
        font-size: 1.1rem;
        padding: 1rem 1.5rem;
    }

    .card-body{
        font-size:16px;
    }

    .form-signin {
        max-width: 750px;
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        margin-top: 2rem;
    }

    .form-floating {
        margin-bottom: 1.5rem;
    }

    .form-control {
        height: 50px;
        border-radius: 8px;
        padding: 0 20px;
        border: 1px solid #ced4da;
        transition: all 0.1s;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        border-color: var(--primary-color);
    }

    .SignInBtn {
        width: 100%;
        padding: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 8px;
        background-color: var(--secondary-color);
        border: none;
        transition: all 0.3s;
    }

    .SignInBtn:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
    }

    .section-title {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .forgotPasswordBtn {
        color: var(--primary-color);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .forgotPasswordBtn:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    .create-account-link {
        color: var(--primary-color);
        font-weight: 500;
        transition: all 0.2s;
    }

    .create-account-link:hover {
        color: var(--primary-hover);
        text-decoration: none;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        z-index: 5;
    }

    .password-container {
        position: relative;
    }
</style>
<main style="margin: unset; padding-bottom:200px">
    <div class="container-fluid">
        <div class="login-container">
            <div class="login-header">
                <i class="fas fa-sign-in-alt me-2"></i> LOGIN
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i> NOTE FOR SUBMITTERS
                </div>
                <div class="card-body text-start">
                    <p class="mb-0">
                        If you have previously been a submitter or an author on an abstract for a PRiSM Annual Meeting,
                        please use that email address and password: <strong>PRISM2026</strong>.
                        You can change your password once you are logged in under 'Settings'.
                    </p>
                </div>
            </div>

            <?php if(1==1) : ?>
                <div class="form-signin">
                    <div class="mb-4">
                    <span class="section-title d-block mb-2">
                        <i class="fas fa-user-plus me-2"></i> New Submitter?
                    </span>
                        <a href="<?=base_url()?>/account" class="create-account-link">
                            <i class="fas fa-arrow-right me-1"></i> Click here to create new account
                        </a>
                    </div>

                    <div class="mb-4">
                    <span class="section-title d-block mb-2">
                        <i class="fas fa-sign-in-alt me-2"></i> Returning to the site?
                    </span>
                        <p class="text-muted mb-0">Enter your email and password and click on 'Login'</p>
                    </div>

                    <form id="formLogin" action="<?=base_url()?>/login/validateLogin" method="post">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" autocomplete="username" required>
                            <label for="floatingInput">
                                <i class="fas fa-envelope me-2"></i>Email address <small class="text-danger">*</small>
                            </label>
                        </div>

                        <div class="form-floating password-container">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="current-password" required>
                            <label for="floatingPassword">
                                <i class="fas fa-lock me-2"></i>Password <small class="text-danger">(Password is case sensitive) *</small>
                            </label>
                            <span class="password-toggle" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </span>
                        </div>

                        <button type="submit" class="SignInBtn btn btn-primary mb-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>

                        <div class="text-start">
                        <span class="section-title d-block mb-2">
                            <i class="fas fa-key me-2"></i> Forgot your password?
                        </span>
                            <a href="#" class="forgotPasswordBtn">
                                <i class="fas fa-arrow-right me-1"></i> Click here to reset your password
                            </a>
                        </div>
                    </form>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center" role="alert">
                            The submission site is now closed. Thank you for your interest!
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>

    </div>
</main>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please type your registered email address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <input type="email" class="form-control text-center" id="resetPasswordEmail" placeholder="name@example.com" autocomplete="email" required>
                    <label for="resetPasswordEmail">Email address <small class="text-danger">*</small></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitForgotPWBtn">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('floatingPassword');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
<script>
    $(function(){

        $('.SignInBtn').on('click', function(e){
            e.preventDefault();
            let email = $('#floatingInput').val();
            let password = $('#floatingPassword').val();
            $.post(base_url+'login/validateLogin',
                {
                    'email': email,
                    'password': password,
                    'login_type': "user"

                }, function(response){

                    console.log(response)
                    if(response.status == "200"){
                        let timerInterval
                        Swal.fire({
                            title: 'Login Success',
                            html: 'Redirecting to homepage...',
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href="<?=base_url()?>/home";
                            }
                        })
                    }else{
                        Swal.fire(
                            '',
                            "Invalid Username or Password",
                            'warning'
                        )
                    }
                },'json')
        })

        // ############### forgot password ##################

        $('.forgotPasswordBtn').on('click', function(){
            $('#forgotPasswordModal').modal('show')
        })

        $('.submitForgotPWBtn').on('click', function() {

            Swal.showLoading();  // Show loading animation

            $.ajax({
                url: base_url + "/account/reset_password",  // URL to send the request
                type: 'POST',  // Method type
                data: {
                    'email': $('#resetPasswordEmail').val()  // Data to be sent
                },
                dataType: 'json',  // Expect JSON response
                beforeSend: function () {  // No comma before this
                    Swal.showLoading();  // Show loading animation
                },
                success: function(response) {
                    console.log(response);

                    // Check if the response status is 200 (success)
                    if (response.status == '200') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Password reset instructions sent to your email.'
                        });
                        $('#forgotPasswordModal').modal('hide');  // Hide modal on success
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'There was an issue. Please try again.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr, status, error)
                    // Handle failed request (e.g., network error, server error)
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: error + '<br>Please register here: <a href="'+base_url+'account"> Register Link</a>'
                    });
                    // console.log('Error:', error);  // Log the error for debugging
                }
            });
        });

    })
</script>