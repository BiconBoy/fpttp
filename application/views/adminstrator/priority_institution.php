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
                <h3 class="card-title">Suggested Institution</h3>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Institution name</th>
                      <th>Region</th>
                      <th>Student details</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if($sugested): $no = 0; ?>
                      <?php foreach($sugested as $school): $no++; ?>
                        <tr>
                          <th><?php echo $no; ?></th>
                          <td><?php echo $school['name']; if($school['reachable'] == 'NO'): ?>
                            <br>
                            <?php $REG = str_replace('/', '_', $school['S_Reg_No']); ?>
                            <a class="text-danger" href="<?php echo base_url('updates/update_institution_reachable/'.$REG.'/priority_institution');?>">Click to make Institution Reachable</a>
                          <?php endif; ?>
                          </td>
                          <td><?php echo $school['region']; ?></td>
                          <td>
                            <?php if($students){ ?>
                              <?php foreach($students as $student): ?>
                                <?php if($school['S_Reg_No'] == $student['I_ID']){  ?>
                                  <?php $SID = str_replace('/', '_', $student['SID']); ?>
                                  <?php echo $student['fname']." ".$student['mname']." ".$student['lname']." <strong>Reg: </strong>".$student['Reg_No']; ?><a href="<?php echo base_url('updates/remove_student/'.$SID); ?>"> <span class="badge badge-danger"> REMOVE</span></a><hr>
                                <?php } ?>
                              <?php endforeach; ?>
                            <?php } ?>
                          </td>
                          <td>
                      

                            <?php if($p_results){ ?>
                              <?php foreach($p_results as $result): ?>
                                <?php if($school['S_Reg_No'] == $result['I_ID']){ ?>
                                    <?php 
                                    $postdate = strtotime($result['set_time']);
                                    $enddate = strtotime(date("Y-m-d"));

                                    if($postdate < $enddate): ?>
                                      <?php $Reg = str_replace('/', '_', $school['S_Reg_No']); ?>
                                      <a href="<?php echo base_url('updates/remove_priority/'.$Reg); ?>">
                                      <button class="btn btn-danger btn-sm">Remove</button>
                                    </a>
                                    <?php endif; ?>
                               <?php break; } ?>
                              <?php endforeach; ?>

                            <?php } ?>
                             <?php $Reg = str_replace('/', '_', $school['S_Reg_No']); ?>
                              <a href="<?php echo base_url('adminstrator/open_priority/'.$Reg); ?>">
                              <button class="btn btn-success btn-sm">add student</button>
                            </a>

                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Institution name</th>
                      <th>Region</th>
                      <th>Student details</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>