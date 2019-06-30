<?php

class Datagrid extends CI_Model {

	public function field_name_replacer($input, $replace_field)
	{
		foreach ($replace_field as $field_name) {
			if ($input['dataSearch']) {
				$field = $input['dataSearch']['field'];
                if ($field == $field_name['old_name']) {
                	$input['dataSearch']['field'] = $field_name['new_name'];
                }
            }
		}

		return $input;
	}

	public function get_rows($table, $param)
	{
		$table->select($param['select'])
			  ->limit($param['input']['offset'], $param['input']['limit']);

		if (!empty($param['input']['sort'])) {
			$table->order_by($param['input']['sort'], $param['input']['order']);
		} else {
			$table->order_by($this->primaryKey, 'desc');
		}

		if ($param['input']['dataSearch']) {
			$input = $this->field_name_replacer($param['input'], $param['replace_field']);
			$table->like($input['dataSearch']['field'], $input['dataSearch']['value']);	
		}
						
		return $table->get()->result_array();
	}

	public function get_total_rows($table, $param)
	{
		$table->select('sql_calc_found_rows ' . $param['select'], false);
		
		if ($param['input']['dataSearch']) {
			$input = $this->field_name_replacer($param['input'], $param['replace_field']);
			$table->like($input['dataSearch']['field'], $input['dataSearch']['value']);
		}

		$table->get();
		$select_total = $this->db->select("found_rows() as total", false)->get()->result();
		return $select_total[0]->total;
	}

	public function query($param, $modifier)
	{
		$table = $modifier($this->db->from($param['table']));
		$select = $this->get_rows($table, $param);
		$table = $modifier($this->db->from($param['table']));
		$select_total = $this->get_total_rows($table, $param);
		
		return ['total' => $select_total, 'rows' => $select];
	}

}