<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {

	protected $data;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('menu_m');
		$this->load->model('group_m');
		$this->load->model('periode_m');
		$this->session->userdata('active_user') == null ? redirect('auth/login') : '';
		$this->data['active_user'] = $this->session->userdata('active_user');
		$this->data['active_user_group'] = $this->group_m->get_group($this->data['active_user']->group_id);
		$this->data['list_menu'] = $this->menu_m->get_menu($this->data['active_user']->group_id);
		$this->data['active_menu'] = $this->active_menu($this->data['list_menu']);
		$this->data['menu_style'] = 'default';
		$this->data['picture_users'] = $this->picture_m->get_picture($this->data['active_user']->id);
	}

    /**
     * Get Active Menu
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function active_menu($list_menu)
	{
		$active_menu = 0;
		foreach ($list_menu as $menu) {
			if ($this->uri->segment(1) == $menu->link || $this->uri->segment(1) . '/' . $this->uri->segment(2) == $menu->link) {
				if ($menu->parent_id != 0 && $menu->child == 0) {
					$active_menu = $menu->parent_id;
				} else if ($menu->parent_id == 0 && $menu->child == 0) {
					$active_menu = $menu->id;
				}
			}
		}
		return $active_menu;
	}
}
