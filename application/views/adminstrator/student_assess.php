<?php 
    
    $info = '';
if($students){ 
    foreach($students as $student){}

    $student['username'] = $student["fname"]." ".$student["lname"];
    $student['imagePath'] = base_url()."assets/profile/student/".$student['image'];
    if($student['image'] == ''){
        $student['imagePath'] = base_url()."assets/images/student.jpg";
    }

    if($application){
      foreach($application as $appl){}

?>


<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
               <a href="<?php echo $back_btn; ?>">
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
                  <?php if($student['category'] == "EDU"): ?>
                   <li class="list-group-item">
                   <strong><i class="fa fa-book mr-1"></i>Subject to be assessed</strong>
                    <p class="text-muted">
                      <?php echo $appl['subject']; ?>
                    </p>
                  </li>
                <?php endif; ?>



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
                <h3 class="card-title">Assessiment area</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    
                    
                       <?php if($appl['marks_confirm'] == 'NO'){ ?>
                        <form class="form" onsubmit="return add_marks()">
                      <div class="form-group">
                        <label class="label-control">Add student assessment marks</label>
                      <div class="form-group">
                        <input class="form-contro text-center  bg-secondary" min="1" max="100" value="<?php echo $appl['marks']; ?>" required="" id="marks" type="number" placeholder="out if 100%" style="width: 100px;" name="marks">
                        <input type="hidden" id="SID" value="<?php echo $student['SID']; ?>">
                      </div>
                    </div>

                      <div class="form-group">
                        <button class="btn btn-sm btn-success">Update</button>
                        <span style="float: right;" class="right">
                          <button type="button" onclick="submit_marks()" class="btn btn-sm btn-warning">Submit</button>
                        </span>
                      </div>
                       </form>
                    <?php }else{ ?>
                      <div class="fa fa-tasks text-success"> Assessiment marks: <strong><?php echo $appl['marks']; ?>%</strong></div><hr>
                      <?php if($appl['document'] == ''){ ?>
                        <form class="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('updates/student_ass_doc'); ?>">
                          <input class="form-control bg-success"  id="userfile" type="file" accept=".png,.jpg,.jpeg,.pdf" style="cursor: pointer;display: none;" name="userfile">
                          <input type="hidden" value="<?php echo $student['SID']; ?>" name="SID">
                          <input type="hidden" value="<?php echo $Reg; ?>" name="Reg">
                          <button style="display: none;" id="file_submit"  class="btn btn-sm btn-success">upload</button>
                        </form>
                      <butoon onclick="click_file()" id="my_btn"  class="btn btn-sm btn-primary fa fa-upload"> Upload doc</butoon>
                    <?php }else{ ?>
                      <a target=”_blank” href="<?php echo base_url('assets/documents/'.$appl['document']); ?>">
                      <button class="btn btn-sm btn-secondary">View documentation</button>
                      </a>
                    <?php } ?>
                    <?php } ?>
                      
                   <?php  
                  if(isset($_SESSION['_success'])){
                    echo $_SESSION['_success'];
                    unset($_SESSION['_success']);
                  }
                  if(isset($_SESSION['_error'])){
                    echo $_SESSION['_error'];
                    unset($_SESSION['_error']);
                  }
                  ?>


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

function add_marks(){
  SID = $("#SID").val();
  marks = $("#marks").val();
  path = "<?php echo base_url('updates/add_marks') ?>";
  $.ajax({
    url:path,
    type:"POST",
    data:{SID:SID, marks:marks},
    success:function(data){
      window.location = "";
    }
  })
  return false;
}

function submit_marks(){
  SID = $("#SID").val();
  path = "<?php echo base_url('updates/submit_marks') ?>";
  $.ajax({
    url:path,
    type:"POST",
    data:{SID:SID},
    success:function(data){
      window.location = "";
    }
  })
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
    $("#userfile").show('slow');
     $("#my_btn").hide('slow');
    $("#file_submit").show('slow');
}


</script>