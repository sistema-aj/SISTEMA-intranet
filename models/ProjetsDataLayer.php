<?php 

	/**
	 * @package Models
	 */
	class ProjetsDataLayer
	{

		/**
		 * récupère la liste des projets du client
		 * 
		 * @author  Guemas Anthony
		 * @param   int   $idClient 
		 * @return  array liste des projets sous forme d'array
		 * @version 1
		 */
		public function getProjetParClient($idClient) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT id, titre, description, type, archive
												FROM projet JOIN client ON client.id = projet.client 
												AND projet.client = :id");

				$result->bindParam(":id", $idClient, PDO::PARAM_INT);
				$result = $result->fetchAll();

				return $result;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		/**
		 * récupère les informations d'un projet et retourne un objet "projet" correspondant
		 * 
		 * @author 	Guemas Anthony
		 * @param   int   $idProjet 
		 * @return  projet 
		 * @version 1
		 */
		public function getDetailProjet($idProjet) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT titre, description, type, archive
												FROM   projet JOIN client ON client.id = projet.client 
												AND    projet.client = :id"
											  );

				$result->bindParam(":id", $idClient, PDO::PARAM_INT);
				$result = $result->fetch();

				$titre		 = $result->titre;
				$description = $result->description;
				$type 		 = $result->type;
				$archive 	 = $result->archive;

				// encapsulation
				Projets $p = new Projets($titre, $description, $type, $archive);

				return $p;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		/**
		 * récupère la liste des projets dont aucun adherent n'a la charge.
		 * 
		 * @author 	Guemas Anthony
		 * @param   String $critereTri 	[type / client] 
		 * @return  Array
		 * @version 1
		 */
		public function getProjetsNonAffectes($critereTri)
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT   id, titre, description, type, archive
												FROM     projet JOIN participer ON projet.id = participer.projet 
												WHERE 	 projet.id NOT IN participer.projet
												ORDER BY :tri"
											 );

				$result->bindParam(":tri", $critereTri, PDO::PARAM_INT);
				$result = $result->fetchAll();

				return $result;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		/**
		 * récupère la liste des projets actifs ou terminés
		 * 
		 * @author 	Guemas Anthony
		 * @param   String $critereTri 	[type / client] 
		 * @return  Array
		 * @version 1
		 */
		public function getProjetsActifsTermines($critereTri)
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT   id, titre, description, type, archive
												FROM     projet JOIN participer ON projet.id = participer.projet 
												WHERE 	 projet.id IN participer.projet
												ORDER BY :tri"
											 );

				$result->bindParam(":tri", $critereTri, PDO::PARAM_INT);
				$result = $result->fetchAll();

				return $result;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		/**
		 * Crée un Projet en base 
		 * 
		 * @author  Guemas Anthony
		 * @param   projet $projet 	objet de type projet devant etre entré en base 
		 * @version 1
		 */
		public function CreerProjet($projet)
		{

			try
			{
				$titre 		 = $projet->titre;
				$description = $projet->description;
				$type  		 = $projet->type;
				$archive 	 = $projet->archive;
				$client 	 = $projet->client;

				// recuperation des informations
					$insert = bdd::$_pdo->prepare(" INSERT INTO  projet( titre,  description,  type,  archive,  client)
													VALUES 		       (:titre, :description, :type, :archive, :client)
												 ");

				$insert->execute( 
									array(
											'titre' 	  => $titre ,
											'description' => $description ,
											'type'		  => $type ,
											'archive'	  => $archive , 
											'client'	  => $client
										)
								);
			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		/**
		 * récupère la liste des Adherents demandant a adherer a un projet.
		 * 
		 * @author 
		 * @return 	array 	Liste d'adherents 
		 * @version 0
		 */
		public function getAdhesions()
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT   telephone, mail, adresse, codePostal,, ville, actif, nom, prenom, promo
												FROM     utilisateur JOIN adherent   ON utilisateur.id = adherent.id
																	 JOIN participer ON adherent.id = participer.user 
												WHERE 	 participer.status = 'A'	
											 ");

				$result = $result->fetchAll();

				return $result;
			}
			catch(Exception $e)
			{
				return $e;
			}
		}

		/**
		 * récupère la liste des Adherents demandant à adherer au projet spécifié
		 * 
		 * @author 
		 * @param   projet $projet 	objet de type projet dont on veut obtenir la liste des demandes 
		 * @version 0
		 */
		public function getAdhesionsParProjet($projet)
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT   telephone, mail, adresse, codePostal,, ville, actif, nom, prenom, promo
												FROM     utilisateur JOIN adherent   ON utilisateur.id = adherent.id
																	 JOIN participer ON adherent.id = participer.user 
												WHERE 	 participer.status = 'A'
												AND 	 projet.id = :id	
											 ");
				$result->bindParam(":id", $projet->id, PDO::PARAM_INT);
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
