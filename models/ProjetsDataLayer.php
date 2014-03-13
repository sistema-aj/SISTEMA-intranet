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
		public static function getProjetParClient($idClient) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT titre, description, type, status
												FROM projet JOIN client ON client.id = projet.client 
												AND projet.client = :id");
				$result->bindParam(":id", $idClient, PDO::PARAM_INT);
				$result->execute();
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
		 * récupère les informations d'un projet et retourne un objet "projet" correspondant
		 * 
		 * @author 	Guemas Anthony
		 * @param   int   $idProjet 
		 * @return  projet 
		 * @version 1
		 */
		public static function getDetailProjet($idProjet) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT titre, description, type, status, client
												FROM   projet JOIN client ON client.id = projet.client 
												AND    projet.client = :id"
											  );

				$result->bindParam(":id", $idClient, PDO::PARAM_INT);
				$result->execute();
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetch();

				$titre		 = $result->titre;
				$description = $result->description;
				$type 		 = $result->type;
				$archive 	 = $result->archive;

				// encapsulation
				$p = new Projets($titre, $description, $type, $archive);

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
		public static function getProjetsNonAffectes($critereTri)
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT titre, description, type, status, raisonSociale as client
												FROM   projet JOIN client ON client.id = projet.client 
												WHERE status = 'N'
												ORDER BY :tri");
				$result->bindParam(":tri", $critereTri, PDO::PARAM_INT);
				$result->execute();
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
		 * récupère la liste des projets actifs ou terminés
		 * 
		 * @author 	Guemas Anthony
		 * @param   String $critereTri 	[type / client] 
		 * @return  Array
		 * @version 1
		 */
		public static function getProjetsActifsTermines($critereTri) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT DISTINCT  id, titre, description, type, status, raisonSociale as client
                                                FROM   projet JOIN client ON client.id = projet.client 
												WHERE status NOT IN ('N')
												ORDER BY :tri");
				$result->bindParam(":tri", $critereTri, PDO::PARAM_INT);
				$result->execute();
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
		 * Crée un Projet en base 
		 * 
		 * @author  Guemas Anthony
		 * @param   projet $projet 	objet de type projet devant etre entré en base 
		 * @version 1
		 */
		public static function CreerProjet($projet)
		{

			try
			{
				$titre 		 = $projet->titre;
				$description = $projet->description;
				$type  		 = $projet->type;
				$status		 = $projet->status;
				$client 	 = $projet->client;

				// recuperation des informations
				$insert = bdd::$_pdo->prepare(" INSERT INTO  projet( titre,  description,  type,  status,  client)
												VALUES (:titre, :description, :type, :status, :client)");

				$insert->execute( 
									array(
											'titre' 	  => $titre ,
											'description' => $description ,
											'type'		  => $type ,
											'status'	  => $status , 
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
		 * @author  Guemas Anthony
		 * @return 	array 	Liste d'adherents 
		 * @version 0
		 */
		public static function getAdhesions()
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->query(" SELECT utilisateur.id, projet.id as projet, titre, telephone, mail,
											adresse, codePostal, ville, actif, nom, prenom, promo
											FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id
											JOIN participer ON adherent.id = participer.user
											JOIN projet ON projet.id = participer.projet
											WHERE participer.status = 'A'");
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
		 * récupère la liste des Adherents demandant à adherer au projet spécifié
		 * 
		 * @author  Guemas Anthony
		 * @param   projet $projet 	objet de type projet dont on veut obtenir la liste des demandes 
		 * @version 0
		 */
		public static function getAdhesionsParProjet($projet)
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT   telephone, mail, adresse, codePostal, ville, actif, nom, prenom, promo
												FROM     utilisateur JOIN adherent   ON utilisateur.id = adherent.id
																	 JOIN participer ON adherent.id = participer.user 
												WHERE 	 participer.status = 'A'
												AND 	 participer.projet = :id	
											 ");
				$result->bindParam(":id", $projet->id, PDO::PARAM_INT);
				$result->execute();
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
         * récupère la liste des projets pour l'adhrent spécifié
         * 
         * @author  Guemas Anthony
         * @param   identifiant $adherent  identifiant de l'adherent sur lequel porte la requete 
         * @version 0
         */
        public static function getProjetParAdherent($adherent)
        {
            try
            {
                // recuperation des informations
                $result = bdd::$_pdo->prepare(" SELECT   titre, description, type, projet.status, raisonSociale as client
                                                FROM     projet JOIN participer ON projet.id = participer.projet
                                                                JOIN client     ON projet.client = client.id
                                                WHERE    participer.user = :id    
                                             ");

                $result->bindParam(":id", $adherent, PDO::PARAM_INT);
                $result->execute();
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
         * récupère la liste des projets non terminés
         * 
         * @author  Guemas Anthony
         * @param   identifiant $adherent  identifiant de l'adherent sur lequel porte la requete 
         * @version 0
         */
        public static function getProjetsNonArchives()
        {
            try
            {
                // recuperation des informations
                $result = bdd::$_pdo->prepare(" SELECT   titre, description, type, projet.status, raisonSociale as client
                                                FROM     projet JOIN client     ON projet.client = client.id
                                                WHERE    status NOT IN ('A')   
                                             ");

                $result->execute();
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
