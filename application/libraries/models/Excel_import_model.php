<?php
class Excel_import_model extends CI_Model
{


	function insert($data)
	{
		$this->db->insert_batch('student', $data);
	}
    
    function insert_institution($data)
	{
		$this->db->insert_batch('school', $data);
	}
}
