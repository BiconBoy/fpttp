<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Delating extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Home_model');
		$this->load->model('Admin_info_model');
		$this->load->model('Other_info_model');
	
		$this->load->library('upload'); //load library upload 
		$this->load->library('session');
		
    }


     	// for adding zone
     public function delate_subject(){
     	echo "string";
     	/*
    	if($this->session->userdata('#_AID_SUA')  and isset($_POST['zone_name'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	/*
            	$accademic_year = $this->db->Other_info_model->get_current_year();
            	$year = $accademic_year['year'];

            	$ID = $this->input->post('ID');
            	$subname = $this->input->post('subname');
            	$reg_no = $this->input->post('reg_no');

            	$check = $this->db->Other_info_model->check_subject($year,$subname,$reg_no);
            	if($check){
            		echo "Subject exist";
            	}else{
            		echo "Delete";
            	}
	
            	echo "string";

            endif;
         }else{
         	redirect('Home');
         }
         */
    }







}