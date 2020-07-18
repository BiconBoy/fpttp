

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
                
                <strong>Verify password</strong>
                <div id="erros_pwd" class="text-danger"></div>
                <div id="short_pwd" class="text-danger"></div>


                 <?php  
       
                  if(isset($_SESSION['reset_failed'])):
                        echo $_SESSION['reset_failed'];
                        unset($_SESSION['reset_failed']);
                    
                  ?>
                 <?php else: ?>
                <!-- Form -->
                <form method="post" id="my_form" action="<?php echo base_url('Home/reset_password'); ?>" style="margin-top: 10px">
                  <div class="form-group">
                    <input required onkeyup="check_pass()" id="password-field" type="password" name="password"  placeholder="Enter new password" class="form-control form-control-sm">
                     <span  id="question1" style="margin-top: -25px; margin-right: 25px;" class="fa fa-fw fa-question field-icon  pull-right"></span>

                            <span style="cursor: pointer;margin-top: -25px; margin-right: 4px;" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password pull-right"></span>
                  </div>

                  <div class="form-group">
                    <input  required onkeyup="check_pass()" type="password" name="pass2" class="form-control form-control-sm" placeholder="Retype your password">
                    <span id="question2" style="margin-top: -25px; margin-right: 25px;" class="fa fa-fw fa-question field-icon  pull-right"></span>

                  </div>
                  <input type="hidden" name="UID" value="<?php echo $UID; ?>">
                  <input type="hidden" name="user" value="<?php echo $user; ?>">
                  <div class="form-group text-center">
                    <button class="btn btn-secondary btn-sm" id="click_submit_btn" type="submit">Submit <span id="spinner_show" style="display: none;" class="fa fa-spinner fa-spin"></span></button>
                  </div>
                </form>
                <!-- /Form -->
              
                 <div class="login-or">
                  <span class="or-line"></span>
                  <span class="span-or">or</span>
                </div>

                <div class="text-center forgotpass"><a href="<?php echo base_url(''); ?>">Back to login </a></div>
               
                 <?php endif; ?> 
              
              </div>
            </div>
 <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/login/js/jquery-3.2.1.min.js"></script>  
          
<script>
 
  <?php  if(isset($_SESSION['recover_failed'])): ?>
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
    toastr["error"]("<strong>Please check your email and try again</strong>")

});
<?php unset($_SESSION['recover_failed']); endif; ?>

function check_pass(){
    re_pass = $("input[name='pass2'").val();
    new_pass = $("input[name='password'").val();
    pass_len = new_pass.length
    required = 6-pass_len;
    if(pass_len < 6){
      $("#short_pwd").removeClass('text-success');
      $("#short_pwd").addClass('text-danger');
      $("#short_pwd").html("Short password add <strong>"+required+"</strong> character");
    }else{
      $("#short_pwd").removeClass('text-danger');
      $("#short_pwd").addClass('text-success');
      $("#short_pwd").html("password length <i class='fa fa-check'></i>");
    }

    if(new_pass != '' && re_pass != '' && pass_len >= 6){
      if(new_pass == re_pass){
        $("#erros_pwd").html("");
        $("#question2").removeClass('fa fa-question');
        $("#question1").removeClass('fa fa-question');
        $("#question2").removeClass('fa fa-remove text-danger');
        $("#question1").removeClass('fa fa-remove text-danger');
        $("#question2").addClass('fa fa-check text-success');
        $("#question1").addClass('fa fa-check text-success');
        $("#click_submit_btn").show('slow');
      }
      else{
        $("#erros_pwd").html("passwords do not match");
        $("#click_submit_btn").hide('fast');
        $("#question2").removeClass('fa fa-question');
        $("#question1").removeClass('fa fa-question');
        $("#question2").removeClass('fa fa-check text-success');
        $("#question1").removeClass('fa fa-check text-success');
        $("#question2").addClass('fa fa-remove text-danger');
        $("#question1").addClass('fa fa-remove text-danger');
      }
     
    }
    else{
      $("#erros_pwd").html('');
      $("#click_submit_btn").hide('fast');
      $("#question2").removeClass('fa fa-check text-success');
      $("#question1").removeClass('fa fa-check text-success');
      $("#question2").removeClass('fa fa-remove text-danger');
      $("#question1").removeClass('fa fa-remove text-danger');
      $("#question2").addClass('fa fa-question');
      $("#question1").addClass('fa fa-question');
    }
  }
 
</script>