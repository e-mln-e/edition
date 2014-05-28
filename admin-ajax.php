<?php

require_once 'includes.php';

// Action en cas de sauvegarde automatique du contenu d'une section

if (isset($_GET['action']) && $_GET['action'] == 'content') {
	$content = $_POST['content'];
	$section = $_POST['section'];
	
	if ($book->update_content($content, $section)) {
		echo 'Dernière modification : ' . date('d/m/Y H:i');
	} else {
		echo 'échec';
	}
}

?>