<?php

class Kab_kota_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
        $this->load->library('datagrid');
    }

    /**
     * Get List of Kab_kota
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$kab_kota = $this->db->get('tbl_kabupaten_kota')->result();
		return $kab_kota;
    }

     /**
     * Get List of Kab_kota versi 2
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all_sub()
    {
        $query = $this->db->from('tbl_kabupaten_kota k')
        ->select('id_kabupaten_kota as id, kabupaten_kota as nama')
        ->get();
        return $query->result();
    }

    /**
     * Get Cpunt of KK
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function count()
    {
    	$query = $this->db->from('tbl_kabupaten_kota')
                        ->select('count(*) as total')
                        ->get();
        return $query->row();
    }

    /**
     * Get limit of KK
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function limit($row)
    {
    	$query = $this->db->from('tbl_kabupaten_kota')
                        ->select('*')
                        ->limit(1,$row)
                        ->get();
        return $query->row();
    }

    /**
     * Get Group by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_kab_kota($id)
    {
        $query = $this->db->from('tbl_kabupaten_kota k')
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
        $table  = 'tbl_kabupaten_kota as a';
        $select = 'a.*';

        $replace_field  = [
            ['old_name' => 'kabupaten_kota', 'new_name' => 'a.kabupaten_kota']
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