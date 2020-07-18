<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
            <a href="<?php echo base_url('adminstrator/add_student'); ?>">
            <button class="btn btn-sm btn-outline-success fa fa-"> Back</button>
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
        <!-- Small boxes (Stat box) -->

        <div class="row">
          <div class="col-md-12">
            
            <div class="card card-success card-outline">
              
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                   
          
    <div class="table-responsive" >
      <?php if($student_list){ $no = 0; ?> 
      <div class="table-responsive">
      <form action="<?php echo base_url('updates/remove_multiple_student'); ?>" method="post">
          <table class="table" id="example1">
            <thead>
              <tr>
                <th>#</th>
                <td></td>
                <th>Reg No</th>
                <th>Full name</th>
                <th>Sex</th>
                <th>Contact</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($student_list as $student): $no++; ?>
              <tr>
                <th><?php echo $no; ?></th>
                <td> <label><input id="check_this"   onclick="show_this_button()"  type="checkbox" class="flat-red" name="SID[]" value="<?php echo $student['SID']; ?>"></label></td>
                <td><?php echo $student['Reg_No']; ?></td>
                <td><?php echo $student['lname'].", ".$student['fname']." ".$student['mname']; ?></td>
                <td><?php echo $student['sex']; ?></td>
                <td><?php echo $student['contact']; ?></td>
                <td>
                <?php $SID = str_replace('/', '_', $student['SID']); ?>
                <?php $path = base_url('updates/remove_student_data'); ?>
                <a href="<?php echo $path."/".$SID."/".$program; ?>"><button type="button" class="btn btn-outline-danger btn-sm">Remove</button></a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
         <div class="form-group text-center">
            <button id="my_btn_submit" style="displaynone" class="btn btn-primary btn-sm btn-outline-danger">Remove multiple student</button>
        </div>
        <form>
       
        </div>
      <?php }else{ ?> 
        <div class="alert alert-warning">Error occured while fatching student data</div>
      <?php } ?>
    </div>

                  </div>
                 
                </div>

              </div>

            </div>

          </div>

        </div>

<script>
function show_this_button(){
    alert('ok');

  }
</script>