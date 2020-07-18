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
         
         
                

          <div class="card card-success card-outline">
          <div class="card-body">
    
              
                    <form class="form-horizontal" method="post"  action="<?php echo base_url('inserting/add_logbook_assessor'); ?>">
            <div class="row">
            <div class="col-md-4">
              
              <div class="card card-success">
                <div class="card-body">
                
                  <div class="form-group form-group-sm">
                                <label class="lable-control">Assessor: </label>
                                <div class="form-group">
                                  <select name="AID" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Select assessor</option>
                                    
                                    <?php if($assessors): ?>
                                      <?php foreach($assessors as $assessor): ?>

                                        <?php
                                        $total = 3; $allocated = 0;
                                          if($logbook_allocated):  $available = 0;
                                            foreach($logbook_allocated as $allo):
                                              if($allo['AID'] == $assessor['AID']):
                                                $available++;
                                              endif;
                                            endforeach;
                                            $allocated = $available;
                                          endif;
                                          $username = $assessor["fname"]." ".$assessor["mname"]." ".$assessor["lname"];
                                            
                                          $range = $total - $allocated;

                                        ?>
                                      <?php if($range > 0): ?>
                                        <option value="<?php echo $assessor['AID']; ?>"> <?php echo $username; ?></option>
                                      <?php endif; ?>
                                      <?php endforeach; ?>
                                    <?php endif; ?>
                                  
                                  </select>
                                </div>
                              </div>
              </div>
             
            </div>

             
            </div>
            <!-- / .col-md-4 -->
              
              <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                   <div class="form-group">
                                <label class="label-control">School:</label>
                                <div class="form-group">
                                  <select required name="school_reg[]" class="form-control select2" multiple="multiple" data-placeholder="Select school you can select more than one school" style="width: 100%;">
                            
                                <?php if($institutions): ?>
                                  <?php foreach($institutions as $school): ?>
                                    <option value="<?php echo $school['S_Reg_No']; ?>"><?php echo $school['name']; ?></option>
                                  <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                                </div>
                              </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-success btn-sm">submit</button>
            </div>
            <div id="table_data" class="table-responsive mailbox-messages">
                <table  class="table table-hover table-striped">
                 
                  <thead>
                    <th>Full name</th>
                    <th style="width: 60px">ID</th>
                    <th class="text-center">Mark logbook institution</th>
                  </thead>
                  <tbody>
                    <?php if($logbook_assessors): ?>
                      <?php foreach($logbook_assessors as $assessor): ?>
                        <tr>
                          <?php $AID = str_replace('/', '_', $assessor['AID']); ?>
                          <td class="mailbox-name"><a href="<?php echo base_url('adminstrator/instructor_view_profile/'.$AID); ?>"><?php echo $assessor['fname']." ".$assessor['lname']; ?></a></td>
                          <td><?php echo $assessor['AID']; ?></td>
                          <td class="mailbox-subject">

                            <?php if($assessor[0]): $no = 0; ?>
                                  <?php foreach($assessor[0] as $school_info):$no++; ?>
                                    <?php $path = base_url('updates/remove_logbook_assess/'.$school_info['id']); ?>
                                    <strong> <?php echo $no; ?>.</strong> <span class="text-uppercase"><?php echo " ".$school_info['name'].'</span>, <small> Region: '.$school_info['region'].', district: '.$school_info['district'].', Ward: '.$school_info['ward'].'.</small> '; ?>
                                    <a href="<?php echo $path; ?>">
                                    <span class="badge badge-danger" style="cursor:pointer" >Remove</span><hr>
                                    </a>
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


          </div>


