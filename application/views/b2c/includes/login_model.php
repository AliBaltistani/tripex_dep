<div class="modal login-modal" id="user-login" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-clode-btn" data-bs-dismiss="modal"></div>
            <div class="modal-header">
                <img src="<?= base_url() ?><?= base_url() ?>assets/img/home1/login-modal-header-img.jpg" alt>
            </div>
            <div class="modal-body" id="login-modal-body">
                <div class="login-registration-form" id="login-form">
                    <div class="form-title">
                        <h2>Sign in to continue</h2>
                        <p id="feedback" class="my-4">Enter your email & password for Login.</p>
                    </div>
                    <form>
                        <div class="form-inner mb-20">
                            <input type="text" name="email" id="loginEmail" placeholder="User name or Email *" value="">
                        </div>
                        <div class="form-inner mb-20">
                            <input type="password" name="password" id="loginPassword" placeholder="User Password *" value="">
                        </div>
                        <a href="#" onclick="loginMe()" class="login-btn mb-25">Sign In</a>
                        <div class="divider">
                            <span>or</span>
                        </div>
                        <a href="#" onclick="showSignUp()" class="google-login-btn">
                            <div class="icon">
                                <!-- <img src="<?= base_url() ?>assets/img/home1/icon/google-icon.svg" alt> -->
                            </div>
                            Sign Up
                        </a>
                    </form>
                </div>

                <div class="login-registration-form" id="register-form" style="display: none !important;">
                    <div class="form-title">
                        <h2 id="signup">Sign up </h2>
                        <p id="regfeedback" class="my-4">Please fill the form for registration.</p>
                    </div>
                    <form role="form" id="addUser" action="#" method="post" >
                        <div class="form-inner mb-20">
                            <input type="text" name="fname" id="regFName" placeholder="Your Fullname *" value="">
                        </div>
                        <div class="form-inner mb-20">
                            <input type="text" name="email" id="regEmail" placeholder="Your Email *" value="">
                        </div>
                        <div class="form-inner mb-20">
                            <input type="text" name="mobile" id="regPhone" placeholder="Your Phone number *" value="">
                        </div>
                        <div class="form-inner mb-20">
                            <input type="password" name="password" id="regPassword" placeholder="User Password *" value="">
                        </div>
                        <div class="form-inner mb-20">
                            <input type="password" name="cpassword" id="regCPassword" placeholder="User Password *" value="">
                        </div>
                        <div class="form-inner mb-20">
                            <input type="hidden" name="regAgent" id="regAgent" value="">
                        </div>
                        <a href="#" onclick="signUpMe()" class="login-btn mb-25">Sign Up</a>
                        <div class="divider">
                            <span>or</span>
                        </div>
                        <a href="#" onclick="showSignIn()" class="google-login-btn">
                            <div class="icon">
                                <!-- <img src="<?= base_url() ?>assets/img/home1/icon/google-icon.svg" alt> -->
                            </div>
                            Back to login
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/admin/js/addUser.js" type="text/javascript"></script>

<script>

// $(document).ready(function(){
    $('#regAgent').val('');
    function loginMe() {
        var current = $('#feedback');
        const uEmail = $('#loginEmail').val();
        const uPassword = $('#loginPassword').val();

        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>Login/userLogin',
            data: {
                email: uEmail,
                password: uPassword
            },
            dataType: 'json',
            beforeSend: function() {
                $('#feedback').html('loading..');
            },
            success: function(response) {
                console.log(response);
                if (response.status == true) {
                    window.location.href = response.redirect;
                }
                $('#feedback').html(response.message);
            },
            error: function(xhr, status, error) {
                $('#feedback').html(xhr.responseText);
                console.error(xhr.responseText);
            }
        }); // end ajax
    } // end loginMe

    function signUpMe() {
        var current = $('#regfeedback');
        const fname = $('#regFName').val();
        const rEmail = $('#regEmail').val();
        const rPhone = $('#regPhone').val();
        const rPassword = $('#regPassword').val();
        const rCPassword = $('#regCPassword').val();
        const rAgent = $('#regAgent').val();

        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>Login/newSignUpUser',
            data: {
                fname: fname,
                email: rEmail,
                mobile: rPhone,
                password: rPassword,
                cpassword: rCPassword,
                agent: rAgent
            },
            dataType: 'json',
            beforeSend: function() {
                $('#regfeedback').html('loading..');
            },
            success: function(response) {
                // console.log(response);
                
                if (response.status == true) {

                    $('#regfeedback').html('<small >'+response.message+'</small>');
                    showSignIn();
                    // window.location.href = response.redirect;
                }else if (response.status == false) {
                    $('#regfeedback').html('<small >'+response.message+'</small>');
                }
            },
            error: function(xhr, status, error) {
                $('#regfeedback').html(xhr.responseText);
                console.error(xhr.responseText);
            }
        }); // end ajax
    } // end signUpMe

    function OnAgentLogin(){
        $('#signup').html('<h3>Agent Register</h3>');
        $('#regAgent').val('<?=AGENT_USER?>');
    }
    function OnGuestLogin(){
        $('#signup').html('<h3>Guest Register</h3>');
        $('#regAgent').val('<?=REGULAR_USER?>');
    }

    function showSignUp(){
       $("#login-form").slideUp(1000).hide();
       $("#register-form").slideDown(1000).show();
    } // end showSignUp

    function showSignIn(){
       $("#register-form").slideUp(1000).hide();
       $("#login-form").slideDown(1000).show();
    } // end showSignUp


// });// end document.ready

</script>