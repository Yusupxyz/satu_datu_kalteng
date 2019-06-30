<?php

class Privilege_m extends CI_Model {   

    /**
     * Get List of Privileges
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$privileges = $this->db->get('privileges')->result();
		return $privileges;
    }

    /**
     * Get List of Privileges by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_privilege($group_id)
    {
        $query = $this->db->from('privileges')
                          ->where('group_id', $group_id)
                          ->get();
        return $query->result();
    }

}