<?php if($school_info): ?>
  <?php foreach($school_info as $school){} ?>
<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> 
            <?php if($back_btn ==''){ ?>
                <a href="<?php echo base_url('adminstrator/manage_school'); ?>"><button class="btn fa fa-backward btn-sm btn-success"> Back</button></a>
            <?php }else{ ?>
                <a href="<?php echo base_url('adminstrator/summary'); ?>"><button class="btn fa fa-backward btn-sm btn-success"> Back to summary</button></a>
            <?php } ?>
             <?php echo $maintitle; ?>
                
            </h1>
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
          <div class="col-md-3">
            <!-- About Me Box -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">About Institution</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-institution mr-1"></i> Institution name</strong>

                <p class="text-muted">
                  <?php echo $school['name']; ?>
                </p>

                <hr>
                 <strong><i class="fa fa-user mr-1"></i> Leadership</strong>
                 <p class="text-muted">
                   <?php echo $school['HDM']; ?>
                </p>

                <hr>
                 <strong><i class="fa fa-list mr-1"></i> Category</strong>
                 <p class="text-muted">
                                   <?php if($school['category'] == "EDU"){echo "Education";} ?>
                                <?php if($school['category'] == "ESM"){echo "Environmental science";} ?>
                                <?php if($school['category'] == "INF"){echo "Informatics";} ?>
                </p>

                <hr>


                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                <p class="text-muted">
                   <?php echo $school['ward'].', '.$school['district'].', '.$school['region'];; ?>
                </p>

                <hr>

                <strong><i class="fa fa-phone mr-1"></i> Contact</strong>

                <p class="text-muted">
                  <?php echo $school['contact']; ?>
                </p>

                <hr>
                <strong><i class="fa fa-bookmark mr-1"></i>Number of student</strong>
                <p class="text-muted">
                  The institution offer <strong><?php echo $school['student_required']; ?></strong> student chances
                </p>

                <hr>
                <?php if($category == 'EDU'): ?>
                <strong><i class="fa fa-bookmark mr-1"></i>Shool type</strong>
                <p class="text-muted">
                  <strong><?php echo $school['type']; ?></strong> 
                </p>

                <hr>
                <strong><i class="fa fa-bookmark mr-1"></i>Shool level</strong>
                <p class="text-muted">
                  <strong><?php echo $school['level']; ?></strong> 
                </p>
                <hr>
              <?php endif; ?>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#Subjects" data-toggle="tab">Subjects</a></li>
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Students</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">information</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">update</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <h5>Students joined for Field practical training for accademic year <strong><?php echo $year; ?></strong></h5>
                    <!-- Post -->

                     <?php if($student_application){ $no = 0; ?>
                      <?php foreach($student_application as $data):$no++; ?>
                        <?php
                        $data['username'] = $data["fname"]." ".$data["mname"]." ".$data["lname"];
                        $data['imagePath'] = base_url()."assets/profile/student/".$data['image'];
                        if($data['image'] == ''){
                            $data['imagePath'] = base_url()."assets/images/student.jpg";
                        }
                        ?>
                      <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo $data['imagePath'] ?>">
                        <span class="username">
                          <a href="#"><?php echo $data['username']; ?></a>
                          <span class="username float-right"><strong>Reg No: </strong><?php echo $data['Reg_No']; ?></span>
                        </span>
                        <span class="description">
                          <strong>Program: </strong><?php echo $data['program']; ?><br>
                          <strong>Contact: </strong><?php echo $data['contact']; ?>
                      </span>
                      </div>
                    
                    </div>


                      <?php endforeach; ?>
                    <?php }else{ ?>
                      
                        <span class="text-center text-danger">No record forund</span>
                      
                    <?php } ?>
                   
                  

                </div>
                
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    no information posted
                    
               <!--
                    <ul class="timeline timeline-inverse">
                    
                      <li class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </li>
                      
                      
                      <li>
                        <i class="fa fa-envelope bg-success"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          
                        </div>
                      </li>
      
                     
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  -->
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" onsubmit="return update_school()">
                      <div class="form-group form-group-sm">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" required class="form-control" value="<?php echo $school['name']; ?>" name="school_name" placeholder="Name">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputEmail" class="col-sm-2 control-label">Registration</label>

                        <div class="col-sm-10">
                          <input name="school_reg_no" type="text" required disabled class="form-control"  placeholder="Email" value="<?php echo $school['S_Reg_No']; ?>">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputName2" class="col-sm-2 control-label">Head</label>

                        <div class="col-sm-10">
                          <input type="text" required class="form-control" value="<?php echo $school['HDM']; ?>" name="HDM" placeholder="Head of the school">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Category</label>

                        <div class="col-sm-10">
                          <select name="category" class="form-control" required>
                            <option value="<?php echo $school['category']; ?>">
                                <?php if($school['category'] == "EDU"){echo "Education";} ?>
                                <?php if($school['category'] == "ESM"){echo "Environmental science";} ?>
                                <?php if($school['category'] == "INF"){echo "Informatics";} ?>
                            
                            </option>
                            <option value="EDU">Education</option>
                            <option value="INF">Informatics</option>
                            <option value="ESM">Environmental science</option>

                          </select>
                        </div>
                      </div>


                      <div class="form-group form-group-sm">
                        <label for="inputExperience" class="col-sm-2 control-label">contact</label>

                        <div class="col-sm-10">
                          <input value="<?php echo $school['contact']; ?>" class="form-control" name="contact" required placeholder="Enter school contact">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                              <label class="lable-control col-md-2">Region: </label>
                              <div class="form-group col-md-10">
                                <select name="region" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="<?php echo $school['region']; ?>"><?php echo $school['region']; ?></option>
                                  
                                  <?php if($regions): ?>
                                    <?php foreach($regions as $region): ?>
                                      <option value="<?php echo $region['region_name']; ?>"><?php echo $region['region_name']; ?></option>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                
                                </select>
                              </div>
                            </div>

                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">District</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?php echo $school['district']; ?>" name="district" placeholder="Enter diostrict allocation of the school">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Ward</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?php echo $school['ward']; ?>" required name="ward" placeholder="Enter ward allocation of the school">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Students No.</label>

                        <div class="col-sm-10">
                          <input type="number" class="form-control" value="<?php echo $school['student_required']; ?>" required name="size" placeholder="Enter number of student required">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Reachable</label>

                        <div class="col-sm-10">
                          <select name="reachable" class="form-control" required>
                            <option value="<?php echo $school['reachable']; ?>"><?php echo $school['reachable']; ?></option>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                          </select>
                        </div>
                      </div>
                      <?php if($category == 'EDU'): ?>
                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Level</label>

                        <div class="col-sm-10">
                          <select name="level" class="form-control" required>
                            <option value="<?php echo $school['level']; ?>"><?php echo $school['level']; ?></option>
                            <option value="O-LEVEL">O-LEVEL</option>
                            <option value="A-LEVEL">A-LEVEL</option>
                            <option value="O-LEVEL & A-LEVEL">O-LEVEL & A-LEVEL</option>

                          </select>
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Type</label>

                        <div class="col-sm-10">
                          <select name="type" class="form-control" required>
                            <option value="<?php echo $school['type']; ?>"><?php echo $school['type']; ?></option>
                            <option value="Single">Single</option>
                            <option value="Core">Core</option>

                          </select>
                        </div>
                      </div>

                      <?php endif; ?>

                     
                      <div class="form-group" id="btn_submit">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button id="add_btn" type="submit" class="btn btn-success btn-sm">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="active tab-pane" id="Subjects">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title"><?php echo $school['name']; ?> 
                        <?php if($category == 'EDU'){ ?>
                        Offered Subjects
                      <?php }else{ ?>
                        Status
                      <?php } ?>
                      </h5>
                      </div>
                      <?php if($category == 'EDU'){ ?>
                         
                        <div class="table-responsive card-body">
                            <?php if($subjects){ $no =0; ?>
                              <form onsubmit="return send_subject_required()" id="form">
                              <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Subject name</th>
                                  <th>Student limit</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($subjects as $subject):$no++; ?>
                           
                            <tr>
                                <th><?php echo $no; ?></th>
                                <td>
                                  <?php $ID = $subject['id']; $sub = $subject['sub_name']; ?>
                                  <i class="fa fa-book"></i> <?php echo $subject['sub_name']; ?>
                                   <span style="cursor: pointer;float: right;" onclick="delete_subject('<?php echo $ID; ?>','<?php echo $sub; ?>')" class="badge bg-danger"><small  id="delete<?php echo $ID?>">Delete</small></span>
                                </td>
                                <td>
                            <?php $color =''; if($subject['required'] > 0){$color = "success";}else{$color = 'secondary'; }?>
                                  <input required="" min="0" type="number" style="width: 100px" class="bg-<?php echo $color; ?> form-control text-center" value="<?php echo $subject['required'];?>" name="required_<?php echo $ID;?>">
                                </td>
                              </tr>
                          <?php endforeach; ?>
                              </tbody>
                            </table>
                            <div class="form-group text-center">
                            <button class="btn btn-info btn-sm">Submit subject student required</button>
                          </div>
                      </form>
                            <?php }else{ ?>
                              <div class="alert alert-warning">No subject record found please add some subject(s)</div>
                            <?php } ?>
                        </div>

                        <div id="result"></div>
                      </div>
                      <div class="card-footer">
                        <form method="post" class="form-horizontal" action="<?php echo base_url('inserting/add_subjects'); ?>" id="form" onsubmit="return add_subject()">
                          <div class="form-group">
                            <strong>Subject name:</strong>
                            <div class="input-group col-md-6">
                            <select required name="subject_name[]" class="form-control select2" multiple="multiple" data-placeholder="Select subjects"
                          style="width: 100%;">
                          
                              <?php if($university_subjects): ?>
                                <?php foreach($university_subjects as $sub): ?>
                                  <option value="<?php echo $sub['subject_name']; ?>"><?php echo $sub['subject_name']; ?></option>
                                <?php endforeach; ?>
                              <?php endif; ?>
                          </select>
                            
                          </div>
                          </div>

                          <input type="hidden" value="<?php echo $school['S_Reg_No']; ?>" name="S_Reg_No">

                          <div class="form-group">
                            <button type="submit" class="btn btn-success  btn-sm">Add</button>
                          </div>

                        </form>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                  <!-- / .tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        <?php endif; ?>

<script>
  function update_school(){
    $("#add_btn").attr('disabled','disabled');
    $("#add_btn").html('processing... <span class="fa fa-refresh fa-spin"></span>');
    region = $("select[name='region']").val();
    school_reg_no = "<?php echo $s_reg_no ?>";
    HDM = $("input[name='HDM']").val();
    contact = $("input[name='contact']").val();
    district = $("input[name='district']").val();
    ward = $("input[name='ward']").val();
    size = $("input[name='size']").val();
    school_name = $("input[name='school_name']").val();
    reachable = $("select[name='reachable']").val();
    category = $("select[name='category']").val();
    <?php if($category == 'EDU'){ ?>
    level = $("select[name='level']").val();
    type = $("select[name='type']").val();
  <?php }else{ ?>
    level = '';
    type = '';
  <?php } ?>
  
    path = "<?php echo base_url('updates/update_school_info') ?>";
    
    $.ajax({
      url:path,
      type:"post",
      data:{region:region, school_reg_no:school_reg_no,category:category, HDM:HDM, contact:contact, district:district, ward:ward, size:size, school_name:school_name, reachable:reachable, level:level, type:type},
      success:function(data){
       // alert(data);
        setTimeout(function(){
          if(data == '1'){
            $("#btn_submit").html('<div class="alert alert-success"> <i class="fa fa-ok"></i> Success information updated</div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }

          if(data == '2'){
            $("#btn_submit").html('<div class="alert alert-danger"> <i class="fa fa-warning"></i> Error occured while updating information</div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }



        },3000);
      }

    });

    return false;
  }
  
function delete_subject(ID,subname){
  $("#delete"+ID).html('<i class="fa fa-refresh fa-spin"></i>..');
  reg_no = "<?php echo $s_reg_no ?>";
  path = "<?php echo base_url('updates/delate_subject') ?>";
  $.ajax({
    url:path,
    type:"post",
    data:{ID:ID, subname:subname, reg_no:reg_no},
    success:function(data){
      //alert(data);
      setTimeout(function(){
        if(data == '1'){
          window.location.replace('');
        }
        if(data == '2'){
          $('#result').html('<div class="alert alert-warning">This subject are in use</div>');
            setTimeout(function(){
              window.location.replace('');
            },2000);
        }
       
      },2000);
    }
  });
}

function send_subject_required(){
   var marks = $('#form').serializeArray();
   Reg = "<?php echo $school['S_Reg_No'] ?>";
   path ="<?php echo base_url('inserting/add_subjects_required') ?>";
   $.ajax({
  url: path,
  type: "POST",
  data:  {marks:marks, Reg:Reg},
  success:function(data){
    window.location.reload();
  }

  })
   return false;
}

</script>