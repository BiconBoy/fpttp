<?php 
    

    $adminstrator['username'] = $adminstrator["fname"]." ".$adminstrator["lname"];
    
    
    
    if($adminstrator['image'] == ''){
        $adminstrator['imagePath'] = base_url()."assets/admin/dist/img/icons/ic_person_24px.svg";
    }else{
        $adminstrator['imagePath'] = base_url()."assets/profile/instructor/".$adminstrator['image'];
    }
        

?>


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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php  
                  if(isset($_SESSION['Profile_success'])){
                    echo $_SESSION['Profile_success'];
                    unset($_SESSION['Profile_success']);
                  }
                  if(isset($_SESSION['Profile_error'])){
                    echo $_SESSION['Profile_error'];
                    unset($_SESSION['Profile_error']);
                  }
                  ?>
                  <img id="profileDisplay" class="profile-user-img img-fluid img-circle"
                       src="<?php echo $adminstrator['imagePath']; ?>"
                       alt="">
                </div>
                
                 <form class="text-center" method="post" enctype="multipart/form-data" action="<?php echo base_url('updates/update_profile_img'); ?>">
                  <input onchange="displayImage(this)" id="userfile" style="display: none;" type="file" accept=".png,.jpg,.jpeg,.gif,.svg,.icon" name="userfile">
                  <input type="hidden" name="oldfile" value="<?php echo$adminstrator['image']; ?>">
                  <input type="hidden" name="AID" value="<?php echo$adminstrator['AID']; ?>">
                  <button style="display: none;" id="file_submit" class="btn btn-sm btn-success">Update</button>
                </form>

                <h3 class="profile-username text-center"><?php echo $adminstrator['username']; ?></h3>
                 <p class="text-muted text-center"><?php echo $adminstrator['AID']; ?>
                <br><?php echo $adminstrator['Designation']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Contact</b> <a class="float-right"><?php echo $adminstrator['contact']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>E-mail</b> <a class="float-right"><?php echo $adminstrator['email']; ?></a>
                  </li>
                </ul>
                
                <a href="#" onclick="click_file()" id="btn_block" class="btn btn-sm btn-success btn-block"><b>Change profile image</b></a>
               
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <strong><i class="fa fa-map-marker mr-1"></i> Department</strong>

                <p class="text-muted"><?php echo $adminstrator['location']; ?></p>

                <hr>

                <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>
                
                <p class="text-muted">
                  <?php echo $adminstrator['skills']; ?>
                </p>
                
                <hr>

                <strong><i class="fa fa-file-text-o mr-1"></i> Notes</strong>
                
                <p class="text-muted"><?php echo $adminstrator['experience']; ?></p>
              
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
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    No record found
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    No record found
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" onsubmit="return update_instructor_details()">
                      <div class="form-group form-group-sm">
                        <label for="inputName" class="col-sm-2 control-label">Full Name</label>

                        <div class="col-sm-10">
                          <input type="text"  disabled value="<?php echo $adminstrator["fname"]." ".$adminstrator["mname"]." ".$adminstrator["lname"]; ?>" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" required value="<?php echo $adminstrator["email"]; ?>" onkeypress="open_submit_btn()" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group form-group-sm">
                        <label for="inputContact" class="col-sm-2 control-label">Contact</label>

                        <div class="col-sm-10">
                          <input onkeypress="open_submit_btn()" type="text" required value="<?php echo $adminstrator['contact']; ?>" class="form-control" id="inputContact" placeholder="Input your phone number">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputLocation" class="col-sm-2 control-label">Department</label>

                        <div class="col-sm-10">
                          <input onkeypress="open_submit_btn()" type="text" class="form-control" value="<?php echo $adminstrator['location']; ?>" id="inputLocation" placeholder="Input your Department">
                        </div>
                      </div>

                      
                      <div class="form-group form-group-sm">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input onkeypress="open_submit_btn()" type="text" value="<?php echo $adminstrator["skills"]; ?>" class="form-control" id="inputSkills" placeholder="What Skills do you have">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-10">
                          <textarea onkeypress="open_submit_btn()" class="form-control" value="<?php echo $adminstrator["experience"]; ?>" id="inputExperience" placeholder="What is your experience"></textarea>
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
<script>
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