<?php

class Setting_m extends CI_Model {   

    /**
     * Get List of Settings
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$settings = $this->db->get('settings')->result();
		return $settings;
    }

}