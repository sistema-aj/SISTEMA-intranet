<?php

	/**
	 * @author Guemas Antony
	 * @package Models
	 * @version 1.0.0
	 */
	class UtilisateurDataLayer {
		/**
		 * Retourne un objet de type de l'utilisateur, instancié a partir des informations obtenues grace à l'identifiant.
		 * 
		 * @author  Guemas Anthony
		 * @param   String $id
		 * @return  Client / Adherent / Administrateur 
		 * @version 1.1.0
		 */
		public static function getUtilisateur($id)  
		{
			switch(self::getType($id))
			{
				case 'A' : return AdministrateurDataLayer::getAdministrateur($id);
				break;

				case 'E' : return AdherentDataLayer::getAdherent($id);
				break;

				case 'C' : return ClientDataLayer::getClient($id);
				break;

				default : return null;
				break;
			}
		}

		/**
		 * Retourne le type de l'utilisateur entré en paramétre.
		 * @author  Deleuil Maxime
		 * @param   String $id
		 * @return  Type de l'utilisateur 
		 * @version 1.0.0
		 */
		public static function getType($id)
		{
			$result = bdd::$_pdo->prepare("SELECT type FROM login WHERE user = :user");
			$result->bindParam(":user", $id, PDO::PARAM_INT);
			// execution de la requête, et récupération sous forme de tableau associatif.
			$result->execute();
			$result->setFetchMode(PDO::FETCH_OBJ);
			$result = $result->fetch();
			return $result;
		}
	}
?>