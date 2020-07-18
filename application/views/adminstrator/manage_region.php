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
                    <div class="col-md-4">
                      <div class="card">
                        <dv class="card-header">
                          <h3 class="card-title">
                            <i class="fa fa-bullhorn"></i>
                            Add Zone
                          </h3>
                        </dv>
                        <div class="card-body">

                          <form class="form-horizontal" onsubmit="return add_new_zone()">
                            <div class="form-group form-group-sm">
                              <label class="lable-control">Region name: </label>
                              <div class="form-group">
                                <input type="text" name="region" required class="form-control" placeholder="Enter Region name here">
                              </div>
                            </div>

                            <div class="form-group form-group-sm">
                              <label class="lable-control">Region Zone: </label>
                              <div class="form-group">
                                <select name="zone" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required >
                                  <option value="">Select zone</option>
                                  <?php if($zone_available): ?>
                                    <?php foreach($zone_available as $zone): ?>
                                      <option value="<?php echo $zone['name']; ?>"><?php echo $zone['name']; ?></option>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group" id="btn_submit">
                              <button id="add_btn" class="btn btn-sm btn-success">Add now</button>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                    <!-- / .col-md-4 -->

                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fa fa-list"></i>
                            Available Zones
                          </h3>
                        </div>
                        <div class="card-body">
                           <table  id="subject_list" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Region name</th>
                                  <th>Zone name</th>
                                  <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if($regions): $no = 0; $color = ''; ?>
                                <?php foreach($regions as $region): $no++; ?>
                                 
                                  <tr>
                                    <th><?php echo $no; ?></th>
                                    <td><?php echo $region['region_name']; ?></td>
                                    <td>
                                      
                                      <span id="hide<?php echo $no; ?>">                         
                                        <?php echo $region['zone_name']; ?>
                                      </span>
                                      <span style="display: none;" id="show<?php echo $no; ?>">
                                          
                                        
                                    <select onchange="update_region_zone('<?php echo $no; ?>','<?php echo $region['region_name']; ?>')" id="zone<?php echo $no; ?>" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <option value="<?php echo $region['zone_name']; ?>"><?php echo $region['zone_name']; ?></option>
                                      
                                      <?php if($zone_available): ?>
                                        <?php foreach($zone_available as $zones): ?>
                                          <option value="<?php echo $zones['name']; ?>"><?php echo $zones['name']; ?></option>
                                        <?php endforeach; ?>
                                      <?php endif; ?>
                                    
                                    </select>
                              
                                  </span>

                                    </td>
                                    <td><button id="button<?php echo $no; ?>" onclick="manage_zone('<?php echo $no; ?>')" type="button" class="btn btn-block btn-outline-success my_btn btn-sm">manege</button></td>
                                  </tr>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </tbody>
                            <tfoot>
                               <tr>
                                  <th>#</th>
                                  <th>Region name</th>
                                  <th>Zone name</th>
                                  <th></th>
                                </tr>
                            </tfoot>
                          </table>
                        </div>  
                      </div>
                    </div>
                    <!-- / .col-md-8 -->

                  </div>

                </div>
            </div>
          </div>
        </div>
        
<script>
  function add_new_zone(){
    $("#add_btn").attr('disabled','disabled');
    $("#add_btn").html('processing... <span class="fa fa-refresh fa-spin"></span>');
    zone = $("select[name='zone']").val();
    region = $("input[name='region']").val();
    path = "<?php echo base_url('inserting/add_region') ?>";

    $.ajax({
      url:path,
      type:"post",
      data:{zone:zone, region:region},
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

  function manage_zone(no){    

  $(".my_btn").attr('disabled','disabled');
  $("#button"+no).removeClass('btn-outline-success');
  $("#button"+no).removeAttr('disabled');
  $("#button"+no).addClass('cancel_btn');
  $("#button"+no).addClass('btn-danger');
  $("#button"+no).html('cancel');
  $("#hide"+no).hide('slow');
  $("#show"+no).show('slow');


  $(".cancel_btn").on('click',function(){
    $(".my_btn").removeAttr('disabled');
    $("#button"+no).removeClass('btn-danger');
    $("#button"+no).addClass('btn-outline-success');
    $("#button"+no).html('manage');
    $("#show"+no).hide('slow');
    $("#hide"+no).show('slow');
    
    $("#button"+no).removeClass('cancel_btn');
  });
  setTimeout(function(){

  },3000);
  
}

function update_region_zone(no,region){
  zone = $("#zone"+no).val();
  path = "<?php echo base_url('updates/update_region_zone') ?>";
  $.ajax({
    url:path,
    type:"post",
    data:{zone:zone, region:region},
    success:function(data){
      window.location.replace('');
    }
  });
}
</script>