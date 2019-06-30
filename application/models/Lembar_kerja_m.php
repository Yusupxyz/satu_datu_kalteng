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
                        ->select('*, uv.nama as nama_v,u.nama as nama_u')
                        ->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_d', 'left')
                        ->join('users as u', 'u.id = a.id_users', 'left')
                        ->join('tbl_semester as s', 's.id_semester = a.id_semester', 'left')
                        ->join('tbl_validasi as v', 'v.id_lembar_kerja = a.id_lembar_kerja', 'left')
                        ->join('tbl_status as st', 'st.id_status = v.id_status_1', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_tahun as t', 't.id = s.id_tahun', 'left')
                        ->join('users as uv', 'uv.id = v.id_login_v', 'left')
                        ->where('s.periode_semester',$semester)
                        ->where('t.state','1')
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
        $select = '*, uv.nama as nama_v,u.nama as nama_u,dlk.status as status2,st.status as status1';

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
            return $data->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_d', 'left')
                        ->join('users as u', 'u.id = a.id_users', 'left')
                        ->join('tbl_semester as s', 's.id_semester = a.id_semester', 'left')
                        ->join('tbl_validasi as v', 'v.id_lembar_kerja = a.id_lembar_kerja', 'left')
                        ->join('tbl_status as st', 'st.id_status = v.id_status_1', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_tahun as t', 't.id = s.id_tahun', 'left')
                        ->join('users as uv', 'uv.id = v.id_login_v', 'left')
                        ->join('tbl_download_lk as dlk','dlk.id_user=u.id')
                        ->where('s.periode_semester','Semester 2')
                        ->where('t.state','1')
                        ->where('u.id',$this->session->userdata('active_user')->id)
                        ->order_by('a.id_lembar_kerja','asc');
        });
        }else{
            $data = $this->datagrid->query($param, function($data) use ($input) {
                return $data->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_d', 'left')
                            ->join('users as u', 'u.id = a.id_users', 'left')
                            ->join('tbl_semester as s', 's.id_semester = a.id_semester', 'left')
                            ->join('tbl_validasi as v', 'v.id_lembar_kerja = a.id_lembar_kerja', 'left')
                            ->join('tbl_status as st', 'st.id_status = v.id_status_1', 'left')
                            ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                            ->join('tbl_tahun as t', 't.id = s.id_tahun', 'left')
                            ->join('users as uv', 'uv.id = v.id_login_v', 'left')
                            ->join('tbl_download_lk as dlk','dlk.id_user=u.id')
                            ->where('s.periode_semester','Semester 1')
                            ->where('t.state','1')
                            ->where('u.id',$this->session->userdata('active_user')->id)
                            ->order_by('a.id_lembar_kerja','asc');
            });
        }
        return $data;
    }

    public function getJson2($input,$s)
    {
        $table  = 'tbl_lembar_kerja as a';
        $select = '*, uv.nama as nama_v,u.nama as nama_u,dlk.status as status2,st.status as status1';

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
            return $data->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_d', 'left')
                        ->join('users as u', 'u.id = a.id_users', 'left')
                        ->join('tbl_semester as s', 's.id_semester = a.id_semester', 'left')
                        ->join('tbl_validasi as v', 'v.id_lembar_kerja = a.id_lembar_kerja', 'left')
                        ->join('tbl_status as st', 'st.id_status = v.id_status_1', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_tahun as t', 't.id = s.id_tahun', 'left')
                        ->join('users as uv', 'uv.id = v.id_login_v', 'left')
                        ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = u.id_ref', 'left')
                        ->join('tbl_download_lk as dlk','dlk.id_user=u.id')
                        ->where('s.periode_semester','Semester 2')
                        ->where('t.state','1')
                        ->where('d.id_direktorat',$this->session->userdata('active_user')->id_ref)
                        ->order_by('a.id_lembar_kerja','asc');
        });
        }else{
            $data = $this->datagrid->query($param, function($data) use ($input) {
                return $data->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_d', 'left')
                            ->join('users as u', 'u.id = a.id_users', 'left')
                            ->join('tbl_semester as s', 's.id_semester = a.id_semester', 'left')
                            ->join('tbl_validasi as v', 'v.id_lembar_kerja = a.id_lembar_kerja', 'left')
                            ->join('tbl_status as st', 'st.id_status = v.id_status_1', 'left')
                            ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                            ->join('tbl_tahun as t', 't.id = s.id_tahun', 'left')
                            ->join('users as uv', 'uv.id = v.id_login_v', 'left')
                            ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = u.id_ref', 'left')
                            ->join('tbl_download_lk as dlk','dlk.id_user=u.id')
                            ->where('s.periode_semester','Semester 1')
                            ->where('t.state','1')
                            ->where('d.id_direktorat',$this->session->userdata('active_user')->id_ref)
                            ->order_by('a.id_lembar_kerja','asc');
            });
        }
        return $data;
    }

    public function getJson3($input,$s)
    {
        $table  = 'tbl_lembar_kerja as a';
        $select = '*, uv.nama as nama_v,u.nama as nama_u,dlk.status as status2,st.status as status1';

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
            return $data->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_d', 'left')
                        ->join('users as u', 'u.id = a.id_users', 'left')
                        ->join('tbl_semester as s', 's.id_semester = a.id_semester', 'left')
                        ->join('tbl_validasi as v', 'v.id_lembar_kerja = a.id_lembar_kerja', 'left')
                        ->join('tbl_status as st', 'st.id_status = v.id_status_1', 'left')
                        ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                        ->join('tbl_tahun as t', 't.id = s.id_tahun', 'left')
                        ->join('users as uv', 'uv.id = v.id_login_v', 'left')
                        ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = u.id_ref', 'left')
                        ->join('tbl_download_lk as dlk','dlk.id_user=u.id')
                        ->where('s.periode_semester','Semester 2')
                        ->where('t.state','1')
                        ->order_by('a.id_lembar_kerja','asc');
        });
        }else{
            $data = $this->datagrid->query($param, function($data) use ($input) {
                return $data->join('tbl_kategori_direktorat as kd', 'kd.id_kategori_direktorat = a.id_kategori_d', 'left')
                            ->join('users as u', 'u.id = a.id_users', 'left')
                            ->join('tbl_semester as s', 's.id_semester = a.id_semester', 'left')
                            ->join('tbl_validasi as v', 'v.id_lembar_kerja = a.id_lembar_kerja', 'left')
                            ->join('tbl_status as st', 'st.id_status = v.id_status_1', 'left')
                            ->join('tbl_direktorat as d', 'd.id_direktorat = kd.id_direktorat', 'left')
                            ->join('tbl_tahun as t', 't.id = s.id_tahun', 'left')
                            ->join('users as uv', 'uv.id = v.id_login_v', 'left')
                            ->join('tbl_kabupaten_kota as kk', 'kk.id_kabupaten_kota = u.id_ref', 'left')
                            ->join('tbl_download_lk as dlk','dlk.id_user=u.id')
                            ->where('s.periode_semester','Semester 1')
                            ->where('t.state','1')
                            ->order_by('a.id_lembar_kerja','asc');
            });
        }
        return $data;
    }

}