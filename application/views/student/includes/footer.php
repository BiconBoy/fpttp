   
   </div><!-- /.container-fluid -->
    </section>
 
</div>

   <!-- /.content -->
  </div>

  
 
</div>
<!-- ./wrapper -->



  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <a href="#">Bicon Codes generator</a> </strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
<!-- jQuery -->

<script src="<?php echo base_url(); ?>assets/LTE/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/LTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>


<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/LTE/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/LTE/plugins/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/LTE/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/LTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/LTE/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/LTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/LTE/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/LTE/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/login/plugins/sweetalert/lib/sweet-alert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/login/plugins/toastr/toastr.min.js"></script>
<script>
                // Preloader
  $(window).on('load', function () {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function () {
        $(this).remove();
      });
    }
  });
  // Add the following into your HEAD section
var timer = 0;
function set_interval() {
  
  // the interval 'timer' is set as soon as the page loads
   timer = setInterval("auto_logout()", 60000);
  // the figure '10000' above indicates how many milliseconds the timer be set to.
  // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300000 millisec.
  // So set it to 300000
}

function reset_interval() {
  //resets the timer. The timer is reset on each of the below events:
  // 1. mousemove   2. mouseclick   3. key press 4. scroliing
  //first step: clear the existing timer

  if (timer != 0) {
    clearInterval(timer);
    timer = 0;
    //implement the timer again
    timer = setInterval("auto_logout()", 60000);
    // completed the reset of the timer
  }
  
}

function auto_logout() {
  //alert('Time out');
  // this function will redirect the user to the logout script

  window.location.href = "<?php echo base_url('Home/logout') ?>";
}


  $(function () {
    //Date range picker
    $('#reservation').daterangepicker(
      {
      format             : 'DD/MM/YYYY'
    }
      )
  })



</script>

 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/LTE/plugins/printThis/printThis.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
});

  $("my_btn").on('click',function(){
    alert('ok');
  })
  
  


</script>

<div id="preloader"></div>
</body>
</html>
