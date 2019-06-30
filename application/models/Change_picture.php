<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_picture extends Base_Controller {
	
	/**
     * Change Picture Form
     *
     * @access 	public
     * @param 	
     * @return 	view
     */

	public function index()
	{
		$this->data['title'] = 'Change Picture';
		$this->data['subview'] = 'change_picture/main';
		$this->load->view('components/main', $this->data);
	}

	/**
     * Validate Input
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */



	public function crop()

	{

		$id 	= $this->session->userdata('active_user')->id;
		$foto  	= $this->input->post('avatar_member');

		$this->load->model('picture_m');
		$this->picture_m->insert($id, $foto);

		$this->load->view('change_picture/crop');   

	}


	public function croppie()

	{

		$id 	= $this->session->userdata('active_user')->id;
		$foto  	= date('YmdHis');

		$this->data['NamaFile'] = $foto.'.png';

		$this->load->model('picture_m');
		$this->picture_m->insert($id, $foto);

		$this->load->view('change_picture/croppie', $this->data);   

	}



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
			if ($user->password != $this->input->post('old_password')) {
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

}
