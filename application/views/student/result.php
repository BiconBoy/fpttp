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
                <div class="table-responsive">
                  
                  <table class="table table-bordered">
                    
                    <thead>
                      <tr>
                        <th>Assessment marks</th>
                        <th>Document</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php if($results): ?>
                        <?php foreach($results as $result): ?>
                          <tr>
                          <td><?php echo $result['marks']; ?>%</td>
                          <td>
                          <?php if($result['document'] != ''){ ?>
                            <a target=”_blank” href="<?php echo base_url('assets/documents/'.$result['document']); ?>">
                      <button class="btn btn-block btn-sm btn-outline-secondary">View</button>
                      </a>
                      <?php }else{ ?>
                      <span class="text-uppercase text-danger">not uploaded yet</span>
                      <?php } ?>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>

                  </table>

                </div>

              </div>
              </div>
              </div>


          </div>