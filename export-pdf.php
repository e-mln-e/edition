<?php

require_once 'includes.php';

$pdf = new fpdf();

// On créé la page A4, portrait, normale
$pdf->AddPage();

// On défini une typo
$pdf->SetFont('Arial', '', 14);

// On défini le contenu à renvoyer

	// On va ici imprimer un chapitre – le 1
	$book->open_book(1);
	
		$book->get_summary();
		$chapters = $book->get_chapters();
		$book->get_chapter($chapters[0]);
		
		$content = 'timestamp: ' . date('d/m/Y H:i:s') . ' \n ' . utf8_decode($book->get_content());
			
	$book->close_book();
	
	
$pdf->AjouterChapitre(0, 0, $content);

// On affiche le tout
$pdf->Output();


?>