<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('excel_import_model');
		$this->load->library('excel');
	}


	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$category = $this->input->post('category');
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			$file_student = 0;
			$exixt = 0;
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$file_student++;
					$Reg_NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$full_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$sex = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$study_year = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                     if(strpos($full_name, ',') == true){
                        $nameData = explode(',', $full_name);
                        $surname = $nameData[0];
                        $nameData = explode(' ', $full_name);
                        $fname = $nameData[1];
                        $mname = "";
                        if(end($nameData) != $fname):
                            $mname = end($nameData);
                        endif;
                     }else{
                        $new_nameData = explode(' ', $full_name);
                        $surname = $new_nameData[0];
                        $fname = $new_nameData[1];
                        $mname = "";
                        if(end($new_nameData) != $fname):
                            $mname = end($new_nameData);
                        endif;
                     }

                    
                    


					$parData = explode('/', $Reg_NO);
                    $start = strtoupper($parData[0]);
                    if($start == 'INF'):
                        $category = 'INF';
                    elseif($start == 'ESM'):
                        $category = 'ESM';
                    else:
                        $category = 'EDU';
                    endif;

					$password = $start.end($parData);
					$program = $start;
                    if($sex == 'F' OR $sex == 'f'){
                        $sex = 'Female';
                    }
                    if($sex == 'M' OR $sex == 'm'){
                        $sex = 'Male';
                    }
                    $sex = strtoupper($sex);


                    $fname = strtoupper($fname);
                    $mname = strtoupper($mname);
                    $surname = strtoupper($surname);
                    $Reg_NO = strtoupper($Reg_NO);
                    if($Reg_NO != "" AND $study_year != "" ){
					$data[] = array(
									'SID'				=>	$Reg_NO,
									'Reg_NO'			=>	$Reg_NO,
									'fname'				=>	$fname,
									'mname'				=>	$mname,
									'lname'				=>	$surname,
									'sex'				=>	$sex,
									'password'			=>	md5($password),
									'year'				=>	$study_year,
									'email'				=>	'',
									'image'				=>	'',
									'program'			=>	$program,
									'category'			=>	$category,
									'status'			=>	'Continuing'
								);
                    }
				}
				
			}
			$this->excel_import_model->insert($data);
			echo 'Data Imported successfully';

			
		}	
	}

    function import_institution()
	{
        
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			$success = 0;
			$exist = 0;
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					
					$institution = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$region = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$district = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$student_no = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$category = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                   
                    $institution = strtoupper($institution);
                    $newNamePart = strtoupper(md5($institution));
                    if($institution != '' AND $region != '' AND $category != ''):
                       $query = $this->db->query("SELECT * FROM school WHERE S_Reg_No = '$newNamePart'");
                        if($query->num_rows() <= 0){
                            $success++;
                            $data[] = array(
                                    'S_Reg_No' => $newNamePart,
                                    'name' => $institution, 
                                    'HDM' => '', 
                                    'level' => '', 
                                    'type' => '', 
                                    'contact' => '', 
                                    'district' => $district, 
                                    'ward' => '', 
                                    'region' =>  $region, 
                                    'student_required' => $student_no, 
                                    'reachable' => 'NO', 
                                    'category' => $category, 
                                    'prevalage' => 'NO',
                                    'address' => $address
								);
                        }else{
                            $exist++;
                        }
                    endif;
                    
				}
			
			}
        
    	$import = $this->excel_import_model->insert_institution($data);
        $_SESSION['upload_success'] = "<div class='alert alert-success'>
							  <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							  <strong><i class='icon fa fa-check'></i> $success </strong> institution uploaded successfull <strong> $exist  </strong> institution failed
							</div> ";
		echo 'Data Imported successfully';
			
		}	
	}
}

?>