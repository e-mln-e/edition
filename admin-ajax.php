<?php

require_once 'includes.php';


// Action en cas de sauvegarde automatique du contenu d'une section

if (isset($_GET['action']) && $_GET['action'] == 'content') {
	$content = $_POST['content'];
	$section = $_POST['section'];
	
	echo $book->update_content($content, $section);
}

?>