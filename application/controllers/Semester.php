<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends Base_Controller {

	/**
     * List of Semester
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
		$this->load->model('tahun_m');
		$this->data['tahun'] = $this->tahun_m->all();
		$this->data['subview'] = 'semester/main';
		$this->load->view('components/main', $this->data);
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
        $this->load->model('semester_m');
		echo json_encode($this->semester_m->getJson($this->input->post()));
	}

	/**
     * Check Year
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	function check()
    {
        $query = null; 
        $year   = $this->input->post('year'); 
		$query = $this->db->get_where('tbl_tahun', array('tahun' => $year));
		$count = $query->num_rows(); 
        if ($count === 0) {
			header("Content-type:application/json");
			echo json_encode('success');
        }else{
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}
	}
	
	/**
     * Set Year
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	function set_tahun()
    {


        $data['state'] = '0';
		$this->db->where('state', '1');
		$this->db->update('tbl_tahun', $data); 

		$data['state'] = '1';
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('tbl_tahun', $data); 
 
		$this->load->model('tahun_m');
		$id = $this->tahun_m->get_aktif_tahun();

		$this->db->like('link', 'semester1');
		$this->db->or_like('link', 'semester2');
		$this->db->delete('menus');

		$this->create_menu_semester($id->tahun);

        header('Content-Type: application/json');
    	echo json_encode('success');
    }

	/**
     * Create a New Semester
     *
     * @access 	public
     * @param 	
     * @return 	json(string)
     */

	public function create()
	{
		$data['tahun'] = $this->input->post('year');
		$data['state'] = '0';
		$this->db->insert('tbl_tahun', $data); 
		$this->load->model('tahun_m');
		$id = $this->tahun_m->get_tahun($this->input->post('year'));
		
		$data2['id_tahun'] = $id->id;
		$data2['periode_semester'] = 'Semester 1';
		$this->db->insert('tbl_semester', $data2); 

		$data3['id_tahun'] = $id->id;
		$data3['periode_semester'] = 'Semester 2';
		$this->db->insert('tbl_semester', $data3); 

		$this->create_menu_semester($this->input->post('year'));
		

		redirect('semester');

		header('Content-Type: application/json');
    	echo json_encode('success');
	}

	public function create_menu_semester($year){
		$data4['parent_id'] ='3';
		$data4['child'] ='0';
		$data4['title'] = $year.' Semester 1';
		$data4['link'] ='semester1_v2';
		$data4['icon'] ='i i-dot';
		$this->db->insert('menus', $data4); 

		$data5['parent_id'] ='3';
		$data5['child'] ='0';
		$data5['title'] = $year.' Semester 2';
		$data5['link'] ='semester2_v2';
		$data5['icon'] ='i i-dot';
		$this->db->insert('menus', $data5); 

		$data6['parent_id'] ='2';
		$data6['child'] ='0';
		$data6['title'] =$year.' Semester 1';
		$data6['link'] ='semester1_v1';
		$data6['icon'] ='i i-dot';
		$this->db->insert('menus', $data6); 

		$data7['parent_id'] ='2';
		$data7['child'] ='0';
		$data7['title'] = $year.' Semester 2';
		$data7['link'] ='semester2_v1';
		$data7['icon'] ='i i-dot';
		$this->db->insert('menus', $data7); 

		$data8['parent_id'] ='4';
		$data8['child'] ='0';
		$data8['title'] = $year.' Semester 1';
		$data8['link'] ='semester1_d';
		$data8['icon'] ='i i-dot';
		$this->db->insert('menus', $data8); 

		$data9['parent_id'] ='4';
		$data9['child'] ='0';
		$data9['title'] = $year.' Semester 2';
		$data9['link'] ='semester2_d';
		$data9['icon'] ='i i-dot';
		$this->db->insert('menus', $data9); 

		$data10['parent_id'] ='5';
		$data10['child'] ='0';
		$data10['title'] = $year.' Semester 1';
		$data10['link'] ='semester1_u';
		$data10['icon'] ='i i-dot';
		$this->db->insert('menus', $data10); 

		$data11['parent_id'] ='5';
		$data11['child'] ='0';
		$data11['title'] = $year.' Semester 2';
		$data11['link'] ='semester2_u';
		$data11['icon'] ='i i-dot';
		$this->db->insert('menus', $data11); 
	}

	public function _uploadImage()
	{
		$config['upload_path']          = './upload/product/';
		$config['allowed_types']        = 'xls';
		$config['file_name']            = $this->product_id;
		$config['overwrite']			= true;
		// $config['max_size']             = 1024; // 1MB
		// // $config['max_width']            = 1024;
		// // $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			return $this->upload->data("file_name");
		}
		
		return "default.jpg";
	}

}
