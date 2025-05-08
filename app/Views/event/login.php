
<?php echo view('event/common/menu'); ?>
<style>
    :root {
        --primary-color: #024464;
        --secondary-color: #00948b;
        --glass-blur: 12px;
        --glass-border: 1px solid rgba(255, 255, 255, 0.2);
    }

    body {
        background: #FFFFFF;
        background-attachment: fixed;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    main {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;

    }

    .login-container {
        margin:auto;
        width: 100%;
        max-width: 750px;
        backdrop-filter: blur(var(--glass-blur));
        background: linear-gradient(90deg,rgba(0, 66, 98, 1) 0%, rgba(87, 150, 199, 1) 50%, rgba(0, 66, 98, 1) 100%);
        border-radius: 24px;
        border: var(--glass-border);
        box-shadow: 0 8px 32px rgba(0, 66, 98, 0.3);
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    /* Frosted glass overlay */
    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /*background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.1) 100%);*/
        z-index: -1;
        border-radius: inherit;
    }

    .login-header {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        letter-spacing: 1px;
        padding: 1.5rem 2rem 0;
    }

    .card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin: 0 2rem 2rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: var(--secondary-color);
        color: white;
        font-size: 1.1rem;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-body {
        padding: 2rem;
        background: rgba(255, 255, 255, 0.7);
    }

    .form-control {
        height: 50px;
        border-radius: 8px;
        padding: 0 20px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.2s;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(2, 68, 100, 0.15);
        border-color: var(--primary-color);
        background: white;
    }

    .form-signin{
        width: 700px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin: 0 2rem 2rem;
        padding: 20px;
    }

    .SignInBtn {
        width: 100%;
        padding: 14px;
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 8px;
        background: var(--secondary-color);
        border: none;
        color: white;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0, 148, 139, 0.3);
        margin-top: 1.5rem
    }

    .SignInBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(2, 68, 100, 0.4);
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    /* Floating label adjustments */
    .form-floating label {
        color: #555;
        margin-bottom: 1.5rem;
    }

    .form-floating>.form-control:focus~label {
        color: var(--primary-color);
    }

    /* Link hover effects */

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

    .password-container {
        position: relative;
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


    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-container {
        animation: fadeIn 0.6s ease-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .login-container {
            border-radius: 16px;
        }
        .card {
            margin: 0 1rem 1rem;
        }
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