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
		public static function ajoutCompetence($idAdherent, $idCompetence)
		{
		 	try
            {
                bdd::$_pdo->beginTransaction();
                $insert = bdd::$_pdo->prepare("INSERT INTO detenir (user, competence)
                                                VALUES (:idA , :idC)");
                $insert->bindParam(':idA',$idAdherent,PDO::PARAM_INT);
                $insert->bindParam(':idC',$idCompetence,PDO::PARAM_INT);
                $insert->execute();
                bdd::$_pdo->commit();
            }
            catch(Exception $e)
            {
                bdd::$_pdo->rollBack();
                throw new Exception($e->getMessage());
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
		public static function supppressionCompetence($idAdherent, $idCompetence)
		{
            try {
                bdd::$_pdo->beginTransaction();
        		$delete = bdd::$_pdo->prepare("DELETE FROM detenir 
                                                WHERE user = :idA
                                                AND compentence = :idC");
                $delete->bindParam(":idA",$idAdherent,PDO::PARAM_INT);
                $delete->bindParam(":idC",$idCompetence,PDO::PARAM_INT);
                $delete->execute();
                bdd::$_pdo->commit();
            } catch (Exception $e) {
                bdd::$_pdo->rollBack();
                throw new Exception($e->getMessage());
            }
        }	


		/**
		 * ajoute une competence à la liste de celles deja existantes
		 * 
		 * @author
		 * @param   String $nomCompetence 
		 * @version 0
		 */
		public static function listerNouvelleCompetence($nomCompetence)
		{
			try
            {
                bdd::$_pdo->beginTransaction();
                $insert = bdd::$_pdo->prepare("INSERT INTO competences(nom)
                                                VALUES (:nom)");
                $insert->bindParam(":nom",$nomCompetence,PDO::PARAM_STR);
                $insert->execute();
                bdd::$_pdo->commit();
            }
            catch(Exception $e)
            {
                bdd::$_pdo->rollBack();
                throw new Exception($e->getMessage());
            }
		}

		/**
		 * récupère la liste des etudiants possedant la competence demandée 
		 * 
		 * @author  Guemas Anthony
		 * @param   int 	  $idCompetence 
		 * @return  array 	  Liste des identifiants des adherents  
		 * @version 0
		 */
		public static function getAdherentParCompetence($idCompetence)
		{
			 try
            {
                $result = bdd::$_pdo->prepare(" SELECT telephone, mail, adresse, codePostal, ville, actif, nom, prenom, promo
                                                FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id
                                                JOIN detenir ON adherent.id = detenir.user 
                                                WHERE detenir.competence = :idC");
                $result->bindParam(":idC", $idCompetence, PDO::PARAM_INT);
                $result->execute();
                $result = $result->fetchAll();
            }
            catch(Exception $e)
            {
                throw new Exception($e->getMessage());
            }
        }

        /**
         * récupère la liste des compétences pour un étudiant 
         * 
         * @author  Deleuil Maxime
         * @param   int       $id 
         * @return  array     Liste des compétences de l'adhérent  
         * @version 1.0.0
         */
        public static function getCompetencesParAdh($id) {
            try {
                $result = bdd::$_pdo->prepare("SELECT nom FROM detenir JOIN competences ON id = competence 
                                            WHERE user = :id");
                $result->bindParam(":id", $id, PDO::PARAM_INT);
                $result->execute();
                $result->setFetchMode(PDO::FETCH_OBJ);
                $result = $result->fetchAll();
                return $result;
            } catch (Exception $e) {
                return $e;
            }
        }
    }
?>


