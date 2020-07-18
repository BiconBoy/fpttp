<?php 
    
    $info = '';
if($students){ 
    foreach($students as $student){}

    $student['username'] = $student["fname"]." ".$student["lname"];
    /*
    $student['imagePath'] = base_url()."assets/profile/student/".$student['image'];
    if($student['image'] == ''){
        $student['imagePath'] = base_url()."assets/images/student.jpg";
    }
*/
$student['imagePath'] = base_url()."assets/admin/dist/img/icons/ic_person_24px.svg";


?>


<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
               <a href="<?php echo base_url('adminstrator/manage_student'); ?>">
              <button class="btn btn-sm btn-success fa fa-angle-double-left"> Back</button></a>
              <?php echo $maintitle; ?></h1>
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
                <h3 class="profile-username text-center"><?php echo $student['username']; ?></h3>
                 <p class="text-muted text-center"><?php echo $student['Reg_No']; ?>
                

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Contact</b> <a class="float-right"><?php echo $student['contact']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>E-mail</b> <a class="float-right"><?php echo $student['email']; ?></a>
                  </li>

                  <li class="list-group-item">
                    <strong><i class="fa fa-mortar-board mr-1"></i> Program:</strong>
                     <p class="text-muted">
                      <?php echo $student['program']; ?>
                    </p>
                  </li>
                  <li class="list-group-item">
                   <strong><i class="fa fa-file-text-o mr-1"></i> Accademic year</strong>
                    <p class="text-muted">
                      Year <?php echo $student['study_year']; ?>
                    </p>
                  </li>
               



                </ul>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-success card-outline">
              <div class="card-header p-2">
                <div class="card-title">
                  <button onclick="change_pwd()" class="btn btn-sm btn-success fa fa-gears"> change password</button>
              </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <div id="pwd_result"></div>

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
    
      <?php } else{ ?>
        <div class="alert alert-warning">an Error accured</div>
      <?php } ?>
<script>
   function open_submit_btn(){
    $("#submit_btn").show('slow');
   }

   function update_instructor_details(){
      $("#submit_btn").attr('disabled','disabled');
      $("#submit_btn").html('Updating... <span class="fa fa-refresh fa-spin"></span>');
      email = $("#inputEmail").val();
      contact = $("#inputContact").val();
      study_year = $("#study_year").val();
      path = "<?php echo base_url('updates/update_student_profile') ?>";

      $.ajax({
        url:path,
        type:"POST",
        data:{study_year:study_year, email:email, contact:contact},
        success:function(data){
          setTimeout(function(){
            window.location.replace('');
          },3000);
        }
      });

      return false;
   }


   function change_pwd(){
    SID = "<?php echo $student['SID'] ?>";
    path = "<?php echo base_url('updates/instructor_change_password_student') ?>";
    $.ajax({
      url:path,
      type:"POST",
      data:{SID:SID},
      success:function(data){
        $("#pwd_result").html(data);
      }
    })
  }


</script>