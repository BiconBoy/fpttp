  
  <div class="login-right">
              <div class="login-right-wrap">
                 <div class="form-container" style="padding-right: 10px;margin-top: -20px">
               
                      <div class="login-content text-center" style="margin-bottom: 8px">

                    <div style="font-family: Roboto;">
                        <small style="font-size: 15px;">Field Practical Trainning & Teaching Practice<br>SMCoSE FPT-TP system
                        </small>
                    </div>
                     <img class="color-primary" oncontextmenu="return false;"  width='150px'style='background-color:transparent;pointer-events: none;' class="img-fluid"  src="<?php echo base_url(); ?>assets/admin/images/logosua.gif">

                </div>
            </div>
          <strong>Login</strong>  
               
                <form method="post" action="<?php echo base_url('Home/login'); ?>" style="margin-top: 10px">
                  <div class="form-group">
                    <input required class="form-control form-control-sm" name="UID" type="text" placeholder="Enter your FPT-TP username">
                  </div>
                  <div class="form-group form-group-sm">
                    <input class="form-control form-control-sm" required id="password-field" type="password" name="password" placeholder="Password">
                    <span style="cursor: pointer;margin-top: -25px; margin-right: 4px;" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password pull-right"></span>
                  </div>
                  <div class="form-group text-center">
                    <button class="btn btn-secondary btn-sm" id="click_submit_btn" type="submit">Sigin in <span id="spinner_show" style="display: none;" class="fa fa-spinner fa-spin"></span></button>
                  </div>
                </form>
               
                
                 <div class="login-or"  style="margin-top:-20px">
                  <span class="or-line"></span>
                  <span class="span-or">or</span>
                </div>
                <div class="text-center forgotpass" style="margin-top:-20px"><small> <a href="<?php echo base_url('Home/new_acount'); ?>">CREATE ACCOUNT</a></small></div>
                <div class="login-or"  style="margin-top:-5px">
                  <span class="or-line"></span>
                  <span class="span-or">or</span>
                </div>
                <div class="text-center forgotpass" style="margin-top:-20px"><small> <a href="<?php echo base_url('Home/forget_password'); ?>">FORGOT PASSWORD</a></small></div>
               
                  
              
              </div>
            </div>

 <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/login/js/jquery-3.2.1.min.js"></script> 
<script>
  <?php  if(isset($_SESSION['login_failed'])): ?>
  $( document ).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "0",
      "timeOut": "10000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr["error"]("<strong>Incorrect username or password</strong>")

});
<?php unset($_SESSION['login_failed']); endif; ?>


  <?php  if(isset($_SESSION['account_blocked'])): ?>
  $( document ).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "0",
      "timeOut": "10000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr["error"]("<strong>Your account is temporary blocked</strong>")

});
<?php unset($_SESSION['account_blocked']); endif; ?>


  <?php  if(isset($_SESSION['session_not'])): ?>
  $( document ).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "0",
      "timeOut": "10000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr["warning"]("<strong>Account was in use now login</strong>")

});
<?php unset($_SESSION['session_not']); endif; ?>

  <?php  if(isset($_SESSION['reset_canceled'])): ?>
  $( document ).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "0",
      "timeOut": "18000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr["success"]("<strong>Your account is safe you have cancelled reset password</strong>")

});
<?php unset($_SESSION['reset_canceled']); endif; ?>

  <?php  if(isset($_SESSION['token_used'])): ?>
  $( document ).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "0",
      "timeOut": "18000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr["error"]("<strong>Error the token alread used</strong>")

});
<?php unset($_SESSION['token_used']); endif; ?>

 <?php  if(isset($page_error)): ?>
  $( document ).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "0",
      "timeOut": "18000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr["error"]("<strong>Page not found please check your page carefull</strong>")

});
<?php endif; ?>


  <?php  if(isset($_SESSION['reset_success'])): ?>
  $( document ).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "0",
      "timeOut": "18000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr["success"]("<strong>Successiful password recovered now login</strong>")

});
<?php unset($_SESSION['reset_success']); endif; ?>
</script>
