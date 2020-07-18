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
            <div class="card card-success card-autline">
              <?php if($checked){ ?>
              <div class="card-header">
                <h3 class="card-title">Select Zone to see regions</h3>
              </div>
              <div class="card-body">
              <div class="row">

          <?php if($zones): ?>
            <?php foreach($zones as $zone): ?>

            <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $zone['zone_name']; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                    <th>Region</th>
                    <th>Assigned(%)</th>
                    <th style="width: 40px"></th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php if($checked): $no = 0; $all = 0; ?>
                    <?php foreach($checked as $region): $all++; ?>
                      <?php if($zone['zone_name'] == $region['zone_name']): $no++; ?>
                      <tr>
                        <td><?php echo $region['region']; ?></td>
                        <td>
                          <?php if($allocated_schools):    $alloc = 0;?>
                            <?php foreach($allocated_schools as $allocated): ?>
                              <?php if($allocated['region'] == $region['region']){$alloc++;}  ?>
                            <?php endforeach; ?>
                          <?php endif; ?>

                         <?php if($all_school): $total = 0;  ?>
                            <?php foreach($all_school as $schools): ?>
                              <?php if($schools['region'] == $region['region']){$total++;} ?>
                            <?php endforeach; ?>
                            <?php 
                            if(!isset($alloc)){
                              $alloc = 0;
                            }
                                $percent = ($alloc/$total)*100;
                                if($percent < 50){
                                  $color = 'danger';
                                }elseif($percent >= 50 && $percent < 100){
                                  $color = "warning";
                                }
                                else{
                                  $color = 'success';
                                }
                            ?>
                            <?php echo $alloc." out of ".$total; ?>
                              <span class="badge bg-<?php echo $color; ?>"><?php echo $percent; ?>%</span>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-<?php echo $color; ?>" style="width: <?php echo $percent; ?>%"></div>
                              </div>
                        <?php endif; ?>

                        </td>
                        <td>
                          <?php $regn = str_replace(' ', '_', $region['region']); ?>
                          <?php if($percent == 100){ ?>
                            <button class="btn btn-block btn-success btn-sm">Allocated</button>
                          <?php }else{ ?>
                          <button id="button<?php echo $all; ?>" type="button" onclick="open_region('<?php echo $regn; ?>','<?php echo $all; ?>')" class="btn my_btn btn-block btn-outline-success btn-sm">Allocate</button>
                        <?php } ?>
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                
                  </tbody>
                  
                  
                </table>
              </div>
        
            </div>
            <!-- /.card -->
          </div>

                    <?php endforeach; ?>
                  <?php endif; ?>
</div>
              </div>
    <?php }else{ ?>
      <div class="alert alert-warning"><strong><i class="fa fa-warning"></i></strong> No any student slected the field in accademic year <strong><?php echo $year; ?></strong> So you can not assign assessors while no student available. <hr>
        If you think its a problem please click to check your setting then switch accademic year <strong><?php echo $year; ?></strong> as current accademic year and allow student to apply
      </div>
    <?php } ?>
            </div>
          </div>
        </div>
<script>
  function open_region(region,btn){
    $(".my_btn").attr('disabled','disabled');
    $("#button"+btn).removeClass('btn-outline-success');
    $("#button"+btn).addClass('btn-success');
    $("#button"+btn).html('opening...');
    setTimeout(function(){
      window.location.href="<?php echo base_url('adminstrator/open_region/') ?>"+region;
    },3000);

  }
</script>
                
            
              