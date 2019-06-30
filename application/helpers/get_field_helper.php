<?php

if(!function_exists('get_field')){

function get_field($id,$namatabel,$namafield='')

{

	$ci = &get_instance();

	

	$ci->db->select($namafield." as field");

	$ci->db->where('ID',$id);

	$Q=$ci->db->get($namatabel)->row();

	return $Q->field;

}



}



if(!function_exists('get_photo')){



function get_photo($foto,$jk,$namatabel,$class='')

{

	if($foto)
	{
		$path = "foto/".$foto;
	}
	elseif($jk == "L")
	{
		$path = "assets/images/default_".$namatabel.".png";
	}
		elseif($jk == "P")
	{
		$path = "assets/images/default_".$namatabel."_2.png";
	}
	else
	{
		$path = "assets/images/tanda_tanya.png";
	}
	return '<img class="'.$class.'" src="'.base_url().$path.'">';

}



}

