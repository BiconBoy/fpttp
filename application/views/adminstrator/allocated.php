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
              <h3 class="card-title">List of allocated assessors with their schools for accademic year <strong><?php echo $year; ?></strong></h3>

              <div class="card-tools">
                <button onclick="print_this('#table_data')" class="btn btn-success btn-sm">print the list</button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
             
              <div id="table_data" class="table-responsive mailbox-messages">
                <table  class="table table-hover table-striped">
                  <thead>
                    <th>Full name</th>
                    <th style="width: 60px">ID</th>
                    <th class="text-center">Allocated to</th>
                  </thead>
                  <tbody>
                    <?php if($region_assessors): ?>
                      <?php foreach($region_assessors as $assessor): ?>
                        <tr>
                          <?php $AID = str_replace('/', '_', $assessor['AID']); ?>
                          <td class="mailbox-name"><a href="<?php echo base_url('adminstrator/instructor_view_profile/'.$AID); ?>"><?php echo $assessor['fname']." ".$assessor['lname']; ?></a></td>
                          <td><?php echo $assessor['AID']; ?></td>
                          <td class="mailbox-subject">
                            <?php if($assessor[0]): $no = 0; ?>
                                  <?php foreach($assessor[0] as $school_info):$no++; ?>
                                    <strong> <?php echo $no; ?>.</strong> <span class="text-uppercase"><?php echo " ".$school_info['name'].'</span>, <small> Region: '.$school_info['region'].', district: '.$school_info['district'].', Ward: '.$school_info['ward'].'.</small><br>'; ?>
                                  <?php endforeach; 
                            endif; ?>
                          </td>
        
                        </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->

            </div>
            <!-- /.card-body -->
         
         
          <!-- /. box -->
      
            </div>
          </div>
        </div>

<script>
  function print_this(data){
    $(data).printThis();
  }
</script>