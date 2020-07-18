<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inserting extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Home_model');
		$this->load->model('Admin_info_model');
        $this->load->model('Other_info_model');
		$this->load->library('upload'); //load library upload 
		$this->load->library('session');
    }

    public function submit_instructor_form(){
    	if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):

                $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$permitted_num = '0123456789';
				function generate_string($input, $strength = 16) {
					$input_length = strlen($input);
					$random_string = '';
					for($i = 0; $i < $strength; $i++) {
						$random_character = $input[mt_rand(0, $input_length - 1)];
						$random_string .= $random_character;
					}
					return $random_string;
				}
				 
				// Output: iNCHNGzByPjhApvn7XB
				$Spart = generate_string($permitted_num, 4 );
				

            	$AID = "SUA/".date('Y')."/".$Spart;
            	$data['fname'] = $this->input->post('fname');
            	$data['mname'] = $this->input->post('mname');
            	$data['lname'] = $this->input->post('lname');
            	$data['email'] = $this->input->post('email');
            	$data['image'] = $this->input->post('image');
            	$data['contact'] = $this->input->post('contact');
            	$data['sex'] = $this->input->post('sex');
            	$data['password'] = md5('1234');
            	$data['experience'] = '';
            	$data['skills'] = '';
            	$data['status'] = 'Active';
            	$data['reg_time'] = '';
            	$data['reg_time'] = date('F d, Y');
                
            	$check = $this->db->query("SELECT * FROM `adminstrator` WHERE `AID` = '$AID'");
            	if($check->num_rows() > 0){
            		echo '<div class="alert alert-warning alert-dismissible">
										<button type="button" onclick=" window.location.reload()" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<strong> <i class="fa fa-warning"></i> Process Failed</strong> instructor with such ID account arleady created please check your data and try again
									</div>';
            	}else{
            		$data['AID'] = $AID; 
            		$query = $this->db->insert('adminstrator', $data);
					if($query){
						echo  '1';
					}else{
						echo  '2';
					}
				
            	}
            endif;
        }else{
        	redirect('Home');
        }
    }

    	// for adding zone
     public function add_zone(){
    	if($this->session->userdata('#_AID_SUA')  and isset($_POST['zone_name'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	
            	$zone_name = $this->input->post('zone_name');
            	

            	$check = $this->db->query("SELECT * FROM `zone` WHERE `name` = '$zone_name'");
            	if($check->num_rows() > 0){
            		echo '2';
            	}else{
            		$data['name'] = $zone_name; 
            		$data['I_ID'] = '';

            		$query = $this->db->insert('zone', $data);
            		if($query){
            			echo '1';
            		}else{
            			echo '3';
            		}
            	}


            endif;
         }else{
         	redirect('Home');
         }
    }

    public function add_subject(){
    	if($this->session->userdata('#_AID_SUA')  and isset($_POST['subject_name'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	
            	$name = $this->input->post('subject_name');
            	

            	$check = $this->db->query("SELECT * FROM `university_subjects` WHERE `subject_name` = '$name'");
            	if($check->num_rows() > 0){
            		$_SESSION['subject_exist'] = "Sorry subject arleady exist";
                    redirect('adminstrator/subjects');
            	}else{
            		$data['subject_name'] = $name; 

            		$query = $this->db->insert('university_subjects', $data);
            		if($query){
            			$_SESSION['subject_success'] = "Successiful new subject added";
                        redirect('adminstrator/subjects');
            		}else{
            			$_SESSION['subject_failed'] = "Error occured while adding new subject";
                        redirect('adminstrator/subjects');
            		}
            	}


            endif;
         }else{
         	redirect('Home');
         }
    }

    //for adding privallages
         public function add_prevalage(){
        if($this->session->userdata('#_AID_SUA')  and isset($_POST['prevalage']) and isset($_POST['AID'])){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $prevs = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
                $GRANTED = true;
            }else{$GRANTED = false; }
                
            if($GRANTED ){
                
                $access_ID = $this->input->post('prevalage');
                $AID = $this->input->post('AID');
                

                $check = $this->db->query("SELECT * FROM `adminstrator_access` WHERE `AID` = '$AID' AND access_ID = '$access_ID'");
                if($check->num_rows() > 0){
                    echo '2';
                }else{
                    $data['id'] = '';
                    $data['AID'] = $AID; 
                    $data['access_ID'] = $access_ID;

                    $query = $this->db->insert('adminstrator_access', $data);
                    if($query){
                        echo '1';
                    }else{
                        echo '3';
                    }
                }
             }else{
            redirect('Home');
         }

         }else{
            redirect('Home');
         }
    }


    public function field_request_form(){
    	if($this->session->userdata('#_SID_SUA')  and isset($_POST['name']) and isset($_POST['coordinator'])){	
                $accademic_year = $this->Other_info_model->get_accademic_year();
                $year = $accademic_year['year'];
                $page_data['student'] = $this->session->userdata('#_SID_SUA');

                $data['id'] = '';
                $data['institution_name'] = $this->input->post('name');
                $data['address'] = $this->input->post('address');
                $data['region'] = $this->input->post('region');
                $data['district'] = $this->input->post('district');
                $data['coordinator'] = $this->input->post('coordinator');
                $data['coordinator_contact'] = $this->input->post('coordinator_contact');
                $data['office_contact'] = $this->input->post('office_contact');
                $data['ward'] = $this->input->post('ward');
                $data['status'] = 'pending';
            	$data['ac_year'] = $year;
                $data['request_SID'] = $page_data['student']['SID'];
                //$student = explode(',',$data['students']);

                if($page_data['student']['category'] == 'EDU')
                {
                    $subjects = $_POST['subject'];
                }

                $students = $_POST['students'];
                $regNo = $_POST['regNo'];
                $data['students'] = '';
                $no = 0;
                $total = 0;
                 foreach($students as $t){$total++;}
                foreach($students as $student => $value){$no++;
                            $data['students'] .= $value. " ";
                    
                    foreach($regNo as $reg => $regvalue){
                        if($student == $reg){
                            $data['students'] .= $regvalue. " ";
                        }
                    }

                    if($page_data['student']['category'] == 'EDU')
                    {
                        foreach($subjects as $subject => $subvalue){
                            if($student == $subject){
                                if($total == $no){
                                    $data['students'] .= $subvalue;
                                }else{
                                    $data['students'] .= $subvalue. "<br>";
                                }
                                
                            }
                        }
                    }


                }


                $full_name = $page_data['student']['lname'].", ".$page_data['student']['fname']." ".$page_data['student']['mname'];

                $insert_data = $this->db->insert('app_field_request',$data);
                if($insert_data){

                $access_info = $this->Admin_info_model->get_assistant_admin_access();
                if($access_info):
                foreach($access_info as $info){
                $email = $info['email'];
                $admin_name = $info['lname'].", ".$info['fname']." ".$info['mname'];

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
                    <h3>Dear '.$admin_name.' </h3>
                    <p style="text-align:center">
                        <strong>'.$full_name.'</strong> ask you to prepare the field request letter for the following information
                    </p>
                    <strong>Institution details</strong>
                    <p>
                        <strong>Name: </strong>'.$data['institution_name'].'<br>
                        <strong>Location: </strong>'.$data['region'].'  '.$data['district'].'  '.$data['ward'].'<br>
                        <strong>Office Contact: </strong>'.$data['office_contact'].'<br>
                        <strong>Office address: </strong>'.$data['address'].'
                    </p>
                    <strong>Student Information</strong>
                    <p>
                        '.$data['students'].'
                    </p>
                        
                    <div style="text-align:center">
                        OR
                    </div>
                    <p style="text-align:center">
                    Click this button to to login in your SMCoSE FPT-TP account for more details
                    </p>
                    <p>
                        <a href="'.base_url().'"><button style=" border: 0;line-height: 2.5;padding: 0 20px;font-size: 1rem;text-align: center;color: #fff;text-shadow: 1px 1px 1px #000;border-radius: 10px;background-color: rgba(0, 153, 51);box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),inset -2px -2px 3px rgba(0, 0, 0, .6);cursor: pointer;" type="button"> Login to your account</button> </a>
                    </p>
                
                    </div>
                        <hr>

                    Thanks!<br>
                <strong>SMCoSE FPT-TP online system</strong>

                </div>
                                
                            

                    
            </body>
            </html>
                    ';


        $this->email->to($email);
        $this->email->from('trialbybicon@gmail.com','SMCoSE FPT-TP');
        $this->email->reply_to('no_reply'); //User email submited in form
        $this->email->subject('SMCoSE FPT-TP field letter request');
        $this->email->message($htmlContent);

        //Send email
        $send_email = $this->email->send();
    }
        $_SESSION['appl_success'] = "Dear <strong>".$full_name."</strong> your request submited successful, you will be notfied soon";
        redirect('student/field_request');
    else:
        $_SESSION['appl_success'] = "Dear <strong>".$full_name."</strong> your request submited successful, you will be notfied soon";
        redirect('student/field_request');
    endif;
    }else{
        $_SESSION['appl_error'] = "Dear <strong>".$full_name."</strong> Error occured while sending your form";
        redirect('student/field_request');
    }
         	
            
         }else{
         	redirect('/');
         }
    }

    	// for adding region
     public function add_region(){
    	if($this->session->userdata('#_AID_SUA')  and isset($_POST['zone']) and isset($_POST['region'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	
            	$region = $this->input->post('region');
            	

            	$check = $this->db->query("SELECT * FROM `region` WHERE `region_name` = '$region'");
            	if($check->num_rows() > 0){
            		echo '2';
            	}else{
            		$data['region_name'] = $region; 
            		$data['zone_name'] = $this->input->post('zone');

            		$query = $this->db->insert('region', $data);
            		if($query){
            			echo '1';
            		}else{
            			echo '3';
            		}
            	}
            endif;
         }else{
         	redirect('Home');
         }
    }

    // for adding schols
     public function add_school(){
    	if($this->session->userdata('#_AID_SUA')  and isset($_POST['category']) and isset($_POST['school_name']) and isset($_POST['contact']) ){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	
            	$school_name = $this->input->post('school_name');
                $region = $this->input->post('region');
            	$check = $this->db->query("SELECT * FROM `school` WHERE `name` = '$school_name' AND region = '$region'");
            	if($check->num_rows() > 0){
            		echo '2';
            	}else{
                    $newNamePart = time(); 
                    $school_name = strtoupper($school_name);
            		$data['S_Reg_No'] = $newNamePart.time();
                    $data['category'] = $this->input->post('category');
            		$data['name'] = $school_name;
            		$data['HDM'] =  $this->input->post('HDM');
            		$data['type'] =  $this->input->post('s_type');
            		$data['level'] =  $this->input->post('level');
            		$data['contact'] = $this->input->post('contact');
            		$data['district'] = $this->input->post('district');
            		$data['ward'] = $this->input->post('ward');
                    $data['prevalage'] = $this->input->post('priority');
            		$data['region'] = $region;
            		$data['student_required'] = $this->input->post('size');

            		$query = $this->db->insert('school', $data);
            		if($query){
            			echo '1';
            		}else{
            			echo '3';
            		}
            	
            	}

            endif;
         }else{
         	redirect('Home');
         }
    }

    public function add_priority(){
    	if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			
            	$SID = $this->input->post('SID');
            	$I_ID = $this->input->post('I_ID');
                $set_time = date("Y-m-d");

            	foreach($SID as $SID):
            		$this->db->query("INSERT INTO `priority_student`(`id`, `I_ID`, `SID`,set_time) VALUES ('','$I_ID','$SID','$set_time')");
            	endforeach;

            	 $Reg = str_replace('/', '_', $I_ID);
            	redirect('adminstrator/open_priority/'.$Reg);
                
            
        }else{
        	redirect('Home');
        }
    }
    

    public function add_subjects(){
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            
                $Reg = $this->input->post('S_Reg_No');
                $subject = $this->input->post('subject_name');
                foreach($subject as $subject):
                    $this->db->query("INSERT INTO `subject`(`id`, `sub_name`, `school_Reg`) VALUES ('','$subject','$Reg')");
                endforeach;

                 $Reg = str_replace('/', '_', $Reg);
                redirect('adminstrator/open_school/'.$Reg);    
        
        }else{
            redirect('Home');
        }
    }

        public function add_subjects_required(){
        if($this->session->userdata('#_AID_SUA')){
            
                $Jdata = json_encode($_POST['marks']);
                $REG = $this->input->post('Reg');
           $Adata = json_decode($Jdata, true);
            $required = 0;
           if($Adata):

                foreach($Adata as $row):
                    $marks = $row['value'];
                    $required = $required + $marks;
                    $namePart = explode('_',$row['name']);
                        $id = $namePart[1];
                      $query =  $this->db->query("UPDATE subject SET required = '$marks' WHERE id = '$id'; ");
                endforeach; 
                if($query){
                   $this->db->query("UPDATE `school` SET student_required = '$required' WHERE S_Reg_No = '$REG'");
                    echo "1";
                }else{
                    echo "0";
                }
            endif;

        
        }else{
            redirect('Home');
        }
    }

     public function update_report_marks(){
        if($this->session->userdata('#_AID_SUA')){
            
                $Jdata = json_encode($_POST['marks']);
           $Adata = json_decode($Jdata, true);
           if($Adata):
                foreach($Adata as $row):
                    $marks = $row['value'];
                    $namePart = explode('_',$row['name']);
                        $id = $namePart[1];
                      $query =  $this->db->query("UPDATE application SET report = '$marks' WHERE id = '$id'; ");
                endforeach; 
                if($query){
                    echo "1";
                }else{
                    echo "0";
                }
            endif;
            

        
        }else{
            redirect('Home');
        }
    }



 public function update_logbook_marks(){
        if($this->session->userdata('#_AID_SUA')){
            
                $Jdata = json_encode($_POST['marks']);
           $Adata = json_decode($Jdata, true);
           if($Adata):
                foreach($Adata as $row):
                    $marks = $row['value'];
                    $namePart = explode('_',$row['name']);
                        $id = $namePart[1];
                      $query =  $this->db->query("UPDATE application SET logbook = '$marks' WHERE id = '$id'; ");
                endforeach; 
                if($query){
                    echo "1";
                }else{
                    echo "0";
                }
            endif;
            

        
        }else{
            redirect('Home');
        }
    }


     public function add_field_assessor(){
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $prevs = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
                $GRANTED = true;
            }else{$GRANTED = false; }
                
            if($GRANTED ):
               $region = $this->input->post('region');
                $zone = $this->input->post('zone');
                $AID = $this->input->post('AID');
                $school_reg = $this->input->post('school_reg');
                //print_r($shool_name);
                $accademic_year = $this->Other_info_model->get_accademic_year();
                $year = $accademic_year['year'];
                foreach($school_reg as $school):
                    $this->db->query("INSERT INTO `assessors_alloction`(`id`, `AID`, `school_reg`, `zone`, `region`,`ac_year`) VALUES  ('','$AID','$school','$zone','$region','$year')");
                endforeach;

                $region = str_replace(' ', '_', $region);
                
                redirect('adminstrator/open_region/'.$region);
            endif;
        }else{
            redirect('Home');
        }
    }

    // add instructor for marking logbooks
    public function add_logbook_assessor(){
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
                $GRANTED = true;
            }else{$GRANTED = false; }
                
            if($GRANTED ):
                $AID = $this->input->post('AID');
                $school_reg = $this->input->post('school_reg');
                //print_r($shool_name);
                $accademic_year = $this->Other_info_model->get_accademic_year();
                $year = $accademic_year['year'];
                foreach($school_reg as $school):
                    $this->db->query("INSERT INTO `logbook_assess`(`id`, `AID`, `I_ID`, `ac_year`) VALUES  ('','$AID','$school','$year')");
                endforeach;
                
                redirect('adminstrator/field_logbook');
            endif;
        }else{
            redirect('Home');
        }
    }

    // add instructor for marking logbooks
    public function add_report_assessor(){
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
                $GRANTED = true;
            }else{$GRANTED = false; }
                
            if($GRANTED ):
                $AID = $this->input->post('AID');
                $school_reg = $this->input->post('school_reg');
                //print_r($shool_name);
                $accademic_year = $this->Other_info_model->get_accademic_year();
                $year = $accademic_year['year'];
                foreach($school_reg as $school):
                    $this->db->query("INSERT INTO `report_assess`(`id`, `AID`, `I_ID`, `ac_year`) VALUES  ('','$AID','$school','$year')");
                endforeach;
                
                redirect('adminstrator/field_report');
            endif;
        }else{
            redirect('Home');
        }
    }

    //open and close application
    public function add_accademic_year(){
        if($this->session->userdata('#_AID_SUA') AND isset($_POST['year'])){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $admin_check = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
            if($admin_check){
                $year = $this->input->post('year');
              
                $check = $this->db->query("SELECT * FROM accademic_year WHERE year = '$year' ");
                if($check->num_rows()>0){
                    echo "2";
                }else{
                    $update = $this->db->query("UPDATE `accademic_year` SET  current = 'NO', status = 'Closed'");
                    if($update){
                        $data['year'] = $year;
                        $data['current'] = 'YES';
                        $data['status'] = 'Closed';
                        $data['date'] = date('d/m/Y H:m:s');
                        $query = $this->db->insert('accademic_year',$data);
                        if($query){
                            echo "1";
                        }
                    }
                }
            }else{
                redirect('Home');
            }
        }else{
            redirect('Home');
        }
        
    }



    //add student application 
       public function submit_application(){
        if($this->session->userdata('#_SID_SUA')  and isset($_POST['reg'])){
                $page_data['student'] = $this->session->userdata('#_SID_SUA');
                $accademic_year = $this->Other_info_model->get_accademic_year();
                $year = $accademic_year['year'];
                $reg_no = $this->input->post('reg');
                $reg_no = str_replace('_', '/', $reg_no);

                $data['id'] = '';
                $data['SID'] = $page_data['student']['SID'];
                $data['school_Reg'] = $reg_no;
                $data['subject'] = $this->input->post('subject');
                $data['ac_year'] = $year;

                $selected_times = $this->Other_info_model->how_many_times_sch_selected($data['school_Reg'],$year);
                $times = 0;
                $limit = 0;
                if($selected_times):
                    foreach($selected_times as $selected){$times++; }
                endif;

                $schoo_info = $this->Other_info_model->get_school_info($data['school_Reg']);
                if($schoo_info):
                    foreach($schoo_info as $school){
                        $limit = $school['student_required'];
                    }
                endif;
                $rechek = $limit - $times;

                if($rechek <= 0){
                    echo '2';
                }else{
                    $query = $this->db->insert('application', $data);
                    if($query){
                        $this->db->where('request_SID',$data['SID']);
                        $this->db->delete('app_field_request');
                        echo '1';
                    }
                    
                }

                
                

         }else{
            redirect('Home');
         }
    }


//add sugested school
       public function add_suggested_school(){
        if($this->session->userdata('#_SID_SUA')  and isset($_POST['name'])){
                $page_data['student'] = $this->session->userdata('#_SID_SUA');

                $name = $this->input->post('name');
                $region = $this->input->post('region');
                $query = $this->db->query("SELECT * FROM `suggested_school` WHERE `name` = '$name' AND `region` = '$region' ");
                if($query->num_rows() >0){
                    echo "2";
                }else{

                    $school = $this->db->query("SELECT * FROM `school` WHERE `name` = '$name' AND `region` = '$region' ");

                    if($school->num_rows() >0){
                        echo "2";
                    }else{


                    $data['id'] = '';
                    $data['ward'] = $this->input->post('ward');
                    $data['district'] = $this->input->post('district');
                    $data['contact'] = $this->input->post('contact');
                    $data['name'] = $name;
                    $data['region'] = $region;
                    $data['SID'] = $page_data['student']['SID'];

                    $query = $this->db->insert('suggested_school',$data);
                    if($query){
                        echo "1";
                    }
                    
                    }
                    
                }

         }else{
            redirect('Home');
         }
    }






}

?>