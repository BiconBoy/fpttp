<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Home_model');
        $this->load->model('Other_info_model');
        $this->load->model('Student_info_model');
        /*
        $this->load->model('Teacher_model');
		$this->load->model('Student_model');
        */


		$this->load->library('upload'); //load library upload 
    }
    

    public function top_Content($page_data=''){
        if($this->session->userdata('#_SID_SUA')){

            $content['student'] = $this->session->userdata('#_SID_SUA');
    
            $this->load->view('student/includes/header',$content);  
        }else{
            exit("nodirect access");
        }
    }

    public function navigation($page_data=''){
        if($this->session->userdata('#_SID_SUA')){

            $content['student'] = $this->session->userdata('#_SID_SUA');
    
            $this->load->view('student/includes/navigation',$content);  
        }else{
            exit("nodirect access");
        }
    }
    
	public function bottom_content($page_data=''){
        if($this->session->userdata('#_SID_SUA')){
            $content['student'] = $this->session->userdata('#_SID_SUA');
    
            $this->load->view('student/includes/footer',$content);   
        }else{
            exit("nodirect access");
        }

    }
    
    
    //geting sidenav content
    public function sideNav($pagePath='',$secondpagePath = ''){
        if($this->session->userdata('#_SID_SUA')){
            $content['pagePath'] = $pagePath;
            $content['secondpagePath'] = $secondpagePath;
            $content['student'] = $this->session->userdata('#_SID_SUA');
            extract($content['student']);
            $SID = $content['student']['SID'];
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            //chek result
            $content['results'] = $this->Other_info_model->get_student_report_($SID,$year);
            
				//check if ther is new result
				//$content['results'] = $this->Student_model->get_result_list($content['student']['SID'],'DESC');
				//end of finding new result

    
            $this->load->view('student/includes/sidenav',$content);   
        }else{
            exit("nodirect access");
        }

	}



// for the home page
	public function index(){
		//load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
            $SID = $page_data['student']['SID'];
             $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];;
            
            $this->db->where('request_SID',$SID);
            $check = $this->db->get('app_field_request');
            if($check->num_rows()>0):
                $page_data['app_field_request'] = $check->result_array();
            else:
                $page_data['app_field_request'] = false;
            endif;

            //check arrive note status
              $arrive_note = $this->db->query("SELECT deadline FROM `accademic_year` WHERE  `accademic_year`.`year` = '$year' AND arrive_note_status = 'YES' ");
            if($arrive_note->num_rows()>0){
                $page_data['arrive_note'] = $arrive_note->result_array();
            }else{
                $page_data['arrive_note'] = false;
            }

            //check re application status
            $page_data['re_application'] = $this->Other_info_model->application_request($SID,$year);

            //check privalage students
            $page_data['institution_prevalage'] = $this->Other_info_model->get_priority_student($SID);

           

             //check if application window is opened
            $page_data['applicatio_window'] = $this->Other_info_model->check_application_window($year);
             //check if student has alredy sellected the field
             $page_data['field_selected'] = $this->Other_info_model->check_student_application($SID,$year);
            if($page_data['field_selected']): 
                foreach($page_data['field_selected'] as $regNO){}
            $page_data['other_student'] = $this->Other_info_model->other_student($SID,$regNO['school_Reg'],$year);
             //assessor allocated
            $s_reg_no = $regNO['school_Reg'];
            $assessor_allocated = $this->db->query("SELECT adminstrator.*,assessors_alloction.* FROM assessors_alloction INNER JOIN adminstrator ON assessors_alloction.AID = adminstrator.AID WHERE assessors_alloction.school_Reg = '$s_reg_no' AND ac_year = '$year'");
            if($assessor_allocated->num_rows()>0){
                $page_data['assessor_allocated'] = $assessor_allocated->result_array();
            }else{
                $page_data['assessor_allocated'] = false;
            }

            
            //assessment date
            $assessment_date = $this->db->query("SELECT as_date FROM assessors_alloction WHERE assessors_alloction.school_Reg = '$s_reg_no' AND ac_year = '$year'");

            if($assessment_date->num_rows()>0){
                $page_data['assessment_date'] = $assessment_date->result_array();
            }else{
                $page_data['assessment_date'] = false;
            }
            endif; 

             if($page_data['field_selected']): 
                $count= 0;
                foreach ($page_data['field_selected'] as $field):
                    $schools = $this->Other_info_model->get_school_info($field['school_Reg']);

                    if($schools){
                        array_push($page_data['field_selected'][$count], $schools);
                    }else{
                        array_push($page_data['field_selected'][$count], array());
                    }
                    $count++;
                endforeach;
             endif;

     

            //print_r($page_data['field_selected'] );
            $pagePath = 'student/index';
            $secondpagePath = 'student/index';

            $page_data['maintitle'] = "Student";
            $page_data['title'] = "Student";
            $page_data['subtitle'] = "Dashboard";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/index', $page_data);
	 		$this->bottom_content($page_data);

            
		}else{
			redirect('Home');
		}
    }
//for viewing profiles 
        public function profile(){
            //load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
            
            $pagePath = 'student/index';
            $secondpagePath = 'student/profile';


            $page_data['maintitle'] = "Profile";
            $page_data['title'] = "Student";
            $page_data['subtitle'] = "Profile";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/profile', $page_data);
            $this->bottom_content($page_data);

            
        }else{
            redirect('Home');
        }
    }   


     public function field_request(){
            //load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $SID = $page_data['student']['SID'];
            
            $this->db->where('request_SID',$SID);
            $check = $this->db->get('app_field_request');
            if($check->num_rows()>0):
                $page_data['app_field_request'] = $check->result_array();
            else:
                $page_data['app_field_request'] = false;
            endif;


            $subject  = $this->db->get('university_subjects');
            if($subject->num_rows()>0){
                $page_data['inst_subject'] = $subject->result_array();
            }else{
                $page_data['inst_subject'] = false;
            }



            
            $pagePath = 'student/index';
            $secondpagePath = '';
            $page_data['maintitle'] = "FPT/TP station request";
            $page_data['title'] = "Student";
            $page_data['subtitle'] = "Form";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/field_request', $page_data);
            $this->bottom_content($page_data);

            
        }else{
            redirect('Hmoe');
        }
    }   

    public function select_field(){
            //load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
            $category = $page_data['student']['category'];

            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $page_data['year'] = $year;

            //check if application window is opened
            $page_data['applicatio_window'] = $this->Other_info_model->check_application_window($year);


             $SID = $page_data['student']['SID'];
             //check if student has alredy sellected the field
             $page_data['field_selected'] = $this->Other_info_model->check_student_application($SID,$year);

             if($page_data['field_selected']): 
                $count= 0;
                foreach ($page_data['field_selected'] as $field):
                    $schools = $this->Other_info_model->get_school_info($field['school_Reg']);
                    if($schools){
                        array_push($page_data['field_selected'][$count], $schools);
                    }else{
                        array_push($page_data['field_selected'][$count], array());
                    }
                    $count++;
                endforeach;
             endif;

     
             $page_data['zones'] = $this->Other_info_model->get_all_zones();

             if($page_data['zones']): 
                $count= 0;
                foreach ($page_data['zones'] as $zone):
                    $regions = $this->Other_info_model->get_zone_reagion_listing($zone['name'],$category);
                    if($regions){
                        array_push($page_data['zones'][$count], $regions);
                    }else{
                        array_push($page_data['zones'][$count], array());
                    }
                    $count++;
                endforeach;
             endif;

            $pagePath = 'student/field';
            $secondpagePath = 'student/select_field';


            $page_data['maintitle'] = "Zone list";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "field";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/select_field', $page_data);
            $this->bottom_content($page_data);

            
        }else{
            redirect('Home');
        }
    }


    // student open region
    public function open_region($region = ''){
            //load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
            $region = str_replace('_', ' ', $region);

            //check theq1   q12
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $category = $page_data['student']['category'];
            $SID = $page_data['student']['SID'];

             //check if application window is opened
            $page_data['applicatio_window'] = $this->Other_info_model->check_application_window($year);
             //check if student has alredy sellected the field
             $page_data['field_selected'] = $this->Other_info_model->check_student_application($SID,$year);
            if($page_data['field_selected']){
                redirect('student/select_field');
            }

            //check privalage students
            $page_data['institution_prevalage'] = $this->Other_info_model->get_priority_student($SID);
            $page_data['region_school'] = $this->Other_info_model->select_region_school($region,$category);

            if($page_data['region_school']):
                $count= 0;
                $start = 1;
                foreach ($page_data['region_school'] as $school):
                    $selected_times = $this->Other_info_model->how_many_times_sch_selected($school['S_Reg_No'],$year);
                    $page_data['subjects'] = $this->Other_info_model->get_all_school_subject();

                    if($selected_times){
                        array_push($page_data['region_school'][$count], $selected_times);
                    }else{
                        array_push($page_data['region_school'][$count], array());
                    }
                    $count++;
                endforeach;
            endif;


            $pagePath = 'student/field';
            $secondpagePath = 'student/select_field';


            $page_data['maintitle'] = "<strong>".$region."</strong> region institutions";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "field";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/open_region', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }


    public function sugest_field_area(){
            //load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
           
            $page_data['regions'] = $this->Other_info_model->get_all_regions();
            $pagePath = 'student/field';
            $secondpagePath = 'student/sugest_field_area';

            $page_data['sugested_school'] = $this->Other_info_model->get_all_school_suggested_school();
            $page_data['maintitle'] = "Suggestion";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "field";

            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/sugest_field_area', $page_data);
            $this->bottom_content($page_data);

            
        }else{
            redirect('Home');
        }
    }
    // This for sugested school view
    public function change_password(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            $page_data['student'] = $this->session->userdata('#_SID_SUA');

            $pagePath = 'student/password';
            $secondpagePath = '';

            $page_data['maintitle'] = "student";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "change password";
            
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/change_password', $page_data);
            $this->bottom_content($page_data);
        }else{
            redirect('Home');
        }
    }

public function student_renew_password(){
        if($this->session->userdata('#_SID_SUA') ){
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
            $SID = $page_data['student']['SID'];
            
            $new_pass =$this->input->post('new_pass');
            $old_pass = $this->input->post('old_pass');
            $old_pass = md5($old_pass); 
            
                $checkData = $this->Student_info_model->get_account($SID,$old_pass);
                if(!$checkData){
                    //incorrect old passwordSID
                    echo "2";
                }else{
                    //correct old password. now ready for newone
                    $data['password'] = md5($new_pass);
                    $data['SID'] = $SID;
                    $this->db->where('SID',$SID);
                    $query=$this->db->update('student_FTP', $data);
                    if($query){
                        $data  = $this->Student_info_model->student_details($SID);
                        $this->session->unset_userdata('#_SID_SUA');
                        $this->session->set_userdata('#_SID_SUA',$data);
                        echo  '1';

                    }else{
                        echo  '3';
                    }
                    
                }//end of newpass registration
        }else{
            echo "Bad Access";
        }
    }

// get all student field results
    public function result(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_SID_SUA')){
            $page_data['student'] = $this->session->userdata('#_SID_SUA');
            $SID = $page_data['student']['SID'];
            $pagePath = 'student/result';
            $secondpagePath = '';
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

            //chek result
            $page_data['results'] = $this->Other_info_model->get_student_report_($SID,$year);

            $page_data['maintitle'] = "Student results";
            $page_data['title'] = "Home";
            $page_data['subtitle'] = "Field Results";
            
            $this->top_Content($page_data);
            $this->navigation($page_data);
            $this->sideNav($pagePath,$secondpagePath);
            $this->load->view('student/result', $page_data);
            $this->bottom_content($page_data);
            
        }else{
            redirect('Home');
        }
    }



    
}

?>
