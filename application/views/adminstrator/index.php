 <?php 
    $adminstrator['username'] = $adminstrator["lname"].", ".$adminstrator["fname"]." ".$adminstrator["mname"];
?>
	
?>
<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $maintitle; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('adminstrator'); ?>"><?php echo $title; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $subtitle; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="margin-top: -23px">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            
            <div class="card card-outline card-success">
              
              <div class="card-header">
                <h3 class="card-title"><?php echo $year; ?> Aplication <?php if($asistance_admin_access): ?>
 general report<?php endif; ?></h3>
              </div>
              <div class="card-body">


              <div class="row">
                <?php if($asistance_admin_access): ?>
                 <?php if($application){ ?> 
                  <?php foreach($application as $prog): ?>
                    
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?php echo $prog['program']." - ".$prog['study_year']; ?></h3>
                          <?php if($totals):  $no = 0; ?>
                            <?php foreach($totals as $total): ?>
                              <?php if($prog['program'] == $total['program'] AND $prog['study_year'] == $total['study_year']){$no++; } ?>
                            <?php endforeach; ?>
                            <p>Total student: <strong><?php echo $no; ?></strong></p>
                          <?php endif; ?>
                        </div>
                        <div class="icon">
                          <i class="fa fa-users"></i>
                        </div>
                        <?php $program = $prog['program']; ?>
                        <?php $year = $prog['study_year']; ?>
                        <a href="<?php echo base_url('adminstrator/application_report/'.$program).'/'.$year; ?>" class="small-box-footer">View list<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php }else{ ?> 
                  <div class="alert alert-warning">Waiting for field report </div>
                <?php } ?>
              <?php endif; ?>

           
              </div>

                 <strong>Allocation:</strong><br>
             <div class="row">
                  <?php if($assessor_allocation): ?>
                    <div class="col-md-3">
                    <strong class="text-success"><i class="fa fa-check"></i> Assessor:</strong> 
                      <a href="<?php echo base_url('adminstrator/assessor_allocation'); ?>">
                    <button type="button" class="btn btn-block btn-outline-success btn-sm">View allocation</button>
                    </a>
                    <hr>
               </div>
               <?php endif; ?>
                <?php if($logbook): ?>
                    <div class="col-md-3">
                    <strong class="text-success"><i class="fa fa-check"></i> Logbook Marking:</strong> 
                      <a href="<?php echo base_url('adminstrator/logbook_view'); ?>">
                    <button type="button" class="btn btn-block btn-outline-success btn-sm">View now</button>
                    </a>
                    <hr>
               </div>
               <?php endif; ?>

                   <?php if($report): ?>
                    <div class="col-md-3">
                    <strong class="text-success"><i class="fa fa-check"></i> Report Marking:</strong> 
                      <a href="<?php echo base_url('adminstrator/report_view'); ?>">
                    <button type="button" class="btn btn-block btn-outline-success btn-sm">View now</button>
                    </a>
                    <hr>
                    </div>
               <?php endif; ?>

             </div>


            </div>

            </div>

          </div>
        </div>
<script src="<?php echo base_url(); ?>assets/LTE/plugins/jquery/jquery.min.js"></script>
<script>

  <?php  if(isset($_SESSION['login_success'])): ?>
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
    toastr["success"]("<strong><?php echo $adminstrator['username'] ?></strong> Welcome to  Your SMCoSE FPT-TP account")

});
<?php unset($_SESSION['login_success']); endif; ?>
</script>