<?php
class Home_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function login($userID, $password, $user,$idName){
			$query = $this->db->get_where($user, array($idName=>$email, 'password'=>$password));
			return $query->row_array();
		}

		public function  get_logo() {
				$sql = $this->db->get('logo');
			if($sql->num_rows()>0){
						$answer =  $sql->row_array();
						return $answer['logo_name'];
			}else {
				return false;
			}
		}

		public function get_page($page = ''){
				$sql = $this->db->get_where('pages', array('title' => $page) );
			return $sql->row_array();
		}

		public function get_page_Result($page = ''){
				$sql = $this->db->get_where('pages', array('title' => $page) );
			return $sql->result();
		}

}

?>
