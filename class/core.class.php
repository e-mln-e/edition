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
		global $core, $user, $book;
	
		if ($sub) {
			include 'tpl/' . $tpl . '-' . $sub . '.tpl.php';
		} else {
			include 'tpl/' . $tpl . '.tpl.php';
		}
	}
	
	
	public	function tpl_redirection($page, $attribut = null, $value = null) {
		if ($attribut && $value) {
			header( 'Location: index.php?page=' . $page . '&attribut=' . $attribut . '&value=' . $value);
		} else {
			header( 'Location: index.php?page=' . $page );
		}
	}
	
	
	public	function tpl_go_to_assets($cible_finale = null) {
		if (!$cible_finale) { echo 'assets/'; }
		else { echo 'assets/' . $cible_finale;  } /* 'css', 'js', 'fonts', 'img' */
	}
	
	
	public	function tpl_get_link_to($page, $value = null, $attribut = null) {
		if ($attribut && $value) {
			return 'index.php?page=' . $page . '&attribut=' . $attribut . '&value=' . $value;
		} else if ($value && !$attribut) {
			return 'index.php?page=' . $page . '&attribut=id&value=' . $value;
		} else {
			return 'index.php?page=' . $page;
		}
	}
}

?>