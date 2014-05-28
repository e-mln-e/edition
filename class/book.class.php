<?php

class book extends core {
	
	private	$db;
	private $open_book;
	private $summary;
	private	$chapter;
	
	
	public	function __construct($db) {
		$this->db = $db;
	}
	
	
	// Opening book
	public	function open_book($id) {
		$query = 'SELECT * FROM books WHERE book_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_assoc();
			
			$this->open_book = array(	'id'			=>	$row['book_id'],
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
	
	
	public	function close_book() {
		$open_book = array();
		
		if (!$open_book) {
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
	
	
	public	function get_summary($book_id = null) {
		if (!$book_id) { $book_id = $this->get_the_ID(); }
	
		$query = 'SELECT * FROM summaries WHERE summary_id = ' . $book_id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_assoc();
			
			$this->summary = array(	'id'		=>	$row['summary_id'],
									'active'	=>	$row['summary_active'],
									'timestamp'	=>	$row['summary_timestamp'],
									'chapters'	=>	$row['summary_sections'] );
			
			return true;
		} else {
			return false;
		}
	}
	
	public	function get_summary_info($info) { return $this->summary[$info]; }
	public	function summary_info($info) { echo $this->get_summary_info($info); }
	
	public	function get_chapters() { return unserialize($this->summary['chapters']); }
	
	
	public	function get_chapter($id) {
		$query = 'SELECT * FROM chapters WHERE chapter_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_assoc();
			
			$this->chapter = array(	'id'			=>	$row['chapter_id'],
									'content'		=>	$row['content_id'],
									'editors'		=>	explode(',', $row['chapter_editors']),
									'name'			=>	$row['chapter_name'],
									'tags'			=>	explode(',', $row['chapter_tags']),
									'section_type'	=>	$row['chapter_section_type'],
									'published'		=>	$row['chapter_published'],
									'release'		=>	$row['chapter_release'] );
		} else {
			return false;
		}
	}
	
	public	function get_chapter_info($info) { return $this->chapter[$info]; }
	
	public	function get_content($id = null) {
		if(!$id) { $id = $this->get_chapter_info('content'); }
		
		$query = 'SELECT * FROM contents WHERE content_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_assoc();
			$content = $row['content_text'];
			$content = utf8_encode($content);
			
			return nl2br($content);
		} else {
			return false;
		}
	}
	public	function content($id = null) { echo $this->get_content($id); }
	
	public	function get_authors($link = false, $parent = 'ul', $child = 'li', $parent_class = null, $child_class = null, $parent_id = null, $child_id = null) {
		$authors = $this->get_chapter_info('editors');
		
		$return = '<' . $parent;	
			if ($parent_class) { $return .= ' class="' . $parent_class . '"'; } else { $return .= ' class="author-list"'; }
			if ($parent_id) { $return .= ' id="' . $parent_id . '"'; }
		$return .= '>';
		
		foreach ($authors as $author) {
			$return .= '<' . $child;
				if ($child_class) { $return .= ' class="' . $child_class . '"'; }
				if ($child_id) { $return .= ' id="' . $child_id . '"'; }
			$return .= '>';
			
				if ($link) { $return .= '<a href="' . $this->tpl_get_link_to('author', $author) . '">'; }
					
					$query = 'SELECT user_nicename, user_login FROM users WHERE user_id = ' . $author;
					$sql = $this->db->query($query);
					$row = $sql->fetch_array();
					
					if ($row[0]) { $return .= $row[0]; }
					else { $return .= ucwords($row[1]); }
				
				if ($link) { $return .= '</a>'; }
			
			$return .= '</' . $child . '>';
		}
		
		$return .= '</' . $parent . '>';
		
		return $return;
	}
	
	public	function authors($link = false, $parent = 'ul', $child = 'li', $parent_class = null, $child_class = null, $parent_id = null, $child_id = null) {
		echo $this->get_authors($link, $parent, $child, $parent_class, $child_class, $parent_id, $child_id);
	}
	
	
	public	function get_tags($link = false, $parent = 'ul', $child = 'li', $parent_class = null, $child_class = null, $parent_id = null, $child_id = null) {
		$tags = $this->get_chapter_info('tags');
		
		$return = '<' . $parent;	
			if ($parent_class) { $return .= ' class="' . $parent_class . '"'; } else { $return .= ' class="tags-list"'; }
			if ($parent_id) { $return .= ' id="' . $parent_id . '"'; }
		$return .= '>';
		
		foreach ($tags as $tag) {
			$return .= '<' . $child;
				if ($child_class) { $return .= ' class="' . $child_class . '"'; }
				if ($child_id) { $return .= ' id="' . $child_id . '"'; }
			$return .= '>';
			
				if ($link) { $return .= '<a href="' . $this->tpl_get_link_to('tag', $tag) . '">'; }
					
					$return .= $tag;
				
				if ($link) { $return .= '</a>'; }
			
			$return .= '</' . $child . '>';
		}
		
		$return .= '</' . $parent . '>';
		
		return $return;
	}
	
	public	function tags($link = false, $parent = 'ul', $child = 'li', $parent_class = null, $child_class = null, $parent_id = null, $child_id = null) {
		echo $this->get_tags($link, $parent, $child, $parent_class, $child_class, $parent_id, $child_id);
	}
	
	
	// Gestion des tags
	
	public	function tag_add($tag, $chapter = null) {
		if (!$chapter) { $chapter = $this->get_chapter_info('id'); }
		
		// On récupère les tags
		$tags = $this->get_chapter_info('tags');
		
		// On vérifie que le tag n'est pas déjà présent dans la liste
		if (!in_array($tag, $tags)) {
			// On ajoute le tag à la liste
			$tags[] = $tag;
			
			// On développe la liste en mise en forme destinée à MySQL
			$tags = implode(',', $tags);
			
			// On ajout à MySQL
			$query = 'UPDATE chapters SET chapter_tags = "' . $tags . '" WHERE chapter_id = ' . $chapter;
			if ($this->db->query($query)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
	public	function tag_delete($tag, $chapter = null) {
		if (!$chapter) { $chapter = $this->get_chapter_info('id'); }
		
		// On récupère les tags
		$tags = $this->get_chapter_info('tags');
		
		// On vérifie que le tag soit présent dans la liste
		if (in_array($tag, $tags)) {
			// On recherche la position dans la liste du tag
			$key = array_search($tag, $tags);
			unset($tags[$key]);
			
			// On développe la liste en mise en forme destinée à MySQL
			$tags = implode(',', $tags);
			
			// On ajout à MySQL
			$query = 'UPDATE chapters SET chapter_tags = "' . $tags . '" WHERE chapter_id = ' . $chapter;
			if ($this->db->query($query)) {
				return true;
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	
	
	public	function author_add($author, $chapter = null) {
		if (!$chapter)  $chapter = $this->get_chapter_info('id');
		
		// On récupère les auteurs
		$authors = $this->get_chapter_info('editors');
		// On vérifie que l'auteur ne soit pas déjà déclaré
		if (!in_array($author, $authors)) {
			// On ajoute le tag à la liste
			$authors[] = $author;
			
			// On développe la liste en mise en forme destinée à MySQL
			$authors = implode(',', $authors);
			
			// On ajout à MySQL
			$query = 'UPDATE chapters SET chapter_editors = "' . $authors . '" WHERE chapter_id = ' . $chapter;
			if ($this->db->query($query)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
	public	function author_delete($author, $chapter = null) {
		if (!$chapter) $chapter = $this->get_chapter_info('id');
		
		// On récupère les tags
		$authors = $this->get_chapter_info('editors');
		
		// On vérifie que le tag soit présent dans la liste
		if (in_array($author, $authors)) {
			// On recherche la position dans la liste du tag
			$key = array_search($author, $authors);
			unset($authors[$key]);
			
			// On développe la liste en mise en forme destinée à MySQL
			$authors = implode(',', $authors);
			
			// On ajout à MySQL
			$query = 'UPDATE chapters SET chapter_editors = "' . $authors . '" WHERE chapter_id = ' . $chapter;
			if ($this->db->query($query)) {
				return true;
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	
	
	public	function update_content($text, $chapter = null) {
		if (!$chapter) $chapter = $this->get_chapter_info('id');
		
		// On protège les apostrophes du fichier
		$text = addslashes($text);
		
		// On récupère l'ID de la version actuelle
		$query = 'SELECT content_id FROM chapters WHERE chapter_id = ' . $chapter;
		$sql = $this->db->query($query);
		$row = $sql->fetch_array();
		$id_now = $row[0];
		
		// On ajout le nouveau texte à la table du contenu
		$query =   'INSERT INTO contents (editor_id, chapter_id, content_text, content_previous)
					VALUES (' . $_COOKIE['user'] . ', ' . $chapter . ', "' . utf8_decode($text) . '", ' . $id_now . ')';
		
		if ($this->db->query($query)) {
			$query = 'UPDATE chapters SET content_id = ' . $this->db->insert_id . ' WHERE chapter_id = ' . $chapter;
			
			if ($this->db->query($query)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
	public function summary_display($book = null) {
		$book_ = $book;
		if (!$book) $book = $this->get_the_ID();
		
		// On recherche les informations sur le sommaire
		if (!$book_) {
			$summary = $this->get_summary_info('id');
		} else {
			$query = 'SELECT summary_id FROM books WHERE book_id = ' . $book;
			$sql = $this->db->query($query);
			$row = $sql->fetch_assoc();
			$summary = $row[0];
		}
		
		// On récupère les informations
		$query = 'SELECT * FROM summaries WHERE summary_id = ' . $summary;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_assoc();
			$array = unserialize($row['summary_sections']);

			$return = '<ul>';

			// On explose le sommaire
			foreach ($array as $key) {
					if (is_array($key)) {
						$return .= '<ul>';
						
							foreach ($key as $subkey) {
								if (is_array($subkey)) {
									$return .= '<ul>';
										
										$return .= '<li>Sous menu temporaire</li>';
										
									$return .= '</ul>';
								} else {
									$return .= '<li id="chapter-' . $subkey . '">';
										$query = 'SELECT chapter_name FROM chapters WHERE chapter_id = ' . $subkey;
										$sql = $this->db->query($query);
										
										if ($sql->num_rows) {
											$row = $sql->fetch_array();
											$return .= '<a href="' . $this->tpl_get_link_to('chapter', $subkey) . '">';
												$return .= utf8_encode($row[0]);
											$return .= '</a>';
										} else {
											$return .= 'Aucune information';
										}
									$return .= '</li>';
								}
							}
						
						$return .= '</ul>';
					} else {
						$return .= '<li id="chapter-' . $key . '">';
							$query = 'SELECT chapter_name FROM chapters WHERE chapter_id = ' . $key;
							$sql = $this->db->query($query);
							
							if ($sql->num_rows) {
								$row = $sql->fetch_array();
								$return .= '<a href="' . $this->tpl_get_link_to('section', $key) . '">';
									$return .= utf8_encode($row[0]);
								$return .= '</a>';
							} else {
								$return .= 'Aucune information';
							}
						$return .= '</li>';
					}
			}
			$return .= '</ul>';
			
			echo $return;
		}
		else {
			echo false;
		}
	}
}

?>