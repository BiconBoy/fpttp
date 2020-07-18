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
              <div class="card card-outline card-success">
                <div class="card-header">
                  <h3 class="card-title text-center">List of schools you have been allocated as assessor in accademic year <strong><?php echo $year; ?></strong></h3>
                </div>
                <div class="card-body">
                  <div class="row">
                  <?php if($allocated_region): ?>
                    <?php foreach($allocated_region as $region): ?>
                      <div class="col-md-6">
                        <div class="card card-info">
                        <div class="card-header text-center"><?php echo $region['region']; ?></div>
                    
                      <div class="card-body table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>School name</th>
                              <th>District</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if($allocated_school): ?>
                              <?php foreach($allocated_school as $school): ?>
                                <?php if($school['region'] == $region['region']): ?>
                                <tr>
                                  <td><?php echo $school['name']; ?></td>
                                  <td><?php echo $school['district']; ?></td>

                                  <td> 
                                  <?php $reg = str_replace('/', '_', $school['school_reg']); ?>
                                    <a href="<?php echo base_url('adminstrator/school_assessor/'.$reg); ?>">
                                      <button class="btn btn-sm btn-success btn-block">open</button>
                                    </a>
                                  </td>
                                </tr>
                              <?php endif; ?>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                      </div>        
                    <?php endforeach; ?>
                  <?php endif; ?>
                  </div>
                  
                </div>
              </div>
          </div>
        </div>