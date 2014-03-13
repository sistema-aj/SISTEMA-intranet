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
		public function __construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif, $prenom, $nom, $promo)
		{
			parent::__construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif);
			$this->prenom 	= $prenom;
			$this->nom 		= $nom;
			$this->promo 	= $promo;
		}

		public function __set($index, $value)
		{
			$this->$index = $value;
		}
		
		public function __get($index)
		{
			return $this->$index;
		}
	}
?>
