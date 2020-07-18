<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Updates extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Home_model');
		$this->load->model('Admin_info_model');
		$this->load->model('Other_info_model');
		$this->load->model('Student_info_model');

	
		$this->load->library('upload'); //load library upload 
		$this->load->library('session');
		
    }


    //remove prevallage
    public function remove_prevalage(){
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $AID = $page_data['adminstrator']['AID'];
            $prevs = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
                $GRANTED = true;
            }else{$GRANTED = false; }
                
            if($GRANTED ){
                
                $id = $this->input->post('ID');
                $delete = $this->db->query("DELETE FROM adminstrator_access WHERE id = '$id' AND AID != '$AID' ");
                if($delete){
                	echo "1";
                }
                
             
             }else{
            redirect('Home');
         }

         }else{
            redirect('Home');
         }
    }

    public function remove_instructor_account(){
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $AID = $page_data['adminstrator']['AID'];
            $prevs = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
                $GRANTED = true;
            }else{$GRANTED = false; }
                
            if($GRANTED ){
                
                $id = $this->input->post('AID');
                if($id == $AID){
                    echo "1";
                    $_SESSION['Remove_error'] = "<div class='alert alert-warning'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> You can not remove this account
							</div> ";
                }else{
                    
                    
                    $this->db->query("DELETE FROM report_assess WHERE AID = '$id'");
                    $this->db->query("DELETE FROM logbook_assess WHERE AID = '$id'");
                    $this->db->query("DELETE FROM assessors_alloction WHERE AID = '$id'");
                    $this->db->query("DELETE FROM adminstrator_access WHERE AID = '$id'");
                    $this->db->query("DELETE FROM adminstrator WHERE AID = '$id'");
                    echo "1";
                    $_SESSION['Remove_success'] = "<div class='alert alert-success'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-check'></i> </strong> Successfull instructor account removed  
							</div> ";
                        
                }
            
             
             }else{

            redirect('Home');
         }

         }else{
            redirect('Home');
         }
    }



    //instructor update information
	public function update_instructor_profile(){
		if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
 			$AID = $page_data['adminstrator']['AID'];

				$data['skills']= $this->input->post('skills'); 
				$data['experience']= $this->input->post('experience');
				$data['email']= $this->input->post('email');
				$data['contact']= $this->input->post('contact'); 
				$data['experience']= $this->input->post('experience');
				$data['location']= $this->input->post('inputLocation');

				//print_r($data);

					$this->db->where('AID', $AID);
					$query=$this->db->update('adminstrator', $data);
					if($query){
						$data  = $this->Admin_info_model->instructor_details($AID);
						$this->session->unset_userdata('#_AID_SUA');
						$this->session->set_userdata('#_AID_SUA',$data);
						echo   '1';
					}else{
						echo  '2';
					}
		}else{
			echo "BAD ACCESS";
		}

    }


//Upload profile images
	public function update_profile_img(){
	
		if(isset($_FILES['userfile']['name'])){

			$oldfile=$this->input->post('oldfile');
			$AID =$this->input->post('AID');
		
			$config['upload_path'] = "./assets/profile/instructor/";
			$config['allowed_types'] = 'png|jpg|jpeg|gif|svg|icon';
			$config['max_size'] = '10240';
			
			$imageParts = explode(".",$_FILES["userfile"]['name']);
			$extension = end($imageParts);
			$newNamePart = time();
			$newNamePart = $newNamePart.time();
			$new_name = $newNamePart.".".$extension;
			$config['file_name'] = $new_name;

			$this->upload->initialize($config);
			if($this->upload->do_upload('userfile')){
				$oldFile = "./assets/profile/instructor/".$oldfile;
				if(file_exists($oldFile) and $oldfile != "Users.ico"){
					@unlink($oldFile);
				}
				$query = $this->db->query("UPDATE adminstrator SET image = '$new_name' WHERE AID = '$AID'; " );
				if($query){
					$data  = $this->Admin_info_model->instructor_details($AID);
						$this->session->unset_userdata('#_AID_SUA');
						$this->session->set_userdata('#_AID_SUA',$data);
				}
				$_SESSION['Profile_success'] = "<div class='alert alert-success'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-check'></i> </strong> Successfull uploading student Image
							</div> ";
			}else{
				$_SESSION['Profile_error'] = " <div class='alert alert-danger alert-sm'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> Fail to uploading student Image
							</div>";
			}
			redirect('adminstrator/profile');
			
		}
		else{
			redirect('adminstrator/profile');
		}
	
	}


	 // this for opening priority institution
        public function remove_priority($Reg = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $Reg = str_replace('_', '/', $Reg);
            $this->db->where('I_ID',$Reg);
            $query = $this->db->delete('priority_student');
            if($query){
            	$this->db->query("UPDATE school SET prevalage = 'NO' WHERE S_Reg_No = '$Reg'");
            	redirect('adminstrator/priority_institution');
            }
        }else{
        	redirect('/');
        }
    }

    public function remove_multiple_student(){
        if($this->session->userdata('#_AID_SUA')){
            $SID = $this->input->post('SID');
            $no = 0;
            if($SID != ''){
                //print_r($SID);
                foreach($SID as $SID){
                    $no++;
                    $this->db->where('SID', $SID);
                    $this->db->delete('student');
                }
                $_SESSION['delete_complite'] = $no;
                redirect('adminstrator/add_student');
            }else{
                redirect('adminstrator/add_student');
            }
            
        }else{
            redirect('/');
        }
    }

    public function update_feild_letter_request($id = ''){
        if($this->session->userdata('#_AID_SUA')){
            $this->db->where('id',$id);
            $this->db->set('status','created');
            $this->db->update('app_field_request');
            redirect('adminstrator/field_letter');
        }else{
            redirect('/');
        }
    }

     // updating arrive note status
        public function update_arrive_status(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $status = $this->input->post('status');
            $deadline = '';
            if($status == 'YES'):
                $deadline = $this->input->post('deadline');
            endif; 
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
        
            $query = $this->db->query("UPDATE accademic_year SET arrive_note_status = '$status', deadline = '$deadline' WHERE year = '$year'");
                if($query){
                    redirect('adminstrator/setting');
                }
            
        }else{
        	redirect('Home');
        }
    }

      // close arive note
        public function close_arrive_note(){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
        
            $query = $this->db->query("UPDATE accademic_year SET arrive_note_status = 'NO', deadline = '' WHERE year = '$year'");
                if($query){
                    redirect('adminstrator/setting');
                }
            
        }else{
        	redirect('Home');
        }
    }



     // this will remove the student
        public function remove_student_data($SID = '', $program =''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $SID = str_replace('_', '/', $SID);
            $this->db->where('SID',$SID);
            $query = $this->db->delete('student');
            if($query){
            	if($program == ''){
                    redirect('adminstrator/add_student');
                }else{
                    redirect('adminstrator/student_list/'.$program);
                }
            	
            }
        }else{
        	redirect('Home');
        }
    }


     // this for removing student from priority 
        public function remove_student($SID = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $SID = str_replace('_', '/', $SID);
            $this->db->where('SID',$SID);
            $query = $this->db->delete('priority_student');
            if($query){
            	redirect('adminstrator/priority_institution');
            }
        }else{
        	redirect('Home');
        }
    }


      public function update_institution_reachable($I_ID = '', $path = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $I_ID = str_replace('_', '/', $I_ID);
            $this->db->where('S_Reg_No',$I_ID);
            $this->db->set('reachable','YES');
            $query = $this->db->update('school');
            if($query){
            	redirect('adminstrator/'.$path);
            }
        }else{
        	redirect('Home');
        }
    }


    // this for removing assesser from marking student lodbook with  ID 
        public function remove_logbook_assess($id = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $this->db->where('id',$id);
            $query = $this->db->delete('logbook_assess');
            if($query){
            	redirect('adminstrator/field_logbook');
            }
        }else{
        	redirect('Home');
        }
    }

// this for removing assesser from marking student field report with  ID 
        public function remove_report_assess($id = ''){
        //load session library
        $this->load->library('session');
        if($this->session->userdata('#_AID_SUA')){
            $page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
            $this->db->where('id',$id);
            $query = $this->db->delete('report_assess');
            if($query){
            	redirect('adminstrator/field_report');
            }
        }else{
        	redirect('Home');
        }
    }

	//Upload student profile images
	public function update_student_profile_img(){
		if($this->session->userdata('#_SID_SUA') and isset($_FILES['userfile']['name'])){
			$page_data['student'] = $this->session->userdata('#_SID_SUA');
 			$SID = $page_data['student']['SID'];


			$oldfile=$this->input->post('oldfile');
		
			$config['upload_path'] = "./assets/profile/student/";
			$config['allowed_types'] = 'png|jpg|jpeg|gif|svg|icon';
			$config['max_size'] = '10240';
			
			$imageParts = explode(".",$_FILES["userfile"]['name']);
			$extension = end($imageParts);
			$newNamePart = time();
			$newNamePart = $newNamePart.time();
			$new_name = $newNamePart.".".$extension;
			$config['file_name'] = $new_name;

			$this->upload->initialize($config);
			if($this->upload->do_upload('userfile')){
				$oldFile = "./assets/profile/student/".$oldfile;
				if(file_exists($oldFile) and $oldfile != "Users.ico"){
					@unlink($oldFile);
				}
				$query = $this->db->query("UPDATE student_FTP SET image = '$new_name' WHERE SID = '$SID'; " );
				if($query){
					$student_data  = $this->Student_info_model->student_details($SID);
						$this->session->unset_userdata('#_SID_SUA');
						$this->session->set_userdata('#_SID_SUA',$student_data);
				}
				$_SESSION['Profile_success'] = "<div class='alert alert-success'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-check'></i> </strong> Successfull uploading student Image
							</div> ";
			}else{
				$_SESSION['Profile_error'] = " <div class='alert alert-danger alert-sm'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> Fail to uploading student Image
							</div>";
			}
			redirect('student/profile');
			
		}
		else{
			redirect('student/profile');
		}
	
	}


	//update assessing date
	public function add_assess_date(){
		if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $AID = $page_data['adminstrator']['AID'];

            	$regNo = $this->input->post('regNo');
            	$date =  $this->input->post('date');
           	$check = $this->db->query("SELECT * FROM assessors_alloction WHERE AID = '$AID' AND ac_year = '$year' AND school_reg = '$regNo' ");
           	if($check->num_rows()>0){
           		$query = $this->db->query("UPDATE assessors_alloction SET as_date = '$date' WHERE AID = '$AID' AND ac_year = '$year' AND school_reg = '$regNo' ");
           		if($query){
           			echo "1";
           		}
           	}else{
           		echo "2";
           	}

		}else{
			echo "BAD ACCESS";
		}

    }


//add student marks
	public function add_marks(){
		if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            	$SID = $this->input->post('SID');
            	$marks = $this->input->post('marks');

           		$query = $this->db->query("UPDATE application SET marks = '$marks' WHERE SID = '$SID' AND ac_year = '$year'");
           		if($query){
           			echo "1";
           		}
          
		}else{
			echo "BAD ACCESS";
		}

    }

    //confirm repoprt marks
	public function confirm_report_marks($REG=''){
		if($this->session->userdata('#_AID_SUA')){
			$Reg = str_replace('_', '/', $REG);
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
           		$query = $this->db->query("UPDATE application SET report_confirm = 'YES' WHERE school_Reg = '$Reg' AND ac_year = '$year'");
           		if($query){
           			redirect('adminstrator/report/'.$REG);
           		}
          
		}else{
			echo "BAD ACCESS";
		}

    }


     //confirm repoprt marks
	public function confirm_logbook_marks($REG=''){
		if($this->session->userdata('#_AID_SUA')){
			$Reg = str_replace('_', '/', $REG);
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
           		$query = $this->db->query("UPDATE application SET logbook_confirm = 'YES' WHERE school_Reg = '$Reg' AND ac_year = '$year'");
           		if($query){
           			redirect('adminstrator/logbook/'.$REG);
           		}
          
		}else{
			echo "BAD ACCESS";
		}

    }


//submit student marks
	public function submit_marks(){
		if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            	$SID = $this->input->post('SID');

           		$query = $this->db->query("UPDATE application SET marks_confirm = 'YES' WHERE SID = '$SID' AND ac_year = '$year'");
           		if($query){
           			echo "1";
           		}
          
		}else{
			echo "BAD ACCESS";
		}

    }


        //student remove arrive note
	public function student_remove_arrive_note(){
		if($this->session->userdata('#_SID_SUA')){
			$student = $this->session->userdata('#_SID_SUA');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $SID = $student['SID'];
            $this->db->where('SID',$SID);
            $this->db->select('arrive_note');
            $application = $this->db->get('application');
            $doc = '';
            if($application->num_rows()>0){
                $application = $application->result_array();
                foreach($application as $ap){}
                $doc = $ap['arrive_note'];
                  $oldFile = "./assets/arrive_note/".$doc;
            if(file_exists($oldFile)){
                @unlink($oldFile);
            }
            $query = $this->db->query("UPDATE application SET arrive_note = '' WHERE SID = '$SID' AND ac_year = '$year'");
           		if($query){
           			redirect('student');
           		}
            }else{
                redirect('student');
            }
          
          
		}else{
			redirect('student');
		}
    

    }



//Upload profile images
	public function student_upload_arrive_note(){
	
		if(isset($_FILES['userfile']['name'])){
            $student = $this->session->userdata('#_SID_SUA');
			$SID =$student['SID'];
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

			$config['upload_path'] = "./assets/arrive_note/";
			$config['allowed_types'] = 'png|jpg|jpeg|gif|svg|icon|pdf';
			$config['max_size'] = '10240';
			
			$imageParts = explode(".",$_FILES["userfile"]['name']);
			$extension = end($imageParts);
			$y = str_replace('-', '_', $year);
            $Sid = str_replace('.', '_', $SID);
			$mypart = $Sid."_".$y;

			$new_name = $mypart.".".$extension;
			$config['file_name'] = $new_name;
			
			$this->upload->initialize($config);
			if($this->upload->do_upload('userfile')){

				$query = $this->db->query("UPDATE application SET arrive_note = '$new_name' WHERE SID = '$SID' AND ac_year = '$year' " );
				
				$_SESSION['note_success'] = "<div class='alert alert-success'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-check'></i> </strong> Successfull uploading your arrive document
							</div> ";
			}else{
				$_SESSION['note_error'] = " <div class='alert alert-danger alert-sm'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> Fail to upload your arrive document document
							</div>";
							
			}
			redirect('student');
			
		}
		else{
			redirect('student');
		}
	
	}



//Upload profile images
	public function student_ass_doc(){
	
		if(isset($_FILES['userfile']['name'])){

			$SID =$this->input->post('SID');
			$Sid = str_replace('.', '_', $SID);
			$Reg =$this->input->post('Reg');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];

			$config['upload_path'] = "./assets/documents/";
			$config['allowed_types'] = 'png|jpg|jpeg|gif|svg|icon|pdf';
			$config['max_size'] = '10240';
			
			$imageParts = explode(".",$_FILES["userfile"]['name']);
			$extension = end($imageParts);
			$y = str_replace('-', '_', $year);
			$mypart = $Sid."_".$y;

			$new_name = $mypart.".".$extension;
			$config['file_name'] = $new_name;
			
			$this->upload->initialize($config);
			if($this->upload->do_upload('userfile')){

				$query = $this->db->query("UPDATE application SET document = '$new_name' WHERE SID = '$SID' AND ac_year = '$year' " );
				
				$_SESSION['_success'] = "<div class='alert alert-success'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-check'></i> </strong> Successfull uploading student assessiment document
							</div> ";
			}else{
				$_SESSION['_error'] = " <div class='alert alert-danger alert-sm'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-warning'></i> </strong> Fail to uploading student  assessiment document
							</div>";
							
			}
			redirect('adminstrator/student_assess/'.$Reg."/".$Sid);
			
		}
		else{
			redirect('adminstrator/student_assess/'.$Reg."/".$Sid);
		}
	
	}




	//instructor update information
	public function update_school_info(){
		if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	$regNo = $this->input->post('school_reg_no');

            	$data['name'] =  $this->input->post('school_name');
            	$data['type'] =  $this->input->post('type');
            		$data['level'] =  $this->input->post('level');
            	$data['HDM'] =  $this->input->post('HDM');
        		$data['contact'] = $this->input->post('contact');
        		$data['district'] = $this->input->post('district');
        		$data['ward'] = $this->input->post('ward');
        		$data['region'] = $this->input->post('region');
        		$data['student_required'] = $this->input->post('size');
        		$data['reachable'] =  $this->input->post('reachable');
                $data['category'] =  $this->input->post('category');


        		$this->db->where('S_Reg_No',$regNo);
        		$query = $this->db->update('school', $data);
        		if($query){
        			echo '1';
        		}else{
        			echo '2';
        		}
				

            endif;
            	

		}else{
			echo "BAD ACCESS";
		}

    }



    public function update_region_zone(){
     	
    	if($this->session->userdata('#_AID_SUA')  and isset($_POST['region'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	$region = $this->input->post('region');
            	$zone = $this->input->post('zone');
            	//echo $region." ".$zone;
            	
            	$check_allocation = $this->db->query("SELECT * FROM `assessors_alloction` WHERE `region` = '$region'");
            	if($check_allocation->num_rows() > 0){
            		
            		$this->db->query("UPDATE `assessors_alloction` SET `zone` = '$zone' WHERE `region` = '$region'");
            		$this->db->query("UPDATE `region` SET  `zone_name` = '$zone' WHERE `region_name` = '$region'");
            		echo "1";
            		
            		echo "string";
            	}else{
            		
            		$query = $this->db->query("UPDATE `region` SET `zone_name` = '$zone' WHERE `region_name` = '$region'");
            		if($query){
            			echo '1';
            		}
            	}
            	
            
            endif;
         }else{
         	redirect('Home');
         }
        
    }


	//del;ete subject
	public function delate_subject(){
		if($this->session->userdata('#_AID_SUA')){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$prevs = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
            if($prevs){
				$GRANTED = true;
			}else{$GRANTED = false; }
                
            if($GRANTED ):
            	$subname = $this->input->post('subname');
            	$reg_no = $this->input->post('reg_no');
            	$ID = $this->input->post('ID');

            	$accademic_year = $this->Other_info_model->get_accademic_year();
            	$year = $accademic_year['year'];
            	// now check the subject in current year 
            	$check = $this->Other_info_model->subject_in_application($year,$reg_no,$subname);
            	if($check){
            		echo "2";
            	}else{
            		$query = $this->db->query("DELETE FROM `subject` WHERE `id` = '$ID' ");
            		if($query){
            			echo '1';
            		}
            	}

            endif;
            	

		}else{
			echo "BAD ACCESS";
		}

    }



    //update student indoemation
	public function update_student_profile(){
		if($this->session->userdata('#_SID_SUA')){
			$page_data['student'] = $this->session->userdata('#_SID_SUA');
 			$SID = $page_data['student']['SID'];

				$data['study_year']= $this->input->post('study_year');
				$data['email']= $this->input->post('email');
				$data['contact']= $this->input->post('contact');
                $fname = $this->input->post('fname');
                $lname = $this->input->post('lname');
                $mname = $this->input->post('mname');
                $fname = strtoupper($fname);
                $mname = strtoupper($mname);
                $lname = strtoupper($lname);
				$data['fname'] = $fname;
                $data['mname'] = $mname;
                $data['lname'] = $lname;

					$this->db->where('SID', $SID);
					$query=$this->db->update('student_FTP', $data);
				
					if($query){
						$student_data  = $this->Student_info_model->student_details($SID);
						$this->session->unset_userdata('#_SID_SUA');
						$this->session->set_userdata('#_SID_SUA',$student_data);
						echo   '1';
					}else{
						echo  '2';
					}
					
				//print_r($SID);
					
		}else{
			redirect('Home');
		}

    }


    //delete application
	public function delete_application(){
		if($this->session->userdata('#_SID_SUA')){
			$page_data['student'] = $this->session->userdata('#_SID_SUA');
 			$SID = $page_data['student']['SID'];				
 			$id = $this->input->post('ID');
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $this->db->where('SID',$SID);
            $this->db->delete('application_request');


            $query = $this->db->query("DELETE FROM application WHERE `id` = '$id' AND `SID` = '$SID' AND `ac_year` = '$year' ");
            if($query){
            	echo '1';
            }
					
		}else{
			redirect('Home');
		}

    }


//reject selection change request
	public function reject_request($id=''){
		if($this->session->userdata('#_AID_SUA')){
			$this->db->where('id',$id);
            $query = $this->db->delete('application_request');
            if($query){
            	redirect('adminstrator/re_application');
            }
					
		}else{
			redirect('Home');
		}
    }

    //accept selection change request
	public function accept_request($id=''){
		if($this->session->userdata('#_AID_SUA')){
            $query = $this->db->query("UPDATE application_request SET status = 'YES' WHERE id ='$id' ");
            if($query){
            	redirect('adminstrator/re_application');
            }
					
		}else{
			redirect('Home');
		}

    }


//delete application
	public function requst_re_application(){
		if($this->session->userdata('#_SID_SUA')){
			$page_data['student'] = $this->session->userdata('#_SID_SUA');
 			$SID = $page_data['student']['SID'];
			$accademic_year = $this->Other_info_model->get_accademic_year();
            $year = $accademic_year['year'];
            $data['ac_year'] = $year;
            $data['id'] = '';
            $data['SID'] = $SID;
            $data['status'] = 'NO';

            $query = $this->db->insert('application_request',$data);
            if($query){
            	redirect('student');
            }
					
		}else{
			redirect('Home');
		}

    }


 public function renew_password(){
		if($this->session->userdata('#_AID_SUA') ){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
 			$AID = $page_data['adminstrator']['AID'];
			
			$new_pass =$this->input->post('new_pass');
			$old_pass = $this->input->post('old_pass');
			$old_pass = md5($old_pass); 
			
				$checkData = $this->Other_info_model->get_account($AID,$old_pass);
				if(!$checkData){
					//incorrect old password
					echo "2";
				}else{
					//correct old password. now ready for newone
					$data['password'] = md5($new_pass);
					$data['AID'] = $AID;
					$this->db->where('AID',$AID);
					$query=$this->db->update('adminstrator', $data);
					if($query){
						$data  = $this->Admin_info_model->instructor_details($AID);
						$this->session->unset_userdata('#_AID_SUA');
						$this->session->set_userdata('#_AID_SUA',$data);
						echo  '1';

					}else{
						echo  '3';
					}
					
				}//end of newpass registration
		}else{
			echo "Bad Access";
		}
	}


	//open and close application
	public function open_close_ap(){
		if($this->session->userdata('#_AID_SUA') AND isset($_POST['status'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$admin_check = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
			if($admin_check){
				$status = $this->input->post('status');
				$year = $this->input->post('year');
				if($status == "YES"){
					$st_value = "Closed";
				}else{
					$st_value = "YES";
				}
			
				$query = $this->db->query("UPDATE accademic_year SET status = '$st_value' WHERE year = '$year' ");
				if($query){
					echo "1";
				}else{
					echo "2";
				}
			}else{
				redirect('Home');
			}
		}else{
			redirect('Home');
		}
		
	}

	//update activate or deactivate instructor
	public function activate_deactivate(){
		if($this->session->userdata('#_AID_SUA') AND isset($_POST['status'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$admin_check = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
			if($admin_check){
				$status = $this->input->post('status');
				$AID = $this->input->post('AID');
				if($status == "Active"){
					$st_value = "Blocked";
				}else{
					$st_value = "Active";
				}
			
				$query = $this->db->query("UPDATE adminstrator SET status = '$st_value' WHERE AID = '$AID' ");
				if($query){
					echo "1";
				}else{
					echo "2";
				}
			}else{
				redirect('Home');
			}
		}else{
			redirect('Home');
		}
		
	}



		//adminstrator change student passwords
	public function instructor_change_password_student(){
		if($this->session->userdata('#_AID_SUA') AND isset($_POST['SID'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$admin_check = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
			if($admin_check){

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
				 
				$pass =  generate_string($permitted_chars, 6);

				$SID = $this->input->post('SID'); 
				
				$data['password'] =  md5($pass);
					$this->db->where('SID',$SID);
					$query=$this->db->update('student_FTP', $data);
					if($query){
						echo  '	<div class="alert alert-success">
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  New student password is <strong>'.$pass. ' </strong>
								</div>';
					}else{
						echo  '	<div class="alert alert-danger">
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  <strong>Failed!</strong> to recover student password
								</div>';
					}
				
			}else{
				redirect('Home');
			}
		}else{
			redirect('Home');
		}
		
	}




	//adminstrator change instructor passwords
	public function instructor_change_password(){
		if($this->session->userdata('#_AID_SUA') AND isset($_POST['AID'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$admin_check = $this->Admin_info_model->get_assistant_admin_access_ifo($page_data['adminstrator']['AID']);
			if($admin_check){

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
				 
				$pass =  generate_string($permitted_chars, 6);

				$AID = $this->input->post('AID'); 
				
				$data['password'] =  md5($pass);
					$this->db->where('AID',$AID);
					$query=$this->db->update('adminstrator', $data);
					if($query){
						echo  '	<div class="alert alert-success">
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  New password is <strong>'.$pass. ' </strong>
								</div>';
					}else{
						echo  '	<div class="alert alert-danger">
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  <strong>Failed!</strong> to recover  password
								</div>';
					}
				
			}else{
				redirect('Home');
			}
		}else{
			redirect('Home');
		}
		
	}


//remove instructor from assessing a certaiin school
	public function remove_assessor(){
		if($this->session->userdata('#_AID_SUA') AND isset($_POST['ID'])){
			$page_data['adminstrator'] = $this->session->userdata('#_AID_SUA');
			$admin_check = $this->Admin_info_model->get_admin_access_ifo($page_data['adminstrator']['AID']);
			if($admin_check){
				$ID = $this->input->post('ID');
				
				
				$query = $this->db->query("DELETE FROM assessors_alloction  WHERE id = '$ID' ");
				if($query){
					echo "1";
				}else{
					echo "2";
				}
			}else{
				redirect('Home');
			}
		}else{
			redirect('Home');
		}
		
	}






}


?>