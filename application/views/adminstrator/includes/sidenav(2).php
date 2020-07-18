<?PHP

    $adminstrator['username'] = $adminstrator["fname"]." ".$adminstrator["lname"];
    $adminstrator['imagePath'] = base_url()."assets/profile/instructor/".$adminstrator['image'];
    if($adminstrator['image'] == ''){
    	
    		$adminstrator['imagePath'] = base_url()."assets/admin/dist/img/icons/ic_person_24px.svg";
    	

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

    $ShowNew = "";

  if($results):
    foreach($results as $result):
      $postdate = strtotime($result['set_time']);
      $enddate = strtotime(date("Y-m-d"));
      if($postdate < $enddate ){
        $ShowNew = '<span class="badge badge-danger fa fa-clock-o"> Expired</span>';
        break;
      }
    endforeach;
  endif;
?>




<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('adminstrator'); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/admin/images/logosua.gif" class="brand-image img-circle elevation-3"
           style="opacity: .9">
      <span class="brand-text font-weight-light">SMCoSE FPT-TP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $adminstrator['imagePath']; ?>" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $adminstrator['username']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
  

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/index",$pagePath); ?>">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: #3d5c5c;;">
             
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator'); ?>" class="nav-link <?php secondary_active("adminstrator/index",$secondpagePath); ?>">
                  <i class="fa fa-dashboard nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/profile'); ?>" class="nav-link <?php secondary_active("adminstrator/profile",$secondpagePath); ?>">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              
            </ul>
          </li>




          <!-- end of dashbord box -->

         <?php if($asistance_admin_access): ?>
                   <!-- for admin only -->
        <?php if($admin_access): ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/instructor",$pagePath); ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Instructor
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: #3d5c5c;;">
             
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/add_instructor'); ?>" class="nav-link <?php secondary_active("adminstrator/add_instructor",$secondpagePath); ?>">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add instructor</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/manage_instructor'); ?>" class="nav-link <?php secondary_active("adminstrator/manage_instructor",$secondpagePath); ?>">
                  <i class="fa fa-gavel nav-icon"></i>
                  <p>Manage instructor</p>
                </a>
              </li>
              
            </ul>
          </li>
    <?php endif; ?>




          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/assessor&allocation",$pagePath); ?>">
              <i class="nav-icon fa fa-retweet"></i>
              <p>
                Assessor
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: #3d5c5c;;">
             
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/allocation'); ?>" class="nav-link <?php secondary_active("adminstrator/allocation",$secondpagePath); ?>">
                  <i class="fa fa-child nav-icon"></i>
                  <p>Allocate Assessor</p>
                </a>
            </li>


              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/allocated'); ?>" class="nav-link <?php secondary_active("adminstrator/allocated",$secondpagePath); ?>">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Allocated assessors</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/field_logbook'); ?>" class="nav-link <?php secondary_active("adminstrator/field_logbook",$secondpagePath); ?>">
                  <i class="fa fa-child nav-icon"></i>
                  <p>Field logbooks</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/field_report'); ?>" class="nav-link <?php secondary_active("adminstrator/field_report",$secondpagePath); ?>">
                  <i class="fa fa-child nav-icon"></i>
                  <p>Field reports</p>
                </a>
            </li>
              
            </ul>
          </li>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/setting",$pagePath); ?>">
              <i class="nav-icon fa fa-gears"></i>
              <p>
                Settings
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: #3d5c5c;;">
             
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/setting'); ?>" class="nav-link <?php secondary_active("adminstrator/setting",$secondpagePath); ?>">
                  <i class="fa fa-gear nav-icon"></i>
                  <p>All settings</p>
                </a>
              </li>
              
            </ul>
          </li>


          <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/subjects'); ?>" class="nav-link <?php secondary_active("adminstrator/subjects",$secondpagePath); ?>">
                  <i class="fa fa-book nav-icon"></i>
                  <p>Subjects</p>
                </a>
              </li>


        <?php endif; ?>

         <!-- student management -->
        <?php if($student_management): ?>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/student",$pagePath); ?>">
              <i class="nav-icon fa fa-group"></i>
              <p>
                Student
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"  style="background-color: #3d5c5c;;">


              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/add_student'); ?>" class="nav-link <?php secondary_active("adminstrator/add_student",$secondpagePath); ?>">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add student</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/manage_student'); ?>" class="nav-link <?php secondary_active("adminstrator/manage_student",$secondpagePath); ?>">
                  <i class="fa fa-legal nav-icon"></i>
                  <p>Manage student</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/student_application'); ?>" class="nav-link <?php secondary_active("adminstrator/student_application",$secondpagePath); ?>">
                  <i class="fa fa-archive nav-icon"></i>
                  <p>Student application</p>
                </a>
              </li>
              
            </ul>
          </li>
<?php endif; ?>


        <!-- admin and accistance -->
        <?php if($asistance_admin_access): ?>
            
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/zone",$pagePath); ?>">
              <i class="nav-icon fa fa-map-marker"></i>
              <p>
                Zone(s)
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"  style="background-color: #3d5c5c;;">
             
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/manage_zone'); ?>" class="nav-link <?php secondary_active("adminstrator/manage_zone",$secondpagePath); ?>">
                  <i class="fa fa-map-signs nav-icon"></i>
                  <p>Manage Zone(s)</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/manage_region'); ?>" class="nav-link <?php secondary_active("adminstrator/manage_region",$secondpagePath); ?>">
                  <i class="fa fa-map-pin nav-icon"></i>
                  <p>Manage Region(s)</p>
                </a>
              </li>

            
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/school",$pagePath); ?>">
              <i class="nav-icon fa fa-institution"></i>
              <p>
                Institutions
                <?php echo $ShowNew; ?>
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"  style="background-color: #3d5c5c;">


              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/add_school'); ?>" class="nav-link <?php secondary_active("adminstrator/add_school",$secondpagePath); ?>">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add Institution</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/manage_school'); ?>" class="nav-link <?php secondary_active("adminstrator/manage_school",$secondpagePath); ?>">
                  <i class="fa fa-clipboard nav-icon"></i>
                  <p>Manage Institutions</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/sugested_schools'); ?>" class="nav-link <?php secondary_active("adminstrator/sugested_schools",$secondpagePath); ?>">
                  <i class="fa fa-twitch nav-icon"></i>
                  <p>Sugested Institutions</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/priority_institution'); ?>" class="nav-link <?php secondary_active("adminstrator/priority_institution",$secondpagePath); ?>">
                  <i class="fa fa-street-view nav-icon"></i>
                  <p>Priority <?php echo $ShowNew; ?></p>
                </a>
              </li>


            </ul>
          </li>



        <?php endif; ?>

        <?php if($admin_access): ?>
             <li class="nav-item">
              <a class="nav-link <?php activePath("adminstrator/prevelage",$pagePath); ?>" href="<?php echo base_url('adminstrator/prevelage'); ?>">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  Privilege
                </p>
              </a>
            </li>

        <?php endif; ?>

        <?php if($assessor_allocation): ?>
          <li class="nav-item">
            <a class="nav-link <?php activePath("adminstrator/assessor_allocation",$pagePath); ?>" href="<?php echo base_url('adminstrator/assessor_allocation'); ?>">
              <i class="nav-icon fa fa-anchor"></i>
              <p>
                Assessor location
              </p>
            </a>
          </li> 
        <?php endif; ?>


        <?php if($report OR $logbook): ?>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php activePath("adminstrator/marking",$pagePath); ?>">
              <i class="nav-icon fa fa-archive"></i>
              <p>
                Field Marking
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"  style="background-color: #3d5c5c;;">
             <?php if($report): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/report_view'); ?>" class="nav-link <?php secondary_active("adminstrator/report_view",$secondpagePath); ?>">
                  <i class="fa fa-list-alt nav-icon"></i>
                  <p>Report</p>
                </a>
              </li>
            <?php endif; ?>
            <?php if($logbook): ?>

              <li class="nav-item">
                <a href="<?php echo base_url('adminstrator/logbook_view'); ?>" class="nav-link <?php secondary_active("adminstrator/logbook_view",$secondpagePath); ?>">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Logbook</p>
                </a>
              </li>
            <?php endif; ?>

            
              
            </ul>
          </li>

        <?php endif; ?>

        <!-- admin and accistance -->
    <?php if($asistance_admin_access): ?>
        <?php if($application_request): ?>
          <li class="nav-item">
            <a class="nav-link <?php activePath("adminstrator/re_application",$pagePath); ?>" href="<?php echo base_url('adminstrator/re_application'); ?>">
              <i class="nav-icon fa fa-warning"></i>
              <p>
                <span class="badge badge-danger">Re application</span>
              </p>
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link <?php activePath("adminstrator/summary",$pagePath); ?>" href="<?php echo base_url('adminstrator/summary'); ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                summary
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php activePath("adminstrator/field_letter",$pagePath); ?>" href="<?php echo base_url('adminstrator/field_letter'); ?>">
              <i class="nav-icon fa fa-list"></i>
              <p>
                Field letter
              </p>
            </a>
          </li>
<?php endif; ?>

          <li class="nav-item">
            <a class="nav-link <?php activePath("adminstrator/password",$pagePath); ?>" href="<?php echo base_url('adminstrator/change_password'); ?>">
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