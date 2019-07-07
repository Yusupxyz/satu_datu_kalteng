<?php

class Template_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
        $this->load->library('datagrid');
    }

    /**
     * Get List of Template
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$semester = $this->db->get('tbl_template')->result();
		return $semester;
    }

    /**
     * Get Cpunt of Template
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function count()
    {
    	$query = $this->db->from('tbl_template')
                        ->select('count(*) as total')
                        ->get();
        return $query->row();
    }

     /**
     * Get template by id_kategori_direktorat
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function get_by_id($id)
    {
    	$query = $this->db->from('tbl_template')
                        ->select('*')
                        ->where('id_kategori_direktorat',$id)
                        ->get();
        return $query->result();
    }

    /**
     * Get template by id_template
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function get_nama_template($id)
    {
    	$query = $this->db->from('tbl_template')
                        ->select('*')
                        ->where('id_template',$id)
                        ->get();
        return $query->row();
    }

    /**
     * Get Template by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function getExcel($id)
    {
        $query = $this->db->from('tbl_template')
                        ->select('*')
                        ->where('id_template', $id)
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
        $table  = 'tbl_template as a';
        $select = '*';

        $replace_field  = [
            ['old_name' => 'template', 'new_name' => 'a.template']
        ];

        $param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_direktorat', 'left')
                        ->join('users as u', 'u.id = a.id_admin', 'left')
                        ->where('aktif','1')
                        ->order_by('id_template','asc');
		});

        return $data;
    }

}