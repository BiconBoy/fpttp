
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

              <div class="row">
                
                <div class="col-md-5">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Accademic year setting</h3>
                    </div>
                    <div class="card-body">
                      <div id="result" style="display: none;">
                        <div class='alert alert-warning'>
                          <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                          <strong><i class='icon fa fa-warning'></i> Warning</strong>
                           accademic year already exist
                        </div> 
                      </div>
                      
                     <form onsubmit="return add_accademic_year()">
                       
                        <div class="form-group form-group-sm">
                                <label class="lable-control">Accademic year: </label>
                                <div class="form-group">
                                  <select id="year" required class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Select accademic year</option>
                                    <?php 
                                      $year = date('Y');
                                      $year_pre = date('Y') - 1;
                                      for($i =1; $i<=2; $i++){ ?>
                                        <option value="<?php echo $year_pre."-".$year; ?>"><?php echo $year_pre."-".$year; ?></option>

                                      <?php $year++; $year_pre++; } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <button class="btn btn-sm btn-secondary">add accademic year</button>
                              </div>

                     </form>

                    <div class="form-group form-group-sm">
                          <label class="lable-control">Allow the student to submit their arrive note</label>
                        <?php if($arrive_note): ?>
                            <?php foreach($arrive_note as $note){} ?>
                                <?php if($note['arrive_note_status'] == "NO"){ ?>
                                    <div class="form-group">
                                    
                                        <div class="btn-group" id="NO">
                                        <button  onclick="show_this('#YES','#NO')" type="button" class="btn btn-danger">Not allowed</button>
                                        <button  disabled type="button" class="btn btn-danger ">
                                            <span class="caret"><i class="fa fa-close"></i></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        </div>
                                        
                                        <div  id="YES" style="display: none;">
                                        <div class="btn-group">
                                        
                                        <button  onclick="show_this_('#NO','#YES')" type="button" class="btn btn-success">Allowed</button>
                                        <button  disabled type="button" class="btn btn-success ">
                                            <span class="caret"><i class="fa fa-check"></i></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        </div>

                                    
                                     <form action="<?php echo base_url('updates/update_arrive_status'); ?>" method="post">
                                           <div class="form-group">
                                            <label>Deadline:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input name="deadline" required type="text" placeholder="Enter dedline date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                            </div>
                                            <!-- /.input group -->
                                            </div>
                                            <input type="hidden" value="YES" name="status">
                                            <div class="form-group text-center">
                                                <button class="btn btn-sm btn-secondary">Submit</button>
                                            </div>

                                            </form>
                                    
                                    </div>
                                    
                                        

                                        
                                    </div>


                                <?php }else{ ?>

                                          <div class="form-group">
                                    
                                       
                                        
                                        <div>
                                        <div class="btn-group">
                                        
                                        <button  onclick="window.location.replace('<?php echo base_url('updates/close_arrive_note') ?>')" type="button" class="btn btn-success">Allowed</button>
                                        <button  disabled type="button" class="btn btn-success ">
                                            <span class="caret"><i class="fa fa-check"></i></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        </div>

                                    
                                     <form action="<?php echo base_url('updates/update_arrive_status'); ?>" method="post">
                                           <div class="form-group">
                                            <label>Deadline:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input name="deadline" required type="text" value="<?php echo $note['deadline']; ?>" placeholder="Enter dedline date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                            </div>
                                            <!-- /.input group -->
                                            </div>
                                            <input type="hidden" value="YES" name="status">
                                            <div class="form-group text-center">
                                                <button class="btn btn-sm btn-secondary">Submit</button>
                                            </div>

                                            </form>
                                    
                                    </div>
                                    
                                        

                                        
                                    </div>

                          <?php } ?>
                          <?php endif; ?>
                    </div>
                        
                 


                    </div>
                  </div>
                </div>
                <!-- / .cpl-md-6 -->
                <div class="col-md-7">
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Accademic year list</h3>
                      </div>
                      <div class="card-body table-responsive">
                        <table class="table table-bordered" > 
                          <thead>
                            <tr>
                              <th>Accademic year</th>
                              <th>Current year</th>
                              <th>Application status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if($accademic_year): ?>
                              <?php foreach($accademic_year as $ac_year): ?>
                                <tr>
                                  <td><?php echo $ac_year['year']; ?></td>
                                  <td><?php echo $ac_year['current']; ?></td>
                                  <td class=" text-center">
                                    <?php $Year = $ac_year['year']; $status = $ac_year['status']; ?>
                                    <?php if($ac_year['status'] == 'YES'){ ?>
                                      <buton onclick="open_close_ap('<?php echo $Year; ?>','<?php echo $status; ?>')" class="btn btn-success btn-sm btn-block">OPENED</buton>
                                    <?php }else{ ?>
                                      <?php if($ac_year['current'] == "YES"){ ?>
                                      <buton onclick="open_close_ap('<?php echo $Year; ?>','<?php echo $status; ?>')" class="btn btn-secondary btn-sm btn-block">CLOSED</buton>
                                    <?php }else{ ?>
                                      <span class="text-danger">FINISHED</span>
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

                </div>

              </div>

            </div>
          </div>
        </div>

<script>
  function add_accademic_year(){
    year = $("#year").val();
    alert(year);

    return false;
  }
  function open_close_ap(year,status){
    path = "<?php echo base_url('updates/open_close_ap') ?>";
    $.ajax({
      url:path,
      type:"post",
      data:{year:year, status:status},
      success:function(data){
        window.location = "";
      }
    })
  }
  function add_accademic_year(){
    year = $("#year").val();
    path = "<?php echo base_url('inserting/add_accademic_year') ?>";
    $.ajax({
      url:path,
      type:"post",
      data:{year:year},
      success:function(data){
       if(data == '2'){
        $("#result").show('slow');
       }else{
          window.location = "";
       }
      }
    })
    return false;
  }

  function show_this(show,hide){
  priority = $("#priority").val();
  $(hide).hide('slow');
  $(show).show('slow');
  $("#priority").val('YES');
}
function show_this_(show,hide){
  priority = $("#priority").val();
  $(hide).hide('slow');
  $(show).show('slow');
  $("#priority").val('NO');
  
}
</script>