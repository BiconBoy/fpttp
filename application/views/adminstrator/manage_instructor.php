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
                <div class="card card-success card-outline">
                  <div class="card-body">
                     <div class="card-header">
                        <h3 class="card-title">Instructors list</h3>
                         <?php  
                  if(isset($_SESSION['Remove_success'])){
                    echo $_SESSION['Remove_success'];
                    unset($_SESSION['Remove_success']);
                  }
                  if(isset($_SESSION['Remove_error'])){
                    echo $_SESSION['Remove_error'];
                    unset($_SESSION['Remove_error']);
                  }
                  ?>
                      </div>
                      <!-- /.card-header -->

                      <div class="card-body table-responsive">
                         <table id="example1" class="table table-bordered ble-hover">
                           <thead>
                            <tr>
                              <th>#</th>
                              <th>Profile</th>
                              <th>Full name</th>
                              <th>ID</th>
                              <th>Sex</th>
                              <th>Contact</th>
                              <th>E-mail</th>
                              <th></th>
                            </tr>
                           </thead>

                           <tbody>
                             
                             <?php if($instructors): $no = 0; ?>
                                <?php foreach($instructors as $instructor): $no++; ?>
                                  <?php 
                                    if($instructor['image'] == ''){
                                        $image = base_url()."assets/admin/dist/img/icons/ic_person_24px.svg";
                                      }else{
                                            $image = base_url()."assets/profile/instructor/".$instructor['image'];
                                      }
                                      

                                      $AID = str_replace('/', '_', $instructor['AID']);
                                      $color ='';
                                      if($instructor['status'] == 'Blocked'){
                                        $color = 'danger';
                                      }
                                      
                                  ?>
                                  <tr class="bg-<?php echo $color; ?>">
                                    <th><?php echo $no; ?></th>
                                    <td>
                                      <img style="width: 40px; height: 40px" class="img-rounded"src="<?php echo $image; ?>"
                                       alt=""></td>
                                    <td><?php echo $instructor['fname']." ".$instructor['mname']." ".$instructor['lname']; ?></td>
                                    <td><?php echo $instructor['AID']; ?></td>
                                    <td><?php echo $instructor['sex']; ?></td>
                                    <td><?php echo $instructor['contact']; ?></td>
                                    <td><?php echo $instructor['email']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url('adminstrator/instructor_view_profile/'.$AID); ?>">
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
                              <th>Profile</th>
                              <th>Full name</th>
                              <th>ID</th>
                              <th>Sex</th>
                              <th>Contact</th>
                              <th>E-mail</th>
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



