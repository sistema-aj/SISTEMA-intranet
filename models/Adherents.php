<?php

	/**
	 * @package Models
	 * @var 	$prenom
	 * @var 	$nom
	 * @var 	$promo
	 */

	class Adherents extends Utilisateur 
	{

		private $prenom;
		private $nom;
		private $promo;

		/**
		 * constructeur d'Adherent 
		 * @author  Guemas Anthony
		 * @version 1.0.1
		 */
		public __construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif, $prenom, $nom, $promo)
		{
			parent($id, $tel, $mail, $adresse, $codePostal, $ville, $actif);
			$this->prenom 	= $prenom;
			$this->nom 		= $nom;
			$this->promo 	= $promo;
		}
	}
?>
