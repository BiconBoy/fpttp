<?php 
    
    $info = '';


    $student['username'] = $student["fname"]." ".$student["lname"];
    $student['imagePath'] = base_url()."assets/profile/student/".$student['image'];
    if($student['image'] == ''){
        //$student['imagePath'] = base_url()."assets/images/student.jpg";
        $student['imagePath'] = base_url()."assets/admin/dist/img/icons/ic_person_24px.svg";
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
              <li class="breadcrumb-item"><a href="<?php echo base_url('student'); ?>"><?php echo $title; ?></a></li>
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
                       src="<?php echo $student['imagePath']; ?>"
                       alt="">
                </div>
                
                 <form class="text-center" method="post" enctype="multipart/form-data" action="<?php echo base_url('updates/update_student_profile_img'); ?>">
                  <input onchange="displayImage(this)" id="userfile" style="display: none;" type="file" accept=".png,.jpg,.jpeg,.gif,.svg,.icon" name="userfile">
                  <input type="hidden" name="oldfile" value="<?php echo $student['image']; ?>">
                  <button style="display: none;" id="file_submit" class="btn btn-sm btn-success">Update</button>
                </form>

                <h3 class="profile-username text-center"><?php echo $student['username']; ?></h3>
                 <p class="text-muted text-center"><?php echo $student['Reg_No']; ?>
                

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Contact</b> <a class="float-right"><?php echo $student['contact']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>E-mail</b> <a class="float-right"><?php echo $student['email']; ?></a>
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

                <strong><i class="fa fa-mortar-board mr-1"></i> Program:</strong>
                
                <p class="text-muted">
                  <?php echo $student['program']; ?>
                </p>
                
                <hr>

                <strong><i class="fa fa-file-text-o mr-1"></i> Accademic year</strong>
                
                <p class="text-muted">Year <?php echo $student['study_year']; ?></p>
              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-success card-outline">
              <div class="card-header p-2">
                <h3 class="card-title">Update your information</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal" onsubmit="return update_instructor_details()">
                      <div class="form-group form-group-sm">
                        <label for="inputName" class="col-sm-2 control-label">First Name</label>

                        <div class="col-sm-10">
                          <input type="text"  onkeypress="open_submit_btn()"   value="<?php echo $student["fname"]; ?>" class="form-control" id="fname" placeholder="Correct Yor first name">
                        </div>
                      </div>
 <div class="form-group form-group-sm">
                        <label for="inputName" class="col-sm-2 control-label">Middle Name</label>

                        <div class="col-sm-10">
                          <input type="text"  onkeypress="open_submit_btn()"   value="<?php echo $student["mname"]; ?>" class="form-control" id="mname" placeholder="Correct your middle name">
                        </div>
                      </div>
 <div class="form-group form-group-sm">
                        <label for="inputName" class="col-sm-2 control-label">Surname</label>

                        <div class="col-sm-10">
                          <input type="text"  onkeypress="open_submit_btn()"  value="<?php echo $student["lname"]; ?>" class="form-control" id="lname" placeholder="Enter your sirname">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" required value="<?php echo $student["email"]; ?>" onkeypress="open_submit_btn()" id="inputEmail" placeholder="Email">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputContact" class=" control-label">Contact <small class="text-danger">(make sure is always reachable)</small></label>

                        <div class="col-sm-10">
                          <input onkeypress="open_submit_btn()" type="text" required value="<?php echo $student['contact']; ?>" class="form-control" id="inputContact" placeholder="Input your phone number">
                        </div>
                      </div>

                      <div class="form-group form-group-sm">
                        <label for="inputContact" class="col-sm-2 control-label">Study year</label>

                        <div class="col-sm-10">
                          <select onchange ="open_submit_btn()"  required  class="form-control" id="study_year">
                            <option value="<?php echo $student['study_year']; ?>">
                              <?php if($student['study_year'] != ''){ ?>
                              <?php echo $student['study_year']; ?>
                            <?php }else{ echo "Select year of study"; } ?>
                            </option>
                            <?php for($i=1; $i<=5; $i++){ ?>
                              <?php if($student['study_year'] != $i): ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endif; ?>
                            <?php } ?>
                          </select>
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
      email = $("#inputEmail").val();
      fname = $("#fname").val();
      mname = $("#mname").val();
      lname = $("#lname").val();
      contact = $("#inputContact").val();
      study_year = $("#study_year").val();
      path = "<?php echo base_url('updates/update_student_profile') ?>";
    
      $.ajax({
        url:path,
        type:"POST",
        data:{study_year:study_year, email:email,fname:fname, mname:mname, lname:lname, contact:contact},
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