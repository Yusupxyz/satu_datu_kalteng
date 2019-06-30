<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends Base_Controller {

	/**
     * List of Groups
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
		$this->data['title'] = 'Satu Data KKP Kalteng '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'status/main';
		$this->load->view('components/main', $this->data);
	}

	/**
     * Group Form
     *
     * @access 	public
     * @param 	
     * @return 	view
     */

	public function form()
	{
		$data['index'] = $this->input->post('index');
		$this->load->view('status/form', $data);
	}

	/**
     * Datagrid Data
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function data()
	{
        header('Content-Type: application/json');
        $this->load->model('status_m');
		echo json_encode($this->status_m->getJson($this->input->post()));
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
				'field' => 'status',
				'label' => 'Status',
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
		if (!$this->input->post('id_status')) {
			$this->create();
		} else {
			$this->update();
		}
	}

	/**
     * Create a New Group
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function create()
	{
		$data['status'] = strtoupper($this->input->post('status'));
		$this->db->insert('tbl_status', $data); 

		header('Content-Type: application/json');
    	echo json_encode('success');
	}

	/**
     * Update Existing Group
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function update()
	{
		$data['status'] = strtoupper($this->input->post('status'));
		$this->db->where('id_status', $this->input->post('id_status'));
		$this->db->update('tbl_status', $data); 

		header('Content-Type: application/json');
    	echo json_encode('success');
	}

	/**
     * Delete a Group
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function delete()
	{
		$this->db->where('id_status', $this->input->post('id'));
		$this->db->delete('tbl_status');
	}

}
