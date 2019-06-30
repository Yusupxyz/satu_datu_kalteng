<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile_student extends Base_Controller {
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

		if($this->session->userdata('active_user')->group_id != '3'){
			redirect('auth/logout');
		}
	}
	public function index()
		{
		$this->load->model('students_m');
		$this->data['title'] = 'APP UKT&SPP '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'profile_student/main';
		//cari id students
		$students_id = $this->students_m->get_student_id($this->session->userdata('active_user')->id);
		$this->data['students'] = $this->students_m->get_students($students_id);
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
				'field' => 'birthplace',
				'label' => 'Birthplace',
				'rules' => 'required'
			],
			[
				'field' => 'birthdate',
				'label' => 'Birthdate',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'Email',
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
* Save Profile Changes
*
	* @access 	public
	* @param
	* @return 	json('string')
*/
	public function save()
	{

		//cari id students
		$students_id = $this->students_m->get_student_id($this->session->userdata('active_user')->id);
		$data['email']   		= $this->input->post('email');
		$data['gender'] 		= $this->input->post('gender');
		$data['birthplace'] 	= $this->input->post('birthplace');
		$data['birthdate'] 		= date('Y-m-d',strtotime($this->input->post('birthdate')));
		$data['phone_number'] 	= $this->input->post('phone_number');
		$data['address'] 		= $this->input->post('address');
		
		$this->db->where('id', $students_id);
		$this->db->update('students', $data);
		header("Content-type:application/json");
		echo json_encode('success');
	}
}