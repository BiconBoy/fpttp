<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SUA_FTP_home extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

public function index(){
	 //load session library
       // $this->load->library('session');

        /*
        $content['logoname'] = $this->Home_model->get_logo();
        $content['headers'] = $this->Home_model->get_page('Header');
        $content['Footer'] = $this->Home_model->get_page('Footer');
        
        $content['logopath'] = base_url()."assets/icon/logo/".$content['logoname'];
*/

        $data['title'] = "Home page";
/*
        //restrict users to go back to login if session has been set
        if($this->session->userdata('admin')){
            redirect('admin');
        }elseif($this->session->userdata('SRMS_student')){
            redirect('student');
        }elseif($this->session->userdata('SRMS_teacher')){
            redirect('teacher');
        }else{
        	*/
            $this->load->view('login/login_top_content');
            $this->load->view('login/index', $data);
            $this->load->view('login/login_footer_content');
      //  }
}









}


?>