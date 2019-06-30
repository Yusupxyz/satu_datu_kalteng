<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_d extends Base_Controller {

	/**
     * List of Kategori Direktorat
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
		$this->data['subview'] = 'kategori_d/main';
		$this->load->view('components/main', $this->data);
	}

	/**
     * Kategori Direktorat Form
     *
     * @access 	public
     * @param 	
     * @return 	view
     */

	public function form()
	{
        $data['index'] = $this->input->post('index');
        $this->load->model('direktorat_m');
        $data['direktorat']=$this->direktorat_m->all();
		$this->load->view('kategori_d/form', $data);
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
        $this->load->model('kategori_d_m');
		echo json_encode($this->kategori_d_m->getJson($this->input->post()));
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
				'field' => 'nama_kategori_direktorat',
				'label' => 'Kategori Direktorat',
				'rules' => 'required'
			],
			[
				'field' => 'id_direktorat',
				'label' => 'Direktorat',
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
		if (!$this->input->post('id_kategori_direktorat')) {
			$this->create();
		} else {
			$this->update();
		}
	}

	/**
     * Create a New Kategori Direktorat
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function create()
	{
		$data['nama_kategori_direktorat'] = $this->input->post('nama_kategori_direktorat');
		$data['id_direktorat'] = $this->input->post('id_direktorat');
		$this->db->insert('tbl_kategori_direktorat', $data); 
		$this->load->model("kategori_d_m");
		$id=$this->kategori_d_m->get_kategori_name($this->input->post("nama_kategori_direktorat"))->id_kategori_direktorat;
		$this->create_template($id);
		header('Content-Type: application/json');
    	echo json_encode('success');
	}

	public function create_template($id)
	{
		$data['id_kategori_direktorat'] = $id;
		$this->db->insert('tbl_template', $data); 
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
		$data['nama_kategori_direktorat'] = $this->input->post('nama_kategori_direktorat');
		$data['id_direktorat'] = $this->input->post('id_direktorat');
		$this->db->where('id_kategori_direktorat', $this->input->post('id_kategori_direktorat'));
		$this->db->update('tbl_kategori_direktorat', $data); 

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

		$this->db->where('id_kategori_direktorat', $this->input->post('id'));
		$this->db->delete('tbl_template');

		$this->db->where('id_kategori_direktorat', $this->input->post('id'));
		$this->db->delete('tbl_kategori_direktorat');
	}

}
