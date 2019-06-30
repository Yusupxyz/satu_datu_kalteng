<?php

class Picture_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
        $this->load->library('datagrid');
    }

    /**
     * Get List of Groups
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function insert($id, $foto)
    {
        $data['foto'] = $foto.'.png';
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function get_picture($id)
    {
        $query = $this->db->from('users')
                        ->select('foto')
                        ->where('id', $id)
                        ->get()->row();

        if(!empty($query->foto)){
            $get_picture = $query->foto;
        }else{
            $get_picture = 'picture.jpg';
        }
        return $get_picture;
    }

    public function get_picture_users($id)
    {
            
        $sql_email = $this->db->from('members')
                        ->select('email')
                        ->where('id', $id)
                        ->get()->row();    


        $sql_picture = $this->db->from('users')
                        ->select('foto')
                        ->where('email', $sql_email->email)
                        ->get()->row();

        if(!empty($sql_picture->foto)){
            $get_picture = $sql_picture->foto;
        }else{
            $get_picture = 'picture.jpg';
        }
        return $get_picture;
    }

}