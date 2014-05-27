<?php

require_once 'includes.php';

// Si on doit renvoyer vers une page de login, avec ou sans erreur, on le fait maintenant
if ($_GET['page'] == 'login' || !$user->check_connexion()) {
	// On regarde si on a récupéré des informations de connexion
	if (isset($_POST['login'], $_POST['pass'])) {
		$user->login($_POST['login'], $_POST['pass']);
		exit;
	} else {
		$core->tpl_load('login');
		exit;
	}
}

// si la page demandée est le logout, on logout
if ($_GET['page'] == 'logout') { $user->logout(); }


// Affichage du chapitre actuel
$book->open_book(1);
$book->get_summary();
$chapters = $book->get_chapters();
$book->get_chapter($chapters[0]);

include 'tpl/index.tpl.php';

$book->close_book();

?>