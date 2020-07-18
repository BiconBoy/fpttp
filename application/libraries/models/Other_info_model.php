<?php 
	class Other_info_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		

		// get all zones
		public function get_all_zones(){
			$sql = $this->db->get('zone');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}


	
				// get all suggested school
		public function get_suggested_schools(){
			$sql = $this->db->get('suggested_school');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

				// get all suggested school
		public function all_zones(){
			$sql = $this->db->get('zone');
				if($sql->num_rows() > 0){
					return $sql->row_array(); 
				}else{
					return [];
				}
		}

		public function get_all_application_report($year=''){
			$query = $this->db->query("SELECT student_FTP.program,student_FTP.study_year FROM application INNER JOIN student_FTP ON application.SID = student_FTP.SID
WHERE logbook_confirm = 'YES' AND report_confirm = 'YES' AND marks_confirm = 'YES' AND application.ac_year = '$year' GROUP BY program,study_year;");
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}
		}


		public function get_full_application_report($program='',$study_year='',$year=''){
			$query = $this->db->query("SELECT student_FTP.*,application.* FROM application INNER JOIN student_FTP ON application.SID = student_FTP.SID
WHERE logbook_confirm = 'YES' AND program = '$program' AND report_confirm = 'YES' AND marks_confirm = 'YES' AND application.ac_year = '$year' AND study_year = '$study_year' ORDER BY fname ASC;");
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}
		}

			// get all reagion for specific zone
		public function get_zone_reagion($zone = ''){
			$this->db->where('zone_name', $zone);
			$sql = $this->db->get('region');
				if($sql->num_rows() > 0){
					return $sql->row_array(); 
				}else{
					return [];
				}
		}


			// get reaplication request
		public function student_application_request($year = ''){
			$sql = $this->db->query("SELECT region,program,Reg_No,student_FTP.fname,lname,mname,application_request.*,school.name FROM application_request INNER JOIN student_FTP ON application_request.SID = student_FTP.SID
				INNER JOIN application ON application_request.SID = application.SID
				INNER JOIN school ON school.S_Reg_No = application.school_Reg
			 WHERE application_request.status = 'NO' AND application_request.ac_year = '$year' ");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}


			// get all reagion for specific zone
		public function get_priority_student($SID = ''){
			$sql = $this->db->query("SELECT region,priority_student.* FROM priority_student INNER JOIN school ON priority_student.I_ID = school.S_Reg_No WHERE priority_student.SID = '$SID'");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}



		// get report marking access
		public function report_marking($AID = '', $year){
			$this->db->where('AID', $AID);
			$this->db->where('ac_year', $year);
			$sql = $this->db->get('report_assess');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}
// get logbook marking access
		public function logbook_marking($AID ='', $year){
			$this->db->where('AID', $AID);
			$this->db->where('ac_year', $year);
			$sql = $this->db->get('logbook_assess');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}


			// get all reagion for specific zone
		public function get_zone_reagion_list($zone = ''){
			$this->db->where('zone_name', $zone);
			$sql = $this->db->get('region');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

		//get institution allocated logbook instructor
		public function get_logbook_allocated_instution($year=''){
			$this->db->where('ac_year',$year);
			$sql = $this->db->get('logbook_assess');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

//get institution allocated report instructor
		public function get_report_allocated_instution($year=''){
			$this->db->where('ac_year',$year);
			$sql = $this->db->get('report_assess');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

		//get all logbook assessor
		public function logbook_assessor(){
			$query = $this->db->get('logbook_assess');
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function get_student_result($SID='', $year){
			$query = $this->db->query("SELECT * FROM application WHERE report_confirm = 'YES' AND marks_confirm = 'YES'  AND ac_year = '$year' AND SID = '$SID'");
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}
		}

public function get_student_report_($SID='', $year){
			$query = $this->db->query("SELECT * FROM application WHERE  marks_confirm = 'YES'  AND ac_year = '$year' AND SID = '$SID'");
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}
		}
				// get all institution with prevalage
		public function get_priority_schools(){
			$this->db->where('prevalage', 'YES');
			$sql = $this->db->get('school');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}


	// get all reagion for specific zone
		public function get_zone_reagion_listing($zone = '',$category = ''){
			$sql = $this->db->query("SELECT DISTINCT region_name FROM region INNER JOIN school ON region.region_name = school.region WHERE school.reachable ='YES' AND region.zone_name = '$zone' AND school.category = '$category'");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}



		// get all subject offered by the university
		public function get_university_offered_subject(){
			$sql = $this->db->get('university_subjects');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		public function get_all_school_subject(){
			$sql = $this->db->get('subject');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		public function get_all_school_suggested_school(){
			$sql = $this->db->get('suggested_school');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		// get all subjects offered by a school
		public function get_school_subject($school_ID = ''){
			$this->db->where('school_Reg',$school_ID);
			$sql = $this->db->get('subject');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}


		// get all allocated schools
		public function get_allocated_school($year=''){
			$this->db->where('ac_year',$year);
			$sql = $this->db->get('assessors_alloction');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		public function get_allocated_region_details($region = ''){
			$query = $this->db->query("SELECT `fname`,`lname`, region.*, assessors_alloction.* FROM assessors_alloction 
							INNER JOIN `adminstrator` ON `assessors_alloction`.`AID` = `adminstrator`.`AID`
                            INNER JOIN `region` ON `region`.`region_name` = `assessors_alloction`.`region`
                            WHERE `assessors_alloction`.`region` = '$region'");
			if($query->num_rows > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}


		// get school from the region
		public function get_region_school($region = ''){
			$this->db->where('region',$region);
			$sql = $this->db->get('school');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

			// get school allocated specifically for this region
		public function get_region_allocated_school($region = '',$year=''){
			$this->db->where('region',$region);
			$this->db->where('ac_year',$year);
			$sql = $this->db->get('assessors_alloction');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}


		// get the instructors for other zone 
		public function get_other_zone_instructor($zone = '',$year=''){
			$sql = $this->db->query("SELECT `AID` FROM `assessors_alloction` WHERE `zone` != '$zone' AND `ac_year` = '$year'");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		public function get_region_zone($region = ''){
			$query = $this->db->query("SELECT `zone_name` FROM `region` WHERE `region_name` = '$region'");
			if($query->num_rows() > 0){
				return $query->row_array();
			}
		}


		public function application_request($SID = '', $year=''){
			$query = $this->db->query("SELECT `status` FROM `application_request` WHERE `SID` = '$SID' AND ac_year = '$year'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
		}

        public function check_institution_application($REG = '', $year=''){
			$query = $this->db->query("SELECT * FROM `application` WHERE `school_Reg` = '$REG' AND ac_year = '$year'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
		}

		//select school found in the region but its reachable
			public function select_region_school($region = '',$category){
			$query = $this->db->query("SELECT * FROM `school` WHERE `region` = '$region' AND `reachable` = 'YES' AND category = '$category' ");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
		}



		//check how many times the school is selected by the student
			public function how_many_times_sch_selected($school = '', $year = ''){
			$query = $this->db->query("SELECT * FROM `application` WHERE `school_Reg` = '$school' AND `ac_year` = '$year' ");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
		}

		//get all student in the application
		public function get_all_application($REG='', $year){
			$query = $this->db->query("SELECT student_FTP.*, application.* FROM application INNER JOIN student_FTP ON application.SID = student_FTP.SID WHERE application.school_Reg = '$REG' AND ac_year = '$year' ORDER BY fname ASC");
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		

		// check instructor if exist 
		public function check_instructor($AID = ''){
			$query = $this->db->query("SELECT * FROM `assessors_alloction` WHERE `AID` = '$AID'");
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return false;
			}
		}


		public function get_school_info($schoolID = ''){
			$query = $this->db->query("SELECT * FROM `school` WHERE `S_Reg_No` = '$schoolID'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}


		public function check_application_window($year = ''){
			$query = $this->db->query("SELECT `status` FROM `accademic_year` WHERE `year` = '$year' AND `status` = 'YES'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}


		//check if the student has already selected the field
			public function check_student_application($SID = '', $year = ''){
			$query = $this->db->query("SELECT * FROM `application` WHERE `ac_year` = '$year' AND `SID` = '$SID'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		//select student selected the same field
		public function other_student($SID ='',$regNO ='',$year =''){
			$query = $this->db->query("SELECT `student_FTP`.*, `application`.* FROM `application` INNER JOIN `student_FTP` ON `student_FTP`.`SID` = `application`.`SID` WHERE `application`.`school_Reg` = '$regNO' AND `application`.`ac_year` = '$year' AND `application`.`SID` != '$SID' ");
			if($query->num_rows() >0){
				return $query->result_array();
			}else{
				return false;
			}
		}



		// get all regions
		public function get_all_regions(){
			$sql = $this->db->query("SELECT * FROM `region`  ORDER BY `region`.`region_name` ASC ");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

		// get all regions
		public function get_all_regions_by(){
			$sql = $this->db->query("SELECT * FROM `region`  ORDER BY `region`.`zone_name` ASC ");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

		// get univerisity accasdemic year
		public function get_accademic_year(){
			$sql = $this->db->query("SELECT `year` FROM `accademic_year` WHERE `current` = 'YES' ");
				if($sql->num_rows() > 0){
					return $sql->row_array(); 
				}else{
					return false;
				}
		}

		// get subject from application in current year
		public function subject_in_application($year ='',$reg_no = '',$subname =''){
			$sql = $this->db->query("SELECT * FROM `application` WHERE `ac_year` = '$year' AND `school_Reg` = '$reg_no' AND `subject` = '$subname' ");
				if($sql->num_rows() > 0){
					return $sql->row_array(); 
				}else{
					return false;
				}
		}


				// getall assessor information 
		public function all_assessors_info(){
			$sql = $this->db->query("SELECT DISTINCT `fname`,`lname`,`mname`, `assessors_alloction`.`AID` FROM assessors_alloction 
							INNER JOIN `adminstrator` ON `assessors_alloction`.`AID` = `adminstrator`.`AID`");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}


				// getall assessor information from logbook
		public function all_logbook_assessor(){
			$sql = $this->db->query("SELECT `fname`,`lname`,`mname`, `logbook_assess`.`AID` FROM logbook_assess 
							INNER JOIN `adminstrator` ON `logbook_assess`.`AID` = `adminstrator`.`AID` GROUP BY adminstrator.AID");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		// getall assessor information from report
		public function all_report_assessor(){
			$sql = $this->db->query("SELECT `fname`,`lname`,`mname`, `report_assess`.`AID` FROM report_assess 
							INNER JOIN `adminstrator` ON `report_assess`.`AID` = `adminstrator`.`AID` GROUP BY adminstrator.AID");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

				// getall assessor schools details 
		public function get_assessor_logbook($AID = '', $year=''){
			$sql = $this->db->query("SELECT `school`.*,id FROM `logbook_assess` 
									INNER JOIN `school` ON `logbook_assess`.`I_ID` = `school`.`S_Reg_No`
									WHERE `logbook_assess`.`AID` = '$AID' AND `logbook_assess`.`ac_year` = '$year' ");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}


			// getall assessor schools details 
		public function get_assessor_report($AID = '', $year=''){
			$sql = $this->db->query("SELECT `school`.*,id FROM `report_assess` 
									INNER JOIN `school` ON `report_assess`.`I_ID` = `school`.`S_Reg_No`
									WHERE `report_assess`.`AID` = '$AID' AND `report_assess`.`ac_year` = '$year' ");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}
				// getall assessor schools details 
		public function get_assessor_schools($AID = '', $year=''){
			$sql = $this->db->query("SELECT `school`.*, `assessors_alloction`.`school_reg` FROM `assessors_alloction` 
									INNER JOIN `school` ON `assessors_alloction`.`school_reg` = `school`.`S_Reg_No`
									WHERE `assessors_alloction`.`AID` = '$AID' AND `assessors_alloction`.`ac_year` = '$year' ");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		// get all field application
		public function check_student_appliction_zone($year=''){
			$sql = $this->db->query("SELECT DISTINCT `zone_name` FROM `application` INNER JOIN `school` ON `application`.`school_Reg` = `school`.`S_Reg_No` INNER JOIN `region` ON `region`.`region_name` = `school`.`region` WHERE `ac_year` = '$year' ORDER BY `zone_name`");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

		// get all field application
		public function check_student_appliction($year=''){
			$sql = $this->db->query("SELECT `school_Reg`,`region`,`zone_name` FROM `application` INNER JOIN `school` ON `application`.`school_Reg` = `school`.`S_Reg_No` INNER JOIN `region` ON `region`.`region_name` = `school`.`region` WHERE `ac_year` = '$year' GROUP BY region");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}


		// get all field application
		public function check_student_appliction_all_shool($year=''){
			$sql = $this->db->query("SELECT DISTINCT `school_Reg`,`region` FROM `application` INNER JOIN `school` ON `application`.`school_Reg` = `school`.`S_Reg_No` INNER JOIN `region` ON `region`.`region_name` = `school`.`region` WHERE `ac_year` = '$year'");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

		// get all schools
		public function get_all_schools(){
			$sql = $this->db->query("SELECT * FROM `school`  ORDER BY `school`.`region` ASC ");
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return false;
				}
		}

		public function student_applied($regNo=''){
			$query = $this->db->query("SELECT DISTINCT `zone_name` FROM `region` INNER JOIN `school` ON `region`.`region_name` = `school`.`region` WHERE `school`.`S_Reg_No` = '$regNo' ");
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
		}


		public function logbook_marking_view($AID='',$year){
			$query = $this->db->query("SELECT  school.* FROM `logbook_assess` INNER JOIN `school` ON `logbook_assess`.`I_ID` = `school`.`S_Reg_No` WHERE AID = '$AID' AND ac_year = '$year' ");
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function report_marking_view($AID='',$year){
			$query = $this->db->query("SELECT  school.* FROM `report_assess` INNER JOIN `school` ON `report_assess`.`I_ID` = `school`.`S_Reg_No` WHERE AID = '$AID' AND ac_year = '$year' ");
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function get_account($AID,$pass){
				$sql = $this->db->query("SELECT * FROM adminstrator WHERE `AID` = '$AID' and password = '$pass'; ");
				if($sql->num_rows() > 0){
					return $sql->result(); 
				}else{
					return false;
				}
        }




	}


?>