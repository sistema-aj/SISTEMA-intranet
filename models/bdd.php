<?php

	/**
	 * @package Models
	 * @var     $_pdo
	 */
	class bdd {
	/* PRIVATE CLASS ATTRIBUTES */
		public static $_pdo;
		
	/* STATIC METHODS */

		/**
		 * initialise la connection avec la base de données 
		 * 
		 * @author  Deleuil Maxime 
		 * @version 1.0.0
		 */
		public static function init() 
		{
			self::$_pdo = new PDO('mysql:host='.Config::$_bdHote.';port='.Config::$_bdPort.';dbname='.config::$_bdName, Config::$_bdUser, Config::$_bdPassword);
			self::$_pdo->exec("SET CHARACTER SET utf8");
		}
		
		/**
		 * récupère le contenu d'une table 
		 * 
		 * @author  Deleuil Maxime
		 * @param   String $table 
		 * @return  array
		 * @version 1.1.0
		 */
		public static function getAllByTable($table) 
		{
			try
			{
				$result = self::$_pdo->query("SELECT * FROM ".$table);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}

		/**
		 * récupère le contenu d'une table selon l'identifiant
		 * 
		 * @author  Deleuil Maxime
		 * @param   String $table 
		 * @param   Integer $id 
		 * @return  array
		 * @version 1.1.0
		 */
		public static function getById($table, $id) 
		{
			try
			{
				$result = self::$_pdo->query("SELECT * FROM ".$table." WHERE id = ".$id);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetch();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}

		/**
		 * récupère le contenu d'une table, trié selon le chammp passé en parametre 
		 * 
		 * @author  Deleuil Maxime 
		 * @param   String $table 
		 * @param   String $arrColumn 
		 * @return  Array
		 * @version 1.0.0
		 */
		public static function getAllByTableOrderBy($table, $arrColumn) 
		{
			try
			{
				$order = $arrColumn[0];
				for ($i=1; $i < count($arrColumn); $i++)
					$order .= ", ".$arrColumn[$i];
				$result = self::$_pdo->query("SELECT * FROM ".$table." ORDER BY ".$order);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}

		/**
		 * Verifie la veracité du couple Login/MDP
		 * 
		 * @todo   ajouter la gestion du salt
		 * @author Deleuil Maxime 
		 * @param  String $login 
		 * @param  String $mdp 
		 * @return boolean 
		 * @version 1.1.0
		 */
		public static function getLogin($login, $mdp) 
		{
			try
			{
				$result = self::$_pdo->prepare("SELECT user, type FROM login WHERE login = :login AND mdp = :mdp");
				$result->bindParam(":login", $login, PDO::PARAM_STR);
				$result->bindParam(":mdp", $mdp, PDO::PARAM_STR);
				// execution de la requête, et récupération sous forme de tableau associatif.
				$result->execute();
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetch();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}

		/**
		 *  récupère la liste des adherents inactifs 
		 * @author  Deleuil Maxime
		 * @return  array
		 * @version 1.0.0
		 */
		public static function getInactiveAdh() 
		{
			try
			{
				$result = self::$_pdo->query("SELECT nom, prenom, promo, telephone, mail 
								FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
								WHERE actif = 0");
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}


		/**
		 *  récupère la liste des adherents actifs 
		 * @author  Deleuil Maxime
		 * @return  array
		 * @version 1.0.0
		 */
		public static function getActiveAdh() 
		{
			try
			{
				$result = self::$_pdo->query("SELECT nom, prenom, promo, telephone, mail 
								FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
								WHERE actif = 1");
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}
	}