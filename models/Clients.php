<?php

	/**
	 * @package Models
	 * @var 	$raisonSociale
	 */
	class Clients extends Utilisateur
	{
		private $raisonSociale

		/**
		 * constructeur de Client 
		 * @author  Deleuil Maxime
		 * @version 1.0.0
		 */
		public __construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif, $raisonSociale) 
		{
			parent($id, $tel, $mail, $adresse, $codePostal, $ville, $actif);
			$this->raisonSociale = $raisonSociale;
		}
	}
?>