<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester2_u extends Base_Controller {

	/**
     * List of Semester1
     *
     * @access 	public
     * @param 	
     * @return 	view
     */
	
	public function index()
	{
		$this->data['title'] = 'Satu Data KKP Kalteng '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'semester2_u/main';
		$this->load->view('components/main', $this->data);

	}

	/**
     * Semester1 Form
     *
     * @access 	public
     * @param 	
     * @return 	view
     */

	public function form()
	{
		$this->load->model('semester_m');
		$data['semester'] = $this->semester_m->get_idsemester('Semester 2');
		$this->load->model('kategori_d_m');
		$data['kategori_d'] = $this->kategori_d_m->all();
		$data['index'] = $this->input->post('index');
		$data['id_user'] = $this->session->userdata('active_user')->id;
		$this->load->view('semester2_u/form', $data);
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
     * Create a New Semester1
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function update()
	{
		date_default_timezone_set('Asia/Jakarta');
		$data['upload_by'] = $this->input->post('id_user');
		$data['keterangan'] = $this->input->post('keterangan');
		$data['uploaded_on']=date('Y-m-d G:i:s');
	
		$config['upload_path']          = './assets/uploads_s2/';
		$config['allowed_types']        = '*';
		$config['overwrite'] 			= TRUE;
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('excel')){
			$data['file_upload'] = $this->upload->display_errors();
		}else{
			$data['file_upload'] = $this->upload->data("file_name");
		}
		$this->db->where('id_lembar_kerja',$this->input->post("id_lembar_kerja"));
		$this->db->update('tbl_lembar_kerja', $data); 
		header('Content-Type: application/json');
		echo json_encode('success');
	}


}
