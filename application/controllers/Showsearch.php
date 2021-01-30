<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Showsearch extends CI_Controller {

	/**
	 * Main search page
	 * 
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model("Showsearch_model");
		set_time_limit(60);
	}

	public function index()
	{
		$data["datosp"]= array();
		$data["datoso"]= array();

		if ($this->input->post()){
			if ($this->input->post("flexsearch")=="name"){
				if ($this->input->post("txtuser")!=''){
					$data["datosp"] = $this->Showsearch_model->get_data_people(0, "name", $this->input->post("txtuser"));
				}	
			}
			else 
			{
				if ($this->input->post("txtuser")!=''){
					$data["datoso"] = $this->Showsearch_model->get_data_opor(0, $this->input->post("txtuser"));
				}	
			}
		}
		$this->load->view('showsearch', $data);
	}
}
