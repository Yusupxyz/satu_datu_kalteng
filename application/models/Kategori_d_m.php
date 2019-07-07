<?php

class Kategori_d_m extends CI_Model {   

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
    	$direktorat = $this->db->get('tbl_kategori_direktorat')->result();
		return $direktorat;
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
        $query = $this->db->from('tbl_kategori_direktorat k')
                        ->select('k.*')
                        ->where('k.id', $id)
                        ->get();

        return $query->row();
    }

    /**
     * Get Kategori ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_kategori_name($kategori)
    {
        $query = $this->db->from('tbl_kategori_direktorat k')
                        ->select('k.*')
                        ->where('k.nama_kategori_direktorat', $kategori)
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
        $table  = 'tbl_kategori_direktorat as a';
        $select = '*';

        $replace_field  = [
            ['old_name' => 'nama_kategori_direktorat', 'new_name' => 'a.nama_kategori_direktorat']
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
        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_direktorat as d', 'd.id_direktorat = a.id_direktorat', 'left')
                        ->order_by('id_kategori_direktorat','asc');
		});

        return $data;
    }

}