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
                        <h3 class="card-title">Field letter request list</h3>
                      </div>
                      <!-- /.card-header -->

                      <div class="card-body table-responsive">
                         <table id="example1" class="table table-bordered table-striped table-hover">
                           <thead>
                            <tr>
                                <th>Coordnator</th>
                                <th>Contact</th>
                                <th>Students</th>
                              <th>Institution name</th>
                              <th>Location</th>
                              <th>Offce contact</th>
                              <th style="width: 30px"></th>
                            </tr>
                           </thead>

                           <tbody>
                             
                             <?php if($field_letter):?>
                                <?php foreach($field_letter as $student): ; ?>
                               
                                  <tr>
                                    <td><?php echo $student['coordinator']; ?></td>
                                    <td><?php echo $student['coordinator_contact']; ?></td>
                                    <td>
                                    <?php 
                                    $all_student = '';
                                         $students = explode('<br>',$student['students']);
                                        $no = 0;
                                        foreach($students as $st){
                                            $no++;
                                                $all_student .= "<strong>".$no."</strong>. ".$st."<br>";
                                        }
                                            echo $all_student;
                                    
                                     ?>
                                    
                                    </td>
                                     <td><?php echo $student['institution_name']; ?></td>
                                    
                                    <td><?php echo $student['region']." ".$student['district']." ".$student['ward']; ?></td>
                                    <td><?php echo $student['office_contact']; ?></td>
                                    <td>
                                    <?php $SID = $student['id']; ?>
                                      <a href="<?php echo base_url('updates/update_feild_letter_request/'.$SID); ?>">
                                      <button type="button" class="btn btn-block btn-outline-success btn-sm">OK</button>
                                      </a>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                             <?php endif; ?>

                           </tbody>

                          
                         </table>
                      </div>
                      <!-- / .card-body -->
                  </div>
                </div>

            </div>
          </div>



