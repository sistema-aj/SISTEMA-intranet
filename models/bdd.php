<?php
	class bdd {
	/* PRIVATE CLASS ATTRIBUTES */
		private static $_pdo;
		private static $_hote = '127.0.0.1';
		private static $_port = '3306';
		private static $_bd='sistema'; // le nom de votre base de données
		private static $_user='root'; // nom d'utilisateur pour se connecter
		private static $_pswd=''; // mot de passe de l'utilisateur pour se connecter
		
	/* STATIC METHODS */
		public static function init() {
			self::$_pdo = new PDO('mysql:host='.self::$_hote.';port='.self::$_port.';dbname='.self::$_bd, self::$_user, self::$_pswd);
			self::$_pdo->exec("SET CHARACTER SET utf8");
		}

		public static function getAllByTable($table) {
			$result = self::$_pdo->query("SELECT * FROM ".$table);
			$result->setFetchMode(PDO::FETCH_OBJ);
			return $result;
		}

		public static function getById($table, $id) {
			$result = self::$_pdo->query("SELECT * FROM ".$table." WHERE id = ".$id);
			$result->setFetchMode(PDO::FETCH_OBJ);
			return $result;
		}

		public static function getAllByTableOrderBy($table, $arrColumn) {
			$order = $arrColumn[0];
			for ($i=1; $i < count($arrColumn); $i++)
				$order .= ", ".$arrColumn[$i];
			$result = self::$_pdo->query("SELECT * FROM ".$table." ORDER BY ".$order);
			$result->setFetchMode(PDO::FETCH_OBJ);
			return $result;
		}
	}