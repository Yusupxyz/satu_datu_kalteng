<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {
	
	/**
     * Dashboard
     *
     * @access  public
     * @param   
     * @return  view
     */
	
	public function index()
	{
		
		if($this->session->userdata('active_user')->group_id == '3'){


		$this->data['title'] = 'Satu Data KKP Kalteng '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'dashboard/main';


	}else{

		$this->data['title'] = 'Satu Data KKP Kalteng '. get_field('1','settings','meta_value');
		$this->data['subview'] = 'dashboard/main';		
	}


		$this->load->view('components/main', $this->data);
	}

}
