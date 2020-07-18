<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><button onclick="window.location.replace('<?php echo base_url() ?>adminstrator/priority_institution')" class="btn fa fa-angle-double-left btn-success btn-sm" > Back</button> <?php echo $maintitle; ?></h1>
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
        
          <div class="card card-success card-autline">
            <div class="card-body">
              <form class="form-horizontal" method="post"  action="<?php echo base_url('inserting/add_priority'); ?>">
            <div class="row">
            <!-- / .col-md-4 -->
            <div class="col-md-8 offset-2">
              <div class="card">
                <div class="card-body">
                   <div class="form-group">
                                <label class="label-control"><?php echo $category; ?>  Student Registration Number:</label>
                                <div class="form-group">
                                  <select required name="SID[]" class="form-control select2" multiple="multiple" data-placeholder="Select <?php echo $category; ?>  student registration number you can select more than one reg No" style="width: 100%;">
                            
                                <?php if($students): ?>
                                  <?php foreach($students as $student): ?>
                                    <option value="<?php echo $student['SID']; ?>"><?php echo $student['Reg_No']."  |---> ".$student['fname']." ".$student['lname']; ?></option>
                                  <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <input type="hidden" name="I_ID" value="<?php echo $Reg; ?>">
                                </div>
                              </div>
                </div>
              </div>
            </div>
          </div>
            <div class="form-group text-center">
              <button class="btn btn-success btn-sm">submit</button>
            </div>
             </form>
            </div>
        </div>
        </div>
        <!-- / .row -->
        <?php if($priority_student):$no = 0; ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><strong><?php echo $category; ?> </strong>Student asked for <strong><?php echo $institution; ?></strong></h3>
              </div>
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Full name</th>
                      <th>Registration No</th>
                      <th>Contact</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($priority_student as $reg_ass):$no++; ?>
                      <tr>
                      <th><?php echo $no; ?></th>
                      <td><?php echo $reg_ass['fname']." ".$reg_ass['lname']." ".$reg_ass['lname']; ?></td>
                      <td><?php echo $reg_ass['contact']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <?php endif; ?>
