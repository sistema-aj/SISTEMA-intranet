<?php

	class Utilisateur	
	{

		protected $identifiant;
		protected $tel;
		protected $mail;
		protected $adresse;
		protected $actif;


		/**
		 * Constructeur d'Utilisateur
		 * 
		 * @author 	 Guemas Anthony
		 * @version  1
		 */
		public Utilisateur($identifiant, $tel, $mail, $adresse, $actif)
		{
			this.$identifiant = $identifiant;
			this.$tel		  = $tel;
			this.$mail 		  = $mail;
			this.$adresse	  = $adresse;
			this.$actif 	  = $actif;
		}

		/**
		 * Retourne un objet de type de l'utilisateur, instancié a partir des informations obtenues grace à l'identifiant.
		 * 
		 * @author  Guemas Anthony
		 * @param   String $idUtilisateur 
		 * @param   Char $type    A = admin/ E = adherent/ C = client
		 * @return  Utilisateur
		 * @version 0
		 */
		public function getUtilisateur($idUtilisateur, $type)  
		{
				switch($type)
				{
					case 'A' : return Administrateur::getAdministrateur($idUtilisateur);
					break;

					case 'E' : return Adherent::getAdherent($idUtilisateur);
					break;

					case 'C' : return Client::getClient($idUtilisateur);
					break;

					default : return 0;
					break;
				}
		}

	}



?>