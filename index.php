<?php

require_once 'includes.php';

// Si on doit renvoyer vers une page de login, avec ou sans erreur, on le fait maintenant
if ((isset($_GET['page']) && $_GET['page'] == 'login') || !$user->check_connexion()) {
	// On regarde si on a récupéré des informations de connexion
	if (isset($_POST['login'], $_POST['pass'])) {
		$user->login($_POST['login'], $_POST['pass']);
		exit;
	} else {
		$core->tpl_load('login');
		exit;
	}
}


// Si une page particulière a été demandée

	// si la page demandée est le logout, on logout
	if (isset($_GET['page']) && $_GET['page'] == 'logout') { $user->logout(); }
	
	// TEMPORAIRE :
	$_GET['page'] = 'section';
	$_GET['id'] = 1;
	
	// si la page demandée correspond à une section, on affiche le formulaire de modification
	if (isset($_GET['page']) && $_GET['page'] == 'section') {
	
		// On cherche les informations sur la section en question
		if (isset($_GET['id'])) : $section = $_GET['id']; else : $core->tpl_redirection(); endif;
		
		$query = '	SELECT *
					FROM chapters 
					LEFT JOIN summaries 
					ON summaries.summary_id = chapters.summary_id
					LEFT JOIN books
					ON books.book_id = chapters.book_id
					WHERE chapters.chapter_id = ' . $section;
		$sql = $mysqli->query($query);
		
		if ($sql->num_rows == 1) {
		
			$row = $sql->fetch_assoc();
			
			// On initialise le livre, le sommaire, les chapitres et on lance l'affichage
			$book->open_book($row['book_id']);
			$book->get_summary();
			$chapters = $book->get_chapters();
			$book->get_chapter($chapters[0]);
			
			$core->tpl_load('section', 'text');
			
			$book->close_book();
			
		} else { 
			$core->tpl_load('index');
		}
		
	}
?>