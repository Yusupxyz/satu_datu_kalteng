<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

	/**
     * List of Users
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
		$this->data['title'] = 'User';
		$this->data['subview'] = 'user/main';
		$this->load->view('components/main', $this->data);
	}

	/**
     * User Form
     *
     * @access 	public
     * @param 	
     * @return 	view
     */

	public function form(){
		$this->load->model('group_m');
		$this->load->model('direktorat_m');
		$this->load->model('kab_kota_m');
		$data['groups'] = $this->group_m->all();
		if ($this->input->post('id_ref')=="2"){
			$data['refs'] = $this->direktorat_m->all_sub();
		}elseif ($this->input->post('id_ref')=="3"){
			$data['refs'] = $this->kab_kota_m->all_sub();
		}
		$data['index'] = $this->input->post('index');
		$this->load->view('user/form', $data);
	}

	/**
     * Datagrid Data
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function data(){
        header('Content-Type: application/json');
        $this->load->model('user_m');
		echo json_encode($this->user_m->getJson($this->input->post()));
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
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'nama',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email'
			],
			[
				'field' => 'password',
				'label' => 'Password',
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
     * Create Update Action
     *
     * @access 	public
     * @param 	
     * @return 	method
     */

	public function action()
	{
		if (!$this->input->post('id')) {
			$this->create();
		} else {
			$this->update();
		}
	}

	/**
     * Create a New User
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function create()
	{
		$data['username'] 	= $this->input->post('username');
		$data['nama'] 		= $this->input->post('nama');
		$data['email']   	= $this->input->post('email');
		$data['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$data['group_id']   = $this->input->post('group_id');
		$data['softdelete'] = '0';
		$data['id_ref']   	= $this->input->post('id_ref');
		$this->db->insert('users', $data); 

		header('Content-Type: application/json');
    	echo json_encode('success');
	}

	/**
     * Update Existing User
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function update()
	{
		$data['username'] 		= $this->input->post('username');
		$data['nama'] 		= $this->input->post('nama');
		$data['email']   	= $this->input->post('email');
		$data['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$data['group_id']   = $this->input->post('group_id');
		$data['id_ref']   	= $this->input->post('id_ref');
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $data); 

		header('Content-Type: application/json');
    	echo json_encode('success');
	}

	/**
     * Delete a User
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function delete()
	{
		$data['softdelete']   = '1';
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $data); 

	}

		/**
     * Get user group
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function get_dir()
	{
		$this->load->model('direktorat_m');
		header("Content-Type: application/json", true);
		echo json_encode($this->direktorat_m->all());
		
	}

		/**
     * Get user group
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function get_kk()
	{
		$this->load->model('kab_kota_m');
		header("Content-Type: application/json", true);
		echo json_encode($this->kab_kota_m->all());
		
	}
}
