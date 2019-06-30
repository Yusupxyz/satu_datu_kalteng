<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_Password extends Base_Controller {
	
	/**
     * Change Password Form
     *
     * @access 	public
     * @param 	
     * @return 	view
     */

	public function index()
	{
		$this->data['title'] = 'APP UKT&SPP'. get_field('1','settings','meta_value');
		$this->data['subview'] = 'change_password/main';
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
				'field' => 'old_password',
				'label' => 'Old Password',
				'rules' => 'required'
			],
			[
				'field' => 'new_password',
				'label' => 'New Password',
				'rules' => 'required'
			]
		];

		$this->load->model('user_m');
		$id = $this->session->userdata('active_user')->id;
		$user = $this->user_m->get_user($id);
		
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			if (!password_verify($this->input->post('old_password'), $user->password)){
				header("Content-type:application/json");
				echo json_encode(['old_password' => ['Wrong old password']]);
			} else {
				header("Content-type:application/json");
				echo json_encode('success');
			}
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}
	}

	/**
     * Save a New Password
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function save()
	{
		
		$data['password'] =password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $data);

		header("Content-type:application/json");
		echo json_encode('success');
	}

}
