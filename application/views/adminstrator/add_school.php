 
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
    <section class="content" style="margin-top: -23px;">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-body">
      
                      <div class="card">
                        <dv class="card-header">
                          <h3 class="card-title">
                            <i class="fa fa-bullhorn"></i>
                            Add Institution
                          </h3>
                        </dv>
                        <div class="card-body">
                         <?php  
                  if(isset($_SESSION['upload_success'])){
                    echo $_SESSION['upload_success'];
                    unset($_SESSION['upload_success']);
                  }
                  if(isset($_SESSION['upload_error'])){
                    echo $_SESSION['upload_error'];
                    unset($_SESSION['upload_error']);
                  }
                  ?>
                        <div >
                              <form method="post" id="import_form" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-12 text-center img-responsive">
                <strong>Example of excel needed. arange your excel in form of this example</strong><br>
                <img class="img-responsive" style="width:100%;" src="<?php echo base_url("assets/images/institution.png"); ?>"  style=";">
            </div>
            <hr><br>
              <div class="form-group col-md-6">
                <label class="label-control">Use Excel File</label>
                <div class="form-group">
                  <input type="file" name="file" class="form-control" id="file" required accept=".xls, .xlsx" />
                </div>
              </div>
               <div class="form-group col-md-6"> 
                
              </div>
            </div>
        <div class="form-group text-center">
      <input type="submit" name="import" value="Import" class="btn btn-info" />
      </div>
    </form>
                        </div><hr>
                        <h3 class="card-title">Manual add institution</h3><br>
                          <form class="form-horizontal" onsubmit="return add_school()">
                            <div class="row">

                              <div class="col-md-4">
                                <div class="form-group form-group-sm">
                                  <label class="lable-control">Full Institution name: </label>
                                  <div class="form-group">
                                    <input type="text" name="school_name" required class="form-control" placeholder="if school( Sokoine Secondary School)">
                                  </div>
                                </div>
                              </div>

                            
                              <div class="col-md-4">
                                <div class="form-group form-group-sm">
                                  <label class="lable-control">Institution leader: </label>
                                  <div class="form-group">
                                    <input type="text" name="HDM" required class="form-control" placeholder="Enter the full name">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-group-sm">
                                  <label class="lable-control">Contact address: </label>
                                  <div class="form-group">
                                    <input type="text" name="contact" required class="form-control" placeholder="Enter the full name">
                                  </div>
                                </div>
                              </div>

                             <div class="col-md-4">
                                <div class="form-group form-group-sm">
                                  <label class="lable-control">Category: </label>
                                  <div class="form-group">
                                    <select onchange="check_category()" id="category" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <option value="">Select student group</option>
                                      <option value="EDU">Education programs</option>
                                      <option value="INF">Information technology programs</option>
                                      <option value="ESM">Environmental Science</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
  
                          <div class="col-md-4 for_school" style="display: none;">
                            <div class="form-group form-group-sm">
                            <label for="inputSkills" class="control-label">School Level:</label>

                            <div class="form-group">
                              <select id="level" name="level" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Select school level offering</option>
                                <option value="O-LEVEL">O-LEVEL</option>
                                <option value="A-LEVEL">A-LEVEL</option>
                                <option value="O-LEVEL & A-LEVEL">O-LEVEL & A-LEVEL</option>

                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4 for_school" style="display: none;">
                          <div class="form-group form-group-sm">
                            <label for="inputSkills" class=" control-label">School type:</label>

                            <div class="form-group">
                              <select name="s_type" id="type" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Select type of school</option>
                                <option value="Single (M)">Single (M)</option>
                                <option value="Single (F)">Single (F)</option>
                                <option value="Core">Core</option>

                              </select>
                            </div>
                          </div>
                        </div>
                      

                        <div class="col-md-4">
                          <div class="form-group form-group-sm">
                            <label class="lable-control">Institution region: </label>
                            <div class="form-group">
                              <select name="region" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Select region</option>
                                
                                <?php if($regions): ?>
                                  <?php foreach($regions as $region): ?>
                                    <option value="<?php echo $region['region_name']; ?>"><?php echo $region['region_name']; ?></option>
                                  <?php endforeach; ?>
                                <?php endif; ?>
                              
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group form-group-sm">
                            <label class="lable-control">Institution district: </label>
                            <div class="form-group">
                              <input type="text" name="district" required class="form-control" placeholder="Enter the district of the institution">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group form-group-sm">
                            <label class="lable-control">Institution ward: </label>
                            <div class="form-group">
                              <input type="text" name="ward" required class="form-control" placeholder="Enter the ward of the school">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group form-group-sm">
                          <label class="lable-control">number of student required: </label>
                          <div class="form-group">
                            <input type="number" name="size" required class="form-control" placeholder="Total number of student required">
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4">
                          <div class="form-group form-group-sm">
                          <label class="lable-control">Student priority</label>
                          <div class="form-group">
                            <strong>Is For priority?:</strong>
                            <div class="btn-group" id="NO">
                              <button  onclick="show_this('#YES','#NO')" type="button" class="btn btn-danger">NO</button>
                              <button  disabled type="button" class="btn btn-danger ">
                                <span class="caret"><i class="fa fa-close"></i></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                            </div>

                            <div class="btn-group" id="YES" style="display: none;">
                              <button  onclick="show_this_('#NO','#YES')" type="button" class="btn btn-success">YES</button>
                              <button  disabled type="button" class="btn btn-success ">
                                <span class="caret"><i class="fa fa-check"></i></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                            </div>

                            <input type="hidden" value="NO" id="priority">
                          </div>
                        </div>
                      </div>



                          </div>
                            <div class="form-group" id="btn_submit">
                              <button id="add_btn" class="btn btn-sm btn-success">Add now</button>
                            </div>
                          </form>

                        </div>
                      </div>
                  



                </div>
            </div>
          </div>
        </div>
<script>
  function add_school(){
    $("#add_btn").attr('disabled','disabled');
    $("#add_btn").html('processing... <span class="fa fa-refresh fa-spin"></span>');
    region = $("select[name='region']").val();
    HDM = $("input[name='HDM']").val();
    contact = $("input[name='contact']").val();
    district = $("input[name='district']").val();
    ward = $("input[name='ward']").val();
    size = $("input[name='size']").val();
    level = $("select[name='level']").val();
    s_type = $("select[name='s_type']").val();
    school_name = $("input[name='school_name']").val();
    category = $("#category").val();
    priority = $("#priority").val();
    path = "<?php echo base_url('inserting/add_school') ?>";

    //alert(priority);
   // alert(category+' -- '+s_type+' -- '+level);
    
    
    $.ajax({
      url:path,
      type:"post",
      data:{region:region, category:category, HDM:HDM, priority:priority, contact:contact, district:district, ward:ward, size:size, school_name:school_name, level:level, s_type:s_type},
      success:function(data){
        //alert(data);
        setTimeout(function(){
          if(data == '1'){
            $("#btn_submit").html('<div class="alert alert-success"> <i class="fa fa-ok"></i> Success New region added </div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }

          if(data == '2'){
            $("#btn_submit").html('<div class="alert alert-warning"> <i class="fa fa-warning"></i> Warning region name already exist</div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }

          if(data == '3'){
            $("#btn_submit").html('<div class="alert alert-danger"> <i class="fa fa-warning"></i> Error occured while adding new region</div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }



        },3000);
      }

    });
    

    return false;
  }

function manage_school(no,s_reg){
  $(".my_btn").attr('disabled','disabled');
  $("#school"+no).removeClass('btn-outline-success');
  $("#school"+no).addClass('btn-success');
  $("#school"+no).html('opening..');
  setTimeout(function(){
    window.location.href= "<?php echo base_url('adminstrator/open_school/') ?>"+s_reg;
  },3000);
}

function check_category(){
  value = $("#category").val();
  if(value == ''){
    $(".for_school").hide('slow');
  }else{
    if(value == "EDU"){
      $(".for_school").show('slow');
      $("#type").attr('required','required');
      $("#level").attr('required','required');
    }else{
      $("#type").val('');
      $("#level").val('');
      $(".for_school").hide('slow');
      $("#type").removeAttr('required');
      $("#level").removeAttr('required');
    }
  }
}


function show_this(show,hide){
  priority = $("#priority").val();
  $(hide).hide('slow');
  $(show).show('slow');
  $("#priority").val('YES');
}
function show_this_(show,hide){
  priority = $("#priority").val();
  $(hide).hide('slow');
  $(show).show('slow');
  $("#priority").val('NO');
  
}



</script>

<script src="<?php echo base_url(); ?>assets/jquery.min.js"></script>
<script>
$(document).ready(function(){

  $('#import_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"<?php echo base_url(); ?>excel_import/import_institution",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('#file').val('');

        window.location = "";

        }
    })
  });

});
</script>