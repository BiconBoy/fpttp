
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
                <strong>Forget password</strong>
                <div id="result_returned"></div>


                 <?php  
                  if(isset($_SESSION['recover_success']) OR isset($_SESSION['send_emsil_failed'])):
                    if(isset($_SESSION['recover_success'])){
                        echo $_SESSION['recover_success'];
                        unset($_SESSION['recover_success']);
                    }
                    if(isset($_SESSION['send_emsil_failed'])){
                        echo $_SESSION['send_emsil_failed'];
                        unset($_SESSION['send_emsil_failed']);
                    }
                  ?>
                 <?php else: ?>
                <!-- Form -->
                <form method="post" action="<?php echo base_url('Home/recover_password'); ?>" style="margin-top: 10px">
                  <div class="form-group">
                    <input class="form-control form-control-sm" name="UID" type="text" placeholder="Enter your FPT-TP username eg. ECA.2018.XXXX.2019">
                  </div>
                  <div class="form-group form-group-sm">
                    <input required class="form-control form-control-sm"  type="email" name="email" placeholder="Enter your registered previous email">
                  </div>
                  <div class="form-group text-center">
                    <button class="btn btn-secondary btn-sm" id="click_submit_btn" type="submit">Submit <span id="spinner_show" style="display: none;" class="fa fa-spinner fa-spin"></span></button>
                  </div>
                </form>
                <!-- /Form -->
              
                 <div class="login-or">
                  <span class="or-line"></span>
                  <span class="span-or">or</span>
                </div>

                <div class="text-center forgotpass"  style="margin-top:-20px"><a href="<?php echo base_url(''); ?>">Back to login </a></div>
                   <div class="login-or"  style="margin-top:-5px">
                  <span class="or-line"></span>
                  <span class="span-or">or</span>
                </div>
                <div class="text-center forgotpass" style="margin-top:-20px"><small> <a href="<?php echo base_url('Home/new_acount'); ?>">CREATE ACCOUNT</a></small></div>
               
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

 
</script>