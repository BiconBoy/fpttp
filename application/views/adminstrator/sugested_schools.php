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
              <div class="card-header">
                <h3 class="card-title">Suggested Institution</h3>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Institution name</th>
                      <th>Contact</th>
                      <th>Region</th>
                      <th>District</th>
                      <th>Ward</th>
                      <th>SID</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if($sugested): $no = 0; ?>
                      <?php foreach($sugested as $school): $no++; ?>
                        <tr>
                          <th><?php echo $no; ?></th>
                          <td><?php echo $school['name']; ?></td>
                          <td><?php echo $school['contact']; ?></td>
                          <td><?php echo $school['region']; ?></td>
                          <td><?php echo $school['district']; ?></td>
                          <td><?php echo $school['ward']; ?></td>
                          <td><?php echo $school['SID']; ?></td>
                          <td><button class="btn btn-success btn-sm">Checked</button></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>School name</th>
                      <th>Contact</th>
                      <th>Region</th>
                      <th>District</th>
                      <th>Ward</th>
                      <th>SID</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>