
    </div>

                    </div>
                </div>
            </div>
        </div>
    <!-- /Main Wrapper -->
    
   
    
    <!-- Bootstrap Core JS -->
        <script src="<?php echo base_url(); ?>assets/login/js/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/login/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/login/plugins/sweetalert/lib/sweet-alert.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/login/plugins/toastr/toastr.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/login/js/script.js"></script>
    <script>
                      // Preloader
  $(window).on('load', function () {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function () {
        $(this).remove();
      });
    }
  });
  
  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<div id="preloader"></div>
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Feb 2020 16:28:15 GMT -->
</html>

