<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}




	function consultacliente($stringCriterio, $stringImei) {

		$query = "CALL spandroidbcontratos( ? , ?);";

		$resultado = $this->db->query($query, array($stringCriterio, $stringImei));

		$row = new stdClass();
		$row->result = $resultado->result();
		$row->num_rows = $resultado->num_rows();

		$resultado->next_result(); //la libreria fue modificada para tener este parametro dentro de mysqli_result
		$resultado->free_result();

		return $row;

	}





}
