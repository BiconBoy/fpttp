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
    <section class="content" style="margin-top: -23px">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
       
          <div class="card card-success card-outline">
            <div class="card-body">
               <div class="row">
                <div class="col-md-3">
                  <form onsubmit="return submit_suggested()">
                    <div class="form-group">
                      <lable class="label-control">School name:<i class="text-danger">*</i></lable>
                      <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-sm" required placeholder="Enter the name of the school">
                      </div>
                    </div>

                    <div class="form-group form-group-sm">
                              <label class="lable-control">School region:<i class="text-danger">*</i> </label>
                              <div class="form-group">
                                <select name="region" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required >
                                  <option value="">Select region</option>
                                  <?php if($regions): ?>
                                    <?php foreach($regions as $region): ?>
                                      <option value="<?php echo $region['region_name']; ?>"><?php echo $region['region_name']; ?></option>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                </select>
                              </div>
                            </div>
                    <div class="form-group">
                      <lable class="label-control">School district:</lable>
                      <div class="form-group">
                        <input type="text" name="district" class="form-control form-control-sm"  placeholder="if you know the district">
                      </div>
                    </div>

                     <div class="form-group">
                      <lable class="label-control">School ward:</lable>
                      <div class="form-group">
                        <input type="text" name="ward" class="form-control form-control-sm"  placeholder="if you know the ward">
                      </div>
                    </div>

                     <div class="form-group">
                      <lable class="label-control">School contact:<i class="text-danger">*</i></lable>
                      <div class="form-group">
                        <input type="text" required name="contact" class="form-control form-control-sm"  placeholder="if you know the contact">
                      </div>
                    </div>
                    <label class="lable-control"><i class="text-danger">*</i> Must be field</label>
                    <div class="form-group" id="Result">
                      <button id="submit" class="btn btn-sm btn-success">submit</button>
                    </div>
                  </form>
                </div>
                <!-- / .col-md-4 -->
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">The list of suggested schools</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table id="example2" class="table table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>School name</th>
                              <th>Region</th>
                              <th>District</th>
                              <th>Ward</th>
                              <th>Contact</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php if($sugested_school):$no = 0; ?>
                              <?php foreach($sugested_school as $school):$no++; ?>
                                <tr>
                                  <th><?php echo $no; ?></th>
                                  <td><?php echo $school['name']; ?></td>
                                  <td><?php echo $school['region']; ?></td>
                                  <td><?php echo $school['district']; ?></td>
                                  <td><?php echo $school['ward']; ?></td>
                                  <td><?php echo $school['contact']; ?></td>
                                </tr>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- / .col-md-8 -->
              </div>
          </div>
        </div>

<script>
  function submit_suggested(){
    $("#submit").html('submiting...');
    $("#submit").attr('disabled','disabled');
    name = $("input[name='name']").val();
    ward = $("input[name='ward']").val();
    district = $("input[name='district']").val();
    contact = $("input[name='contact']").val();
    region = $("select[name='region']").val();
    path ="<?php echo base_url('inserting/add_suggested_school') ?>";
    $.ajax({
      url:path,
      type:"post",
      data:{name:name, ward:ward, district:district, contact:contact, region:region},
      success:function(data){
      
       if(data == '1'){
        window.location.replace('');
       }
       if(data == '2'){
          $("#Result").html('<div class="alert alert-warning">The school already added in the list</div>');
          setTimeout(function(){
            window.location.replace('');
          },3000);
       }
       
      }
    })
    return false;
  }
</script>