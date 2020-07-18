<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><button onclick="window.location.replace('<?php echo base_url() ?>adminstrator/allocation')" class="btn fa fa-angle-double-left btn-success btn-sm" > Back</button> <?php echo $maintitle; ?></h1>
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
              <form class="form-horizontal" method="post"  action="<?php echo base_url('inserting/add_field_assessor'); ?>">
            <div class="row">
            <div class="col-md-4">
              
              <div class="card card-success">
                <div class="card-body">
                
                  <div class="form-group form-group-sm">
                                <label class="lable-control">Assessor: </label>
                                <div class="form-group">
                                  <select name="AID" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Select assessor</option>
                                    
                                    <?php if($assessors): ?>
                                      <?php foreach($assessors as $assessor): ?>

                                        <?php

                                          $username = $assessor["fname"]." ".$assessor["mname"]." ".$assessor["lname"];
                                          

                                        ?>
                                        <option value="<?php echo $assessor['AID']; ?>"> <?php echo $username; ?></option>
                                      <?php endforeach; ?>
                                    <?php endif; ?>
                                  
                                  </select>
                                </div>
                              </div>
                </div>
              </div>
             
            </div>
            <!-- / .col-md-4 -->
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                   <div class="form-group">
                                <label class="label-control">School:</label>
                                <div class="form-group">
                                  <select required name="school_reg[]" class="form-control select2" multiple="multiple" data-placeholder="Select school you can select more than one school" style="width: 100%;">
                            
                                <?php if($schools): ?>
                                  <?php foreach($schools as $school): ?>
                                    <option value="<?php echo $school['school_Reg']; ?>"><?php echo $school['name']; ?></option>
                                  <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <input type="hidden" name="region" value="<?php echo $region; ?>">
                            <input type="hidden" name="zone" value="<?php echo $zone; ?>">
                                </div>
                              </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-success btn-sm">submit</button>
            </div>
             </form>
            </div>
        </div>
        </div>
        <!-- / .row -->
        <?php if($region_assessors):$no = 0; ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Samary of assessors in <?php echo $region; ?> rrgion</h3>
              </div>
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Assessor</th>
                      <th>School</th>
                      <th>District</th>
                      <th>Ward</th>
                      <th>Contact</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($region_assessors as $reg_ass):$no++; ?>
                      <tr>
                      <th><?php echo $no; ?></th>
                      <td><?php echo $reg_ass['fname']." ".$reg_ass['lname']; ?></td>
                      <td><?php echo $reg_ass['name']; ?></td>
                      <td><?php echo $reg_ass['district']; ?></td>
                      <td><?php echo $reg_ass['ward']; ?></td>
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
