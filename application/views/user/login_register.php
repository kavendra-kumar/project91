<!DOCTYPE html>
<html lang="en">
<?php 
$title_name = 'Login - Register'; 
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url('assets/images/project91_Round_logo.png');?>">
  <title><?php echo $title_name; ?> | project91</title>
  <!-- Vendors Style-->
  <link rel="stylesheet" href="<?php echo base_url('assets/css_js/login_register/vendor_components/bootstrap/dist/css/bootstrap.css');?>">   
  <link rel="stylesheet" href="<?php echo base_url('assets/css_js/login_register/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">      
    <!-- Style-->  
  <link rel="stylesheet" href="<?php echo base_url('assets/css_js/login_register/css/style.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css_js/login_register/css/checkbox_style.css');?>">
  <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script> 
</head>

<body class="hold-transition theme-primary bg-img">
  <div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">
      <div class="col-12">
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-5 col-md-5 col-12">
            <div class="bg-white rounded30 shadow-lg">
              <div class="content-top-agile p-20 pb-0">
                <img class="login-logo" src="">
              </div>

              <div class="box-body">
                <ul class="nav nav-tabs customtab2" role="tablist">
                  <li class="nav-item"> 
                    <a class="nav-link active" data-toggle="tab" href="#home7" role="tab" aria-selected="true">
                      <span class="hidden-sm-up">
                        Login
                      </span> 
                      <span class="hidden-xs-down">Login</span>
                    </a> 
                  </li>
                  <!-- <li class="nav-item"> 
                    <a class="nav-link" data-toggle="tab" href="#profile7" role="tab" aria-selected="false">
                      <span class="hidden-sm-up">
                        Registration
                      </span> 
                      <span class="hidden-xs-down">Registration</span>
                    </a> 
                  </li> -->
                </ul>

                <!-- LOGIN SECTION START -->
                <div class="tab-content">
                  <div class="tab-pane active" id="home7" role="tabpanel">
                    <div class="p-15">
                      <form method="POST" name="login_form" id="login_form" class="login_form" autocomplete="off">
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                            </div>
                            <input type="email" name="login_email" id="login_email" value="<?php if(isset($_COOKIE["med_email"])) { echo $_COOKIE["med_email"]; } ?>" class="form-control pl-15 bg-transparent" placeholder="Email Address" required="">
                          </div>
                          <span id="login_emailErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" name="login_password" id="login_password" value="<?php if(isset($_COOKIE["med_password"])) { echo $_COOKIE["med_password"]; } ?>" class="form-control pl-15 bg-transparent password-pl" placeholder="Password" required="">
                            <div class="input-group-append">
                              <span class="input-group-text"><i onclick="loginPassword();" class="fa fa-eye" id="togglePassword1"></i></span>
                            </div>
                          </div>
                          <span id="login_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="g-recaptcha" data-sitekey="6Ldw3zocAAAAAG3QmoHLPRc-Y2CBq-SSIFtZE8hf"></div>
                          </div>
                          <span id="recaptchaErr" class="text-danger"></span>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="checkbox">
                              <input name="basic_checkbox_1" id="basic_checkbox_1" type="checkbox" <?php if(isset($_COOKIE["med_password"])) { ?> checked <?php } ?> >
                              <label for="basic_checkbox_1">Remember Me</label>
                            </div>
                          </div>
                          <div class="col-12 text-center">
                            <button type="submit" id="login_submit" class="waves-effect waves-light btn-block btn btn-primary">SIGN IN</button>
                            <img id="login_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
                          </div>
                        </div>
                      </form>
                      
                    </div>
                  </div>
                  <!-- LOGIN SECTION END -->

                  <!-- REGISTRATION SECTION START -->
                  <div class="tab-pane" id="profile7" role="tabpanel">
                    <div class="p-15">
                      <form method="POST" name="registration_form" id="registration_form" class="registration_form" autocomplete="off">
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                            </div>
                            <input type="text" name="first_name" id="first_name" class="form-control pl-15 bg-transparent" placeholder="First Name" required="">
                          </div>
                          <span id="first_nameErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                            </div>
                            <input type="text" name="last_name" id="last_name" class="form-control pl-15 bg-transparent" placeholder="Last Name" required="">
                          </div>
                          <span id="last_nameErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                            </div>
                            <input type="email" name="email_address" id="email_address" class="form-control pl-15 bg-transparent" placeholder="Email Address" required="">
                          </div>
                          <span id="email_addressErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control pl-15 bg-transparent password-pl" placeholder="Password" required="">
                            <div class="input-group-append">
                              <span class="input-group-text"><i onclick="newPassword();" class="fa fa-eye" id="togglePassword2"></i></span>
                            </div>
                          </div>
                          <span id="passwordErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>                              
                            </div>
                            <input type="password" name="conf_password" id="conf_password" class="form-control pl-15 bg-transparent password-pl" placeholder="Retype Password" required="">
                            <div class="input-group-append">
                              <span class="input-group-text"><i onclick="confPassword();" class="fa fa-eye" id="togglePassword3"></i></span>
                            </div>
                          </div>
                          <span id="conf_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="g-recaptcha" data-sitekey="6Ldw3zocAAAAAG3QmoHLPRc-Y2CBq-SSIFtZE8hf"></div>
                          </div>
                          <span id="g-recaptcha-responseErr" class="text-danger"></span>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="checkbox">
                              <label for="basic_checkbox_1">By signing in you agree to Project terms & privacy policy.</label>
                            </div>
                          </div>
                          <div class="col-12 text-center">
                            <button type="submit" id="register_submit" class="waves-effect waves-light btn-block btn btn-primary">REGISTER</button>
                            <img id="register_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
                          </div>
                        </div>
                      </form>    
                      <script src='https://www.google.com/recaptcha/api.js'></script>                  
                    </div>
                  </div>
                  <!-- REGISTRATION SECTION END -->

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="<?php echo base_url('assets/js/vendors.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/login_register/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js');?>"></script>
<?php
if(($this->session->flashdata('message')) && ($this->session->flashdata('message') != ""))
{
?>
<script type="text/javascript">
$.toast({
          heading: 'project91',
          text: '<?php echo $this->session->flashdata('message'); ?>',
          position: 'top-right',
          loaderBg: '#9fcd53',
          icon: 'success',
          hideAfter: 5500,
          stack: 6
      });
</script>
<?php
}
?>
<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script type="text/javascript">
$(function(){
  function rescaleCaptcha(){
    var width = $('.g-recaptcha').parent().width();
    var scale;
    if (width < 302) {
      scale = width / 302;
    } else{
      scale = 1.0; 
    }

    $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('transform-origin', '0 0');
    $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
  }

  rescaleCaptcha();
  $( window ).resize(function() { rescaleCaptcha(); });

});
</script>
<script type="text/javascript">
function loginPassword() {
  var x = document.getElementById("login_password");
  var y = document.getElementById("togglePassword1");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

function newPassword() {
  var x = document.getElementById("password");
  var y = document.getElementById("togglePassword2");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

function confPassword() {
  var x = document.getElementById("conf_password");
  var y = document.getElementById("togglePassword3");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}
</script>
</body>
</html> 