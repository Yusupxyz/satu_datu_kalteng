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
                        ->where('id', $id)
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
        $table  = 'tbl_template as t';
        $select = '*';

        $replace_field  = [
            ['old_name' => 'id_lembar_kerja', 'new_name' => 'a.id_lembar_kerja']
        ];

		$param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_kategori_direktorat as d', 'd.id_kategori_direktorat = t.id_kategori_direktorat', 'left');
        });

        return $data;
    }

}