<?php

class core {
	
	// Attributs de la classe
	private	$db;
	
	
	// Méthodes de la classe
	
	public	function __construct($db) {
		$this->db = $db;
	}
	
	
	
	// Méthodes liées au templating
	
	public	function tpl_load($tpl, $sub = NULL) {
		if ($sub) {
			include 'tpl/' . $tpl . '-' . $sub . '.tpl.php';
		} else {
			include 'tpl/' . $tpl . '.tpl.php';
		}
	}
	
	
}

?>