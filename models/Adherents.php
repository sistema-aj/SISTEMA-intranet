<?php

	/**
	 * @package Models
	 */

	class Adherents extends Utilisateur 
	{

		private $prenom;
		private $nom;

		/**
		 * constructeur d'Adherent 
		 * @todo Verifier le "super"
		 * 
		 * @author  Guemas Anthony
		 * @version 1
		 */
		public Adherent($id, $tel, $mail, $adresse, $actif, $prenom, $nom)
		{
			super($id, $tel, $mail, $adresse, $actif);

			this.$prenom = $prenom;
			this.$nom = $nom;
		}

		/**
		 * retourne la liste des adherents 
		 * 
		 * @author  Guemas Anthony
		 * @return  array liste d'identifiants
		 * @version 1
		 */
		public static function getAdherents() 
		{
			try
			{
				$result = self::$_pdo->query("SELECT id
											  FROM adherent");

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
		 * retourne un adherent à partir de son identifiant
		 *  
		 * @author  Guemas Anthony
		 * @param   $idAdherent  identifiant de l'adherent 
		 * @return  adherent     Objet adherent correspondant à l'identifiant 
		 * @version 1
		 */
		public static function getDetailAdherent($idAdherent) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT id, telephone, mail, adresse, actif, nom, prenom 
												FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
												AND utilisateur.id = :id");
				$result->bindParam(":id", $idAdherent, PDO::PARAM_INT);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				//return $result;

				$id      = $result->id;
				$tel     = $result->tel;
				$mail    = $result->mail;
				$adresse = $result->adresse;
				$actif   = $result->actif;
				$nom     = $result->nom;
				$prenom  = $result->prenom;


				// encapsulation
				Adherent $A = new Adherent($id, $tel, $mail, $adresse, $actif, $nom, $prenom);

				return $A;

			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		/**
		 * retourne la liste des adherents participant à un projet
		 * 
		 * @author
		 * @param   $idProjet  identifiant du projet
		 * @return  Array      liste d'identifiants
		 * @version 0
		 */
		public static function getAdherentsParProjet($idProjet)
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT id
												FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id
												JOIN projet ON utilisateur.id = projet.user 
												AND projet.id = :id");
				$result->bindParam(":id", $idProjet, PDO::PARAM_INT);
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}
	}
?>
