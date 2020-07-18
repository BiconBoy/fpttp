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
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card">

                        <?php if(isset($_SESSION['subject_success'])): ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['subject_success']; ?>
                            </div>
                        <?php unset($_SESSION['subject_success']); endif; ?>

                         <?php if(isset($_SESSION['subject_failed'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['subject_failed']; ?>
                            </div>
                        <?php unset($_SESSION['subject_failed']); endif; ?>

                         <?php if(isset($_SESSION['subject_exist'])): ?>
                            <div class="alert alert-warning">
                                <?php echo $_SESSION['subject_exist']; ?>
                            </div>
                        <?php unset($_SESSION['subject_exist']); endif; ?>

                        <dv class="card-header">
                          <h3 class="card-title">
                            <i class="fa fa-book"></i>
                            Add subject
                          </h3>
                        </dv>
                        <div class="card-body">

                          <form class="form-horizontal" method="post" action="<?php echo base_url('inserting/add_subject'); ?>">
                            <div class="form-group form-group-sm">
                              <label class="lable-control">Subject name: </label>
                              <div class="form-group">
                                <input type="text" name="subject_name" required class="form-control" placeholder="Enter subject name here">
                              </div>
                            </div>

                            <div class="form-group" id="btn_submit">
                              <button id="add_btn" class="btn btn-sm btn-success">Add now</button>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                    <!-- / .col-md-4 -->

                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fa fa-list"></i>
                            Available Subjects
                          </h3>
                        </div>
                        <div class="card-body">
                           <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Subject name</th>
                                  <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if($inst_subject): $no = 0; $color = ''; ?>
                                <?php foreach($inst_subject as $subject): $no++; ?>
                                  <tr>
                                    <th><?php echo $no; ?></th>
                                    <td><?php echo $subject['subject_name']; ?></td>
                                    <td><button  type="button" class="btn btn-block btn-outline-success btn-sm">manege</button></td>
                                  </tr>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </tbody>
                            <tfoot>
                               <tr>
                                  <th>#</th>
                                  <th>Subject name</th>
                                  <th></th>
                                </tr>
                            </tfoot>
                          </table>
                        </div>  
                      </div>
                    </div>
                    <!-- / .col-md-8 -->

                  </div>

                </div>
            </div>
          </div>
        </div>
