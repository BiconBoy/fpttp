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
        <!-- Small cardes (Stat card) -->
        <div class="row">
          <div class="col-md-12">
         
         
                

                <div class="card card-success">
        
          <div class="card-body">
    
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
            <div id="result"></div>

                    <form class="form-horizontal" onsubmit="return change_pwd()">
                        <div class="input-group">
                          <span class="input-group-text"><i class="fa fa-unlock"></i></span>
                          <input class="form-control form-control-sm" name="old_pass" placeholder="Input Old password" type="password" required >
                        </div><br>
                        <p id="pass_error" class="text-danger"></p>
                      
                          
                        <div class="input-group">
                         <span class="input-group-text"><i class="fa fa-key"></i></span>
                          <input class="form-control form-control-sm" name="new_pass" placeholder="Input New password" type="password" required  onkeyup="check_pass()">
                          <span class="input-group-text"><i id="question1" class="fa fa-question"></i></span>
                        </div><br>

                        <div class="input-group">
                          <span class="input-group-text"><i class="fa fa-key"></i></span>
                          <input class="form-control form-control-sm" name="re_pass" placeholder="Retry New password" type="password" required onkeyup="check_pass()">
                          <span class="input-group-text"><i id="question2" class="fa fa-question"></i></span>
                        </div><br>

                  
                         <span id="spin_lod" class="pull-right"><i  class=""></i></span>
                        <div class="text-center input-group">
                          <button  id="confirm" style="display: none;" type="submit" class="btn btn-sm btn-primary">Submit</button>
                          <button  id="reset" style="display: none;" type="reset"></button>
                        </div>

                    </form>



</div>
</div>
              </div>


          </div>



<script>
  
function check_pass(){
    re_pass = $("input[name='re_pass'").val();
    new_pass = $("input[name='new_pass'").val();
    old_pass = $("input[name='old_pass'").val();
    if(new_pass != '' && re_pass != ''){
    // alert(old_pass+" "+new_pass+" "+re_pass);
      if(new_pass == re_pass){
        $("#pass_error").html("");
        $("#question2").removeClass('fa fa-question');
        $("#question1").removeClass('fa fa-question');
        $("#question2").removeClass('fa fa-remove text-danger');
        $("#question1").removeClass('fa fa-remove text-danger');
        $("#question2").addClass('fa fa-check text-success');
        $("#question1").addClass('fa fa-check text-success');
        $("#confirm").show('slow');
      }
      else{
        $("#pass_error").html("password not matches");
        $("#confirm").hide('fast');
        $("#question2").removeClass('fa fa-question');
        $("#question1").removeClass('fa fa-question');
        $("#question2").removeClass('fa fa-check text-success');
        $("#question1").removeClass('fa fa-check text-success');
        $("#question2").addClass('fa fa-remove text-danger');
        $("#question1").addClass('fa fa-remove text-danger');
      }
     
    }
    else{
      $("#pass_error").html('');
      $("#confirm").hide('fast');
      $("#question2").removeClass('fa fa-check text-success');
      $("#question1").removeClass('fa fa-check text-success');
      $("#question2").removeClass('fa fa-remove text-danger');
      $("#question1").removeClass('fa fa-remove text-danger');
      $("#question2").addClass('fa fa-question');
      $("#question1").addClass('fa fa-question');
    }
  }

   function change_pwd(){
    $("#confirm").hide('fast');
    $("#spin_lod").addClass('fa fa-circle-o-notch fa-spin');
    path = "<?php echo base_url().'student/student_renew_password'; ?>";
    old_pass = $("input[name='old_pass'").val();
    re_pass = $("input[name='re_pass'").val();
    new_pass = $("input[name='new_pass'").val();
   //alert(old_pass+" "+new_pass+" "+worker_id);
   $.ajax({
      url:path,
      type:"post",
      data:{ old_pass:old_pass, new_pass:new_pass},
      success:function(data){
        //alert(old_pass);
        $("#reset").click();
        $("#question2").removeClass('fa fa-check text-success');
        $("#question1").removeClass('fa fa-check text-success');
        setTimeout(function(){
          $("#spin_lod").removeClass('fa fa-circle-o-notch fa-spin');
          //alert(data);
          if(data == '1'){
            $("#result").addClass('alert alert-success');
            $("#result").html('<i class="fa fa-check"> </i> password changed successifull');
            setTimeout(function(){
              $("#result").removeClass('alert alert-success');
            $("#result").html('');
            $("#password_complete").load(location.href + " #password_complete");
            },2000);
          }
          if(data == '2'){
            $("#result").addClass('alert alert-warning');
            $("#result").html('<i class="fa fa-exclamation-circle"> </i> Current password not match');
            setTimeout(function(){
              $("#result").removeClass('alert alert-waring');
            $("#result").html('');
            $("#password_complete").load(location.href + " #password_complete");
            },2000);
          }
          if(data == '3'){
            $("#result").addClass('alert alert-danger');
            $("#result").html('<i class="fa fa-exclamation-circle"> </i> Failed password not match');
            setTimeout(function(){
              $("#result").removeClass('alert alert-danger');
            $("#result").html('');
            $("#password_complete").load(location.href + " #password_complete");
            },2000);
          }
        },2000);
      }
   });

    return false;
  }

</script>