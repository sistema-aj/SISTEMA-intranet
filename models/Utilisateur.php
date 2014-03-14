<?php

	/**
	 * @package Models
	 * @var     $id
	 * @var 	$tel
	 * @var     $mail
	 * @var     $adresse
	 * @var 	$codePostal
	 * @var 	$ville
	 * @var     $actif
	 */
	class Utilisateur	
	{
		protected $id;
		protected $tel;
		protected $mail;
		protected $adresse;
		protected $codePostal;
		protected $ville;
		protected $actif;

		/**
		 * Constructeur d'Utilisateur
		 * 
		 * @author 	 Guemas Anthony
		 * @version  1.1.0
		 */
		public function __construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif)
		{
			$this->id 		= $id;
			$this->tel		= $tel;
			$this->mail 	= $mail;
			$this->adresse  = $adresse;
			$this->codePostal = $codePostal;
			$this->ville 	= $ville;
			$this->actif 	= $actif;
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