<?php
	/**
	 * @author  Deleuil Maxime
	 * @package Models
	 * @version 1.2.0
	 */
	class AdherentsDataLayer {
		/**
		 * retourne la liste des adherents et leurs détails
		 * @author  Deleuil Maxime
		 * @return  array liste avec le détail des Adhérents
		 * @version 1.1.0
		 */
		public static function getAdherents() 
		{
			try
			{
				$result = bdd::$_pdo->query("SELECT utilisateur.id, nom, prenom, promo, telephone, mail 
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

		/**
		 * retourne l'objet d'Adherent en fonction de l'identifiant entré en paramétre 
		 * @author  Deleuil Maxime
		 * @param   $id 
		 * @return  objet Adherent
		 * @version 1.0.0
		 */
		public static function getAdherent($id)
		{
			try {
				$result = bdd::$_pdo->prepare("SELECT nom, prenom, promo, telephone, mail, adresse, codePostal, ville, actif 
								FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
								WHERE actif = 1
								AND adherent.id = :id");
				$result->bindParam(":id", $id, PDO::PARAM_INT);
				$result->execute();
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetch();
				
				$tel     	= $result->telephone;
				$mail    	= $result->mail;
				$adresse 	= $result->adresse;
				$codePostal = $result->codePostal;
				$ville 	 	= $result->ville;
				$actif   	= $result->actif;
				$nom     	= $result->nom;
				$prenom  	= $result->prenom;
				$promo	 	= $result->promo;
				return new Adherents($id, $tel, $mail, $adresse, $codePostal, $ville, $actif, $prenom, $nom, $promo);

			} catch (Exception $e) {
				return $e;
			}
		}
	} 
?>