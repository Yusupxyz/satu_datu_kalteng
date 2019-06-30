<?php

class Tahun_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get List of Tahun
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
        $tahun = $this->db->from('tbl_tahun')
                            ->select('*')
                            ->order_by('state','desc')
                            ->get();
		return $tahun->result();
    }

    /**
     * Get Tahun Aktif by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_aktif_tahun()
    {
        $query = $this->db->from('tbl_tahun k')
                        ->select('k.*')
                        ->where('state', '1')
                        ->get();

        return $query->row();
    }

    /**
     * Get ID by Tahun
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_tahun($year)
    {
        $query = $this->db->from('tbl_tahun k')
                        ->select('k.*')
                        ->where('k.tahun', $year)
                        ->get();

        return $query->row();
    }

}