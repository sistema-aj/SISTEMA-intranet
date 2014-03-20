<?php

	/**
	 * @author  Deleuil Maxime
	 * @package Models
	 * @var 	$prenom
	 * @var 	$nom
	 * @var 	$promo
	 * @version 1.1.0
	 */

	class Adherents extends Utilisateur 
	{

		private $prenom;
		private $nom;
		private $promo;

		/**
		 * constructeur d'Adherent 
		 * @author  Guemas Anthony
		 * @param   $id 
		 * @param   $tel
		 * @param   $mail
		 * @param   $adresse
		 * @param   $codePostal
		 * @param   $ville
		 * @param   $actif
		 * @param   $prenom
		 * @param   $nom
		 * @param   $promo
		 * @version 1.0.1
		 */
		public function __construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif, $prenom, $nom, $promo)
		{
			parent::__construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif);
			$this->prenom 	= $prenom;
			$this->nom 		= $nom;
			$this->promo 	= $promo;
		}

		/**
		 * setter general de la classe 
		 * 
		 * @author Deleuil Maxime
		 * @param  $index 
		 * @param  $value
		 */ 
		public function __set($index, $value)
		{
			$this->$index = $value;
		}
		
		/**
		 * getter de la classe 
		 * 
		 * @author Deleuil Maxime
		 * @param  $index
		 * @return variable demandée
		 */ 
		public function __get($index)
		{
			return $this->$index;
		}
	}
?>
