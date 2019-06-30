<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kab_kota extends Base_Controller {

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
		$this->data['subview'] = 'kab_kota/main';
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
		$this->load->view('kab_kota/form', $data);
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
        $this->load->model('kab_kota_m');
		echo json_encode($this->kab_kota_m->getJson($this->input->post()));
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
				'field' => 'kabupaten_kota',
				'label' => 'Kabupaten/Kota',
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
		if (!$this->input->post('id_kabupaten_kota')) {
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
		$data['kabupaten_kota'] = $this->input->post('kabupaten_kota');
		$this->db->insert('tbl_kabupaten_kota', $data); 

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
		$data['kabupaten_kota'] = $this->input->post('kabupaten_kota');
		$this->db->where('id_kabupaten_kota', $this->input->post('id_kabupaten_kota'));
		$this->db->update('tbl_kabupaten_kota', $data); 

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
		$this->db->where('id_kabupaten_kota', $this->input->post('id'));
		$this->db->delete('tbl_kabupaten_kota');
	}

}
