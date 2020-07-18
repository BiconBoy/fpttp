<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <a href="<?php echo base_url('adminstrator/assessor_allocation'); ?>">
              <button class="btn btn-sm btn-success fa fa-angle-double-left"> Back</button></a><?php echo $maintitle; ?></h1>
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
<?php if($school_info){ ?>
  <?php foreach($school_info as $school){} ?>
    <!-- Main content -->
    <section class="content" style="margin-top: -23px;">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success card-outline">
              <div class="card-bod">
                
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Information</h3>
                    </div>
                    <div class="card-body">
                       <strong><i class="fa fa-institution mr-1"></i> Institution name</strong>

                <p class="text-muted pull-right">
                  <?php echo $school['name']; ?>
                </p>

                <hr>
                 <strong><i class="fa fa-user mr-1"></i>Leader name </strong>
                 <p class="text-muted pull-right">
                   <?php echo $school['HDM']; ?>
                </p>

                <hr>
                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                <p class="text-muted pull-right">
                   <?php echo $school['ward'].', '.$school['district'].', '.$school['region'];; ?>
                </p>

                <hr>

                <strong><i class="fa fa-phone mr-1"></i> Contact</strong>

                <p class="text-muted pull-right">
                  <?php echo $school['contact']; ?>
                </p>

                <hr>
                <form onsubmit="return add_assess_date()">
                <div class="form-group">
                  <label>Assessiment date:</label>
                  <small style="display: none;" id="format" class="text-danger d-sm-none
" ><br>Eg: 01/12/2018 - 07/12/2018</small>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <?php $date = ''; if($dates): ?>
                      <?php foreach($dates as $Adate){} $date = $Adate['as_date']; ?>
                    <?php endif; ?>
                    <input onchange="show_btn()" onkeyup="show_btn()"  placeholder="select date in range" required type="text" value="<?php echo $date; ?>" class="form-control float-right" id="reservation">
                    <div class="input-group-prepend" style="display: none;" id="submit">
          
                        <button class="btn btn-sm btn-success">Go</button>
                      
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
              </form>
                <!-- /.form group -->

                    </div>
                  </div>
                </div>
                <!-- / .col-md-4 -->
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-tittle">List of student</h3>
                    </div>
                    <div class="card-body table-responsive">
                      <table class="table table-bordered table-hover" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
            
                      <th>Student name</th>
                      <th>Program</th>
                      <th>contact</th>
                      <th>Arrive note</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($student_application){ $no = 0; ?>
                      <?php foreach($student_application as $data):$no++; ?>
                        <?php
                        $data['username'] = $data["fname"]." ".$data["mname"]." ".$data["lname"];
                        $data['imagePath'] = base_url()."assets/profile/student/".$data['image'];
                        if($data['image'] == ''){
                            $data['imagePath'] = base_url()."assets/images/student.jpg";
                        }
                        ?>
                        <tr>
                        <th><?php echo $no; ?></th>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['program']; ?></td>
                        <td><?php echo $data['contact']; ?></td>
                        <td>
                        <?php $arrive_note = $data['arrive_note']; ?>
                        <?php if($arrive_note != ''){ ?>
                        <a target="_blank" href="<?php echo base_url('assets/arrive_note/'.$arrive_note); ?>">
                      <button class="btn btn-sm btn-secondary"><?php echo $data['arrive_note']; ?></button> </a>
                      <?php }else{ echo "<span class='text-danger'><i>Not submitted</i></span>"; } ?>
                      </td>
                        <td>
                          <?php if($data['document'] == ""){ ?>
                          <?php 
                            $SID = str_replace('.', '_', $data['SID']);
                            $path = $reg."/".$SID;
                          ?>
                          <a href="<?php echo base_url('adminstrator/student_assess/'.$path); ?>">
                          <button  class="btn btn-sm btn-info">Assess</button>
                          </a>
                        <?php }else{ ?>
                            <span class="text-center text-success">ASSESSED</span>
                        <?php } ?>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    <?php }else{ ?>
                      <tr>
                        <td colspan="8" class="text-center text-danger">No record forund</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                    </div>
                  </div>
                </div>
              </div>

              </div>
            </div>
          </div>
        </div>

        <?php }else{ ?>
          <div class="alert alert-warning">Error occured please click to <a href="<?php echo base_url(); ?>" class="text-info"> back home </a></div>
          <?php } ?>


<script>
function show_btn(){
  
  date = $('#reservation').val();
  size = date.length
  if(size < 23){
    $("#format").show('slow');
    $("#submit").hide('slow');
  }else{
    $("#format").hide('slow');
    $("#submit").show('slow');
  }
}


  function add_assess_date(){
    date = $('#reservation').val();
    regNo = "<?php echo $regNo ?>";
    path = "<?php echo base_url('updates/add_assess_date') ?>";
    $.ajax({
      url:path,
      type:"post",
      data:{date:date, regNo:regNo},
      success:function(data){
        window.location = "";
      }
    })
    return false;
  }
</script>