<?php

class Validasi_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
        $this->load->library('datagrid');
    }

    /**
     * Get List of Semester
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$semester = $this->db->get('tbl_semester')->result();
		return $semester;
    }

 /**
     * Get Excel by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function getExcel($id)
    {
        $query = $this->db->from('tbl_validasi')
                        ->select('*')
                        ->where('id_validasi', $id)
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
        $table  = 'tbl_validasi as a';
        $select = '*';

        $replace_field  = [
            ['old_name' => 'keterangan_invalid_lembar_kerja', 'new_name' => 'a.keterangan_invalid_lembar_kerja']
        ];

        $param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_lembar_kerja as lk', 'lk.id_lembar_kerja = a.id_lembar_kerja', 'left')
                        ->join('tbl_kategori_direktorat as d', 'd.id_kategori_direktorat = a.id_kategori_direktorat', 'left')
                        // ->join('tbl_status as s', 's.id_status = a.id_status_1', 'left')
                        // ->join('users as u', 'u.id = a.id_login_v', 'left')
                        // ->join('users as u2', 'u2.id = lk.id_users', 'left')
                        // ->join('tbl_semester as s', 's.id_semester = lk.id_semester', 'left')
                        ->order_by('a.id_validasi','asc');
        });

        return $data;
    }

}