<?php

class Status_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
        $this->load->library('datagrid');
    }

    /**
     * Get List of Direktorat
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$status = $this->db->get('tbl_status')->result();
		return $status;
    }

    /**
     * Get Status by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_status($id)
    {
        $query = $this->db->from('tbl_status k')
                        ->select('k.*')
                        ->where('k.id', $id)
                        ->get();

        return $query->row();
    }


     /**
     * Get Status by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_status_aktif($semester)
    {
        $query = $this->db->from('tbl_status k')
                        ->select('k.*')
                        ->where('k.id', $id)
                        ->get();

        return $query->row();
    }

    /**
     * Datagrid Data
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function getJson($input)
    {
        $table  = 'tbl_status as a';
        $select = 'a.*';

        $replace_field  = [
            ['old_name' => 'status', 'new_name' => 'a.status']
        ];

        $param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data;
        });

        return $data;
    }

}