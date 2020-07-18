<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <a href="<?php echo base_url('adminstrator'); ?>">
                <button class="btn btn-sm btn-success fa fa-angle-double-left"> Back</button>
              </a>

              <?php echo $maintitle; ?></h1>
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
    <section class="content" style="margin-top: -23px;">
      <div class="container-fluid">
        <!-- Small cardes (Stat card) -->
        <div class="row">
          <div class="col-md-12">

            <div class="card card-outline-success">
            <div class="text-center">
             <button style="float:left" class="btn btn-sm btn-outline-success fa fa-download" onclick="download_excel()"> Download Excel</button>
            <button style="float:right;width:100px;" class="btn btn-sm btn-outline-secondary fa fa-print" onclick="print_the_list()"> Print list</button>
            </div>
              <div class="card-body table-responsive">
                <div id="hide">
                <table class="table table-bordered table-hover" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Full name</th>
                      <th>Reg No</th>
                      <th>Assessment</th>
                      <th>Logbook</th>
                      <th>Report</th>
                      <th>document</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($applications): $no =0; ?>
                      <?php foreach($applications as $app):$no++; ?>
                        <tr>
                        <th><?php echo $no; ?></th>
                        <td><?php echo $app['lname'].", ".$app['fname']." ".$app['mname']; ?></td>
                        <td><?php echo $app['Reg_No']; ?></td>
                        <td class="text-center"><?php echo $app['marks']; ?>%</td>
                        <td class="text-center"><?php echo $app['logbook']; ?>%</td>
                        <td class="text-center"><?php echo $app['report']; ?>%</td>
                        <td>
                           <a target=”_blank” href="<?php echo base_url('assets/documents/'.$app['document']); ?>">
                      <button class="btn btn-block btn-sm btn-outline-secondary">View</button>
                      </a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
                </div>
                <div id="mytable" style="display:none">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Full name</th>
                        <th>Reg No</th>
                        <th>Assessment</th>
                        <th>Logbook</th>
                        <th>Report</th>
                        </tr>
                    </thead>
                       <tbody>
                    <?php if($applications): $no =0; ?>
                      <?php foreach($applications as $app):$no++; ?>
                        <tr>
                        <td><?php echo $app['lname'].", ".$app['fname']." ".$app['mname']; ?></td>
                        <td><?php echo $app['Reg_No']; ?></td>
                        <td class="text-center"><?php echo $app['marks']; ?></td>
                        <td class="text-center"><?php echo $app['logbook']; ?></td>
                        <td class="text-center"><?php echo $app['report']; ?></td>
                      </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>

              </div>
            </div>
        

 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/LTE/plugins/printThis/printThis.js"></script>
<script>
program = "<?php echo $program; ?>";
year = '<?php echo $year; ?>';
    function print_the_list(){
        $("#hide").hide('slow');
        $("#mytable").show('slow',function(){
            $('#mytable').printThis({
            
        header: "<small>"+program+" student report list</small>"
    });
        });
        
    }
    function download_excel(){
         $("#hide").hide('slow');
         $("#mytable").show('slow',function(){
            $('#mytable').table2csv({
                file_name:'SMCoSE FPT-TP '+year+' '+program+'.csv',
                header_body_space: 0
            });

        });
    }
</script>