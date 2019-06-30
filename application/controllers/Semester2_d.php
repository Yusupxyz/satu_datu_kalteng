<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester2_d extends Base_Controller {

    function __construct(){
		parent::__construct();
		
	}

	/**
     * List of Semester2
     *
     * @access 	public
     * @param 	
     * @return 	view
     */
	
	public function index()
	{
		$this->data['title'] = 'Satu Data KKP Kalteng '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'semester2_d/main';
		$this->load->view('components/main', $this->data);
	}

	/**
     * Datagrid Semester1
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function data()
	{
        header('Content-Type: application/json');
        $this->load->model('lembar_kerja_m');
		if($this->session->userdata('active_user')->group_id == '3'){
			echo json_encode($this->lembar_kerja_m->getJson($this->input->post(),'Semester 1'));
		}elseif($this->session->userdata('active_user')->group_id == '2'){
			echo json_encode($this->lembar_kerja_m->getJson2($this->input->post(),'Semester 1'));
		}
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
				'field' => 'kategori_d_id',
				'label' => 'Lembar Kerja',
				'rules' => 'required'
			]
			
		];

			// $this->form_validation->set_rules('excel', 'File', 'callback_file_check');

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
     * Create a New Semester1
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function create()
	{
		date_default_timezone_set('Asia/Jakarta');
		$uniqid= uniqid();
		$data['id_lembar_kerja'] = $uniqid;
		$data['id_users'] = $this->input->post('id_user');
		$data['id_semester'] = $this->input->post('id_semester');
		$data['id_kategori_d'] = $this->input->post('kategori_d_id');
		$data['keterangan_lembar_kerja'] = $this->input->post('keterangan');
		$data['uploaded_on']=date('Y-m-d G:i:s');
	
		$config['upload_path']          = './assets/uploads/';
		$config['allowed_types']        = 'xls|xlsx';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('excel')){
			$data['file_lembar_kerja'] = $this->upload->display_errors();
		}else{
			$data['file_lembar_kerja'] = $this->upload->data("file_name");
		}
		$this->db->insert('tbl_lembar_kerja', $data); 

		$this->createValidasi($uniqid);

		header('Content-Type: application/json');
    	echo json_encode('success');
	}

	/**
     * Create a New Semester1
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	private function createValidasi($idLembarKerja){
		$data['id_validasi'] = uniqid();
		$data['id_lembar_kerja'] = $idLembarKerja;
		$data['id_status_1'] = '1';
		$this->db->insert('tbl_validasi', $data); 
	}

    public function download($id=null){			
        $this->load->helper('download');
	
        $this->load->model('lembar_kerja_m');
        $file=$this->lembar_kerja_m->getExcel($id);
        
        force_download('assets/uploads/'.$file->file_lembar_kerja,NULL);

        header('Content-Type: application/json');
    	echo json_encode(site_url().'assets/uploads/'.$file->file_lembar_kerja);
	}

}
