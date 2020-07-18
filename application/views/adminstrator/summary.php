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
         
                <div class="card card-outline-success">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-header"> <h3 class="card-title">Education summary</h3></div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <tr>
                                            <th>Field chance(s)</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                if($EDU_INS >= $EDU){
                                                echo "<span class='text-success'>".ucfirst($f->format($EDU_INS));
                                                 echo " (".$EDU_INS.")</span>"; 
                                                }else{
                                                ?>
                                                <p class="text-danger text-justify">
                                                <?php $EDU_req = $EDU - $EDU_INS; ?>
                                                    Insufficient chances please add <?php echo ucfirst($f->format($EDU_req))." (".$EDU_req.")"; ?>
                                                    chance to fit Education students requirenment 
                                                </p>
                                                <?php } ?>
                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Total students</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                echo ucfirst($f->format($EDU));
                                                ?>
                                                <?php echo " (".$EDU.")"; ?>
                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Applied student</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                echo ucfirst($f->format($EDU_APP));
                                                ?>
                                                <?php echo " (".$EDU_APP.")"; ?>
                                            </td>
                                    </tr>
                            
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-header"> <h3 class="card-title">Environmental Science</h3></div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <tr>
                                            <th>Field chance(S)</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                 if($ESM_INS >= $ESM){
                                                echo "<span class='text-success'>".ucfirst($f->format($ESM_INS));
                                                 echo " (".$ESM_INS.")</span>"; 
                                                }else{
                                                ?>
                                                <p class="text-danger  text-justify">
                                                <?php $ESM_req = $ESM - $ESM_INS; ?>
                                                    Insufficient chances please add <?php echo ucfirst($f->format($ESM_req))." (".$ESM_req.")"; ?>
                                                    chance to fit Environmental Science students requirenment 
                                                </p>
                                                <?php } ?>
                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Total students</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                echo ucfirst($f->format($ESM));
                                                ?>
                                                <?php echo " (".$ESM.")"; ?>
                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Applied student</th>
                                             <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                echo ucfirst($f->format($ESM_APP));
                                                ?>
                                                <?php echo " (".$ESM_APP.")"; ?>
                                            </td>
                                    </tr>
                            
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-header"> <h3 class="card-title">Informatics summary</h3></div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <tr>
                                            <th>Field chance(s)</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                if($INF_INS >= $INF){
                                                echo "<span class='text-success'>".ucfirst($f->format($INF_INS));
                                                 echo " (".$INF_INS.")</span>"; 
                                                }else{
                                                ?>
                                                <p class="text-danger  text-justify">
                                                <?php $INF_req = $INF - $INF_INS; ?>
                                                    Insufficient chances please add <?php echo ucfirst($f->format($INF_req))." (".$INF_req.")"; ?>
                                                    chance to fit Informatics students requirenment 
                                                </p>
                                                <?php } ?>
                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Total students</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                echo ucfirst($f->format($INF));
                                                ?>
                                                <?php echo " (".$INF.")"; ?>
                                            </td>
                                    </tr>
                                    <tr>
                                            <th>Applied student</th>
                                            <td>
                                            <?php
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                echo ucfirst($f->format($INF_APP));
                                                ?>
                                                <?php echo " (".$INF_APP.")"; ?>
                                            </td>
                                    </tr>
                            
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
          <div class="card-body table-responsive">
        
           <table class="table table-striped" id="example1">
                <thead>
                    <tr>
                        <th style="width:30px;">#</th>
                        <th>Institution name</th>
                        <th style="width:80px;">Region</th>
                        <th style="width:30px;">Category</th>
                        <th>Summary</th>
                        <th style="width:70px">Status</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php if($all_institution): $no = 0; ?>
                        <?php foreach($all_institution as $institution): $no++; ?>
                        <?php $total = $institution['student_required']; ?>
                        <tr>
                            <th><?php echo $no; ?></th>
                            <td>
                            <?php $REG = str_replace('/','_', $institution['S_Reg_No']); ?>
                            <a href="<?php echo base_url('adminstrator/open_school/'.$REG.'/summary'); ?>">
                                <?php echo ucfirst(strtolower($institution['name'])); ?>
                                <?php if($institution['reachable'] == 'NO'): ?>
                            <br>
                            <?php $REG = str_replace('/', '_', $institution['S_Reg_No']); ?>
                            <a class="text-danger" href="<?php echo base_url('updates/update_institution_reachable/'.$REG.'/summary');?>">Click to make Institution Reachable</a>
                          <?php endif; ?>
                            </a>
                            </td>
                            <td><?php echo ucfirst(strtolower($institution['region'])); ?></td>
                            <td>
                                <?php if($institution['category'] == "EDU"){echo "Education";} ?>
                                <?php if($institution['category'] == "INF"){echo "Informatics";} ?>
                                <?php if($institution['category'] == "ESM"){echo "Environmental Sc.";} ?>
                            </td>
                            <td>
                            <?php if($institution['category'] == 'EDU'){ ?>
                                <!-- subject given to the school -->
                                <?php if($inst_subject): $sub_no = 0; ?>
                                    <?php foreach($inst_subject as $subject): ?>
                                
                                        <?php if($subject['school_Reg'] == $institution['S_Reg_No']): ?>
                                        
                                        <?php if($institution[0]): $sub = 0; ?>
                                                    <?php foreach($institution[0] as $insti): ?>
                                                        <?php if($insti['school_Reg'] == $subject['school_Reg'] AND $insti['subject'] == $subject['sub_name']):$sub++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php $sub_no = $sub; ?>
                                                <?php endif; ?>

                                    <?php $valdate =  $subject['required'] - $sub_no; ?>
                                    <?php if($subject['required'] <= 0 OR $valdate > 0): ?>
                                    
                                    <div>
                                    
                                            <span class="text-secondary pull-left">
                                                <?php echo ucfirst(strtolower($subject['sub_name']." <small>Required ".$subject['required']."</small>")); ?>
                                                
                                            
                                            </span>
                                           
                                            
                                            <span class="text-success pull-right fa fa-check">
                                            <?php echo $sub_no; ?>
                                            </span>
                                        
                                        <div>
                                        <hr><br>
                                    
                                                
<?php endif; ?> 

                                        <?php endif; ?>
                                       
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            
                            <?php }else{ ?>
                                <!-- This is for other course with no relation to subjects opr education -->
                                <?php if($institution[0]){  $count =0; ?>
                                  <?php foreach($institution[0] as $ins): ?>
                                    <?php if($institution['S_Reg_No'] == $ins['school_Reg']): ?>
                                        <?php $count++; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                    <span class="pull-left text-secondary">Required <?php echo $total; ?></span>
                                    <span class="pull-right fa fa-check text-success">Occupied <?php echo $total; ?></span>    
                                <?php }else{ ?>
                                <span class="pull-left text-info">No any student selected this institution</span>
                                <?php } ?>

                            <?php } ?>
                            </td>
                            <td>
                            <?php if($institution[0]){  $count =0; ?>
                                <?php foreach($institution[0] as $ins): ?>
                                    <?php if($institution['S_Reg_No'] == $ins['school_Reg']): ?>
                                        <?php $count++; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                    <?php $available = $total - $count; ?>

                                    <?php if($available <= 0){ ?>
                                        <span class="text-center text-danger">
                                            Full
                                        </span>
                                    <?php }else{ ?>
                                        <span class="text-center text-success">
                                                 Available <?php echo $available; ?>
                                        </span>
                                    <?php } ?>
                            <?php }else{ ?>
                                <?php if($total > 0){ ?>
                                <span class="text-center text-success">
                                     Available <?php echo $total; ?>
                                    </span>
                                <?php }else{ ?>
                                    <span class="text-center text-danger">
                                        Full
                                    </span>
                                <?php } ?>
                            <?php } ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

           </table>
          </div>


          </div>
