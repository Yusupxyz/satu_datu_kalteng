<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Base_Controller {

	/**
     * Settings form
     *
     * @access 	public
     * @param 	
     * @return 	view
     */
	function __construct()
	{
		parent::__construct();

		if($this->session->userdata('active_user')->group_id == '3'){
			redirect('auth/logout');
		}
	}		
	public function index()
	{
		$this->load->model('setting_m');
		
		$this->data['title'] = 'Settings';
		$this->data['subview'] = 'settings/main';
		$this->data['settings'] = $this->setting_m->all();

		$this->load->view('components/main', $this->data);
	}

	/**
     * Validate Input
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function validate()
	{
		$rules = [
			[
				'field' => 'company_name',
				'label' => 'Company Name',
				'rules' => 'required'
			],
			[
				'field' => 'company_address',
				'label' => 'Company Address',
				'rules' => 'required'
			],
			[
				'field' => 'company_phone_number',
				'label' => 'Company Phone Number',
				'rules' => 'required'
			],
			[
				'field' => 'company_email',
				'label' => 'Company Email',
				'rules' => 'required|valid_email'
			]
		];

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}
	}

	/**
     * Save Settings Changes
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function save()
	{
		$data['meta_value'] = $this->input->post('company_name');
		$this->db->where('meta_key', 'company_name');
		$this->db->update('settings', $data);

		$data['meta_value'] = $this->input->post('company_address');
		$this->db->where('meta_key', 'company_address');
		$this->db->update('settings', $data);

		$data['meta_value'] = $this->input->post('company_phone_number');
		$this->db->where('meta_key', 'company_phone_number');
		$this->db->update('settings', $data);

		$data['meta_value'] = $this->input->post('company_email');
		$this->db->where('meta_key', 'company_email');
		$this->db->update('settings', $data);

		header("Content-type:application/json");
		echo json_encode('success');
	}

}
