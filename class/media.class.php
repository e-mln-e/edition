<?php

class media extends core {
	
	private	$db;
	
	
	public	function __construct($db) {
		$this->db = $db;
	}
	
	
	public	function upload($fichier) {
		
		// On vérifie que le fichier existe bien
		if (empty($fichier)) return false;
		
		
		// On détermine la destination du fichier
		$destination = 'uploads/' . time() . '-' . $fichier['name'];
		
		// On tente de déplacer le fichier
		if (move_uploaded_file($fichier['tmp_name'], $destination)) {
			$query = '	INSERT INTO medias (media_url,
											media_type,
											media_user_uploader )
						VALUES ("' . $destination . '",
								"image",
								' . $_COOKIE['user'] . ')';
								
			if ($this->db->query($query)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
}

?>