<?php

class status_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    /*------------------------------------------------------------------------
	| GET USED LANGUAGE
	-------------------------------------------------------------------------*/
	function get_lingua() {
		$data = array();
		$query = $this->db->get('impostazioni');
		if ( $query->num_rows() > 0 ) {
			$data = $query->result_array();
		}
		return $data[0]['lingua'];
	}

}

?>