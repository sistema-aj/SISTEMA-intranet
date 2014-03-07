<?php

	/**
	 * @package Models
	 */
	class Competences 
	{
		/**
		 * ajoute une competence à l'adherent
		 * 
		 * @author  Guemas Anthony
		 * @param   String $idAdherent 
		 * @param   int    $idCompetence 
		 * @version 1
		 */
		public function ajoutCompetence($idAdherent, $idCompetence)
		{
		 	try
            {
                // recuperation des informations
                $insert = bdd::$_pdo->prepare(" INSERT INTO detenir (user, competence)
                                                VALUES (:idA , :idC)
                                              ");

                $insert->execute( 
                                    array(
                                            'idA'       => $idAdherent   ,
                                            'idC' 		=> $idCompetence 
                                        )
                                );
            }
            catch(Exception $e)
            {
                return $e;
            }
		}

		/**
		 * enlève la competence à l'adherent
		 * 
		 * @author
		 * @param  String $idAdherent 
		 * @param  int    $idCompetence 
		 * @version 0
		 */
		public function supppressionCompetence($idAdherent, $idCompetence)
		{
			$delete = bdd::$_pdo->prepare(" DELETE FROM detenir 
                                            WHERE 	    user 	    = :idA
                                            AND    		compentence = :idC
                                         ");

            $delete->execute( 
                                    array(
                                            'idA'       => $idAdherent   ,
                                            'idC' 		=> $idCompetence 
                                        )
                                );
            }	
		}


		/**
		 * ajoute une competence à la liste de celles deja existantes
		 * 
		 * @author
		 * @param   String $nomCompetence 
		 * @version 0
		 */
		public function listerNouvelleCompetence($nomCompetence)
		{
			try
            {
                // recuperation des informations
                $insert = bdd::$_pdo->prepare(" INSERT INTO competences( nom )
                                                VALUES (:nom)
                                              ");

                $insert->execute( 
                                    array(
                                            'nom'       => $nomCompetence   ,
                                        )
                                );
            }
            catch(Exception $e)
            {
                return $e;
            }
		}

		/**
		 * récupère la liste des etudiants possedant la competence demandée 
		 * 
		 * @author 
		 * @param   int 	  $idCompetence 
		 * @return  array 	  Liste des identifiants des adherents  
		 * @version 0
		 */
		public function getAdherentParCompetence($idCompetence)
		{
			 try
            {
                // recuperation des informations
                $result = bdd::$_pdo->prepare(" SELECT   telephone, mail, adresse, codePostal, ville, actif, nom, prenom, promo
                                                FROM     utilisateur JOIN adherent   ON utilisateur.id = adherent.id
                                                                     JOIN detenir    ON adherent.id    = detenir.user 
                                                WHERE    detenir.competence = :idC    
                                             ");

                $result->bindParam(":idC", $idCompetence, PDO::PARAM_INT);
                $result = $result->fetchAll();

                return $result;
            }
            catch(Exception $e)
            {
                return $e;
            }
        }

		}

	}




?>


