<?php 

	/**
	 * @author  Guemas Antony
	 * @package Models
	 * @version 1.1.0
	 */
	class ProjetsDataLayer
	{

		/**
		 * récupère la liste des projets du client
		 * 
		 * @author  Guemas Anthony
		 * @param   int   $idClient 
		 * @return  array liste des projets sous forme d'array
		 * @version 1.1.0
		 */
		public static function getProjetParClient($idClient) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT projet.id,titre, description, type, status
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
		 * @param   Integer  $idProjet 
		 * @return  projet 
		 * @version 1.1.0
		 */
		public static function getDetailProjet($idProjet) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT projet.id, titre, description, type, status, raisonSociale as client
												FROM   projet JOIN client ON client.id = projet.client 
												AND    projet.id = :id"
											  );

				$result->bindParam(":id", $idProjet, PDO::PARAM_INT);
				$result->execute();
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetch();

				return $result;
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
		 * @version 1.1.0
		 */
		public static function getProjetsNonAffectes($critereTri)
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT projet.id, titre, description, type, status, raisonSociale as client
												FROM   projet JOIN client ON client.id = projet.client 
												WHERE  status = 'N'
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
		 * @version 1.1.0
		 */
		public static function getProjetsActifsTermines($critereTri) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT DISTINCT  projet.id, titre, description, type, status, raisonSociale as client
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
		 * @param   $titre 
         * @param   $description
         * @param   $client
		 * @version 2.0.0
		 */
		public static function CreerProjet($titre, $description, $type, $client)
		{

			try
			{
				$status = 'N';

				// recuperation des informations
				$insert = bdd::$_pdo->prepare(" INSERT INTO  projet( titre,  description,  type,  status,  client)
												VALUES (:titre, :description, :type, :status, :client)");

				$insert->bindParam(":titre",$titre,PDO::PARAM_STR);
                $insert->bindParam(":description",$description,PDO::PARAM_STR);
                $insert->bindParam(":type",$type,PDO::PARAM_STR);
                $insert->bindParam(":status",$status,PDO::PARAM_STR);
                $insert->bindParam(":client",$client,PDO::PARAM_STR);

                $insert->execute();


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
		 * @version 1.0.0
		 */
		public static function getAdhesions()
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->query(" SELECT utilisateur.id, projet.id as projet, titre, telephone, mail,
											adresse, codePostal, ville, actif, nom, prenom, promo
											FROM utilisateur JOIN adherent 	 ON utilisateur.id = adherent.id
															 JOIN participer ON adherent.id = participer.user
															 JOIN projet 	 ON projet.id = participer.projet
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
		 * @param   identifiant $id  identifiant du projet dont on veut obtenir la liste des demandes 
		 * @version 1.0.0
		 */
		public static function getAdhesionsParProjet($id)
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

				$result->bindParam(":id", $id, PDO::PARAM_INT);
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
         * récupère la liste des Adherents participant au projet spécifié
         * 
         * @author  Guemas Anthony
         * @param   identifiant $id  identifiant du projet dont on veut obtenir la liste des adherents
         * @version 1.0.0
         */
        public static function getAdherentsParProjet($id)
        {
            try
            {
                // recuperation des informations
                $result = bdd::$_pdo->prepare(" SELECT   utilisateur.id, telephone, mail, adresse, codePostal, ville, actif, nom, prenom, promo, chefProjet
                                                FROM     utilisateur JOIN adherent   ON utilisateur.id = adherent.id
                                                                     JOIN participer ON adherent.id = participer.user 
                                                WHERE    participer.status = 'O'
                                                AND      participer.projet = :id    
                                             ");

                $result->bindParam(":id", $id, PDO::PARAM_INT);
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
         * @version 1.0.0
         */
        public static function getProjetParAdherent($adherent)
        {
            try
            {
                // recuperation des informations
                $result = bdd::$_pdo->prepare(" SELECT   projet.id, titre, description, type, projet.status, raisonSociale as client
                                                FROM     projet JOIN participer ON projet.id = participer.projet
                                                                JOIN client     ON projet.client = client.id
                                                WHERE    participer.user = :id
                                                AND participer.status NOT IN('A','R')    
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
         * Récupère la liste des projets actifs / en attente sur lesquels
         * l'adhérent n'est pas affecté.
         * @author Deleuil Maxime
         * @param $adherent identifiant de l'adherent
         * @return Array liste des projets
         * @version 1.0.0
         */
		public static function getProjetsNonAffecteParAdherent($adherent)
        {
            try
            {
                // recuperation des informations
                $result = bdd::$_pdo->prepare(" SELECT DISTINCT id, titre
												FROM projet
												WHERE id NOT IN ( SELECT projet FROM participer
             													WHERE user = :id
                												AND status IN('A','O'))");
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
         * @return  Array
         * @version 1.0.0
         */
        public static function getProjetsNonArchives()
        {
            try
            {
                // recuperation des informations
                $result = bdd::$_pdo->prepare(" SELECT   projet.id, titre, description, type, projet.status, raisonSociale as client
                                                FROM     projet JOIN client ON projet.client = client.id
                                                WHERE    status NOT IN ('A') 
                                                GROUP BY status  
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

		/**
		 * récupère le  chef de projet du projet passé en parametres  
		 * @author  Guemas Anthony
		 * @param   Integer $idPro Identifiant du projet
		 * @version 1.0.0
		 */
		public static function getChefProjet($idPro) 
		{
			try
			{
				// recuperation des informations
				$result = bdd::$_pdo->prepare(" SELECT   telephone, mail, adresse, codePostal, ville, actif, nom, prenom, promo
												FROM     utilisateur JOIN adherent   ON utilisateur.id = adherent.id
																	 JOIN participer ON adherent.id = participer.user 
												WHERE 	 participer.chefProjet = 'O'
												AND 	 participer.projet = :id	
											 ");

				$result->bindParam(":id", $idPro, PDO::PARAM_INT);
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
