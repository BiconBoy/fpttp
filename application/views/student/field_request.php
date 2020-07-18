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
    <section class="content" style="margin-top: -23px">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
       
          <div class="card card-success card-outline">
            <div class="card-body">
               <div class="row">
                <div class="col-md-12">
                    <?php if(isset($_SESSION['appl_success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['appl_success']; ?>
                        </div>
                    <?php unset($_SESSION['appl_success']); endif; ?>

                    <?php if(isset($_SESSION['appl_error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['appl_error']; ?>
                        </div>
                    <?php unset($_SESSION['appl_error']); endif; ?>

                    <?php if($app_field_request): ?>
                    <div class="callout callout-info">
                        <?php foreach($app_field_request as $app){} ?>
                        
                            <h5></i>Request for field letter:</h5>
                            <label>Coordinator name: </label> <?php echo $app['coordinator']; ?><br>
                            <label>Coordinator contact: </label> <?php echo $app['coordinator_contact']; ?><br>
                            <label>Institution name: </label> <?php echo $app['institution_name']; ?><br>
                            <label>Office contact: </label> <?php echo $app['office_contact']; ?><br>
                            <label>Location: </label> <?php echo $app['region']." ".$app['district']." ".$app['ward']; ?><br>
                            <label>Students:</label><br>
                            <?php 
                                $student = explode('<br>',$app['students']);
                                $no = 0;
                                foreach($student as $student){$no++;
                                    echo "(".$no."). ".$student."<br>";
                                }
                            ?>
                            <label>Status: </label><i> <?php echo $app['status'] ?></i>


                        </div>


                    <?php else: ?>
                  <form action="<?php echo base_url('inserting/field_request_form'); ?>" method="POST">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">Institution:<i class="text-danger">*</i></lable>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-sm" required placeholder="Enter the name of institution">
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">Office phone:<i class="text-danger">*</i></lable>
                            <div class="form-group">
                                <input type="text" name="office_contact" class="form-control form-control-sm" placeholder="Enter office contact">
                            </div>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">Office address:<i class="text-danger">*</i></lable>
                            <div class="form-group">
                                <input type="text" name="address" class="form-control form-control-sm" placeholder="Enter office address">
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">Region:<i class="text-danger">*</i></lable>
                            <div class="form-group">
                                <input type="text" name="region" class="form-control form-control-sm" required placeholder="Enter region of the institution">
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">District:<i class="text-danger">*</i></lable>
                            <div class="form-group">
                                <input type="text" required name="district" class="form-control form-control-sm" placeholder="Enter district of the institution">
                            </div>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">Ward:</lable>
                            <div class="form-group">
                                <input type="text" name="ward" class="form-control form-control-sm" placeholder="Enter ward of the institution">
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">Student leader name:<i class="text-danger">*</i></lable>
                            <div class="form-group">
                                <input type="text" name="coordinator" class="form-control form-control-sm" required placeholder="Enter name of group coordinater">
                            </div>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                            <lable class="label-control">Student leader phone number:<i class="text-danger">*</i></lable>
                            <div class="form-group">
                                <input type="text" name="coordinator_contact" class="form-control form-control-sm" required placeholder="Enter name of group coordinater">
                            </div>
                            </div>
                        </div>
<hr>

                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-outline-danger pull-right fa fa-plus-circle" onclick="add_div_form()"> Student</button>
                            <h3>Student list</h3>
                            <div class="row" id="student_list">
                        <? if($student['category'] == 'EDU'){ ?>
                                <div class="col-md-4 col-4">
                                    <input type="text"  name="students[]" value="<? echo $student['fname']." ".$student['mname']." ".$student['lname']; ?>" required=""  placeholder="Full name" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-4 col-4">
                                    <input type="text" name="regNo[]" value="<? echo $student['Reg_No']; ?>" required="" placeholder="Registration number" minlength="" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <select name="subject[]" class="form-control select2 select2-hidden-accessible" required="" style="width: 100%;" tabindex="-1" aria-hidden="true" required >
                                  <option value="">Subject</option>
                                  <?php if($inst_subject): ?>
                                    <?php foreach($inst_subject as $subject): ?>
                                      <option value="<? echo $subject['subject_name']; ?>"><? echo $subject['subject_name']; ?></option>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                </select>
                                    </div>
                                    
                                </div>
                        <? }else{ ?>
                            <div class="col-md-6 col-7">
                                <input type="text" name="students[]" value="<? echo $student['fname']." ".$student['mname']." ".$student['lname']; ?>" required=""  placeholder="Full name" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-6 col-5">
                                <input type="text" name="regNo[]" value="<? echo $student['Reg_No']; ?>"  required="" placeholder="Registration number" minlength="" class="form-control form-control-sm">
                            </div>
                        <? } ?>
                            </div>
                        


                        </div>



                    </div>

                   
                    <label class="lable-control"><i class="text-danger">*</i> Must be field</label><br>
                    <label class="lable-control">NOTE!</label> All student added must create FPT-TP account
                    <div class="form-group text-center" id="Result">
                      <button id="submit" class="btn btn-sm btn-success">submit</button>
                    </div>
                  </form>

                  <?php endif; ?>
                </div>
               
              </div>
          </div>
        </div>
<script>

    function add_div_form(){
        $("#student_list").append(
<? if($student['category'] == 'EDU'){ ?>
    '<div class="col-md-12 clo-12 bg-dark" style="border-style:solid;height:1px;"></div>'+
    '<div class="col-md-4 col-4"><input type="text"  name="students[]" required=""  placeholder="Full name" class="form-control form-control-sm"></div><div class="col-md-4 col-4"><input type="text" name="regNo[]" required="" placeholder="Registration number" minlength="" class="form-control form-control-sm"></div>'+
    '<div class="col-md-4 col-4"><div class="form-group"><select name="subject[]" class="form-control" required="" style="width: 100%;" tabindex="-1" aria-hidden="true" required ><option value="">Subject</option>'+
                                  <?php if($inst_subject): ?>
                                    <?php foreach($inst_subject as $subject): ?>
                                      '<option value="<? echo $subject['subject_name']; ?>"><? echo $subject['subject_name']; ?></option>'+
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                '</select></div></div>'
<? }else{ ?>
    '<div class="col-md-6 col-7"><input type="text" name="students[]"  required=""  placeholder="Full name" class="form-control form-control-sm"></div>'+
    '<div class="col-md-6 col-5">'+
        '<input type="text" name="regNo[]"   required="" placeholder="Registration number" minlength="" class="form-control form-control-sm">trertikhiekth'+
    '</div>'
<? } ?>
        );
    }
</script>