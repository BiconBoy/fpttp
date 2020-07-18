<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <a href="<?php echo base_url('adminstrator/report_view'); ?>">
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
         
            <div class="card card-success">
          
              <div class="card-body">
                
                <div class="row">
                  <div class="col-md-8 offset-2 table-responsive">
                     <form onsubmit="return update_report_marks()">
                    
              <?php if($students): $no = 0; $over = 0; ?>
                <table class="table table-bordered" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Student name</th>
                      <th>Regstration No</th>
                      <th>Marks</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                <?php foreach($students as $student): $no++; ?>
                 
                  <tr>
                    <th><?php echo $no; ?></th>
                    <td><?php echo $student['fname']." ".$student['mname']." ".$student['lname']; ?></td>
                    <td><?php echo $student['Reg_No']; ?></td>
                    <td class="text-center">
                      <?php if($student['report_confirm'] == 'YES'){ $over = 1; ?>
                        <?php echo $student['report']; ?>%
                      <?php }else{ ?>
                      <input  class="form-control <?php if($student['report'] <= 0){ echo "bg-secondary"; }else{echo "bg-success";} ?> text-center" style="width: 100px;" type="number" value="<?php echo $student['report']; ?>" name="marks_<?php echo $student['id']; ?>" >


                      
                    <?php } ?>
                    </td>
                    
                  </tr>
                
                <?php endforeach; ?>

              </div>
              <?php endif; ?>
            </tbody>
            </table>
            <?php if($over == 0){ ?>
            <div class="form-group">

              <button class="btn btn-sm btn-success">Update</button>
              <button data-toggle="modal" data-target="#myModal" type="button" style="float: right;" class="btn btn-warning btn-sm">Submit</button>
            </div>
          <?php } ?>
            </form>
          </div>
            </div>
                
              </div>
    
            </div>  

          </div>
        </div>

        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you sure that you need to submit report scores?</p>
       <strong> if you will submit you can not edit.</strong> <br>
       To confirm press <strong>Confirm</strong> button or press <strong>Cancel</strong> to cancel


      </div>
      <div class="modal-footer text-left">
        <button style="margin-right: 300px;" type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url('updates/confirm_report_marks/'.$REG); ?>">
        <button type="button" class="btn btn-danger btn-sm" >Confirm</button>
        </a>
      </div>
    </div>

  </div>
</div>


<script>
  function update_report_marks(){
   var marks = $('form').serializeArray();
   path ="<?php echo base_url('inserting/update_report_marks') ?>";
   $.ajax({
  url: path,
  type: "POST",
  data:  {marks:marks},
  success:function(data){
    window.location.reload();
  }

  })
   return false;
}
</script>