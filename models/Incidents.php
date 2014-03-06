<?php

	/**
	 * @package Models
	 */
	class Incidents 
	{

		/**
		 * récupère la liste d'incidents du projet
		 * 
		 * @author 
		 * @param   String $idProjet 
		 * @return  Array  Liste d'identifiant des incidents
		 * @version 0
		 */
		public static function getIncidentParProjet($idProjet) {

		}

		/**
		 * récupère le detail d'un incident, et retourne un objet "incident"
		 * 
		 * @author
		 * @param  String    $idIncident 
		 * @return incident  
		 * @version 0
		 */
		public static function getDetailIncident($idIncident) {

		}

		/**
		 * Modifie l'etat de l'incident
		 * 
		 * @author 
		 * @param  type $idIncident 
		 * @param  type $nouvelEtat 
		 * @return type
		 * @version 0
		 */
		public static function modifierEtatIncident($idIncident, $nouvelEtat) {

		}

		/**
		 * Crée un incident, possédant l'état "à traiter"
		 * 
		 * @author 
		 * @param   type $typeRapport 
		 * @param   type $message 
		 * @return  type
		 * @version 0
		 */
		public static function creerIncident($typeRapport, $message){

		}

	}
?>