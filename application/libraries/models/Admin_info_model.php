<?php 
	class Admin_info_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function get_admin_access_ifo($AID = ''){
			$query = $this->db->query("SELECT * FROM `adminstrator_access` WHERE `access_ID` = '1' AND `AID` = '$AID'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
			else{
				return false;
			}
		}

        // student management
    public function student_management($AID = ''){
			$query = $this->db->query("SELECT * FROM `adminstrator_access` WHERE `access_ID` = '1' AND `AID` = '$AID' OR `access_ID` = '2' AND `AID` = '$AID' OR `access_ID` = '3' AND `AID` = '$AID'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
			else{
				return false;
			}
		}


		// get all instructors
		public function get_all_instructors(){
			$sql = $this->db->get('adminstrator');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		// check instructor if is allocated to supervice the student in their field in that year 
		public function check_instructor_allocation($AID = '', $year= ''){
			$query = $this->db->query("SELECT * FROM `assessors_alloction` WHERE `AID` = '$AID' AND ac_year = '$year'");
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return false;
			}
		}


		// get all students in FTP table
		public function get_all_students($year = ''){
                    $this->db->where('accademic_year',$year);
			$sql = $this->db->get('student_FTP');
				if($sql->num_rows() > 0){
					return $sql->result_array(); 
				}else{
					return [];
				}
		}

		public function get_assistant_admin_access_ifo($AID = ''){
			$query = $this->db->query("SELECT * FROM `adminstrator_access` WHERE `access_ID` = '1' AND `AID` = '$AID' OR `access_ID` = '2' AND `AID` = '$AID'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
			else{
				return false;
			}
		}

        public function get_assistant_admin_access(){
			$query = $this->db->query("SELECT fname,lname,mname,email FROM `adminstrator_access` INNER JOIN adminstrator ON adminstrator_access.AID = adminstrator.AID WHERE `access_ID` = '1'");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
			else{
				return false;
			}
		}

		public function instructor_details($AID = ''){
			$query = $this->db->query("SELECT * FROM `adminstrator` WHERE `AID` = '$AID'");
			if($query){
				return $query->row_array();
			}
			else{
				return false;
			}
		}

		public function get_instructor_details($AID = ''){
			$query = $this->db->query("SELECT * FROM `adminstrator` WHERE `AID` = '$AID'");
			if($query){
				return $query->row_array();
			}
			else{
				return false;
			}
		}


		public function get_access_list(){
			$query = $this->db->query("SELECT * FROM `access`");
			if($query->num_rows() > 0){
				return $query->result_array();
			}
			else{
				return false;
			}
		}



	}


?>