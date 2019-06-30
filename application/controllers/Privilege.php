<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends Base_Controller {

	/**
     * Privilege Settings
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
		$this->load->model('menu_m');
		$this->load->model('group_m');
		
		$this->data['title'] = 'APP UKT&SPP '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'privilege/main';
		$this->data['menus'] = $this->menu_m->all();
		$this->data['groups'] = $this->group_m->all();

		$this->load->view('components/main', $this->data);
	}

	/**
     * Load Privilege by Selected Group
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function load()
	{
		$this->load->model('privilege_m');
		$privileges = $this->privilege_m->get_privilege($this->input->post('group_id'));
		header("Content-type:application/json");
		echo json_encode($privileges);
	}

	/**
     * Save Privilege Of Selected Group
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function action()
	{
		$this->db->where('group_id', $this->input->post('group_id'));
		$this->db->delete('privileges');

		foreach ($this->input->post('arr_id') as $id) {
				$data['group_id'] = $this->input->post('group_id');
				$data['menu_id'] = $id;
				$this->db->insert('privileges', $data);
		}
	}

}
