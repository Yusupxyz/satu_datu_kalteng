<?php

class Periode_m extends CI_Model {   

    /**
     * Get List of Settings
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$periode = $this->db->get('periode')->result();
		return $periode;
    }

    public function getstartDate($periode)
    {
        $d      = substr($periode, 3,2);
        $m      = substr($periode, 0,2);
        $y      = substr($periode, 6,4);
        $date   = $y.'-'.$m.'-'.$d;
        return $date;
    }

    public function getendDate($periode)
    {
        $d      = substr($periode, 16,2);
        $m      = substr($periode, 13,2);
        $y      = substr($periode, 19,4);
        $date   = $y.'-'.$m.'-'.$d;

        return $date;
    }
    public function getstartDatetime($periode)
    {
        $d      = substr($periode, 3,2);
        $m      = substr($periode, 0,2);
        $y      = substr($periode, 6,4);
        $date   = $y.'-'.$m.'-'.$d.' 00:00:00';
        return $date;
    }

    public function getendDatetime($periode)
    {
        $d      = substr($periode, 16,2);
        $m      = substr($periode, 13,2);
        $y      = substr($periode, 19,4);
        $date   = $y.'-'.$m.'-'.$d.' 23:59:59';

        return $date;
    }

}