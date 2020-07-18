 <?php 
    $student['my_username'] = $student["lname"].", ".$student["fname"]." ".$student["mname"];
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
          <div class="col-md-12">

            

            <?php
            $url = base_url('student/profile');
              if($student['image'] == ''):
                echo '<div class="callout callout-warning">
              <h5><i class="fa fa-waning"></i> Warning:</h5>
              Please <a class="text-info" href="'.$url.'"><strong>click here</strong></a> to apload your valid picture before field start. 
            </div>';
            endif;
            ?>
            

 <?php if($field_selected){ ?>
  <?php foreach($field_selected as $field){} ?>
    <?php if($field[0]): ?>
      <?php foreach($field[0] as $school){} ?> 
      <?php endif; ?>
                   
                     <div class="callout callout-success">
                    <?php if($arrive_note): ?>
                        <?php foreach($arrive_note as $note){} ?>
                            <?php if($field['arrive_note'] == ''){ ?>
                        <strong>Your required to submit arrive letter signed with the institution you are</strong><br>
                        <button onclick="click_btn()" id="click_btn" class="btn btn-sm btn-outline-secondary fa fa-upload"> Upload your arrive letter</button>
                        <form class="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('updates/student_upload_arrive_note'); ?>">
                    
                            <input required name="userfile" accept=".pdf" onchange="check_file_name()" type="file" style="display:none" id="file" ?>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </form>
                        <hr>
                        <?php }else{ ?>
                                    
                             <a target=”_blank” href="<?php echo base_url('assets/arrive_note/'.$field['arrive_note']); ?>">
                      <button class="btn btn-sm btn-secondary">View documentation</button></a> <a href="<?php echo base_url('updates/student_remove_arrive_note'); ?>">
                      <button class="btn btn-sm btn-danger fa fa-trash"> Remove</button>
                      </a>
                      <hr>
                      <br>
                        <?php } ?>

                    <?php endif; ?>

                  <h5>Training practicle information</h5>
                  <p>
                    <strong><i class="fa fa-institution text-success"></i> You have select your field at: </strong> <span class="text-uppercase  text-success"> <?php echo $school['name']; ?></span><br>
                    <?php if($student['category'] == 'EDU'): ?>
                    <strong><i class="fa fa-book text-success"></i> Your will be teaching: </strong><span class=" text-success"><?php echo $field['subject']; ?></span>
                    <br>
                  <?php endif; ?>
                    <strong><i class="fa fa-user text-success"></i> Assessor name: </strong>
                    <?php 
                      if($assessor_allocated){ ?>
                        <?php foreach($assessor_allocated as $assesessor){}
                        echo "<a href='#' class='text-success text-uppercase'> ". $assesessor['fname']." ". $assesessor['mname']." ". $assesessor['lname']."</a>";
                        ?>
                      <?php }else{ ?>
                        <span class="fa fa-warning text-danger"> You will be notfied soon</span>
                      <?php } ?>
                      <br>
                    <strong><i class="fa fa-calendar text-success"></i> Assessment date: </strong>
                    <?php 
                      if($assessment_date){ ?>
                        <?php foreach($assessment_date as $ass_date){}
                        if($ass_date['as_date'] == ''){ ?>
                          <span class="fa fa-warning text-danger"> You will be notfied soon</span>
                      <?php }else{ ?>
                        <span class='text-success text-uppercase'><?php echo $ass_date['as_date']; ?></span>
                      <?php } ?>
                    <?php }else{ ?>
                      <span class="fa fa-warning text-danger"> Wait first for your assessor is allocated</span>
                    <?php } ?>
                    <hr>
                    <strong><small>For more information about your selection click <a href="<?php echo base_url('student/select_field'); ?>" class="text-info">here</a></small></strong><hr>

                    <?php if($applicatio_window){ ?>
                    <?php if($re_application){ ?>

                      <?php foreach($re_application as $re_app){} ?>
                      <?php if($re_app['status'] == 'YES'){ ?>
                          <?php $fieldID = $field['id']; ?> 
                          <button onclick="remove_application('<?php echo $fieldID; ?>')" class="btn btn-success btn-sm fa fa-check"> Your request accepted click to re aply</button>
                        <?php }else{ ?>
                          <strong class="text-success">Your request is processed  <i class="fa fa-refresh fa-spin"></i></strong>
                        <?php } ?>
                    <?php }else{ ?>
                    <strong><small>If you need to cancel your selection click <a class="text-info" data-toggle="modal" data-target="#myModal" href="#"  data-toggle="modal" data-target="#myModal">here</a></small></strong>

                    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <p>Are you sure that you need to cancel your selection?</p>
          <strong>NOTE:</strong>
          If you ask for changing your selection and you see again this then your request is rejected for the first time
        </div>
        <div class="modal-footer pull-left">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
          <a href="<?php echo base_url('updates/requst_re_application'); ?>">
            <button type="button" class="btn btn-danger btn-sm">Confirm</button>
          </a>


        </div>
      </div>
    </div>
  </div>
<?php } ?>
                  <?php }else{ ?>
                    <div class="alert alert-warning"><i class="fa fa-warning"></i> The application is closed you can't change anything</div>
                  <?php } ?>
                  </p>
                </div>
                <div class="card">
                <?php if($other_student){ ?>
                  <div class="card-header">
                    <h3 class="card-title">Other student selected for the same school</h3>
                  </div>
                  <div class="card-body table-hover table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Profile</th>
                      <th>Full name</th>
                      <th>Program</th>
                      <th>contact</th>
                      <th>subject</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach($other_student as $student): ?>
                        <?php 
                           $student['imagePath'] = base_url()."assets/profile/student/".$student['image'];
                            if($student['image'] == ''){
                              $student['imagePath'] = base_url()."assets/images/student.jpg";
                            }
                        ?>
                        <tr>
                        <td><img style="width: 30px; height: 30px;" src="<?php echo $student['imagePath']; ?>"></td>
                        <td><?php echo $student['fname']." ".$student['mname']." ".$student['lname']; ?></td>
                        <td><?php echo $student['program']; ?></td>
                        <td><?php echo $student['contact']; ?></td>
                        <td><?php echo $student['subject']; ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  </div>
                <?php }else{ ?>
                  <div class="alert alert-info">
                    No any other student selected this school. if there will be any update you will know other student sellected this Institution 
                  </div>
                <?php } ?>
                </div>


  


<?php }else{ ?>    
           <?php if($applicatio_window){ ?>
            <?php if($institution_prevalage){ ?>
              <?php foreach($institution_prevalage as $inst){} ?>
              <?php $Region = str_replace(' ', '_', $inst['region']); ?>
              <a href="<?php echo base_url('student/open_region/'.$Region); ?>">
                <button class="btn btn-success btn-sm"> <i class="fa fa-spinner fa-spin"> </i> You have Institution priority click to select your field area</button>
              </a>

            <?php }else{ ?>
              <div class="callout callout-warning">
                You have not made your application please clik <a href="<?php echo base_url('student/select_field'); ?>" class="text-info">here</a> to aply before the chance is over
              </div>
            <?php } ?>
        
            <?php }else{ ?>
               <div class="callout callout-warning">
                Application window is temporary closed wait  for a while. we are preparing slot for you
              </div>
            <?php } ?>
<?php } ?>
        <?php if(!$field_selected AND !$app_field_request){ ?>
            <div class="callout callout-info">
              <h5>Field area letter request:</h5>
              Please <a class="text-info" href="<?php echo base_url(); ?>student/field_request"><strong>click here</strong></a> to requst field area form. 
            </div>
        <?php }else{ ?>
            <?php if($app_field_request AND !$field_selected){ ?>
             <div class="callout callout-success">
                <?php foreach($app_field_request as $request){} ?>
                <?php if($request['status'] == 'pending'){ ?>
                    <h5>Field letter request status:</h5>
                    <i class="text-danger">request pending<i>
                <?php }else{ ?>
                <h5>Field letter arleady prepared:</h5>
                    <span class="text-success">Vist directors office to get your letter</strong>
                <?php } ?>
                <a class="text-info" href="<?php echo base_url(); ?>student/field_request"><strong>View application</strong></a>
            </div>
            <?php } ?>
        <?php } ?>

          </div>
        </div>
      

<script>
  function remove_application(ID){
    path = "<?php echo base_url('updates/delete_application') ?>";
    $.ajax({
      url:path,
      type:"post",
      data:{ID:ID},
      success:function(data){
        //alert(data);
       window.location.replace('student/select_field');
      }
    })
  }
</script>

<script>
function check_file_name(){
   file =  $('#file').val();
   if(file != ''){
       $('#click_btn').removeClass('btn-outline-secondary');
       $('#click_btn').removeClass('fa-upload');
       $('#click_btn').addClass('fa-check');
       $('#click_btn').addClass('btn-outline-success');
   }
   fileName = file.split('\\').pop();
    $('#click_btn').html(" "+fileName)
}
function click_btn(){
    $('#file').click();
}

</script>

