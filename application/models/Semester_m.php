<?php

class Semester_m extends CI_Model {   

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
     * Get Semester by year
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_semester()
    {
        $query = $this->db->join('tbl_tahun as t', 't.id = k.id_tahun', 'left')
                        ->from('tbl_semester k')
                        ->select('k.*')
                        ->where('t.state', '1')
                        ->get();

        return $query->row();
    }

    /**
     * Get Semester by year & semester
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_idsemester($semester)
    {
        $query = $this->db->join('tbl_tahun as t', 't.id = k.id_tahun', 'left')
                        ->from('tbl_semester k')
                        ->select('k.*')
                        ->where('t.state', '1')
                        ->where('k.periode_semester', $semester)
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
        $table  = 'tbl_semester as a';
        $select = '*';

        $replace_field  = [
            ['old_name' => 'periode_semester', 'new_name' => 'a.periode_semester']
        ];

        $param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_tahun as t', 't.id = a.id_tahun', 'left')
                        ->order_by('a.id_semester','asc');
        });

        return $data;
    }

}