<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends Base_Controller {

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
		$this->data['title'] = 'Satu Data KKP Kalteng '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'template/main';
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
		$this->load->model('direktorat_m');
		$data['groups'] = $this->group_m->all();
		if ($this->input->post('id_ref')=="2"){
			$data['refs'] = $this->direktorat_m->all_sub();
		}elseif ($this->input->post('id_ref')=="3"){
			$data['refs'] = $this->kab_kota_m->all_sub();
		}
		$data['index'] = $this->input->post('index');
		$this->load->view('template/form', $data);
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
        $this->load->model('template_m');
		echo json_encode($this->template_m->getJson($this->input->post()));
	}


	/**
     * Update Existing Template
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function update()
	{
		date_default_timezone_set('Asia/Jakarta');
		$data['id_kategori_direktorat']=$this->input->post("id_kategori_direktorat");
		$data['upload_on']=date('Y-m-d G:i:s');
	
		$config['upload_path']          = './assets/uploads_template/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['overwrite'] = TRUE;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('excel')){
			$data['template'] = $this->upload->display_errors();
		}else{
			$data['template'] = $this->upload->data("file_name");
		}
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('tbl_template', $data); 

		header('Content-Type: application/json');
    	echo json_encode('success');
	}

    public function download($id=null){			
        $this->load->helper('download');
	
        $this->load->model('template_m');
        $file=$this->template_m->getExcel($id);
        
        force_download('assets/uploads_template/'.$file->template,NULL);

        header('Content-Type: application/json');
    	echo json_encode(site_url().'assets/uploads/'.$file->template);
	}
}
