<?php

	/**
	 * @package Models
	 */
	class Competences {

		/**
		 * ajoute une competence à l'adherent
		 * 
		 * @author
		 * @param   String $idAdherent 
		 * @param   int    $idCompetence 
		 * @version 0
		 */
		public function ajoutCompetence($idAdherent, $idCompetence){

		}

		/**
		 * enlève la competence à l'adherent
		 * 
		 * @author
		 * @param  String $idAdherent 
		 * @param  int    $idCompetence 
		 * @version 0
		 */
		public function supppressionCompetence($idAdherent, $idCompetence){

		}


		/**
		 * ajoute une competence à la liste de celles deja existantes
		 * 
		 * @author
		 * @param   String $nomCompetence 
		 * @version 0
		 */
		public function listerNouvelleCompetence($nomCompetence){

		}

		/**
		 * récupère la liste des etudiants possedant la competence demandée 
		 * 
		 * @author 
		 * @param   int 	  $idCompetence 
		 * @return  array 	  Liste des identifiants des adherents  
		 * @version 0
		 */
		public function getEtudiantParCompetence($idCompetence){
	
		}
	}




?>


