<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester1_v1 extends Base_Controller {

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
		$this->data['subview'] = 'semester1_v1/main';
		$this->load->model('status_m');
		$this->data['status']=$this->status_m->all();
		$this->load->model('lembar_kerja_m');
		$this->data['status_aktif']=$this->lembar_kerja_m->get_lk_aktif("Semester 1");
		$this->load->view('components/main', $this->data);
	}


		/**
     * Update Status
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	function update_status($index)
    {
		if ($this->input->post('komentar')!=""){
			$data['keterangan_invalid'] = $this->input->post('komentar');
		}else{
			$data['keterangan_invalid'] = "-";
		}
        $data['id_status'] = $this->input->post('id');
        $this->db->where('id_lembar_kerja',$index);
		$this->db->update('tbl_lembar_kerja', $data); 

        header('Content-Type: application/json');
    	echo json_encode('success');
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
		$data['id_user'] = $this->session->userdata('active_user')->id;
		$data['index'] = $this->input->post('index');
		$this->load->view('semester1_v1/form', $data);
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
		}else{
			echo json_encode($this->lembar_kerja_m->getJson3($this->input->post(),'Semester 1'));
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


	public function download($id=null){			
        $this->load->helper('download');
	
        $this->load->model('lembar_kerja_m');
        $file=$this->lembar_kerja_m->getExcel($id);
        
        force_download('assets/uploads/'.$file->file_upload,NULL);

        header('Content-Type: application/json');
    	echo json_encode(site_url().'assets/uploads/'.$file->file_upload);
	}

}
