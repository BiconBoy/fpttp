<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Other_info_model');
    }

    public function index(){
        //load session library
        $this->load->library('session');
        
        $accademic_year = $this->Other_info_model->get_accademic_year();
        $year = $accademic_year['year'];
        $data['year'] = $year;

        $data['title'] = "SMCoSE FPT-TP Login";

        //restrict users to go back to login if session has been set
        if($this->session->userdata('#_AID_SUA')){
            redirect('adminstrator');
        }elseif($this->session->userdata('#_SID_SUA')){
            redirect('student');
        }else{
            
            $this->load->view('login/login_top_content',$data);
            $this->load->view('login/index',$data);
            $this->load->view('login/login_footer_content');
            
        }
    }

    public function new_acount(){
        $data['title'] = "SMCoSE FPT-TP create account";

        //restrict users to go back to login if session has been set
        if($this->session->userdata('admin')){
            redirect('admin');
        }elseif($this->session->userdata('#_SID_SUA')){
            redirect('student');
        }elseif($this->session->userdata('#_AID_SUA')){
            redirect('adminstrator');
        }else{

            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $data['year'] = $year;

            $this->load->view('login/login_top_content',$data);
            $this->load->view('login/create_account',$data);
            $this->load->view('login/login_footer_content');
        }
    }


    //recover password
    public function recover_password(){
        $data['username'] = $_POST['UID'];
        $data['email'] = $this->input->post('email');
        $UID = $data['username'];
        $email = $data['email'];
        //check data in the DB
        $student_result = $this->db->query("SELECT * FROM `student_FTP` WHERE `SID` = '$UID' AND `email` = '$email' OR `Reg_No` = '$UID' AND `email` = '$email'");
        if($student_result->num_rows()>0) {
            $query = $this->db->query("SELECT * FROM student_FTP WHERE SID = '$UID' OR Reg_No = '$UID'");
			$student_info = $query->result_array();
            foreach($student_info as $student){}
                $full_name = $student['lname'].", ".$student['fname']." ".$student['mname'];
            //geneerate tokens
            $permitted_chars = '0123hjkmnKHDGHouyuypq353453m5fUY3hrsj3OPQ3RSTU456789abcde3436fgyzAB87CDEF553353GHIJKLMN436346436VWXYZ';
                    function generate_string($input, $strength = 16) {
                        $input_length = strlen($input);
                        $random_string = '';
                        for($i = 0; $i < $strength; $i++) {
                            $random_character = $input[mt_rand(0, $input_length - 1)];
                            $random_string .= $random_character;
                        }
                        return $random_string;
                    }
                    $token =  generate_string($permitted_chars, 100);
                    $token = strtoupper($token);
                
        $SID = $data['username'];

        $this->db->query("UPDATE student_FTP SET validation = '$token' WHERE SID = '$SID' OR Reg_No = '$SID'");

        $this->load->library('email');

        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'trialbybicon@gmail.com',
            'smtp_pass' => 'bako070595',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent = '

        <html>
<head>
	<title>Email send</title>
</head>
<body style="background:rgba(249, 249, 250,0.9);padding:10px;padding-left:300;padding-right:300">
    
    <div style="background-color:rgba(255, 255, 255);box-shadow: 1px 0px 2px 1px black;border-radius:6px;padding:10px">
       <div style="font-family: Roboto;text-align:center;">
      
            <div style="margin-top:20px;">
                <strong style="font-family:helvetica;">Field Practical Trainning & Teaching Practical SMCoSE FPT-TP system</strong>
                <hr>
            </div>
        </div>
        <div>
        <h3>Dear '.$full_name.' </h3>
        <p style="text-align:center">
            You have asked to reset your password if it was you.. Click the button below to reset your password
        </p>
        <p style="text-align:center">   
            <a href="'.base_url('Home/verify_password/'.$token).'"><button style=" border: 0;line-height: 2.5;padding: 0 20px;font-size: 1rem;text-align: center;color: #fff;text-shadow: 1px 1px 1px #000;border-radius: 10px;background-color: rgba(0, 153, 51);box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),inset -2px -2px 3px rgba(0, 0, 0, .6);cursor: pointer;" type="button"> Reset your password here</button> </a>
        </p>
            
        <div style="text-align:center">
            OR
        </div>
        <p style="text-align:center">
        Click this button to cancel this is for your account security purposes
        </p>
        <p style="text-align:center">
            <a href="'.base_url('Home/cancel_verify_password/'.$token).'"><button style=" border: 0;line-height: 2.5;padding: 0 20px;font-size: 1rem;text-align: center;color: #fff;text-shadow: 1px 1px 1px #000;border-radius: 10px;background-color: rgba(220, 0, 0, 1);box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),inset -2px -2px 3px rgba(0, 0, 0, .6);cursor: pointer;">cancel resetting password</button></a>
        </p>
    
        </div>
              <hr>

        Thanks!<br>
    <strong>SMCoSE FPT-TP online system</strong>

    </div>
                    
                

        
</body>
</html>
        ';


        $this->email->to($data['email']);
        $this->email->from('trialbybicon@gmail.com','SMCoSE FPT-TP');
        $this->email->reply_to('no_reply'); //User email submited in form
        $this->email->subject('SMCoSE FPT-TP Recover your password');
        $this->email->message($htmlContent);

        //Send email
        $send_email = $this->email->send();
        if($send_email){
                 $_SESSION['recover_success'] = "<div class='alert alert-success text-center'>
                              <strong><i class='icon fa fa-check'></i> Success </strong> Go to your email <strong style='cursor:pointer'>".$data['email']." </strong> and recover your password
                            </div> ";
            redirect('Home/forget_password');
        }else{
            $_SESSION['recover_failed'] =  "<div class='alert alert-danger'>
                              <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong><i class='icon fa fa-warning'></i> </strong> No record found.<br>
                              Check your information and try again
                            </div> ";
        }
    
        }else{
            $instructor_result = $this->db->query("SELECT * FROM `adminstrator` WHERE  `email` = '$email';");
            if($instructor_result->num_rows()>0){
                $query = $this->db->query("SELECT * FROM adminstrator WHERE email = '$email'");
			$instructor_info = $query->result_array();
            foreach($instructor_info as $instructor){}
                $full_name = $instructor['lname'].", ".$instructor['fname']." ".$instructor['mname'];
            //geneerate tokens
            $permitted_chars = '0123hjkmnKHDGHouyuypq353453m5fUY3hrsj3OPQ3RSTU456789abcde3436fgyzAB87CDEF553353GHIJKLMN436346436VWXYZ';
                    function generate_string($input, $strength = 16) {
                        $input_length = strlen($input);
                        $random_string = '';
                        for($i = 0; $i < $strength; $i++) {
                            $random_character = $input[mt_rand(0, $input_length - 1)];
                            $random_string .= $random_character;
                        }
                        return $random_string;
                    }
                    $token =  generate_string($permitted_chars, 100);
                    $token = strtoupper($token);
                
        $SID = $data['username'];

        $this->db->query("UPDATE adminstrator SET validation = '$token' WHERE email = '$email'");

        $this->load->library('email');

        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'trialbybicon@gmail.com',
            'smtp_pass' => 'bako070595',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent = '
                <html>
<head>
	<title>Email send</title>
</head>
<body style="background:rgba(249, 249, 250,0.9);padding:10px;padding-left:300;padding-right:300">
    
    <div style="background-color:rgba(255, 255, 255);box-shadow: 1px 0px 2px 1px black;border-radius:6px;padding:10px">
       <div style="font-family: Roboto;text-align:center;">
            <div style="margin-top:20px;">
                <strong style="font-family:helvetica;">Field Practical Trainning & Teaching Practical SMCoSE FPT-TP system</strong>
                <hr>
            </div>
        </div>
        <div>
        <h3>Dear '.$full_name.' </h3>
        <p style="text-align:center">
            You have asked to reset your password if it was you.. Click the button below to reset your password
        </p>
        <p style="text-align:center">   
            <a href="'.base_url('Home/verify_password/'.$token).'"><button style=" border: 0;line-height: 2.5;padding: 0 20px;font-size: 1rem;text-align: center;color: #fff;text-shadow: 1px 1px 1px #000;border-radius: 10px;background-color: rgba(0, 153, 51);box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),inset -2px -2px 3px rgba(0, 0, 0, .6);cursor: pointer;" type="button"> Reset your password here</button> </a>
        </p>
            
        <div style="text-align:center">
            OR
        </div>
        <p style="text-align:center">
        Click this button to cancel this is for your account security purposes
        </p>
        <p style="text-align:center">
            <a href="'.base_url('Home/cancel_verify_password/'.$token).'"><button style=" border: 0;line-height: 2.5;padding: 0 20px;font-size: 1rem;text-align: center;color: #fff;text-shadow: 1px 1px 1px #000;border-radius: 10px;background-color: rgba(220, 0, 0, 1);box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),inset -2px -2px 3px rgba(0, 0, 0, .6);cursor: pointer;">cancel resetting password</button></a>
        </p>
    
        </div>
              <hr>

        Thanks!<br>
    <strong>SMCoSE FPT-TP online system</strong>

    </div>
                    
                

        
</body>
</html>
        ';


        $this->email->to($data['email']);
        $this->email->from('trialbybicon@gmail.com','SMCoSE FPT-TP');
        $this->email->reply_to('no_reply'); //User email submited in form
        $this->email->subject('SMCoSE FPT-TP Recover your password');
        $this->email->message($htmlContent);

        //Send email
        $send_email = $this->email->send();
        if($send_email){
                 $_SESSION['recover_success'] = "<div class='alert alert-success text-center'>
                              <strong><i class='icon fa fa-check'></i> Success </strong> Go to your email <strong style='cursor:pointer'>".$data['email']." </strong> and recover your password
                            </div> ";
            redirect('Home/forget_password');
        }else{
            $_SESSION['recover_failed'] =  "<div class='alert alert-danger'>
                              <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong><i class='icon fa fa-warning'></i> </strong> No record found.<br>
                              Check your information and try again
                            </div> ";
        }

            }else{

                $_SESSION['recover_failed'] =  "<div class='alert alert-danger'>
                              <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong><i class='icon fa fa-warning'></i> </strong> No record found.<br>
                              Check your information and try again
                            </div> ";
            redirect('Home/forget_password');

            }
        }  
    
    }


     public function reset_password(){
        $password = $this->input->post('password');
        $UID = $this->input->post('UID');
        $user = $this->input->post('user');
        $password = md5($password);
        if($user == 'student_FTP'){
            $query = $this->db->query("UPDATE student_FTP SET password = '$password' WHERE SID = '$UID'");
            if($query){
                $this->db->set('validation','-');
                $this->db->where('SID',$UID);
                $this->db->update('student_FTP');
                $_SESSION['reset_success'] = "OK";
                redirect('');
            }else{
                $_SESSION['reset_failed'] = "<div class='alert alert-danger'>
                                    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                    <strong><i class='icon fa fa-danger'></i> </strong> Failed to reset the password please reflesh the page or <a href='".base_url('Home/forget_password')."'> click here </a> to repeat the procedure
                                    </div> ";
                redirect('');
            }
        }else{

            $query = $this->db->query("UPDATE adminstrator SET password = '$password' WHERE AID = '$UID'");
            if($query){
                $this->db->set('validation','-');
                $this->db->where('AID',$UID);
                $this->db->update('adminstrator');
                $_SESSION['reset_success'] = "OK";
                redirect('');
            }else{
                $_SESSION['reset_failed'] = "<div class='alert alert-danger'>
                                    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                    <strong><i class='icon fa fa-danger'></i> </strong> Failed to reset the password please reflesh the page or <a href='".base_url('Home/forget_password')."'> click here </a> to repeat the procedure
                                    </div> ";
                redirect('');
            }
        }
        
    }


    public function cancel_verify_password($code=''){
        //if the code exist
        $this->db->where('validation',$code);
        $check = $this->db->get('student_FTP');
        if($check->num_rows()){
            $check = $check->result_array();
            foreach($check as $student_data){}
                $SID = $student_data['SID'];
                $this->db->set('validation','-');
                $this->db->where('SID',$SID);
                $this->db->update('student');
                $_SESSION['reset_canceled'] = "OK";
                redirect('');
        }else{
            $this->db->where('validation',$code);
            $check = $this->db->get('adminstrator');
            if($check->num_rows()){
                $check = $check->result_array();
                foreach($check as $student_data){}
                    $AID = $student_data['AID'];
                    $this->db->set('validation','-');
                    $this->db->where('AID',$AID);
                    $this->db->update('adminstrator');
                    $_SESSION['reset_canceled'] = "OK";
                    redirect('');
            }else{
                $_SESSION['token_used'] = "OK";
                redirect('');
            }
        }
    }


       //verify password from the email link
    public function verify_password($code=''){
        //if the code exist
        $this->db->where('validation',$code);
        $check = $this->db->get('student_FTP');
        if($check->num_rows()){
            $check = $check->result_array();
            foreach($check as $student_data){}
                $data['UID'] = $student_data['SID'];
                $data['user'] = 'student_FTP';
        }else{
             $this->db->where('validation',$code);
            $check = $this->db->get('adminstrator');
            if($check->num_rows()){
                $check = $check->result_array();
                foreach($check as $student_data){}
                    $data['UID'] = $student_data['AID'];
                    $data['user'] = 'adminstrator';
            }else{
                $_SESSION['token_used'] = "OK";
                redirect('/');
            }
        }

        $this->load->view('login/login_top_content');
        $this->load->view('login/verify_password',$data);
        $this->load->view('login/login_footer_content');
    }



      public function forget_password(){
        //restrict users to go back to login if session has been set
        if($this->session->userdata('#_AID_SUA')){
            redirect('student');
        }elseif($this->session->userdata('#_AID_SUA')){
            redirect('adminstrator');
        }else{
            $this->load->view('login/login_top_content');
            $this->load->view('login/forget_password');
            $this->load->view('login/login_footer_content');
        }
    }

    public function login(){
     
        //load session library
        $this->load->library('session');

        $output = array('error' => false);

        $student = $this->input->post('UID');
        $teacher = $_POST['UID'];
        $password = $this->input->post('password');
        $password = md5($password);

        
        $accademic_year = $this->Other_info_model->get_accademic_year();
        $year = $accademic_year['year'];
    //student login
        $sql = $this->db->query("SELECT * FROM student_FTP WHERE `SID` = '$student' and password = '$password' and accademic_year = '$year'; ");
            if($sql->num_rows()>0){
                    $data = $sql->row_array();
                    setcookie("User_Tem", "online", time()+10800);
                    $_SESSION["log+student_FTP"] = "online";//these for testing login
                    $this->session->set_userdata('#_SID_SUA',$data);
                    $_SESSION['login_success'] = "YES___";
                    redirect('Student');
            }else {
                //login to adminstrator table
                $sql = $this->db->query("SELECT * FROM adminstrator WHERE 
                                            AID = '$teacher' and password = '$password'
                                         or email = '$teacher' and password = '$password'; ");
                if($sql->num_rows() > 0){
                        $data = $sql->row_array();
                        if($data['status'] == 'Active'){
                            setcookie("User_Tem", "online", time()+10800);
                            $_SESSION["log+adminstrator"] = "online";//these for testing login
                            $this->session->set_userdata('#_AID_SUA',$data);
                            $_SESSION['login_success'] = "YES___";
                            redirect('adminstrator');
                        }else{
                            //blocked
                            $_SESSION['account_blocked'] = "<div class='alert alert-warning'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-danger'></i> </strong> You are account is temporary blocked
							</div> ";
                            redirect('Home');
                        }
                    }
                else{
                    //this mean fail to login
                    $_SESSION['login_failed'] = "<div class='alert alert-warning'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> Incorect username or password
							</div> ";
                    redirect('Home');
                }


            }
        
    }
    
    public function create_new_acount(){
     
        //load session library
        $this->load->library('session');

        $output = array('error' => false);
        $accademic_year = $this->Other_info_model->get_accademic_year();
        $year = $accademic_year['year'];
        $data['year'] = $year;
        $student = $_POST['UID'];
        $password = $_POST['password'];
        $password = md5($password);

    //student login
        $sql = $this->db->query("SELECT * FROM student WHERE `SID` = '$student' and password = '$password' and status = 'Continuing'; ");
            if($sql->num_rows() > 0){
                $data = $sql->row_array();
                $Reg_No = $data['Reg_No'];
                $accademic_year = "$year";
                $fname = $data['fname'];
                $mname  = $data['mname'];
                $lname  = $data['lname'];
                $sex = $data['sex'];
                $study_year = $data['year'];
                $phone  = $data['contact'];
                $email = $data['email'];
                $program  = $data['program'];
                $category  = $data['category'];

                $FTP_username = str_replace('/', '.', $Reg_No);
                $new_year = explode('-',$year);
                $FTP_username = $FTP_username.".".end($new_year);
                $check_student = $this->db->query("SELECT * FROM `student_FTP` WHERE SID = '$FTP_username' and `Reg_No` = '$Reg_No' and `accademic_year` = '$accademic_year'");
                if($check_student->num_rows() > 0){
                    
                     $_SESSION['account_exist'] = "<div class='alert alert-warning'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> Account aready exist
							</div> ";
                    redirect('Home/new_acount');
                }else{


                    $permitted_chars = '0123hJKM@KHDGH&UY#@353453@M5FUY3HRSJ3P@Q3RSTU4567E#89ABCDE#3436F@GYZAB87#CDEF553353GHIJ#MN43634#6436VWXYZ@#';
                    function generate_string($input, $strength = 16) {
                        $input_length = strlen($input);
                        $random_string = '';
                        for($i = 0; $i < $strength; $i++) {
                            $random_character = $input[mt_rand(0, $input_length - 1)];
                            $random_string .= $random_character;
                        }
                        return $random_string;
                    }
                    $pass =  generate_string($permitted_chars, 6);
                    
                    $password = md5($pass);

                    $query = $this->db->query("INSERT INTO `student_FTP`(`SID`,`fname`,`mname`,`lname`,`sex`,`contact`, `Reg_No`, `password`, `accademic_year`,`email`,`program`,category,study_year)
                                            VALUES ('$FTP_username','$fname', '$mname', '$lname', '$sex', '$phone', '$Reg_No','$password','$accademic_year','$email','$program','$category','$study_year') ");
                    if($query){
                        $this->db->where('SID',$student);
                        $this->db->delete('student');
                        
                        $_SESSION['account_credential'] = '
                           
                                <p>
                                Your FTP username : <strong>'.$FTP_username.'</strong><br>Your FTP password: <strong>'.$pass.'</strong>
                                </p>
                                <p>
                                    Do not show or share with anyone your SMCoSE FPT-TP cridentials
                                </p>
                                <p class="text-center">
                                    <a href="'.base_url('Home/logout').'">
                                        <button type="button" class="btn btn-primary">CONTINUE.. CLICK TO LOGIN </button>
                                    </a>
                                </p>
                        ';
                        redirect('Home/new_acount');
                    }
                    
                }

                
            }else {
                    $_SESSION['account_error'] = "<div class='alert alert-danger'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> No record found <br>
                                    Enter your details correctly
                                        for example <br>
                                        Reg No EAB/D/2017/xxxx password EABxxx
							</div> ";
                    redirect('Home/new_acount');

                }


        }
    


    public function logout(){
        //load session library
        if(isset($_SESSION['account_credential'])):
            unset($_SESSION['account_credential']);
        endif;
        $this->load->library('session');
        $this->session->unset_userdata('#_SID_SUA');
        $this->session->unset_userdata('#_AID_SUA');
        redirect('/');
    }

}
