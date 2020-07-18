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
              <div class="col-md-12">
                <div class="table-responsive">
                  
                  <table class="table table-bordered">
                    
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Full name</th>
                        <th>Reg No</th>
                        <th>Program</th>
                        <th>Institution</th>
                        <th>Region</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php if($application_request){ $no = 0; ?>
                        <?php foreach($application_request as $selection): $no++; ?>
                          <?php $ID = $selection['id'];  ?>
                          <tr>
                            <th><?php echo $no; ?></th>
                          <td><?php echo $selection['fname']." ".$selection['mname']." ".$selection['lname']; ?></td>
                          <td><?php echo $selection['Reg_No']; ?></td>
                          <td><?php echo $selection['program']; ?></td>
                          <td><?php echo $selection['name']; ?></td>
                          <td><?php echo $selection['region']; ?></td>
                          <td>
                            <?php if($selection['status'] == "YES"){ ?>
                              <span class="text-success">ACCEPTED</span>
                            <?php }else{ ?>
                              <a href="<?php echo base_url('updates/accept_request/'.$ID); ?>">
                            <button class="btn btn-block btn-outline-success btn-sm">Accept</button>
                          </a>
                            <?php } ?>
                          </td>
                          <td>
                             <?php if($selection['status'] == "YES"){ ?>
                              <span class="text-success">ACCEPTED</span>
                            <?php }else{ ?>
                              <a href="<?php echo base_url('updates/reject_request/'.$ID); ?>">
                            <button class="btn btn-danger btn-block btn-sm">Reject</button>
                          </a>
                          <?php } ?>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php }else{ ?>
                        <tr>
                          <td colspan="8" class="text-center">No record found</td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>

                </div>

              </div>
              </div>
              </div>


          </div>