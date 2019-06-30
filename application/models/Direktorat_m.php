<?php

class Direktorat_m extends CI_Model {   

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
    	$direktorat = $this->db->get('tbl_direktorat')->result();
		return $direktorat;
    }

    /**
     * Get List of Direktorat versi 2
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all_sub()
    {
        $query = $this->db->from('tbl_direktorat k')
        ->select('id_direktorat as id, direktorat as nama')
        ->get();
        return $query->result();
    }

    /**
     * Get Direktorat by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_direktorat($id)
    {
        $query = $this->db->from('tbl_direktorat k')
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
        $table  = 'tbl_direktorat as a';
        $select = 'a.*';

        $replace_field  = [
            ['old_name' => 'direktorat', 'new_name' => 'a.direktorat']
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