
<?php
$student['username'] = $student["fname"]." ".$student["lname"];

    
    if($student['image'] == ''){
        $student['imagePath'] = base_url("assets/admin/dist/img/icons/ic_person_24px.svg");
    }else{
        $student['imagePath'] = base_url()."assets/profile/student/".$student['image'];
    }
 
    function activePath($page,$pagePath){
        if($page == $pagePath){
            echo "active";
        }else{
                 echo "no";
        }
    
    }

    function secondary_active($page,$secondpagePath){
        if($page == $secondpagePath){
            echo "active bg-success";
        }else{
                 echo "no";
        }
    
    }

?>


<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('student'); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/admin/images/logosua.gif" class="brand-image img-circle elevation-3"
           style="opacity: .9">
      <span class="brand-text font-weight-light">SMCoSE FPT-TP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $student['imagePath']; ?>" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $student['username']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("student/index",$pagePath); ?>">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: #3d5c5c;;">
             
              <li class="nav-item">
                <a href="<?php echo base_url('student'); ?>" class="nav-link <?php secondary_active("student/index",$secondpagePath); ?>">
                  <i class="fa fa-dashboard nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('student/profile'); ?>" class="nav-link <?php secondary_active("student/profile",$secondpagePath); ?>">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              
            </ul>
          </li>

          <!-- end of dashbord box -->
      

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("student/field",$pagePath); ?>">
              <i class="nav-icon fa fa-newspaper-o"></i>
              <p>
                Fields
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"  style="background-color: #3d5c5c;">
             
              <li class="nav-item">
                <a href="<?php echo base_url('student/select_field'); ?>" class="nav-link <?php secondary_active("student/select_field",$secondpagePath); ?>">
                  <i class="fa fa-list-alt nav-icon"></i>
                  <p>Select field</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('student/sugest_field_area'); ?>" class="nav-link <?php secondary_active("student/sugest_field_area",$secondpagePath); ?>">
                  <i class="fa fa-pencil-square nav-icon"></i>
                  <p>SugGest field area</p>
                </a>
              </li>
              
            </ul>
          </li>


          <?php if($results): ?>
            <li class="nav-item">
            <a class="nav-link <?php activePath("student/result",$pagePath); ?>" href="<?php echo base_url('student/result'); ?>">
              <i class="nav-icon fa fa-file-text"></i>
              <p>
                Field result
              </p>
            </a>
          </li>
          <?php endif; ?>


          <li class="nav-item">
            <a class="nav-link <?php activePath("student/password",$pagePath); ?>" href="<?php echo base_url('student/change_password'); ?>">
              <i class="nav-icon fa fa-key"></i>
              <p>
                Change password
              </p>
            </a>
          </li>

        

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>