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
                  <div class="col-md-8 offset-2">
              <?php if($report_school): $no = 0; ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Institution name</th>
                      <th>Total student</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                <?php foreach($report_school as $ist): $no++; ?>
                  <tr>
                    <th><?php echo $no; ?></th>
                    <td><?php echo $ist['name']; ?></td>
                    <?php if($ist[0]): $total = 0; ?>
                      <?php foreach($ist[0] as $Total){$total++;} ?>
                      <td>
                        <span><?php echo $total; ?></span>
                      </td>
                    <td>
                      <?php if($Total['report_confirm'] == 'YES'){ ?>
                        <span class="text-success">SUBMITTED</span>
                      <?php }else{ ?>
                        <?php $REG = str_replace('/', '_', $ist['S_Reg_No']); ?>
                        <a href="<?php echo base_url('adminstrator/report/'.$REG); ?>">
                      <button type="button" class="btn btn-block btn-outline-success btn-sm">Open</button>
                      </a>
                    <?php } ?>
                    </td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </tbody>
            </table>
          </div>
            </div>
                
              </div>
    
            </div>  

          </div>
        </div>

