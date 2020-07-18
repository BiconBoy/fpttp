

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

 <?php  if(isset($_SESSION['account_credential'])){ ?>
            <div class="alert alert-success">
                     <?php  echo $_SESSION['account_credential'] ?>
            </div>
<?php }else{ ?>
                <strong>Create FPT-TP account</strong>
                <div id="result_returned"></div>
                

                 <?php  
                    if(isset($_SESSION['account_error'])):
                        echo $_SESSION['account_error'];
                        unset($_SESSION['account_error']);
                    endif;
                  ?>
                
                <!-- Form -->
                <form method="post" action="<?php echo base_url('Home/create_new_acount'); ?>" style="margin-top: 10px">
                  <div class="form-group">
                    <input required class="form-control form-control-sm" name="UID" type="text" placeholder="Enter your Reg No eg EAB/D/2018/xxxx">
                  </div>
                  <div class="form-group form-group-sm">
                    <input class="form-control form-control-sm" required id="password-field" type="password" name="password" placeholder="Enter your password eg EABxxx">
                    <span style="cursor: pointer;margin-top: -25px; margin-right: 4px;" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password pull-right"></span>
                  </div>
                  <div class="form-group text-center">
                    <button class="btn btn-secondary btn-sm" id="click_submit_btn" type="submit">Submit <span id="spinner_show" style="display: none;" class="fa fa-spinner fa-spin"></span></button>
                  </div>
                </form>
                <!-- /Form -->
                 <div class="login-or"  style="margin-top:-20px">
                  <span class="or-line"></span>
                  <span class="span-or">or</span>
                </div>
                <div class="text-center forgotpass" style="margin-top:-20px"><small><a href="<?php echo base_url(''); ?>">BACK TO LOGIN</a></small></div>
               
                 <?php } ?> 
                 
              
              </div>
            </div>
           
 <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/login/js/jquery-3.2.1.min.js"></script>   
<script>

 
  <?php  if(isset($_SESSION['account_exist'])): ?>
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
    toastr["error"]("<strong>Sorry!! account arleady exixt.</strong>")

});
<?php unset($_SESSION['account_exist']); endif; ?>

 
</script>