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
        <div class="card card-success card-outline">
          <div class="row">  
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class='alert alert-warning' style="display: none;" id="result">
                    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong><i class='icon fa fa-warning'></i> Warning </strong> Account already exist
                  </div>
                  <form onsubmit="return add_prevalage()">

                    <div class="form-group">
                      <label class="label-control">Privileges: </label>
                      <div class="form-group">
                        <select required class="form-control select2" style="width: 100%;" id="prevalage">
                          <option value="">Select Privilege</option>
                          <?php if($access): ?>
                            <?php foreach($access as $access): ?>
                              <option value="<?php echo $access['id']; ?>"><?php echo $access['name'] ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="label-control">Staff: </label>
                      <div class="form-group">
                        <select required class="form-control select2" id="AID" style="width: 100%;">
                          <option value="">Select staff member</option>
                           <?php if($staffs): ?>
                            <?php foreach($staffs as $staff): ?>
                              <option value="<?php echo $staff['AID']; ?>"><?php echo $staff['fname']." ".$staff['lname']." [".$staff['AID']."] "; ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-sm btn-secondary">submit</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
            <!-- / .col-md-4 -->
            <div class="col-md-8">
              <div class="card">
                <div class="card-body table-responsive">
                  <table class="table table-bordered" id="example1">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Privilege</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($access_member): ?>
                        <?php foreach($access_member as $member): ?>
                          <tr>
                            <td><?php echo $member['fname']." ".$member['mname']." ".$member['lname']; ?>
                            </td>
                            <td><?php echo $member['AID']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td>
                              <button onclick="remove_prevalage('<?php echo $member['id']; ?>')" class="btn btn-sm btn-danger">remove</button></td>
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

<script>
  function add_prevalage(){
    AID = $("#AID").val();
    prevalage = $("#prevalage").val();
    //alert(AID+" "+prevalage);
    
    path = "<?php echo base_url('inserting/add_prevalage') ?>";
    $.ajax({
      url:path,
      type:"post",
      data:{AID:AID, prevalage:prevalage},
      success:function(data){
        if(data == '2'){
          $("#result").show('slow');
        }else{
          window.location.replace('');
        }
      }
    })
    
    return false;
  }

  function remove_prevalage(ID){
     path = "<?php echo base_url('updates/remove_prevalage') ?>";
    $.ajax({
      url:path,
      type:"post",
      data:{ID:ID},
      success:function(data){
        window.location = "";
      }
    })
  }
</script>