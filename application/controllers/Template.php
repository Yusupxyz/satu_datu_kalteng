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
		$this->set_aktif();
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
		$data['id_user'] = $this->session->userdata('active_user')->id;
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
		$data['id_admin']=$this->input->post("id_user");
		$data['upload_on']=date('Y-m-d G:i:s');
		$filename=$this->input->post("nama_kategori_direktorat").'_Kalimantan_Tengah.xlsm';
	
		$config['upload_path']          = './assets/uploads_template/';
		$config['allowed_types']        = '*';
		$config['overwrite'] 			= TRUE;
		$config['file_name'] 			= $filename;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('excel')){
			$data['template'] = $this->upload->display_errors();
		}else{
			$data['template'] = $this->upload->data("file_name");
		}
		$this->db->where('id_template', $this->input->post('id_template'));
		$this->db->update('tbl_template', $data); 

		header('Content-Type: application/json');
    	echo json_encode($this->upload->data("file_name"));
	}

	/**
     * Update template
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function delete()
	{
		$data['template'] = "Tidak Ada";
		$data['upload_on'] = NULL;
		$data['id_admin'] = 0;
		$this->db->where('id_template', $this->input->post('id'));
		$this->db->update('tbl_template', $data); 
	}

	/**
     * Set Template Aktif
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function set_aktif()
	{
		if (!$this->input->post('val')) {
			$data['aktif'] = '1';
			$this->db->where('periode_semester', '1');
			$this->db->update('tbl_template', $data); 

			$data2['aktif'] = '0';
			$this->db->where('periode_semester', '2');
			$this->db->update('tbl_template', $data2);
		}else{
			if ($this->input->post('val')=='2'){
				$data['aktif'] = '0';
				$this->db->where('periode_semester', '1');
				$this->db->update('tbl_template', $data); 

				$data2['aktif'] = '1';
				$this->db->where('periode_semester', '2');
				$this->db->update('tbl_template', $data2);
			}else{
				$data['aktif'] = '1';
				$this->db->where('periode_semester', '1');
				$this->db->update('tbl_template', $data); 
	
				$data2['aktif'] = '0';
				$this->db->where('periode_semester', '2');
				$this->db->update('tbl_template', $data2);
			}
			header('Content-Type: application/json');
			echo json_encode('success');	
		}
		
	}
}
