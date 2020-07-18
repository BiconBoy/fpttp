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
                              <label class="lable-control">Zone name: </label>
                              <div class="form-group">
                                <input type="text" name="zone_name" required class="form-control" placeholder="Enter Zone name here">
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
                           <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Zone name</th>
                                  <th>Number of regions</th>
                                  <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if($zones): $no = 0; $color = ''; ?>
                                <?php foreach($zones as $zone): $no++; ?>
                                  <tr>
                                    <th><?php echo $no; ?></th>
                                    <td><?php echo $zone['name']; ?></td>
                                    <td>
                                      <?php if($regions): $ren_no = 0; ?>
                                        <?php foreach($regions as $region): ?>
                                          <?php 
                                            if($zone['name'] == $region['zone_name']){
                                              $ren_no++;
                                            } 
                                          ?>
                                        <?php endforeach; ?>
                                        <?php echo $ren_no; ?>
                                      <?php endif; ?>
                                    </td>
                                    <td><button  type="button" class="btn btn-block btn-outline-success btn-sm">manege</button></td>
                                  </tr>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </tbody>
                            <tfoot>
                               <tr>
                                  <th>#</th>
                                  <th>Zone name</th>
                                  <th>Zone instructors</th>
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
    zone_name = $("input[name='zone_name']").val();
    path = "<?php echo base_url('inserting/add_zone') ?>";

    $.ajax({
      url:path,
      type:"post",
      data:{zone_name:zone_name},
      success:function(data){
        //alert(data);
        setTimeout(function(){
          if(data == '1'){
            $("#btn_submit").html('<div class="alert alert-success"> <i class="fa fa-ok"></i> Success New Zone added </div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }

          if(data == '2'){
            $("#btn_submit").html('<div class="alert alert-warning"> <i class="fa fa-warning"></i> Warning Zone name already exist</div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }

          if(data == '3'){
            $("#btn_submit").html('<div class="alert alert-danger"> <i class="fa fa-warning"></i> Error occured</div>');
            setTimeout(function(){
              window.location.replace('');
            },3000);
          }



        },3000);
      }

    });

    return false;
  }
</script>