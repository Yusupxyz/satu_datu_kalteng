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

	/**
     * Create a New Template
     *
     * @access 	private
     * @param 	
     * @return 	json(string)
     */
	private function create_template($id)
	{
		$id_template1=uniqid();
		$id_template2=uniqid();
		$data['id_kategori_direktorat'] = $id;
		$data['periode_semester'] = 1;
		$data['aktif'] = "1";
		$data['id_template']=$id_template1;
		$this->db->insert('tbl_template', $data); 
		$data2['id_kategori_direktorat'] = $id;
		$data2['periode_semester'] =2;
		$data2['aktif'] ="0";
		$data2['id_template']=$id_template2;
		$this->db->insert('tbl_template', $data2); 
		$this->create_lk_kab_kota($id_template1,$id_template2);
	}

	/**
     * Create a New Lembar Kerja
     *
     * @access 	private
     * @param 	
     * @return 	json(string)
     */
	private function create_lk_kab_kota($id_template1,$id_template2)
	{
		$this->load->model("kab_kota_m");
		$this->load->model("template_m");
		$total_kk=$this->kab_kota_m->count()->total;

		for ($i = 0; $i < $total_kk; $i++) {
				$id_kk=$this->kab_kota_m->limit($i)->id_kabupaten_kota;
				$data['id_template'] = $id_template1;
				$data['id_kabupaten_kota'] = $id_kk;
				$this->db->insert('tbl_lembar_kerja', $data);
				$data2['id_template'] = $id_template2;
				$data2['id_kabupaten_kota'] = $id_kk;
				$this->db->insert('tbl_lembar_kerja', $data2);  
		}	
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

		$this->load->model("template_m");
		$data=$this->template_m->get_by_id($this->input->post('id'));
		foreach ($data as $key => $value) {
			$this->db->where('id_template', $value->id_template);
			$this->db->delete('tbl_lembar_kerja');
		}

		$this->db->where('id_kategori_direktorat', $this->input->post('id'));
		$this->db->delete('tbl_template');

		$this->db->where('id_kategori_direktorat', $this->input->post('id'));
		$this->db->delete('tbl_kategori_direktorat');
		
	}

}
