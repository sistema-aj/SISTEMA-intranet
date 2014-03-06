<?php
	/**
	 * @package Models
	 */
	class AdherentsDataLayer {
		/**
		 * retourne la liste des adherents 
		 * @author  Deleuil Maxime
		 * @return  array liste d'identifiants
		 * @version 1.1.0
		 */
		public static function getAdherents() 
		{
			try
			{
				$result = bdd::$_pdo->query("SELECT nom, prenom, promo, telephone, mail 
								FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
								WHERE actif = 1");
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		public static function getAdherent($id)
		{
			try {
				$result = bdd::$_pdo->prepare("SELECT nom, prenom, promo, telephone, mail 
								FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
								WHERE actif = 1
								AND adherent.id = :id");
				$result->bindParam(":id", $id, PDO::PARAM_INT);
				$result->execute();
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetch();

				$id      = $result->id;
				$tel     = $result->tel;
				$mail    = $result->mail;
				$adresse = $result->adresse;
				$actif   = $result->actif;
				$nom     = $result->nom;
				$prenom  = $result->prenom;
				return new Adherent($id, $tel, $mail, $adresse, $actif, $nom, $prenom);

			} catch (Exception $e) {
				return $e;
			}
		}
	} 
?>