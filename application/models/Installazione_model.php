<?php

class installazione_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function controlla_connessione() {
		return 1;
	}

}
?>