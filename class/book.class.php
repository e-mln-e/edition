<?php

class book {
	
	private	$db;
	private $open_book;
	
	
	public	function __construct($db) {
		$this->db = $db;
	}
	
	
	// Opening book
	public	function opening($id) {
		$query = 'SELECT * FROM books WHERE book_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_assoc();
			
			$open_book = array(	'id'			=>	$row['book_id'],
								'summary'		=>	$row['summary_id'],
								'template'		=>	$row['template_id'],
								'collection'	=>	$row['collection_id'],
								'title'			=>	$row['book_title'],
								'hash'			=>	$row['book_hash'],
								'editors'		=>	$row['book_editors'],
								'tags'			=>	$row['book_tags'],
								'cover'			=>	$row['book_cover'] );
								
			return true;
		} else {
			return false;
		}
	}
	
	
	public	function get_the_ID() { return $this->open_book['id']; }
	public	function the_ID() { echo $this->get_the_ID(); }
	
	public	function get_infos($info) {
		if (array_key_exists($info, $this->open_book)) {
			return $this->open_book[$info];
		} else {
			return false;
		}
	}
	
	public	function get_the_title() { return $this->open_book['title']; }
	public	function the_title() { echo $this->get_the_title(); }
	
	public	function get_the_hash() { return $this->open_book['hash']; }
	public	function the_hash() { echo $this->get_the_hash(); }
	
	public	function get_the_editors() { return $this->open_book['editors']; }
	public	function the_editors() { echo $this->get_the_editors(); }
	
	public	function get_the_tags() { return $this->open_book['tags']; }
	public	function the_tags() { echo $this->get_the_tags(); }
	
	public	function get_the_cover() { return $this->open_book['cover']; }
	public	function the_cover() { echo $this->get_the_cover(); }
	
}

?>