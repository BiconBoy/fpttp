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
    <section class="content" style="margin-top: -23px;">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title text-center">List of students applied for field practicle in accademic year <strong><?php echo $year; ?></strong></h3>
                <button style="float:left" class="btn btn-sm btn-outline-success fa fa-download" onclick="excel_download()"> Download Excel</button>
              </div>
              <div class="card-body table-responsive">
                <table id="example1" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Reg No</th>
                      <th>Student name</th>
                      <th>Institution</th>
                      <th>Region</th>
                      <th>District</th>
                      <th>ward</th>
                      <th>Subject</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($student_application){ $no = 0; ?>
                      <?php foreach($student_application as $data):$no++; ?>
                        <?php $data['username'] = $data['lname'].", ".$data['fname']." ".$data['mname']; ?>                       
                        <tr>
                        <td><?php echo $data['Reg_No']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['region']; ?></td>
                        <td><?php echo $data['district']; ?></td>
                        <td><?php echo $data['ward']; ?></td>
                        <td><?php echo $data['subject']; ?></td>
                      </tr>
                      <?php endforeach; ?>
                    <?php }else{ ?>
                      <tr>
                        <td colspan="8" class="text-center text-danger">No record forund</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>