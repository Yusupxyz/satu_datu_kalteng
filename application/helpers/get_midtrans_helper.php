<?php

//Author : Hariselmi//



if ( ! function_exists('getMidtrans'))

{

	function getMidtrans($items, $sql3) {

	switch ($sql3)
	{
		case 1: return $item_details = array ($items['1']);
		case 2: return $item_details = array ($items['1'],$items['2']);
		case 3: return $item_details = array ($items['1'],$items['2'],$items['3']);
		case 4: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4']);
		case 5: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5']);
		case 6: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6']);
		case 7: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7']);
		case 8: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8']);
		case 9: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9']);
		case 10: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10']);
		case 11: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11']);
		case 12: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12']);
		case 13: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13']);
		case 14: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14']);
		case 15: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15']);
		case 16: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16']);
		case 17: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17']);
		case 18: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18']);
		case 19: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19']);
		case 20: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20']);
		case 21: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21']);
		case 22: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22']);
		case 23: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23']);
		case 24: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24']);
		case 25: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25']);
		case 26: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26']);
		case 27: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27']);
		case 28: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28']);
		case 29: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29']);
		case 30: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30']);
		case 31: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31']);
		case 32: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32']);
		case 33: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33']);
		case 34: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34']);
		case 35: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35']);
		case 36: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36']);
		case 37: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37']);
		case 38: return $item_details = array31 ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38']);
		case 39: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39']);
		case 40: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40']);
		case 41: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41']);
		case 42: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42']);
		case 43: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43']);
		case 44: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43'],$items['44']);
		case 45: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43'],$items['44'],$items['45']);
		case 46: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43'],$items['44'],$items['45'],$items['46']);
		case 47: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43'],$items['44'],$items['45'],$items['46'],$items['47']);
		case 48: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43'],$items['44'],$items['45'],$items['46'],$items['47'],$items['48']);
		case 49: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43'],$items['44'],$items['45'],$items['46'],$items['47'],$items['48'],$items['49']);
		case 50: return $item_details = array ($items['1'],$items['2'],$items['3'],$items['4'],$items['5'],$items['6'],$items['7'],$items['8'],$items['9'],$items['10'],$items['11'],$items['12'],$items['13'],$items['14'],$items['15'],$items['16'],$items['17'],$items['18'],$items['19'],$items['20'],$items['21'],$items['22'],$items['23'],$items['24'],$items['25'],$items['26'],$items['27'],$items['28'],$items['29'],$items['30'],$items['31'],$items['32'],$items['33'],$items['34'],$items['35'],$items['36'],$items['37'],$items['38'],$items['39'],$items['40'],$items['41'],$items['42'],$items['43'],$items['44'],$items['45'],$items['46'],$items['47'],$items['48'],$items['49'],$items['50']);

	}
	return 'error';

}

}