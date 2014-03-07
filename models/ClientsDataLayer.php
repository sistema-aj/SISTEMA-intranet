<?php
	class ClientsDataLayer
	{
		/**
		 * retourne la liste des clients et leurs détails 
		 * @author  Deleuil Maxime
		 * @return  array liste avec le détail des Clients
		 * @version 1.0.0
		 */
		public static function getClients() 
		{
			try
			{
				$result = bdd::$_pdo->query("SELECT utilisateur.id, raisonSociale, telephone, mail, adresse, codePostal, ville  
								FROM utilisateur JOIN client ON utilisateur.id = client.id");
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
		 * retourne l'objet de Client en fonction de l'identifiant entré en paramétre 
		 * @author  Deleuil Maxime
		 * @return  objet Client
		 * @version 1.0.0
		 */
		public static function getClient($id)
		{
			try {
				$result = bdd::$_pdo->prepare("SELECT raisonSociale, telephone, mail, adresse, codePostal, ville, actif 
								FROM utilisateur JOIN client ON utilisateur.id = client.id 
								WHERE client.id = :id");
				$result->bindParam(":id", $id, PDO::PARAM_INT);
				$result->execute();
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetch();

				$tel     	= $result->telephone;
				$mail    	= $result->mail;
				$adresse 	= $result->adresse;
				$codePostal	= $result->codePostal;
				$ville 	 	= $result->ville;
				$actif   	= $result->actif;
				$raisonSociale = $result->raisonSociale;
				return new Client($id, $tel, $mail, $adresse, $codePostal, $ville, $actif, $raisonSociale);

			} catch (Exception $e) {
				return $e;
			}
		}		
	}
?>