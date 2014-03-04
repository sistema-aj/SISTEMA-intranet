<?php
	class bdd {
	/* PRIVATE CLASS ATTRIBUTES */
		private static $_pdo;
		
	/* STATIC METHODS */
		public static function init() {
			self::$_pdo = new PDO('mysql:host='.Config::$_bdHote.';port='.Config::$_bdPort.';dbname='.config::$_bdName, Config::$_bdUser, Config::$_bdPassword);
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

		public static function getLogin($login, $mdp) {
			$result = self::$_pdo->prepare("SELECT user, type FROM login WHERE login = :login AND mdp = :mdp");
			$result->bindParam(":login", $login, PDO::PARAM_STR);
			$result->bindParam(":mdp", $mdp, PDO::PARAM_STR);
			// execution de la requête, et récupération sous forme de tableau associatif.
			$result->execute();
			$result->setFetchMode(PDO::FETCH_OBJ);
			$result = $result->fetch();
			return $result;	
		}

		public static function getInactiveAdh() {
			$result = self::$_pdo->query("SELECT nom, prenom, promo, telephone, mail 
								FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
								WHERE actif = 0");
			$result->setFetchMode(PDO::FETCH_OBJ);
			$result = $result->fetchAll();
			return $result;
		}

		public static function getAdhesionsPro()
		{
			try 
			{
				$result = self::$_pdo->query("SELECT nom, prenom, promo, telephone, mail, titre
									FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
									JOIN participer ON utilisateur.id = participer.user
									JOIN projet ON projet.id = participer.projet
									WHERE status = 'A'");
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			} 
			catch(Exception $e)
			{
				return "Erreur à définir";
			}
		}
	}