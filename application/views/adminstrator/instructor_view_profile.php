<?php 
    
   if($instructors){
     foreach($instructors as $instructor){}





    $instructor['username'] = $instructor["fname"]." ".$instructor["lname"];
    $instructor['imagePath'] = base_url()."assets/profile/instructor/".$instructor['image'];
    if($instructor['image'] == ''){
           
             $instructor['imagePath'] = base_url()."assets/admin/dist/img/icons/ic_person_24px.svg";
            
        
    }

?>


<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <a href="<?php echo base_url('adminstrator/manage_instructor'); ?>">
                <button class="btn btn-sm btn-success fa fa-angle-double-left"> Back</button>
              </a>
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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                 
                  <img id="profileDisplay" class="profile-user-img img-fluid img-circle"
                       src="<?php echo $instructor['imagePath']; ?>"
                       alt="">
                </div>
                
                <h3 class="profile-username text-center"><?php echo $instructor['username']; ?></h3>
                 <p class="text-muted text-center"><?php echo $instructor['AID']; ?>
                <br><?php echo $instructor['Designation']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Contact</b> <a class="float-right"><?php echo $instructor['contact']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>E-mail</b> <a class="float-right"><?php echo $instructor['email']; ?></a>
                  </li>
                </ul>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
          
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                 
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update</a></li>
                  <li class="nav-item"><a class="nav-link" id="status">
                    <?php if($instructor['status'] == "Active"){ ?>
                      <button onclick="activate_block()" id="status" class="btn btn-sm btn-success">Activated</button>
                    <?php }else{ ?>
                    <button onclick="activate_block()"  id="status" class="btn btn-sm btn-danger">Blocked</button>
                  <?php } ?>
                  </a></li>
                  <li class="nav-item"><a class="nav-link">
                  <button onclick="change_pwd()" class="btn btn-sm btn-success fa fa-gears"> change password</button>
                </a></li>
                <li class="nav-item"><a class="nav-link">
                  <button onclick="remove_account()" class="btn btn-sm btn-outline-danger fa fa-gears"> Remove account</button>
                </a></li>
                <li class="nav-item" id="pwd_result">
                  
                </li>
                </ul>

              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    
                    <?php if($allocated){ ?>
                      <?php foreach($allocated as $allocate): ?>
                        <strong><i class=" fa fa-institution"></i> School name: </strong><span class="text-uppercase text-success"> <?php echo $allocate['name']; ?></span> <button class="btn btn-warning btn-sm"  onclick="remove_instructor('<?php echo $allocate['id']; ?>')"> remove</button><br>
                        <strong><i class=" fa fa-map-marker"></i> Location: </strong><?php echo $allocate['region']." ".$allocate['district']." ".$allocate['ward']; ?><br>
                        <strong><i class=" fa fa-calendar"></i> Planned date for assessment: </strong>
                        <?php 
                          if($allocate['as_date'] == ''){ ?>
                            <span class="text-danger"> Not planned yet</span>

                          <?php }else{ ?>
                            <span class="text-success"> <?php echo $allocate['as_date']; ?></span>


                        <?php } ?>

                        <hr class="btn-success">
                      <?php endforeach; ?>
                    <?php }else{ ?>
                      <div class="alert alert-ifo">Not allocated any ware</div>
                    <?php } ?>

                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                 
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" onsubmit="return update_instructor_details()">
                      <div class="form-group form-group-sm">
                        <label for="inputName" class="col-sm-2 control-label">Full Name</label>

                        <div class="col-sm-10">
                          <input type="text"  disabled value="<?php echo $instructor["fname"]." ".$instructor["mname"]." ".$instructor["lname"]; ?>" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" required value="<?php echo $instructor["email"]; ?>" onkeypress="open_submit_btn()" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="inputContact" class="col-sm-2 control-label">Contact</label>

                        <div class="col-sm-10">
                          <input onkeypress="open_submit_btn()" type="text" required value="<?php echo $instructor['contact']; ?>" class="form-control" id="inputContact" placeholder="Input your phone number">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputLocation" class="col-sm-2 control-label">Location</label>

                        <div class="col-sm-10">
                          <input onkeypress="open_submit_btn()" type="text" class="form-control" value="<?php echo $instructor['location']; ?>" id="inputLocation" placeholder="Input your address location">
                        </div>
                      </div>

                      
                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input onkeypress="open_submit_btn()" type="text" value="<?php echo $instructor["skills"]; ?>" class="form-control" id="inputSkills" placeholder="What Skills do you have">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-10">
                          <textarea onkeypress="open_submit_btn()" class="form-control" value="<?php echo $instructor["experience"]; ?>" id="inputExperience" placeholder="What is your experience"></textarea>
                        </div>
                      </div>
                     
                      <div class="form-group text-center">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" id="submit_btn" style="display: none" class="btn btn-sm btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
<?php }else{ ?>
  <div class="alert alert-warning">Error occured </div>  
<?php } ?>

<script>

  function activate_block(){
    status = "<?php echo $instructor['status'] ?>";
    AID = "<?php echo $instructor['AID'] ?>";
    path = "<?php echo base_url('updates/activate_deactivate') ?>";
    $.ajax({
      url:path,
      type:"POST",
      data:{status:status, AID:AID},
      success:function(data){
        window.location.replace('');
      }
    })
  }

   function change_pwd(){
    AID = "<?php echo $instructor['AID'] ?>";
    path = "<?php echo base_url('updates/instructor_change_password') ?>";
    $.ajax({
      url:path,
      type:"POST",
      data:{AID:AID},
      success:function(data){
        $("#pwd_result").html(data);
      }
    })
  }

     function remove_account(){
    AID = "<?php echo $instructor['AID'] ?>";
    path = "<?php echo base_url('updates/remove_instructor_account') ?>";
    $.ajax({
      url:path,
      type:"POST",
      data:{AID:AID},
      success:function(data){
        window.location = "<?php echo base_url('adminstrator/manage_instructor') ?>";
      }
    })
  }


    function remove_instructor(ID){
    path = "<?php echo base_url('updates/remove_assessor') ?>";
    $.ajax({
      url:path,
      type:"POST",
      data:{ID:ID},
      success:function(data){
        window.location.replace('');
      }
    })
  }

   function open_submit_btn(){
    $("#submit_btn").show('slow');
   }

   function update_instructor_details(){
      $("#submit_btn").attr('disabled','disabled');
      $("#submit_btn").html('Updating... <span class="fa fa-refresh fa-spin"></span>');
      skills = $("#inputSkills").val();
      experience = $("#inputExperience").val();
      email = $("#inputEmail").val();
      contact = $("#inputContact").val();
      inputLocation = $("#inputLocation").val();
      path = "<?php echo base_url('updates/update_instructor_profile') ?>";

      $.ajax({
        url:path,
        type:"POST",
        data:{skills:skills, experience:experience, email:email,inputLocation:inputLocation, contact:contact},
        success:function(data){
          setTimeout(function(){
            window.location.replace('');
          },3000);
        }
      });

      return false;
   }

function displayImage(e) {
  if(e.files[0]) {
  var reader = new FileReader();
  reader.onload = function(e){
  document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
  }
  reader.readAsDataURL(e.files[0]);
  }
}

function click_file(){
    $("#userfile").click();
    $("#file_submit").show('slow');
}


</script>