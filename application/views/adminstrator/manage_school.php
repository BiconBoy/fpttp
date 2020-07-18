 
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
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fa fa-list"></i>
                            Available Institution
                          </h3>
                        </div>
                        <div class="card-body table-responsive">
                           <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Institution name</th>
                                  <th>HDS</th>
                                  <th>Contact</th>
                                  <th>Region</th>
                                  <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                              <?php if($schools): $no = 0; ?>
                                <?php foreach($schools as $school): $no++;$color = ''; ?>
                                 
                                 <?php if($school['reachable'] == 'NO'){$color = 'danger';} ?>
                                  <tr class="bg-<?php echo $color; ?>">
                                    <th><?php echo $no; ?></th>
                                    <td title="<?php echo $school['name']; ?>">
                                      <?php echo $school['name']; ?>
                                      </td>


                                    <td><?php echo $school['HDM']; ?></td>
                                    <td><?php echo $school['contact']; ?></td>
                                    <td><?php echo $school['region']; ?></td>
                                    <?php $s_reg = str_replace('/', '_', $school['S_Reg_No']); ?>
                                    <td><button  type="button" id="school<?php echo $no; ?>" onclick="manage_school('<?php echo $no; ?>','<?php echo $s_reg; ?>')" class="btn btn-block btn-outline-success btn-sm my_btn">manege</button></td>
                                  </tr>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            
                            </tbody>
                            <tfoot>
                               <tr>
                                  <th>#</th>
                                  <th>School name</th>
                                  <th>HDS</th>
                                  <th>Contact</th>
                                  <th>Region</th>
                                  <th></th>
                                </tr>
                            </tfoot>
                          </table>
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
    school_reg_no = $("input[name='school_reg_no']").val();
    HDM = $("input[name='HDM']").val();
    contact = $("input[name='contact']").val();
    district = $("input[name='district']").val();
    ward = $("input[name='ward']").val();
    size = $("input[name='size']").val();
    school_name = $("input[name='school_name']").val();
    path = "<?php echo base_url('inserting/add_school') ?>";
    
    $.ajax({
      url:path,
      type:"post",
      data:{region:region, school_reg_no:school_reg_no, HDM:HDM, contact:contact, district:district, ward:ward, size:size, school_name:school_name},
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

</script>