<?php

	/**
	 * @package Models
	 */

	class Adherents extends Utilisateur 
	{

		private $prenom;
		private $nom;

		/**
		 * constructeur d'Adherent 
		 * @author  Guemas Anthony
		 * @version 1.0.1
		 */
		public __construct($id, $tel, $mail, $adresse, $actif, $prenom, $nom)
		{
			parent($id, $tel, $mail, $adresse, $actif);
			$this->prenom 	= $prenom;
			$this->nom 		= $nom;
		}
	}
?>
