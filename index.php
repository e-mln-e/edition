<?php

require_once 'includes.php';

$book->open_book(1);
$book->get_summary();
$chapters = $book->get_chapters();
$book->get_chapter($chapters[0]);

include 'tpl/index.tpl.php';

$book->authors(true);

$book->close_book();

?>
