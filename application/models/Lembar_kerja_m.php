<?php

class Lembar_kerja_m extends CI_Model {   

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
    	$semester = $this->db->get('tbl_lembar_kerja')->result();
		return $semester;
    }

    /**
     * Get Lembar_kerja with Join
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_lk_aktif($semester)
    {
        $query = $this->db->from('tbl_lembar_kerja as a')
                        ->select('*,u2.nama as nama_admin,u.nama as nama_kk, u3.nama as nama_upload_by')
                        ->join('tbl_template as t', 't.id_template = a.id_template', 'left')
                        ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = a.id_kabupaten_kota', 'left')
                        ->join('users as u', 'u.id = a.id_admin_kk', 'left')
                        ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = t.id_kategori_direktorat', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_status as s', 's.id_status = a.id_status', 'left')
                        ->join('users as u2', 'u2.id = t.id_admin', 'left')
                        ->join('users as u3', 'u3.id = a.upload_by', 'left')
                        ->where('t.periode_semester','1')
                        ->where('d.id_direktorat',$this->session->userdata('active_user')->id_ref)
                        ->order_by('a.id_lembar_kerja','asc')
                        ->get();

        return $query->result();
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
        $query = $this->db->from('tbl_lembar_kerja')
                        ->select('*')
                        ->where('id_lembar_kerja', $id)
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

    public function getJson($input,$s)
    {
        $table  = 'tbl_lembar_kerja as a';
        $select = '*,u2.nama as nama_admin,u.nama as nama_kk, u3.nama as nama_upload_by';

        $replace_field  = [
            ['old_name' => 'id_lembar_kerja', 'new_name' => 'a.id_lembar_kerja']
        ];

        $param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        if ($s=='Semester 2'){
        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_template as t', 't.id_template = a.id_template', 'left')
                        ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = a.id_kabupaten_kota', 'left')
                        ->join('users as u', 'u.id = a.id_admin_kk', 'left')
                        ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = t.id_kategori_direktorat', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_status as s', 's.id_status = a.id_status', 'left')
                        ->join('users as u2', 'u2.id = t.id_admin', 'left')
                        ->join('users as u3', 'u3.id = a.upload_by', 'left')
                        ->where('t.periode_semester','2')
                        ->where('a.id_kabupaten_kota',$this->session->userdata('active_user')->id_ref)
                        ->order_by('a.id_lembar_kerja','asc');
        });
        }else{
            $data = $this->datagrid->query($param, function($data) use ($input) {
                return $data->join('tbl_template as t', 't.id_template = a.id_template', 'left')
                            ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = a.id_kabupaten_kota', 'left')
                            ->join('users as u', 'u.id = a.id_admin_kk', 'left')
                            ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = t.id_kategori_direktorat', 'left')
                            ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                            ->join('tbl_status as s', 's.id_status = a.id_status', 'left')
                            ->join('users as u2', 'u2.id = t.id_admin', 'left')
                            ->join('users as u3', 'u3.id = a.upload_by', 'left')
                            ->where('t.periode_semester','1')
                            ->where('a.id_kabupaten_kota',$this->session->userdata('active_user')->id_ref)
                            ->order_by('a.id_lembar_kerja','asc');
            });
        }
        return $data;
    }

    public function getJson2($input,$s)
    {
        $table  = 'tbl_lembar_kerja as a';
        $select = '*,u2.nama as nama_admin,u.nama as nama_kk, u3.nama as nama_upload_by';

        $replace_field  = [
            ['old_name' => 'id_lembar_kerja', 'new_name' => 'a.id_lembar_kerja']
        ];

        $param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        if ($s=='Semester 2'){
        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_template as t', 't.id_template = a.id_template', 'left')
                        ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = a.id_kabupaten_kota', 'left')
                        ->join('users as u', 'u.id = a.id_admin_kk', 'left')
                        ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = t.id_kategori_direktorat', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_status as s', 's.id_status = a.id_status', 'left')
                        ->join('users as u2', 'u2.id = t.id_admin', 'left')
                        ->join('users as u3', 'u3.id = a.upload_by', 'left')
                        ->where('t.periode_semester','2')
                        ->where('d.id_direktorat',$this->session->userdata('active_user')->id_ref)
                        ->order_by('a.id_lembar_kerja','asc');
        });
        }else{
            $data = $this->datagrid->query($param, function($data) use ($input) {
                return $data->join('tbl_template as t', 't.id_template = a.id_template', 'left')
                            ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = a.id_kabupaten_kota', 'left')
                            ->join('users as u', 'u.id = a.id_admin_kk', 'left')
                            ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = t.id_kategori_direktorat', 'left')
                            ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                            ->join('tbl_status as s', 's.id_status = a.id_status', 'left')
                            ->join('users as u2', 'u2.id = t.id_admin', 'left')
                            ->join('users as u3', 'u3.id = a.upload_by', 'left')
                            ->where('t.periode_semester','1')
                            ->where('d.id_direktorat',$this->session->userdata('active_user')->id_ref)
                            ->order_by('a.id_lembar_kerja','asc');
            });
        }
        return $data;
    }

    public function getJson3($input,$s)
    {
        $table  = 'tbl_lembar_kerja as a';
        $select = '*,u2.nama as nama_admin,u.nama as nama_kk, u3.nama as nama_upload_by';

        $replace_field  = [
            ['old_name' => 'id_lembar_kerja', 'new_name' => 'a.id_lembar_kerja']
        ];

        $param = [
            'input'     => $input,
            'select'    => $select,
            'table'     => $table,
            'replace_field' => $replace_field
        ];

        if ($s=='Semester 2'){
        $data = $this->datagrid->query($param, function($data) use ($input) {
            return $data->join('tbl_template as t', 't.id_template = a.id_template', 'left')
                        ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = a.id_kabupaten_kota', 'left')
                        ->join('users as u', 'u.id = a.id_admin_kk', 'left')
                        ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = t.id_kategori_direktorat', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_status as s', 's.id_status = a.id_status', 'left')
                        ->join('users as u2', 'u2.id = t.id_admin', 'left')
                        ->join('users as u3', 'u3.id = a.upload_by', 'left')
                        ->where('t.periode_semester','2')
                        ->order_by('a.id_lembar_kerja','asc');
        });
        }else{
            $data = $this->datagrid->query($param, function($data) use ($input) {
                return $data->join('tbl_template as t', 't.id_template = a.id_template', 'left')
                            ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = a.id_kabupaten_kota', 'left')
                            ->join('users as u', 'u.id = a.id_admin_kk', 'left')
                            ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = t.id_kategori_direktorat', 'left')
                            ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                            ->join('tbl_status as s', 's.id_status = a.id_status', 'left')
                            ->join('users as u2', 'u2.id = t.id_admin', 'left')
                            ->join('users as u3', 'u3.id = a.upload_by', 'left')
                            ->where('t.periode_semester','1')
                            ->order_by('a.id_lembar_kerja','asc');
            });
        }
        return $data;
    }

}