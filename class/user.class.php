<?php

// Classe dédiée aux fonctions utilisateurs


class user extends core {
	
	// Attributs déclarés
	private	$db;
	private	$connexion; // Statut de la connexion
	
	private	$id; // Connected profile ID
	
	
	// Méthodes déclarées
	
	public	function __construct($db) {
		$this->db = $db;
		
		if ($_COOKIE['user']) {
			$query = 'SELECT user_id FROM users WHERE user_id = ' . $_COOKIE['user'];
			$sql = $this->db->query($query);
			
			if ($sql->num_rows == 1) {
				$this->connexion = true;
			} else {
				$this->connexion = false;
			}
		} else {
			$this->connexion = false;
		}
	}
	
	
	// Méthode de vérification de la connexion de l'utilisateur
	public	function check_connexion() {
		// On vérifie si le cookie est présent sur la machine
		if ($this->connexion) {
			return true;
		} else if ($_COOKIE['user']) {
			$query = 'SELECT user_id FROM users WHERE user_id = ' . $_COOKIE['user'];
			$sql = $this->db->query($query);
			
			if ($sql->num_rows == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
	// Méthode d'éjection des personnes non identifiées
	public	function secure_page() {
		if (!$this->statut_connexion()) { tpl_redirection('login', 'erreur', 'session'); }
	}
	
	
	// Encoding password
	public	function crypt_password($pass) {
		return md5($pass);
	}
	
	
	// Log in function
	public	function login($login, $pass) {
		if ($this->check_login($login)) {
			$query = 'SELECT * FROM users WHERE user_login = "' . $login . '"';
			$sql = $this->db->query($query);
			$row = $sql->fetch_assoc();
			
			if ($row['user_pass'] == $this->crypt_password($pass)) {
				$timeout = time() + (3600*24*5); // five day
				setcookie('user', $row['user_id'], $timeout);
				$this->tpl_redirection('dashboard');
			} else {
				$this->tpl_redirection('login', 'error', 'password');
			}
		} else { $this->tpl_redirection('login', 'error', 'login'); }
	}
	
	
	// Méthodes d'affichage des erreurs de login
	public	function is_error($type) {
		if ($_POST['error'] == $type) {
			return true;
		} else {
			return false;
		}
	}
	
	
	// Verify the existence of a login
	public	function check_login($login) {
		$query = 'SELECT user_login FROM users WHERE user_login = "' . $login . '"';
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	
	// Profil informations
	
	public	function get_the_ID($id = null) {
		if (!$id) { $id = $this->id; }
		$query = 'SELECT user_id FROM users WHERE user_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_array($sql);
			return $row[0];
		}
	}
	public	function the_ID($id = null) { echo $this->get_the_ID($id); }
	
	
	public	function get_the_login($id = null) {
		if (!$id) { $id = $this->id; }
		$query = 'SELECT user_login FROM users WHERE user_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_array($sql);
			return $row[0];
		}
	}
	public	function the_login($id = null) { echo $this->get_the_login($id); }
	
	
	public	function get_the_email($id = null) {
		if (!$id) { $id = $this->id; }
		$query = 'SELECT user_email FROM users WHERE user_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_array($sql);
			return $row[0];
		}
	}
	public	function the_email($id = null) { echo $this->get_the_email($id); }
	
	
	public	function get_the_twitter($id = null) {
		if (!$id) { $id = $this->id; }
		$query = 'SELECT user_twitter FROM users WHERE user_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_array($sql);
			return $row[0];
		}
	}
	public	function the_twitter($id = null) { echo $this->get_the_twitter($id); }
	
	
	public	function get_the_avatar($id = null) {
		if (!$id) { $id = $this->id; }
		$query = 'SELECT user_profile_picture FROM users WHERE user_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_array($sql);
			return $row[0];
		}
	}
	public	function the_avatar($id = null) { echo $this->get_the_avatar($id); }
	
	
	public	function get_the_website($id = null) {
		if (!$id) { $id = $this->id; }
		$query = 'SELECT user_website FROM users WHERE user_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_array($sql);
			return $row[0];
		}
	}
	public	function the_website($id = null) { echo $this->get_the_website($id); }
	
	
	public	function get_the_nicename($id = null) {
		if (!$id) { $id = $this->id; }
		$query = 'SELECT user_nicename, user_login FROM users WHERE user_id = ' . $id;
		$sql = $this->db->query($query);
		
		if ($sql->num_rows == 1) {
			$row = $sql->fetch_array($sql);
			if ($row[0]) {
				return $row[0];
			} else {
				return $row[1];
			}
		}
	}
	public	function the_nicename($id = null) { echo $this->get_the_nicename($id); }
	
	
	public	function user_create($login, $pass, $email) {
		if (!$this->check_login($login)) {
			if ($pass[0] == $pass[1]) {
				if ($core->check_format($email)) {
					$query = 'INSERT INTO users (user_login, user_pass, user_email) VALUES ("' . $login . '", "' . $pass . '", "' . $email . '")';
				} else {
					$core->tpl_redirection('inscription', 'erreur', 'email');
				}
			} else {
				$this->tpl_redirection('inscription', 'erreur', 'pass');
			}
		} else {
			$this->tpl_redirection('inscription', 'erreur', 'login');
		}
	}
}

?>