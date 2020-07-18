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
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

          <div class="row">
            <div class="col-md-12">
                <div class="card card-success card-outline">
                  <div class="card-body">
                     <div class="card-header">
                        <h3 class="card-title">Student list</h3>
                      </div>
                      <!-- /.card-header -->

                      <div class="card-body table-responsive">
                         <table id="example1" class="table table-bordered table-striped table-hover">
                           <thead>
                            <tr>
                              <th>#</th>
                
                              <th>Fuul name</th>
                              <th>Reg No</th>
                              <th>Sex</th>
                              <th>Contact</th>
                              <th>Program</th>
                              <th style="width: 30px"></th>
                            </tr>
                           </thead>

                           <tbody>
                             
                             <?php if($students): $no = 0; ?>
                                <?php foreach($students as $student): $no++; ?>
                               
                                  <tr>
                                    <th><?php echo $no; ?></th>
                                
                                    <td><?php echo $student['lname'].", ".$student['fname']." ".$student['mname']; ?></td>
                                    <td><?php echo $student['Reg_No']; ?></td>
                                    <td><?php echo $student['sex']; ?></td>
                                    <td><?php echo $student['contact']; ?></td>
                                    <td><?php echo $student['program']; ?></td>
                                    <td>
                                      <?php $SID = str_replace('.', '_', $student['SID']); ?>
                                      <a href="<?php echo base_url('adminstrator/adminstrator_view_student/'.$SID); ?>">
                                      <button type="button" class="btn btn-block btn-outline-primary btn-sm">manage</button>
                                      </a>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                             <?php endif; ?>

                           </tbody>

                           <tfoot>
                             <tr>
                              <th>#</th>
                              <th>Fuul name</th>
                              <th>Reg No</th>
                              <th>Sex</th>
                              <th>Contact</th>
                              <th>Program</th>
                              <th></th>
                            </tr>
                           </tfoot>
                         </table>
                      </div>
                      <!-- / .card-body -->
                  </div>
                </div>

            </div>
          </div>



