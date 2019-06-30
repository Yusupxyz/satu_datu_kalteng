<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Base_Controller {

	/**
     * Update Profile Form
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
		$this->load->model('group_m');

		$this->data['title'] = 'APP UKT&SPP'. get_field('1','settings','meta_value');
		$this->data['subview'] = 'profile/main';
		$this->data['groups'] = $this->group_m->all();

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
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			],
			[
				'field' => 'group_id',
				'label' => 'Group Id',
				'rules' => 'required'
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
     * Save Profile Changes
     *
     * @access 	public
     * @param 	
     * @return 	json('string')
     */

	public function save()
	{
		$data['name'] 		= $this->input->post('name');
		$data['email']   	= $this->input->post('email');
		$data['group_id'] 	= $this->input->post('group_id');
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $data);

		$this->load->model('user_m');
		$user = $this->user_m->get_user($this->input->post('id'));
		$this->session->set_userdata('active_user', $user);

		header("Content-type:application/json");
		echo json_encode('success');
	}

}
