<?php

	/**
	 * @author  Guemas Anthony
	 * @package Models
	 * @var     $id
	 * @var 	$tel
	 * @var     $mail
	 * @var     $adresse
	 * @var 	$codePostal
	 * @var 	$ville
	 * @var     $actif
	 * @version 1.0.0
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

		/**
		 * Setter de la classe
		 * @author  Guemas Antony
		 * @param   String $index variable à laquellle on veut acceder
		 * @param   type $value 
		 * @version 1.0.0
		 */
		public function __set($index, $value)
		{
			$this->$index = $value;
		}
		
		/**
		 * Getter de la classe 
		 * @author  Guemas Antony
		 * @param   String $index variable à laquellle on veut acceder
		 * @return  type
		 * @version 1.0.0
		 */
		public function __get($index)
		{
			return $this->$index;
		}
	}
?>