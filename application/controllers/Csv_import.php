<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_import extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('csv_import_model');
		$this->load->library('csvimport');
	}

	function index()
	{
		$this->load->view('csv_import');
	}



	function import()
	{
		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		foreach($file_data as $row)
		{
			$data[] = array(
				'S_Reg_No'	=>	time(),
        		'name'		=>	$row["Institution name"],
        		'address'			=>	$row["Address"],
        		'region'			=>	$row["Region"],
                'category' => $row['Category'],
                'districtict' => $row['District'],
                'student_required' => $row['NO. stuident']
			);
		}
		//$this->csv_import_model->insert($data);
        print_r($data);
	}
	
		
}
