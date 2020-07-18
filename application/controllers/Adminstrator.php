<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adminstrator extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Home_model');
		$this->load->model('Admin_info_model');
		$this->load->model('Other_info_model');
        $this->load->model('excel_import_model');
      //  $this->load->library('excel');

		$this->load->library('upload'); //load library upload 
		$this->load->library('session');
    }

    public function top_Content($page_data=''){
        if($this->session->userdata('#_AID_SUA')){

            $content['student'] = $this->session->userdata('#_AID_SUA');
    
            $this->load->view('adminstrator/includes/header',$content);  
        }else{
            exit("nodirect access");
        }
    }

    public function navigation($page_data=''){
        if($this->session->userdata('#_AID_SUA')){

            $content['adminstrator'] = $this->session->userdata('#_AID_SUA');
    
            $this->load->view('adminstrator/includes/navigation',$content);  
        }else{
            exit("nodirect access");
        }
    }
    
	public function bottom_content($page_data=''){
        if($this->session->userdata('#_AID_SUA')){
            $content['adminstrator'] = $this->session->userdata('#_AID_SUA');
    
            $this->load->view('adminstrator/includes/footer',$content);   
        }else{
            exit("nodirect access");
        }

    }
    
    
    //geting sidenav content
    public function sideNav($pagePath = '',$secondpagePath = ''){
        if($this->session->userdata('#_AID_SUA')){
            $content['pagePath'] = $pagePath;
            $content['secondpagePath']  = $secondpagePath;
            $content['adminstrator'] = $this->session->userdata('#_AID_SUA');
            extract($content['adminstrator']);
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $content['year'] = $year;

            $this->db->select('set_time');
            $results = $this->db->get('priority_student');
            if($results->num_rows()>0){
                $content['results'] = $results->result_array();
            }else{
                $content['results'] = false;
            }

            $content['application_request'] = $this->Other_info_model->student_application_request($year);
            

            $content['application'] = $this->Other_info_model->get_all_application_report($year);
            $content['report'] = $this->Other_info_model->report_marking($content['adminstrator']['AID'],$year);
            $content['logbook'] = $this->Other_info_model->logbook_marking($content['adminstrator']['AID'],$year);

            //check if the user have been selected to assess the student in their field
            $content['assessor_allocation'] = $this->Admin_info_model->check_instructor_allocation($content['adminstrator']['AID'],$year);
            $content['admin_access'] = $this->Admin_info_model->get_admin_access_ifo($content['adminstrator']['AID']);
            $content['student_management'] = $this->Admin_info_model->student_management($content['adminstrator']['AID']);
            $content['asistance_admin_access'] = $this->Admin_info_model->get_assistant_admin_access_ifo($content['adminstrator']['AID']);
				//check if ther is new result
				//$content['results'] = $this->Student_model->get_result_list($content['student']['SID'],'DESC');
				//end of finding new result
    
            $this->load->view('adminstrator/includes/sidenav',$content);   
        }else{
            exit("nodirect access");
        }

	}


	public function index(){
		//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $totals = $this->db->query("SELECT student_FTP.program,student_FTP.study_year FROM application INNER JOIN student_FTP ON application.SID = student_FTP.SID
WHERE logbook_confirm = 'YES' AND report_confirm = 'YES' AND marks_confirm = 'YES' AND application.ac_year = '$year'");
            if($totals->num_rows()>0){
                $page_data['totals'] = $totals->result_array();
            }else{
                $page_data['totals'] = false;
            }
            
            $pagePath = 'adminstrator/index';
            $secondpagePath = 'adminstrator/index';

            $page_data['maintitle'] = "Dashboard";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Dashboard";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/index', $page_data);
	 	$this->bottom_content($page_data);
             
		}else{
			redirect('Home');
		}
    }


    //This is for calling prifile
    public function profile(){
		//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            
            $pagePath = 'adminstrator/index';
            $secondpagePath = 'adminstrator/profile';

            $page_data['maintitle'] = "Profile";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Profile";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/profile', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    public function subjects(){
		//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            
            $pagePath = 'adminstrator/subjects';
            $secondpagePath = 'adminstrator/subjects';
            $subject  = $this->db->get('university_subjects');
            if($subject->num_rows()>0){
                $page_data['inst_subject'] = $subject->result_array();
            }else{
                $page_data['inst_subject'] = false;
            }

            $page_data['maintitle'] = "FPT/TP manage subjects";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Subjects";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/subjects', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    public function field_letter(){
		//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            

                $this->db->where('ac_year',$year);
                $this->db->where('status','pending');
            $field_letter = $this->db->get('app_field_request');
            if($field_letter->num_rows()>0){
                $page_data['field_letter'] = $field_letter->result_array();
            }else{
                $page_data['field_letter'] = false;
            }
            $pagePath = 'adminstrator/field_letter';
            $secondpagePath = '';

            $page_data['maintitle'] = "Field letter";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Request";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/field_letter', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    public function add_instructor(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $page_data['access_list'] = $this->Admin_info_model->get_access_list();

            $pagePath = 'adminstrator/instructor';
            $secondpagePath = 'adminstrator/add_instructor';

            $page_data['maintitle'] = "Management";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Add Instructor";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);;
            $this->load->view('adminstrator/add_instructor', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    //add student in new accademic year
     public function add_student(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
           
            $student_list = $this->db->query("SELECT program, year FROM student  GROUP BY program,year ORDER BY program ASC");
            if($student_list->num_rows()>0){
                $page_data['student_list'] = $student_list->result_array();
            }else{
                $page_data['student_list'] = false;
            }

            $totals = $this->db->get('student');
            if($totals->num_rows()>0){
                $page_data['totals'] = $totals->result_array();
            }else{
                $page_data['totals'] = false;
            }


            $pagePath = 'adminstrator/student';
            $secondpagePath = 'adminstrator/add_student';

            $page_data['maintitle'] = "Student";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Add Student";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);;
            $this->load->view('adminstrator/add_student', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }

    // view student list
        public function student_list($program = '', $study_year = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $page_data['program'] = $program;

           $this->db->where('program',$program);
           $this->db->where('year',$study_year);
            $student_list = $this->db->get('student');
            if($student_list->num_rows()>0){
                $page_data['student_list'] = $student_list->result_array();
            }else{
                $page_data['student_list'] = false;
            }

            $page_data['program'] = $program;

            $pagePath = 'adminstrator/student';
            $secondpagePath = 'adminstrator/add_student';

            $page_data['maintitle'] = $program." year ".$study_year;
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Student list";
            
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/student_list', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }


     public function adminstrator_view_student($SID = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
           $SID = str_replace('_', '.', $SID);
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['application'] = $this->Other_info_model->check_student_application($SID,$year);

            $studentData = $this->db->query("SELECT * FROM `student_FTP` WHERE `SID` = '$SID'");
            if($studentData->num_rows()>0){
                $page_data['students'] = $studentData->result_array();
            }else{
                 $page_data['students'] = false;
            }

            $pagePath = 'adminstrator/student';
            $secondpagePath = 'adminstrator/manage_student';

            $page_data['maintitle'] = "Management";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage student";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/adminstrator_view_student', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }


    public function instructor_view_profile($AID = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $AID = str_replace('_', '/', $AID);

            $instructor = $this->db->query("SELECT * FROM adminstrator WHERE AID = '$AID' ");
            if($instructor->num_rows()>0){
                $page_data['instructors'] = $instructor->result_array();
            }

            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            $allocated = $this->db->query("SELECT assessors_alloction.*, school.*, adminstrator.* FROM adminstrator 
                                        INNER JOIN assessors_alloction ON assessors_alloction.AID = adminstrator.AID
                                        INNER JOIN school ON school.S_Reg_No = assessors_alloction.school_reg
                                        WHERE assessors_alloction.AID = '$AID' AND ac_year = '$year' ");
            if($allocated->num_rows()>0){
                $page_data['allocated'] = $allocated->result_array();
            }else{
                $page_data['allocated'] = false;
            }


            $pagePath = 'adminstrator/instructor';
            $secondpagePath = 'adminstrator/manage_instructor';

            $page_data['maintitle'] = "Management";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage Instructor";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);;
            $this->load->view('adminstrator/instructor_view_profile', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }



    public function manage_instructor(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $page_data['instructors'] = $this->Admin_info_model->get_all_instructors();

            $pagePath = 'adminstrator/instructor';
            $secondpagePath = 'adminstrator/manage_instructor';

            $page_data['maintitle'] = "Management";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage Instructor";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);;
            $this->load->view('adminstrator/manage_instructor', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    public function prevelage(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $pagePath = 'adminstrator/prevelage';
            $secondpagePath = 'adminstrator/prevelage';

            $staff = $this->db->query("SELECT * FROM adminstrator WHERE status = 'Active'");
            if($staff->num_rows()>0){
                $page_data['staffs'] = $staff->result_array();
            }else{
                $page_data['staffs'] = false;
            }

            $access_member = $this->db->query("SELECT adminstrator.fname, adminstrator.lname, adminstrator.mname,access.name,adminstrator_access.AID,adminstrator_access.id FROM adminstrator_access 
                INNER JOIN adminstrator ON adminstrator_access.AID = adminstrator.AID 
                INNER JOIN access ON adminstrator_access.access_ID = access.id WHERE status = 'Active'");
            if($staff->num_rows()>0){
                $page_data['access_member'] = $access_member->result_array();
            }else{
                $page_data['access_member'] = false;
            }


            $access = $this->db->get('access');
            if($access->num_rows()>0){
                $page_data['access'] = $access->result_array();
            }else{
                $page_data['access'] = false;
            }

            $page_data['maintitle'] = "Privilege";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Grant Privilege";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/prevelage', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

//This for managing student page
    public function manage_student(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['students'] = $this->Admin_info_model->get_all_students($year);
            $pagePath = 'adminstrator/student';
            $secondpagePath = 'adminstrator/manage_student';

            $page_data['maintitle'] = "Management";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage Student";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/manage_student', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    // This for zone view
    public function manage_zone(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $page_data['zones'] = $this->Other_info_model->get_all_zones();
             $page_data['regions'] = $this->Other_info_model->get_all_regions();

            $pagePath = 'adminstrator/zone';
            $secondpagePath = 'adminstrator/manage_zone';

            $page_data['maintitle'] = "Zone";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage Zone";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/manage_zone', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    // This for region view
    public function manage_region(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $page_data['zone_available'] = $this->Other_info_model->get_all_zones();
            $page_data['regions'] = $this->Other_info_model->get_all_regions_by();


            $pagePath = 'adminstrator/zone';
            $secondpagePath = 'adminstrator/manage_region';

            $page_data['maintitle'] = "Zone";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage Region";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/manage_region', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    // this for opening priority institution
        public function open_priority($Reg = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $Reg = str_replace('_', '/', $Reg);
            $page_data['Reg'] = $Reg;
            $pagePath = 'adminstrator/school';
            $secondpagePath = 'adminstrator/priority_institution';

            $this->db->select('name');
            $this->db->select('category');
            $this->db->where('S_Reg_No',$Reg);
            $name = $this->db->get('school');
            if($name->num_rows()>0){
                $names = $name->result_array();
                foreach($names as $n){
                    $page_data['institution'] = $n['name'];
                    $page_data['category'] = $n['category'];
                }
            }

            $category = $page_data['category'];

            $priority = $this->db->get('priority_student');
            if($priority->num_rows()>0){
                $priority = $priority->result_array();

                $SID_available = " ";
                foreach($priority as $p):
                    $SID = $p['SID'];
                    $SID_available .= "`student_FTP`.`SID` != '".$SID."' AND ";
                endforeach;
                $SIDDATA = $this->db->query("SELECT * FROM student_FTP WHERE $SID_available `category` = '$category' ");
                if($SIDDATA){
                    $page_data['students'] = $SIDDATA->result_array(); 
                }

            }else{
                 $students = $this->db->query("SELECT * FROM student_FTP WHERE category = '$category'");
            if($students->num_rows()>0){
                $page_data['students'] = $students->result_array();
            }else{
                $page_data['students'] = false;
            }
            }   

            $query = $this->db->query("SELECT student_FTP.*, priority_student.I_ID FROM student_FTP INNER JOIN priority_student ON student_FTP.SID = priority_student.SID WHERE I_ID = '$Reg'");
            if($query->num_rows()>0){
                $page_data['priority_student'] = $query->result_array();
            }else{
                $page_data['priority_student'] = false;   
            }
            
            

            $page_data['maintitle'] = $n['name'];
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Give student priority";

            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/open_priority', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }


        // This for region view
    public function student_application(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['year'] = $year;
            $application = $this->db->query("SELECT `student_FTP`.*,`school`.*,application.* FROM `application` INNER JOIN `student_FTP` ON `application`.`SID` = `student_FTP`.`SID` INNER JOIN `school` ON `application`.`school_Reg` = `school`.`S_Reg_No` WHERE `application`.`ac_year` = '$year' ORDER BY `program` ASC ");
            if($application->num_rows()>0){
                $page_data['student_application'] = $application->result_array();
            }else{
                $page_data['student_application'] = false;
            }

            //print_r($page_data['student_application']);

            $pagePath = 'adminstrator/student';
            $secondpagePath = 'adminstrator/student_application';

            $page_data['maintitle'] = "Student";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Student list";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/student_application', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }



    // This for region view
    public function zone_instructor(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $pagePath = 'adminstrator/zone';
            $secondpagePath = 'adminstrator/zone_instructor';

            $page_data['maintitle'] = "Zone";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Zone instructor";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/zone_instructor', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    // This for school view
    public function manage_school(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $page_data['regions'] = $this->Other_info_model->get_all_regions();
            $page_data['schools'] = $this->Other_info_model->get_all_schools();
            $pagePath = 'adminstrator/school';
            $secondpagePath = 'adminstrator/manage_school';

            $page_data['maintitle'] = "Institution list";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage Institution";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/manage_school', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    // This for school view
    public function add_school(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $page_data['regions'] = $this->Other_info_model->get_all_regions();
            $page_data['schools'] = $this->Other_info_model->get_all_schools();
            $pagePath = 'adminstrator/school';
            $secondpagePath = 'adminstrator/add_school';

            $page_data['maintitle'] = "Institution";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Add Institution";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/add_school', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

     // This for subject view
    public function manage_subject(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $pagePath = 'adminstrator/school';
            $secondpagePath = 'adminstrator/manage_subject';

            $page_data['maintitle'] = "Schools";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Manage Subject";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/manage_subject', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

    //instution that have student priority
     public function priority_institution(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $priority = $this->db->query("SELECT student_FTP.SID,Reg_No,student_FTP.fname,lname,mname, priority_student.I_ID FROM student_FTP INNER JOIN priority_student ON student_FTP.SID = priority_student.SID");
            if($priority->num_rows()>0){
                $page_data['students'] = $priority->result_array();
            }else{
                $page_data['students'] = false;
            }

        
            $results = $this->db->query("SELECT * FROM priority_student GROUP BY I_ID");
            if($results->num_rows()>0){
                $page_data['p_results'] = $results->result_array();
            }else{
                $page_data['p_results'] = false;
            }

            $page_data['sugested'] = $this->Other_info_model->get_priority_schools();
            $pagePath = 'adminstrator/school';
            $secondpagePath = 'adminstrator/priority_institution';


            $page_data['maintitle'] = "Priority institution";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Priority";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/priority_institution', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }

    // This for sugested school view
    public function sugested_schools(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $page_data['sugested'] = $this->Other_info_model->get_suggested_schools();
            $pagePath = 'adminstrator/school';
            $secondpagePath = 'adminstrator/sugested_schools';

            $page_data['maintitle'] = "Institution";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Sugested institution";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/sugested_schools', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

     // This for field logbooks
    public function field_logbook(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            $logbook_assess = $this->Other_info_model->logbook_assessor();
            if($logbook_assess){

            }else{

            }

            $instructorData = $this->db->query("SELECT * FROM adminstrator WHERE `status` = 'Active' ORDER BY fname ASC ");
                if($instructorData){
                    $page_data['assessors'] = $instructorData->result_array(); 
                }

                $logbook_allocated = $this->Other_info_model->get_logbook_allocated_instution($year);
                $page_data['logbook_allocated'] = $logbook_assess;
                $page_data['logbook_assessors'] = $this->Other_info_model->all_logbook_assessor();
                if($page_data['logbook_assessors']){
                    $count= 0;
                    foreach ($page_data['logbook_assessors'] as $assessor):
                        $allocated_school_info = $this->Other_info_model->get_assessor_logbook($assessor['AID'],$year);

                        if($allocated_school_info){
                            array_push($page_data['logbook_assessors'][$count], $allocated_school_info);
                        }else{
                            array_push($page_data['logbook_assessors'][$count], array());
                        }
                        $count++;
                    endforeach;
                }





                
                if($logbook_allocated){
                    $Data = " ";
                    foreach($logbook_allocated as $institution):
                    $REG = $institution['I_ID'];
                    $Data .= "`application`.`school_Reg` != '".$REG."' AND ";
                    endforeach;

                    $institution_Data = $this->db->query("SELECT `school`.`S_Reg_No`, `school`.`name` FROM `application` 
                                                    INNER JOIN `school` ON `school`.`S_Reg_No` = `application`.`school_Reg` 
                                                    WHERE $Data  `school`.`reachable` = 'YES' AND `ac_year` = '$year'  GROUP BY S_Reg_No ORDER BY name ASC ");
                    if($institution_Data){
                        $page_data['institutions'] = $institution_Data->result_array(); 
                    }

                }else{ 
                    $institution_Data = $this->db->query("SELECT `school`.`S_Reg_No`, `school`.`name` FROM `application` 
                                                    INNER JOIN `school` ON `school`.`S_Reg_No` = `application`.`school_Reg` 
                                                
                                                    WHERE  `school`.`reachable` = 'YES' AND `ac_year` = '$year'  GROUP BY S_Reg_No ORDER BY name ASC ");
                    if($institution_Data->num_rows() > 0){
                        $page_data['institutions'] = $institution_Data->result_array();
                    }
                }

            $pagePath = 'adminstrator/assessor&allocation';
            $secondpagePath = 'adminstrator/field_logbook';

            $page_data['maintitle'] = "Logbooks";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Field logbook";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/field_logbook', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }

    // This for field reports
    public function field_report(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            $instructorData = $this->db->query("SELECT * FROM adminstrator WHERE `status` = 'Active' ORDER BY fname ASC ");
                if($instructorData){
                    $page_data['assessors'] = $instructorData->result_array(); 
                }

                $report_allocated = $this->Other_info_model->get_report_allocated_instution($year);
                $page_data['report_allocated'] = $report_allocated;
                $page_data['report_assessors'] = $this->Other_info_model->all_report_assessor();
                if($page_data['report_assessors']){
                    $count= 0;
                    foreach ($page_data['report_assessors'] as $assessor):
                        $allocated_school_info = $this->Other_info_model->get_assessor_report($assessor['AID'],$year);

                        if($allocated_school_info){
                            array_push($page_data['report_assessors'][$count], $allocated_school_info);
                        }else{
                            array_push($page_data['report_assessors'][$count], array());
                        }
                        $count++;
                    endforeach;
                }





                
                if($report_allocated){
                    $Data = " ";
                    foreach($report_allocated as $institution):
                    $REG = $institution['I_ID'];
                    $Data .= "`application`.`school_Reg` != '".$REG."' AND ";
                    endforeach;

                    $institution_Data = $this->db->query("SELECT `school`.`S_Reg_No`, `school`.`name` FROM `application` 
                                                    INNER JOIN `school` ON `school`.`S_Reg_No` = `application`.`school_Reg` 
                                                    WHERE $Data  `school`.`reachable` = 'YES' AND `ac_year` = '$year'  GROUP BY S_Reg_No ORDER BY name ASC ");
                    if($institution_Data){
                        $page_data['institutions'] = $institution_Data->result_array(); 
                    }

                }else{ 
                    $institution_Data = $this->db->query("SELECT `school`.`S_Reg_No`, `school`.`name` FROM `application` 
                                                    INNER JOIN `school` ON `school`.`S_Reg_No` = `application`.`school_Reg` 
                                                
                                                    WHERE  `school`.`reachable` = 'YES' AND `ac_year` = '$year'  GROUP BY S_Reg_No ORDER BY name ASC ");
                    if($institution_Data->num_rows() > 0){
                        $page_data['institutions'] = $institution_Data->result_array();
                    }
                }



            $pagePath = 'adminstrator/assessor&allocation';
            $secondpagePath = 'adminstrator/field_report';

            $page_data['maintitle'] = "reports";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Field reports";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/field_report', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }
    // This for sugested school view
    public function change_password(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $pagePath = 'adminstrator/password';
            $secondpagePath = '';

            $page_data['maintitle'] = "Instructor";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Change password";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/change_password', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

     // This for viewing school summary with application statuses
    public function summary(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $this->db->order_by('region ASC');
            $institution = $this->db->get('school');
            if($institution->num_rows()>0){
                $page_data['all_institution'] = $institution->result_array();
                $count= 0;
				foreach ($page_data['all_institution'] as $inst):
					$inst_app = $this->Other_info_model->check_institution_application($inst['S_Reg_No'],$year);

					if($inst_app){
						array_push($page_data['all_institution'][$count], $inst_app);
					}else{
						array_push($page_data['all_institution'][$count], array());
					}
					$count++;
				endforeach;
            }else{
                $page_data['all_institution'] = false;
            }
            $subject  = $this->db->get('subject');
            if($subject->num_rows()>0){
                $page_data['inst_subject'] = $subject->result_array();
            }else{
                $page_data['inst_subject'] = false;
            }
            $INF = 0;
            $EDU = 0;
            $ESM = 0;
            
            $this->db->where('accademic_year',$year);
            $this->db->select('category');
            $students = $this->db->get('student_FTP');
            if($students->num_rows()>0){
                $students = $students->result_array();
                foreach($students as $student):
                    if($student['category'] == 'EDU'){
                        $EDU++;
                    }
                    if($student['category'] == 'INF'){
                        $INF++;
                    }
                    if($student['category'] == 'ESM'){
                        $ESM++;
                    }
                endforeach;
            }
            $INF_INS = 0;
            $EDU_INS = 0;
            $ESM_INS = 0;
            $this->db->where('reachable','YES');
            $this->db->select('category');
            $this->db->select('student_required');
            $institutions = $this->db->get('school');
            if($institutions->num_rows()>0){
                $institutions = $institutions->result_array();
                foreach($institutions as $institution):
                    if($institution['category'] == 'EDU'){
                        $EDU_INS = $EDU_INS + $institution['student_required'];
                    }
                    if($institution['category'] == 'INF'){
                        $INF_INS = $INF_INS + $institution['student_required'];
                    }
                    if($institution['category'] == 'ESM'){
                        $ESM_INS = $ESM_INS + $institution['student_required'];
                    }
                endforeach;
            }

            $INF_APP = 0;
            $EDU_APP = 0;
            $ESM_APP = 0;
            $applications = $this->db->query("SELECT category FROM application INNER JOIN student_FTP ON application.SID = student_FTP.SID WHERE accademic_year = '$year'");
            if($applications->num_rows()>0){
                $applications = $applications->result_array();
                foreach($applications as $application):
                    if($application['category'] == 'EDU'){
                        $EDU_APP++;
                    }
                    if($application['category'] == 'INF'){
                        $INF_APP++;
                    }
                    if($application['category'] == 'ESM'){
                        $ESM_APP++;
                    }
                endforeach;
            }
            
            $page_data['INF'] = $INF;
            $page_data['INF_INS'] = $INF_INS;
            $page_data['INF_APP'] = $INF_APP;

            $page_data['EDU'] = $EDU;
            $page_data['EDU_INS'] = $EDU_INS;
            $page_data['EDU_APP'] = $EDU_APP;

            $page_data['ESM'] = $ESM;
            $page_data['ESM_INS'] = $ESM_INS;
            $page_data['ESM_APP'] = $ESM_APP;
            
            
            $pagePath = 'adminstrator/summary';
            $secondpagePath = '';

            $page_data['maintitle'] = "Institution summary";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Summary";
			
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/summary', $page_data);
	 		$this->bottom_content($page_data);
             
		}else{
			redirect('Home');
		}
    }



// This for FTP setting
    public function setting(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            $pagePath = 'adminstrator/setting';
            $secondpagePath = 'adminstrator/setting';

            $accademic_year = $this->db->query("SELECT * FROM `accademic_year` ORDER BY `accademic_year`.`date` DESC LIMIT 5 ");
            if($accademic_year->num_rows()>0){
                $page_data['accademic_year'] = $accademic_year->result_array();
            }else{
                $page_data['accademic_year'] = false;
            }

            $arrive_note = $this->db->query("SELECT deadline,arrive_note_status FROM `accademic_year` WHERE  `accademic_year`.`year` = '$year' ");
            if($arrive_note->num_rows()>0){
                $page_data['arrive_note'] = $arrive_note->result_array();
            }else{
                $page_data['arrive_note'] = false;
            }

            $page_data['maintitle'] = "<small>Current accademic year <strong>".$year."</strong></small>";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "All settings";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/setting', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }


     // student assess
    public function student_assess($reg='',$SID=''){
        //load session libraryedf
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');

            $pagePath = 'adminstrator/assessor_allocation';
            $secondpagePath = '';
            $page_data['back_btn'] = base_url('adminstrator/school_assessor/'.$reg);
            $page_data['Reg'] = $reg;
            $SID = str_replace('_', '.', $SID);
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['application'] = $this->Other_info_model->check_student_application($SID,$year);

            $studentData = $this->db->query("SELECT * FROM `student_FTP` WHERE `SID` = '$SID'");
            if($studentData->num_rows()>0){
                $page_data['students'] = $studentData->result_array();
            }


            //print_r($page_data['students']);
            $page_data['maintitle'] = "Assessment";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Assess student";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/student_assess', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }


    //for field selected assessors only
     public function assessor_allocation(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $AID = $page_data['adminstrator']['AID'];
            $pagePath = 'adminstrator/assessor_allocation';
            $secondpagePath = '';

            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['year'] = $year;

            //select the school that assessor have been allocated
            $sData = $this->db->query("SELECT `region` FROM `assessors_alloction`  WHERE `AID`= '$AID' AND `assessors_alloction`.`ac_year` = '$year' GROUP BY region ");
            if($sData->num_rows()>0){
                $page_data['allocated_region'] = $sData->result_array();
                foreach($page_data['allocated_region'] as $myre){
                    $page_data['shoolRe'] = $myre['region'];
                }
            }else{
                $page_data['allocated_region'] = false;
            }

            $schoolDATA = $this->db->query("SELECT school.`district`,school.`region`,`school_reg`,`name` FROM `assessors_alloction` INNER JOIN `school` ON `assessors_alloction`.`school_reg` = `school`.`S_Reg_No`  WHERE `AID`= '$AID' AND `assessors_alloction`.`ac_year` = '$year' ");
            if($schoolDATA->num_rows()>0){
                $page_data['allocated_school'] = $schoolDATA->result_array();
            }else{
                $page_data['allocated_school'] = false;
            }


            $page_data['maintitle'] = "Allocation";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Assesor";
            //print_r($page_data['allocated_school']);
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/assessor_allocation', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }


    //for field selected assessors only
     public function school_assessor($reg=''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $AID = $page_data['adminstrator']['AID'];
            $pagePath = 'adminstrator/assessor_allocation';
            $secondpagePath = '';

            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['year'] = $year;
            $page_data['reg'] = $reg;
            $regNo = str_replace('_', '/', $reg);
            $page_data['regNo'] = $regNo;
            

            $page_data['school_info'] = $this->Other_info_model->get_school_info($regNo);
            foreach($page_data['school_info'] as $school){
                $shool_name = $school['name'];
            }


            $assessor_allocation = $this->db->query("SELECT student_FTP.*,application.* FROM `student_FTP` 
                INNER JOIN `application` ON `student_FTP`.`SID` = `application`.`SID` 
                WHERE `application`.`school_Reg` = '$regNo' AND `application`.`ac_year` = '$year' ");
            if($assessor_allocation->num_rows()>0){
                $page_data['student_application'] = $assessor_allocation->result_array();
            }else{
                $page_data['student_application'] = false;
            }

            $ass_date = $this->db->query("SELECT as_date FROM assessors_alloction WHERE AID = '$AID' AND ac_year = '$year' AND school_reg = '$regNo'");
            if($ass_date->num_rows()>0){
                    $page_data['dates'] = $ass_date->result_array();
            }else{
                $page_data['dates'] = false;
            }

            $page_data['maintitle'] = $shool_name;
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Assesor";
            //print_r($page_data['allocated_school']);
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/school_assessor', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }



    // This for opening school
    public function open_school($s_reg_no = '',$path=''){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $s_reg_no = str_replace('_', '/', $s_reg_no);
            
            $school_subjects = $this->Other_info_model->get_school_subject($s_reg_no);
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['year'] = $year;
            $page_data['back_btn'] = '';
            if($path != ''){
                $page_data['back_btn'] = $path;
            }
            $page_data['school_info'] = $this->Other_info_model->get_school_info($s_reg_no);
            foreach($page_data['school_info'] as $SChool):
                $page_data['category'] = $SChool['category'];
            endforeach;

             //check if there is some subject availabe 
            if($school_subjects){
                $sub_available = " ";
                foreach($school_subjects as $sub):
                $subjectName = $sub['sub_name'];
                $sub_available .= "`university_subjects`.`subject_name` != '".$subjectName."' AND ";
                endforeach;

                $subData = $this->db->query("SELECT * FROM university_subjects WHERE $sub_available `subject_name` != '' ");
                if($subData){
                    $page_data['university_subjects'] = $subData->result_array(); 
                }
            }else{
                $page_data['university_subjects'] = $this->Other_info_model->get_university_offered_subject();
            }
            //print_r($page_data['university_subjects']);
            $page_data['subjects'] = $school_subjects;
            $page_data['s_reg_no'] = $s_reg_no;
            $pagePath = 'adminstrator/school';
            $secondpagePath = 'adminstrator/manage_school';

            $student_application = $this->db->query("SELECT student_FTP.*,application.* FROM application INNER JOIN student_FTP ON application.SID = student_FTP.SID WHERE application.school_Reg = '$s_reg_no' AND ac_year = '$year'");
            if($student_application->num_rows()>0){
                $page_data['student_application'] = $student_application->result_array();
            }else{
                $page_data['student_application'] = false;
            }



            $page_data['regions'] = $this->Other_info_model->get_all_regions();

            $page_data['maintitle'] = 'Institution';
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "manage institution";
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/open_school', $page_data);
	 		$this->bottom_content($page_data);
		}else{
			redirect('Home');
		}
    }

     // This for opening region 
    public function open_region($region = ''){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $region = str_replace('_', ' ', $region);
           $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            
            
            $zones = $this->Other_info_model->get_region_zone($region);
            $zone = $zones['zone_name'];
            $page_data['zone'] = $zone;
            $page_data['region'] = $region;
           // print_r($region);

            //check the assessor if he/she have been allocated to another zone
            $other_zone_allocated = $this->Other_info_model->get_other_zone_instructor($zone,$year);
            if($other_zone_allocated){
            	$data = " ";
            	foreach($other_zone_allocated as $instructor):
            	$AID = $instructor['AID'];
            	$data .= "`adminstrator`.`AID` != '".$AID."' AND ";
            	endforeach;

            	$instructorData = $this->db->query("SELECT * FROM adminstrator WHERE $data `status` = 'Active' ");
            	if($instructorData){
            		$page_data['assessors'] = $instructorData->result_array(); 
            	}

            }else{
                $assessorData = $this->db->query("SELECT * FROM `adminstrator` WHERE `status` = 'Active'");
                if($assessorData){
                    $page_data['assessors'] = $assessorData->result_array();
                }
            }

   			
           //check scholls that have already allocated the assessors
           $allocated_schools = $this->Other_info_model->get_allocated_school($year);

           //check the schools that have field student for this accademic year
           $field_student = $this->Other_info_model->check_student_appliction($year);
           // print_r($field_student);
            if($field_student){
                //find the region of obtained schools

	   			$school_region = $this->Other_info_model->get_region_allocated_school($region,$year);
	   			
                if($school_region){
	            	$Data = " ";
	            	foreach($school_region as $school):
	            	$school_reg = $school['school_reg'];
	            	$Data .= "`application`.`school_Reg` != '".$school_reg."' AND ";
	            	endforeach;

	            	$school_Data = $this->db->query("SELECT DISTINCT `school`.`S_Reg_No`, `school`.`name`,`application`.`school_Reg`,`region`.`region_name` FROM `application` 
													INNER JOIN `school` ON `school`.`S_Reg_No` = `application`.`school_Reg` 
													INNER JOIN `region` ON `school`.`region` = `region`.`region_name`
													WHERE $Data `school`.`region` = '$region' AND `school`.`reachable` = 'YES' AND `ac_year` = '$year' ");
	            	if($school_Data){
	            		$page_data['schools'] = $school_Data->result_array(); 
	            	}

	   			}else{ 
	   				$schoolData = $this->db->query("SELECT  DISTINCT `school`.`S_Reg_No`, `school`.`name`,`application`.`school_Reg`,`region`.`region_name` FROM `application` 
													INNER JOIN `school` ON `school`.`S_Reg_No` = `application`.`school_Reg` 
													INNER JOIN `region` ON `school`.`region` = `region`.`region_name`
													WHERE `school`.`region` = '$region' AND `school`.`reachable` = 'YES' AND `ac_year` = '$year' ");
	   				if($schoolData->num_rows() > 0){
	   					$page_data['schools'] = $schoolData->result_array();
	   				}
	   			}

   		}

   			$myn = $this->db->query("SELECT `fname`,`lname`, school.*, assessors_alloction.* FROM assessors_alloction 
							INNER JOIN `adminstrator` ON `assessors_alloction`.`AID` = `adminstrator`.`AID`
                            INNER JOIN `school` ON `assessors_alloction`.`school_reg` = `school`.`S_Reg_No`
                            WHERE `assessors_alloction`.`region` = '$region' AND `assessors_alloction`.`ac_year` = '$year'");
   			if($myn){
   				$page_data['region_assessors'] = $myn->result_array();
   			}
   		

            $pagePath = 'adminstrator/assessor&allocation';
            $secondpagePath = 'adminstrator/allocation';
            $page_data['maintitle'] = '<strong>'.$region.'</strong> region assessor';
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Allocate assessor";
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/open_region', $page_data);
	 		$this->bottom_content($page_data);
	 		
		}else{
			redirect('Home');
		}
    }




    // This for allocating assessors
    public function allocation(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
         //   $page_data['zones'] = $this->Other_info_model->get_all_zones();

            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            $page_data['zones'] = $this->Other_info_model->check_student_appliction_zone($year);
			//$page_data['regions'] = $this->Other_info_model->get_all_regions();   
            $page_data['checked'] = $this->Other_info_model->check_student_appliction($year);  
          
            $page_data['all_school'] = $this->Other_info_model->check_student_appliction_all_shool($year);
            $page_data['allocated_schools'] = $this->Other_info_model->get_allocated_school($year);
            $pagePath = 'adminstrator/assessor&allocation';
            $secondpagePath = 'adminstrator/allocation';

            
            $page_data['regions'] = $this->Other_info_model->get_all_regions();

            $page_data['maintitle'] = 'Zone group';
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "allocate assessors";
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
           	$this->sideNav($pagePath,$secondpagePath);
           	$this->load->view('adminstrator/allocation', $page_data);
	 		$this->bottom_content($page_data);
                   
		}else{
			redirect('Home');
		}
    }


     // This for allocating assessors
    public function allocated(){
    	//load session library
		$this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['year'] = $year;

            $page_data['region_assessors'] = $this->Other_info_model->all_assessors_info();
   			if($page_data['region_assessors']){
				$count= 0;
				foreach ($page_data['region_assessors'] as $assessor):
					$allocated_school_info = $this->Other_info_model->get_assessor_schools($assessor['AID'],$year);

					if($allocated_school_info){
						array_push($page_data['region_assessors'][$count], $allocated_school_info);
					}else{
						array_push($page_data['region_assessors'][$count], array());
					}
					$count++;
				endforeach;
   			}

   			//print_r($page_data['region_assessors']);
            $pagePath = 'adminstrator/assessor&allocation';
            $secondpagePath = 'adminstrator/allocated';

            $page_data['regions'] = $this->Other_info_model->get_all_regions();

            $page_data['maintitle'] = 'Assessors';
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "allocated assessors";
			
			$this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/allocated', $page_data);
	 		$this->bottom_content($page_data);
	 		
		}else{
			redirect('Home');
		}
    }


 // This if for viewing students logbook 
    public function logbook_view(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $AID = $page_data['adminstrator']['AID'];
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['logbook_school'] = $this->Other_info_model->logbook_marking_view($page_data['adminstrator']['AID'],$year);

            if($page_data['logbook_school']){
                    $count= 0;
                    foreach ($page_data['logbook_school'] as $app):
                        $allocated_school_info = $this->Other_info_model->how_many_times_sch_selected($app['S_Reg_No'],$year);

                        if($allocated_school_info){
                            array_push($page_data['logbook_school'][$count], $allocated_school_info);
                        }else{
                            array_push($page_data['logbook_school'][$count], array());
                        }
                        $count++;
                    endforeach;
                }

            $pagePath = 'adminstrator/marking';
            $secondpagePath = 'adminstrator/logbook_view';

            $page_data['maintitle'] = "Logbook marking";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "List of school";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/logbook_view', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }


    // This if for viewing students reports 
    public function report_view(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $AID = $page_data['adminstrator']['AID'];
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['report_school'] = $this->Other_info_model->report_marking_view($page_data['adminstrator']['AID'],$year);
            
            if($page_data['report_school']){
                    $count= 0;
                    foreach ($page_data['report_school'] as $app):
                        $allocated_school_info = $this->Other_info_model->how_many_times_sch_selected($app['S_Reg_No'],$year);

                        if($allocated_school_info){
                            array_push($page_data['report_school'][$count], $allocated_school_info);
                        }else{
                            array_push($page_data['report_school'][$count], array());
                        }
                        $count++;
                    endforeach;
                }
            $pagePath = 'adminstrator/marking';
            $secondpagePath = 'adminstrator/report_view';

            $page_data['maintitle'] = "Report marking";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "List of school";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/report_view', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }


  // This if for viewing students reports 
    public function report($REG){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['REG'] = $REG; 
            $regNo = str_replace('_', '/', $REG);
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            $page_data['students'] = $this->Other_info_model->get_all_application($regNo,$year);
            
            $pagePath = 'adminstrator/marking';
            $secondpagePath = 'adminstrator/report_view';

            $page_data['maintitle'] = "Report marking";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Add report marks";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/report', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }


    // This if for viewing students logbook 
    public function logbook($REG){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['REG'] = $REG; 
            $regNo = str_replace('_', '/', $REG);
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            $page_data['students'] = $this->Other_info_model->get_all_application($regNo,$year);
            
            $pagePath = 'adminstrator/marking';
            $secondpagePath = 'adminstrator/logbook_view';

            $page_data['maintitle'] = "Logbook marking";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Add logbook marks";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/logbook', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }


   // This if for viewing students logbook 
    public function application_report($program='',$study_year=''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['program'] = $program." year ".$study_year;
            $page_data['applications'] = $this->Other_info_model->get_full_application_report($program,$study_year,$year);
            
            $pagePath = 'adminstrator/index';
            $secondpagePath = '';

            $page_data['maintitle'] = $program." year ".$study_year;
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Student reports";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/application_report', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }

// Gest student requested to cancel their selection
    public function re_application(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $content['application_request'] = $this->Other_info_model->student_application_request($year);

            $pagePath = 'adminstrator/re_application';
            $secondpagePath = '';

            $page_data['maintitle'] = "Cancel selection request";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Re application";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('adminstrator/re_application', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }

    
}

?>
