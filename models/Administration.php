<?php

	/**
	 * @package Models
	 */
	class Administration {
	

		/**
		 * crée un adherent ne possedant pas de Login/Mot de passe 
		 * 
		 * @author 
		 * @param   String Nom
		 * @param   String Prenom
		 * @param   String Mail
		 * @param   String telephone
		 * @param   String adresse
		 * @param   Array  competences Liste de competences du candidat
		 * @version 0
		 * 
		 */
		public static function creerCandidat() {

		}

		/**
		 * recupère les informations de tous les candidats
		 * retourne une liste d'instances d'adherent
		 * 
		 * @author
		 * @return  array Candidats 	Liste d'objets "adherent"
		 * @version 0
		 */

		public static function getCandidats() {

		}

		/**
		 * Valide l'inscription d'un candidat et lui fournit un couple Login / mot de passr
		 * 
		 * @author
		 * @param   String $identifiant   Id de l'adherent
		 * @param   String $mail 		 adresse Mail de l'adherent 
		 * @version 0
		 */ 
		public static function validerCandidat($identifiant, $mail) {

		}


		/**
		 * Affecte l'adherent au projet specifié
		 * 
		 * @author
		 * @param   String $idAdherent
		 * @param   String $idProjet
		 * @version 0
		 */
		public static function affecterAuProjet($idAdherent, $idProjet) {

		}

		/**
		 * Definit l'adherent en tant que chef de projet 
		 * 
		 * @author
		 * @param String $idAdherent
		 * @param String $idProjet
		 * @version 0
		 */
		public static function nommerChefProjet($idAdherent, $idProjet) {

		}
	}
?>