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
			echo json_encode($this->lembar_kerja_m->getJson($this->input->post(),'Semester 2'));
		}elseif($this->session->userdata('active_user')->group_id == '2'){
			echo json_encode($this->lembar_kerja_m->getJson2($this->input->post(),'Semester 2'));
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
     * Download Lembar Kerja Semester 1
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

    public function download($id=null,$id_lembar_kerja=null){			

		date_default_timezone_set('Asia/Jakarta');
		$data['id_admin_kk']=$this->session->userdata('active_user')->id;
		$data['download_on']=date('Y-m-d G:i:s');
		$this->db->where('id_lembar_kerja', $id_lembar_kerja);
		$this->db->update('tbl_lembar_kerja', $data); 
		
        $this->load->helper('download');
	
        $this->load->model('template_m');
        $file=$this->template_m->getExcel($id);
        
        force_download('assets/uploads_template2/'.$file->template,NULL);
		
	

        header('Content-Type: application/json');
    	echo json_encode("File Kosong");
	}

}
