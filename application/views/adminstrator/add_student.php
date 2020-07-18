<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
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
        <!-- Small boxes (Stat box) -->
        <?php if(isset($_SESSION['delete_complite'])): ?>
        <div class="alert alert-success"> <strong class="fa fa-check"> Successiful <?php echo $_SESSION['delete_complite']; ?> </strong>  student deleted from the list</div>
      <?php unset($_SESSION['delete_complite']); endif; ?>
        <div class="row">
          <div class="col-md-12">
            
            <div class="card card-success card-outline">
              
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                   
          <form method="post" id="import_form" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-12 text-center img-responsive">
                <strong>Example of excel needed. arange your excel in form of this example</strong><br>
                <img class="img-responsive" style="width:100%;" src="<?php echo base_url("assets/images/excel.png"); ?>"  style=";">
            </div>
            <hr><br>
              <div class="form-group col-md-6">
                <label class="label-control">Select Excel File</label>
                <div class="form-group">
                  <input type="file" name="file" class="form-control" id="file" required accept=".xls, .xlsx" />
                </div>
              </div>
           

               
            </div>
        <div class="form-group text-center">
      <input type="submit" name="import" value="Import" class="btn btn-info" />
      </div>
    </form>
    <br />

    

      <div class="row">
      
      <?php if($student_list){ ?> 
        <div class="col-md-12 text-center">
            <strong class="title"><u>List of student who not created their account</u></strong>
        </div><br>
        <?php foreach($student_list as $prog): ?>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo $prog['program']." - ".$prog['year']; ?></h3>
                <?php if($totals):  $no = 0; ?>
                  <?php foreach($totals as $total): ?>
                    <?php if($prog['program'] == $total['program'] AND $prog['year'] == $total['year']){$no++; } ?>
                  <?php endforeach; ?>
                  <p>Total student: <strong><?php echo $no; ?></strong></p>
                <?php endif; ?>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <?php $program = $prog['program']; ?>
              <?php $year = $prog['year']; ?>
              <a href="<?php echo base_url('adminstrator/student_list/'.$program."/".$year); ?>" class="small-box-footer">View list<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php }else{ ?> 
        <div class="alert alert-warning">No any student addedd</div>
      <?php } ?>
    </div>
   

                  </div>
                 
                </div>

              </div>

            </div>

          </div>

        </div>
        <!-- /.row -->
<script src="<?php echo base_url(); ?>assets/jquery.min.js"></script>
<script>
$(document).ready(function(){

  $('#import_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"<?php echo base_url(); ?>excel_import/import",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        
        $('#file').val('');
        $('#category').val('');

        window.location = "";

        }
    })
  });

});
</script>

