<!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin-top: 40px; border-bottom-style: groove; border-bottom-width: 1px">
          <div class="col-sm-6">
            <?php if($applicatio_window){ ?>
              <?php if(!$field_selected){ ?>
            <h1 class="m-0 text-dark"><?php echo $maintitle; ?></h1>
          <?php }else{ ?>
            <h1 class="m-0 text-dark">Field information</h1>
          <?php } ?>
        <?php }else{ ?>
          <h1 class="m-0 text-dark">Closed</h1>
        <?php } ?>
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
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
<!-- if the appluication window is closed or opened -->


  <!-- if the student has alread selected the field -->

    <?php if(!$field_selected){ ?>
      <?php if($applicatio_window){ ?>

            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">Select region</h3>
              </div>
              <div class="card-body">
                
                     <div class="row">
                  <?php if($zones): $Zno = 0; ?>
                    <?php foreach($zones as $zone): $Zno++; ?>

 
            <?php 
              $color = '';
              if($Zno == 1){ $color = 'success'; }
              if($Zno == 2){ $color = 'primary'; }
              if($Zno == 4){ $color = 'secondary'; }
              if($Zno == 5){ $color = 'info'; }
              if($Zno == 6){ $color = 'warning'; }
              if($Zno == 3){ $color = 'info'; }
               if($Zno > 6){ $color = 'danger'; }
              



            ?>
            <div class="col-md-6">
            <div class="card card-<?php echo $color; ?> ">
              <div class="card-header">
                <h3 class="card-title"><?php echo $zone['name']; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                    <th>Region</th>
                    <th style="width: 40px"></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if($zone[0]){ $no = 0; $all = 0; ?>
                      <?php foreach($zone[0] as $region): $all++; ?>
                        <tr>
                          <td><?php echo $region['region_name']; ?></td>
                          <td>
                            <?php $regn = str_replace(' ', '_', $region['region_name']); ?>
                            <button id="<?php echo $regn; ?>" type="button" onclick="open_region('<?php echo $regn; ?>')" class="btn my_btn btn-block btn-outline-success btn-sm">Select</button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php }else{ ?>
                      <tr>
                        <td colspan="2" class="text-danger text-center">No any institution available for this zone</td>
                      </tr>
                    <?php } ?>
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
            </div>
<?php } ?>
<?php }else{ ?>


<?php } ?>

  <?php if($field_selected): ?>
  <?php foreach($field_selected as $field): ?>
    <?php if($field[0]): ?>
      <?php foreach($field[0] as $school): ?>

        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title">Selection information</h3>
          </div>
          <div class="card-body">
            <strong>Institution name: </strong><?php echo $school['name']; ?><br>
            <strong>Institution contact: </strong><?php echo $school['contact']; ?><br>
            <?php if($student['category'] == 'EDU'): ?>
            <strong>Subject: </strong><?php echo $field['subject']; ?>
          <?php endif; ?>
            <hr>
            <strong>Location:</strong>
            <p>
              <strong>Region: </strong><?php echo $school['region']; ?><br>
              <strong>District:</strong> <?php echo $school['district']; ?><br>
              <strong>Ward:</strong> <?php echo $school['ward']; ?>
            </p>
            <hr>
            <?php if($student['category'] == 'EDU'): ?>
            <strong>Other in information</strong>
            <p>
              <strong>School level:</strong> <?php echo $school['level']; ?><br>
              <strong>School Type:</strong> <?php echo $school['type']; ?>
            </p>
          <?php endif; ?>

            <?php if($field['information'] == ''){ ?>
              <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i>Successifull application submited!</h5>
                  <p class="text-justify">
                  Please wait for for other field information and make sure you vist your FTP account befor the dipature to the field area becose any changes may occur...
                </p>
                </div>
            <?php }else{ ?>
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-text-width"></i>
                  Now read carefull field information
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <blockquote>
                 <?php echo $field['information']; ?>
                </blockquote>
              </div>
              <!-- /.card-body -->
            </div>

            <?php } ?>

          </div>

        </div>

      <?php endforeach; ?>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>
<?php if($applicatio_window){ ?>
<?php }else{ ?>

  <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Application is temporary closed</h3>
              </div>
              <div class="card-body">
                <strong>FTP</strong> application for accademic year <?php echo $year; ?> is temporary closed
              </div>
              <!-- /.card-body -->
              <!-- Loading (remove the following to stop the loading)-->
              <div class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
              <!-- end loading -->
            </div>

<?php } ?>


          </div>
        </div>

        <script>
  function open_region(region){
    
    $(".my_btn").attr('disabled','disabled');
    $("#"+region).removeClass('btn-outline-success');
    $("#"+region).addClass('btn-success');
    $("#"+region).html('opening...');
    setTimeout(function(){
      window.location.href="<?php echo base_url('student/open_region/') ?>"+region;
    },3000);

  }
</script>