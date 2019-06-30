<?php

class Menu_m extends CI_Model {   

	public function all()
    {
    	$menus = $this->db->get('menus')->result();
		return $menus;
    }

    /**
     * Get List of Menus
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function get_menu($group_id)
    {
    	$menus = $this->db->from('privileges as p')
						  ->join('menus as m', 'm.id = p.menu_id', 'left')
						  ->where('p.group_id', $group_id)
						  ->order_by('m.id', 'ASC')
						  ->select('*')
						  ->get()
						  ->result();

        return $menus;
    }

}