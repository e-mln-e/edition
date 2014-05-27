<?php
/*
	Fichier d'appel des différents modules, fonctions et classes du core du site
*/

// On met en place l'affichage des erreurs en mode développement
error_reporting(-1); // -1 reporte toutes les erreurs PHP (=E_ALL) / 0 en mode production
ini_set('error_reporting', E_ALL);

// On détermine les problématiques de langage des données PHP
setlocale(LC_ALL, 'fr_FR', 'fr');


// Appel de la classe MySQL

$mysqli = new mysqli('localhost', 'root', 'root', 'edition');

// On vérifie qu'il n'existe pas une erreur de connexion, auquel cas on l'affiche
if ($mysqli->connect_errno) { echo 'Erreur de connexion à la base de données'; }

// Constructeur de classes

function __autoload($class_name) {
	include 'class/'.$class_name.'.class.php';
}

// On appelle l'ensemble des classes générales au site
	$core =	new core($mysqli);
	$user = new user($mysqli);
	$book = new book($mysqli);


// On nomme ces variables comme globales
global $core;
global $user;
global $book;

?>