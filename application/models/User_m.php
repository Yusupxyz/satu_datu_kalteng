<?php

class User_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('datagrid');
	}

	/**
     * Check User Credentials
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */
	
	public function attempt($input)
	{

		$group=$this->get_group($input['username']);

		if ($group->group_id=='3'){
			$query = $this->db->from('users u')
			->select('u.*, g.group_nama, k.kabupaten_kota')
			->where('username', $input['username'])
			->where('u.softdelete', '0')
			->join('groups as g', 'g.id = u.id', 'left')
			->join('tbl_kabupaten_kota as k', 'k.id_kabupaten_kota = u.id_ref', 'left')
			->get();
		}elseif($group->group_id=='2'){
			$query = $this->db->from('users u')
			->select('u.*, g.group_nama, d.direktorat')
			->where('username', $input['username'])
			->where('u.softdelete', '0')
			->join('groups as g', 'g.id = u.id', 'left')
			->join('tbl_direktorat as d', 'd.id_direktorat = u.id_ref', 'left')
			->get();
		}else{
			$query = $this->db->from('users u')
			->select('u.*, g.group_nama')
			->where('username', $input['username'])
			->where('u.softdelete', '0')
			->join('groups as g', 'g.id = u.id', 'left')
			->get();
		}

		return $query->row();
	}
	

	/**
     * Get User by ID
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function get_user($id)
	{

		$query = $this->db->from('users u')
						->select('u.*, g.group_nama')
						->where('u.id', $id)
						->where('u.softdelete', '0')
						->join('groups as g', 'g.id = u.id', 'left')
						->get();

		return $query->row();
	}

	/**
     * Datagrid Data
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

	public function getJson($input)
	{
		$table  = 'users as a';
		$select = 'a.*, g.group_nama, d.*, k.*';

		$replace_field  = [
			['old_name' => 'nama', 'new_name' => 'a.nama'],
			['old_name' => 'group_nama', 'new_name' => 'g.group_nama']
		];

		$param = [
			'input'     => $input,
			'select'    => $select,
			'table'     => $table,
			'replace_field' => $replace_field
		];

		$data = $this->datagrid->query($param, function($data) use ($input) {
			return $data->join('groups as g', 'g.id = a.group_id', 'left')
						->join('tbl_direktorat as d', 'd.id_direktorat = a.id_ref', 'left')
						->join('tbl_kabupaten_kota as k', 'k.id_kabupaten_kota = a.id_ref', 'left')
						->where('a.id !=', $this->session->userdata('active_user')->id)
						->where('a.softdelete', '0');
		});

		return $data;
	}

	/**
     * Get User Group 
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */
	
	public function get_group($input)
	{
		$query = $this->db->from('users')
						->select('group_id')
						->where('username', $input)
						->where('softdelete', '0')
						->get();

		return $query->row();
	}

}