<?php 
	class Student_info_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

	public function student_details($SID = ''){
			$query = $this->db->query("SELECT * FROM `student_FTP` WHERE `SID` = '$SID'");
			if($query){
				return $query->row_array();
			}
			else{
				return false;
			}
		}

	public function get_account($SID,$pass){
				$sql = $this->db->query("SELECT * FROM student_FTP WHERE `SID` = '$SID' and password = '$pass'; ");
				if($sql->num_rows() > 0){
					return $sql->result(); 
				}else{
					return false;
				}
        }
 


}
?>