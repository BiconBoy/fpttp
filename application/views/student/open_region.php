

<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <a href="<?php echo base_url('student/select_field'); ?>">
              <button class="btn btn-sm btn-outline-success fa fa-angle-double-left"> Back</button></a>
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
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">
          <div class="col-md-12">
            <div class="card card-success card-outline">
              <div class="card-header">
                <?php if($student['category'] == 'EDU'){ ?>
                <h3 class="car-title">Find the school for your wish then apply</h3>
                <?php }else{ ?>
                  <h3 class="car-title">Find the institution for your wish then apply</h3>
                <?php } ?>
              </div>
              <div class="card-body">
                <div class="row">
                <?php if($region_school){$no =0; ?>
                  <?php foreach($region_school as $school):$no++; ?>
                    <?php if($region_school[0]):  $times = 0; ?>
                      <?php foreach($school[0] as $selected){$times++;} ?>
                    <?php endif; ?>

                    <?php 
                      $color = 'success';
                      $mut = '';
                      $remained_chance = $school['student_required'] - $times;
                      if($remained_chance == 0){
                        $color = 'danger';
                      }
                      if($remained_chance == 1){
                        $mut = 'chance';
                      }
                       if($remained_chance > 1){
                        $mut = 'chances';
                      }

                    ?>
                    <?php if($school['prevalage'] == "YES"){ ?>
                      <?php if($institution_prevalage): ?>
                         <?php foreach($institution_prevalage as $inst): ?>
                          <?php if($inst['I_ID'] == $school['S_Reg_No']){ ?>

                            <div class="col-md-6">
                      <div class="card card-<?php echo $color; ?>">
                        <div class="card-header">
                          <h3 class="card-title"><?php echo $school['name']; ?></h3>
                        </div>
                       
                        <div class="card-body">
                          <?php if($remained_chance == 0){ ?>
                            <?php if($student['category'] == 'EDU'){ ?>
                            <small class="text-danger">No chance available for this school</small>
                          <?php }else{ ?>
                            <small class="text-danger">No chance available for this institution</small>
                          <?php } ?>
                          <?php }else{ ?>
                          <small>
                            <?php if($student['category'] == 'EDU'): ?>
                            <strong>Level:</strong><?php echo $school['level']; ?><br>
                            <strong>Type:</strong><?php echo $school['type']; ?><br>
                          <?php endif; ?>
                            <strong>District-[ward]:</strong><?php echo $school['district']."-[".$school['ward']."]"; ?><br>
                            <strong><?php echo $remained_chance.' '.$mut; ?> remained </strong>
                          </small>
                          <?php $reg = str_replace('/', '_', $school['S_Reg_No']); ?>
                          <form onsubmit="return submit_application('<?php echo $reg; ?>')">
                            <?php if($student['category'] == 'EDU'){ ?>
                                <div class="form-group">
                                  <small>Select subject:</small>
                                    <select  onchange="show_submit_btn('<?php echo $reg; ?>')" id="subject<?php echo $reg; ?>" required class="form-control form-control-sm select2 select2-hidden-accessible my_select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Select subject</option>

                                <?php if($subjects): ?>
                                  <?php foreach($subjects as $subject): ?>
                                    <?php if($subject['school_Reg'] == $school['S_Reg_No']): ?>
                              <?php $required = $subject['required']; $sub_taken = 0;?>
                              <?php if($subject['required'] > 0): ?> 
                              <?php if($region_school[0]):  $subtimes = 0; ?>
                                <?php foreach($school[0] as $selected){ ?>
                                  <?php if($subject['sub_name'] == $selected['subject']): ?>
                                    <?php $subtimes++; ?>
                                  <?php endif; ?>
                                <?php } ?>
                                <?php $sub_taken = $subtimes; ?>
                              <?php endif; ?>
                            <?php endif; ?>
                            <?php $sub_remained = $required - $sub_taken; ?>
                            <?php if($sub_remained > 0): ?>
                          <option value="<?php echo $subject['sub_name']; ?>"> <?php echo $subject['sub_name']; ?></option>
                          <?php endif; ?>
                    

                                         <?php endif; ?>
                                  <?php endforeach; ?>
                                <?php endif; ?>

                                  </select>
                                </div>
                                <div id="result<?php echo $reg; ?>">
                                  <button style="display: none;" style="margin-top: -10px;" class="btn btn-sm btn-block btn-success my_btn" id="btn<?php echo $reg; ?>">Now submit your application</button>
                                  </div>
                                 <?php }else{ ?>

                              <!-- Modal -->
                              <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <p><strong>Warning !</strong> Are you sure you want to select <strong><?php echo  $school['name']; ?></strong></p>
                                      If you will confirm you can not change your selection until  you ask for changing your selection
                                      <br>
                                      Click <strong>Cancel </strong> button to cancel OR click <strong>Confirm</strong> button to confirm selection
                                    </div>
                                    <div class="modal-footer">
                                      <button  style="margin-right: 200px;" type="button" class="btn btn-success btn-sm my_btn" data-dismiss="modal">Close</button>
                                      <button id="btn<?php echo $reg; ?>" class="btn btn-sm btn-danger my_btn">Confirm</button>
                                    </div>
                                  </div>

                                </div>
                              </div>

                                  <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-sm btn-block btn-success my_btn">Select this institution</button>
                                 <?php } ?>
                                </form>
                             


                        <?php } ?>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    </div>

                          <?php }else{ ?>
                            <alert class="alert alert-warning">You have priority institution to select your field click <a href="<?php echo base_url('student'); ?>"><button class="btn btn-sm btn-default">Here</button></a> to start afresh</alert>
                          <?php break; } ?>
                         <?php endforeach; ?>
                      <?php endif; ?>

                    <?php }else{ ?>
                       <?php if(!$institution_prevalage): ?>
                    <div class="col-md-6">
                      <div class="card card-<?php echo $color; ?>">
                        <div class="card-header">
                          <h3 class="card-title"><?php echo $school['name']; ?></h3>
                        </div>
                       
                        <div class="card-body">
                          <?php if($remained_chance == 0){ ?>
                            <?php if($student['category'] == 'EDU'){ ?>
                            <small class="text-danger">No chance available for this school</small>
                          <?php }else{ ?>
                            <small class="text-danger">No chance available for this institution</small>
                          <?php } ?>
                          <?php }else{ ?>
                          <small>
                            <?php if($student['category'] == 'EDU'): ?>
                            <strong>Level:</strong><?php echo $school['level']; ?><br>
                            <strong>Type:</strong><?php echo $school['type']; ?><br>
                          <?php endif; ?>
                            <strong>District-[ward]:</strong><?php echo $school['district']."-[".$school['ward']."]"; ?><br>
                            <strong><?php echo $remained_chance.' '.$mut; ?> remained </strong>
                          </small>
                          <?php $reg = str_replace('/', '_', $school['S_Reg_No']); ?>
                          <form onsubmit="return submit_application('<?php echo $reg; ?>')">
                            <?php if($student['category'] == 'EDU'){ ?>
                                <div class="form-group">
                                  <small>Select subject:</small>
                                    <select  onchange="show_submit_btn('<?php echo $reg; ?>')" id="subject<?php echo $reg; ?>" required class="form-control form-control-sm select2 select2-hidden-accessible my_select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Select subject</option>

                                <?php if($subjects): ?>
                                  <?php foreach($subjects as $subject): ?>
                                    <?php if($subject['school_Reg'] == $school['S_Reg_No']): ?>
                              <?php $required = $subject['required']; $sub_taken = 0;?>
                              <?php if($subject['required'] > 0): ?> 
                              <?php if($region_school[0]):  $subtimes = 0; ?>
                                <?php foreach($school[0] as $selected){ ?>
                                  <?php if($subject['sub_name'] == $selected['subject']): ?>
                                    <?php $subtimes++; ?>
                                  <?php endif; ?>
                                <?php } ?>
                                <?php $sub_taken = $subtimes; ?>
                              <?php endif; ?>
                            <?php endif; ?>
                            <?php $sub_remained = $required - $sub_taken; ?>
        
                            <option value="<?php echo $subject['sub_name']; ?>" <?php if($sub_remained <= 0): ?> disabled <?php endif; ?> > 
                                <?php echo $subject['sub_name']; ?>
                                    <?php if($sub_remained <= 0): ?> <small> no chance</small><?php endif; ?>
                            </option>
                    

                                         <?php endif; ?>
                                  <?php endforeach; ?>
                                <?php endif; ?>

                                  </select>
                                </div>
                                <div id="result<?php echo $reg; ?>">
                                  <button style="display: none;" style="margin-top: -10px;" class="btn btn-sm btn-block btn-success my_btn" id="btn<?php echo $reg; ?>">Now submit your application</button>
                                  </div>
                                 <?php }else{ ?>

                              <!-- Modal -->
                              <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <p><strong>Warning !</strong> Are you sure you want to select <strong><?php echo  $school['name']; ?></strong></p>
                                      If you will confirm you can not change your selection until  you ask for changing your selection
                                      <br>
                                      Click <strong>Cancel </strong> button to cancel OR click <strong>Confirm</strong> button to confirm selection
                                    </div>
                                    <div class="modal-footer">
                                      <button  style="margin-right: 200px;" type="button" class="btn btn-success btn-sm my_btn" data-dismiss="modal">Close</button>
                                      <button id="btn<?php echo $reg; ?>" class="btn btn-sm btn-danger my_btn">Confirm</button>
                                    </div>
                                  </div>

                                </div>
                              </div>

                                  <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-sm btn-block btn-success my_btn">Select this institution</button>
                                 <?php } ?>
                                </form>
                             


                        <?php } ?>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php } ?>
                  <?php endforeach; ?>
                <?php }else{ ?>
                  <div class="callout callout-warning">
              <h5><i class="fa fa-info"></i> Note:</h5>
                No any school added for this region please you may add a suggestion for this
            </div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>

<script>
  function submit_application(reg){
    $(".my_select").attr('disabled','disabled');
    $(".my_btn").attr('disabled','disabled');
    $('#btn'+reg).html('application processing... <i class="fa fa-refresh fa-spin"></i>');
    
   
    path = "<?php echo base_url('Inserting/submit_application') ?>";
    <?php if($student['category'] == 'EDU'){ ?>
       subject = $("#subject"+reg).val();
      $.ajax({
      url:path,
      type:"post",
      data:{reg:reg, subject:subject},
      success:function(data){
        if(data == '2'){
          $("#result"+reg).html('<div class="alert alert-warning">Warning please refresh the page and try again</div>');
        }
        if(data == '1'){
          window.location.href="<?php echo base_url('student/select_field') ?>";
        }
      }
    })
    <?php }else{ ?>
      subject = '';
      $.ajax({
      url:path,
      type:"post",
      data:{reg:reg, subject:subject},
      success:function(data){
        if(data == '2'){
          $("#result"+reg).html('<div class="alert alert-warning">Warning please refresh the page and try again</div>');
        }
        if(data == '1'){
          window.location.href="<?php echo base_url('student/select_field') ?>";
        }
      }
    })
    <?php } ?>
    


    return false;
  }
  function show_submit_btn(reg){
    $(".my_btn").hide('slow');
    $('#btn'+reg).show('slow');
  }
</script>