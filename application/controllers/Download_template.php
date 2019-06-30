<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_template extends Base_Controller {

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
	}

	public function index()
	{
		$this->data['title'] = 'Satu Data KKP Kalteng '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'download_template/main';
		$this->load->view('components/main', $this->data);
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
     *Update download_on
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function update($id)
	{
		date_default_timezone_set('Asia/Jakarta');
		$data['status']="1";
		$data['download_on']=date('Y-m-d G:i:s');
		$data['id_user']= $this->session->userdata('active_user')->id;
		$data['id_template']= $id;
		
		$this->db->insert('tbl_download_lk', $data); 
	}


    public function download($id=null){	
        
        $this->update($id);

        $this->load->helper('download');
	
        $this->load->model('template_m');
        $file=$this->template_m->getExcel($id);
        
        force_download('assets/uploads_template/'.$file->template,NULL);

        header('Content-Type: application/json');
    	echo json_encode(site_url().'assets/uploads/'.$file->template);
	}
}
