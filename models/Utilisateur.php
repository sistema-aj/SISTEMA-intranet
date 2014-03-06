<?php

	/**
	 * @package Models
	 * @var     $id
	 * @var 	$tel
	 * @var     $mail
	 * @var     $adresse
	 * @var     $actif
	 */
	class Utilisateur	
	{
		protected $id;
		protected $tel;
		protected $mail;
		protected $adresse;
		protected $actif;

		/**
		 * Constructeur d'Utilisateur
		 * 
		 * @author 	 Guemas Anthony
		 * @version  1
		 */
		public __construct($id, $tel, $mail, $adresse, $actif)
		{
			$this->id 		= $id;
			$this->tel		= $tel;
			$this->mail 	= $mail;
			$this->adresse  = $adresse;
			$this->actif 	= $actif;
		}
	}
?>