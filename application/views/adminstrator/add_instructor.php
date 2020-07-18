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
                <div class="row">
                  <div class="col-md-12">
                    <form class="form" onsubmit="return submit_instructor_form()">
                    <div class="row">
                   

                    <div class="col-md-4">
                      <div class="form-group form-group-sm">
                        <lable class="label-control">First name: </lable>
                        <div class="form-group">
                          <input type="text" placeholder="Enter first name" name="fname" required class="form-control">
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group form-group-sm">
                        <lable class="label-control">Middel name: </lable>
                        <div class="form-group">
                          <input type="text" placeholder="Enter Middel name" name="mname" required class="form-control">
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group form-group-sm">
                        <lable class="label-control">Surname: </lable>
                        <div class="form-group">
                          <input type="text" placeholder="Enter surname" name="lname" required class="form-control">
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group form-group-sm">
                        <lable class="label-control">E-mail: </lable>
                        <div class="form-group">
                          <input type="email" placeholder="Enter email" name="email" required class="form-control">
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group form-group-sm">
                        <lable class="label-control">Phone number: </lable>
                        <div class="form-group">
                          <input type="text" placeholder="Enter contact number" name="contact" required class="form-control">
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group form-group-sm">
                        <lable class="label-control">Sex: </lable>
                        <div class="form-group">
                          <select required name="sex" class="form-control">
                            <option value="">Select sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                    </div>


                    </div>
                    <!-- / .row -->

                      <div class="form-group" id="results">
                        <button id="submit_form" class="btn btn-sm btn-success">Submit</button>
                      </div>

                    </form>
                  </div>
                 
                </div>

              </div>

            </div>

          </div>

        </div>
        <!-- /.row -->
<script>
  function submit_instructor_form(){
    $("#submit_form").attr('disabled','disabled');
    $("#submit_form").html('Processing... <span class="fa fa-refresh fa-spin"></span>');
    
    fname = $("input[name='fname']").val();
    mname = $("input[name='mname']").val();
    lname = $("input[name='lname']").val();
    email = $("input[name='email']").val();
    contact = $("input[name='contact']").val();
    sex = $("select[name='sex']").val();
    path = "<?php echo base_url('inserting/submit_instructor_form') ?>";

    $.ajax({
      url:path,
      type:"POST",
      data:{fname:fname, mname:mname, lname:lname, email:email, contact:contact, sex:sex},
      success:function(data){
        //alert(data);
          setTimeout(function(){
            if(data == '1'){
              $("#results").html('<div class="alert alert-success"><strong>Successifull</strong> new Instructor added</div>')
              
              setTimeout(function(){
                window.location.replace('');
              },3000);
            }

            if(data == '2'){
                            $("#results").html('<div class="alert alert-danger"><strong>Error!</strong> occured while adding new Instructor</div>')
            }

            if(data != '1' && data != '2'){
                            $("#results").html(data)
            }


          },3000);
      }
    });




    return false;
  }
</script>