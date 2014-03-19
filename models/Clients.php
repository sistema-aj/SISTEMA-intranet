<?php

	/**
	 * @package Models
	 * @var 	$raisonSociale
	 * @version 1.0.0
	 */
	class Clients extends Utilisateur
	{
		private $raisonSociale

		/**
		 * constructeur de Client 
		 * @author  Deleuil Maxime
		 * @param   $id 
		 * @param   $tel
		 * @param   $mail
		 * @param   $adresse
		 * @param   $codePostal
		 * @param   $ville
		 * @param   $actif
		 * @param   $raisonSociale
		 * @version 1.0.0
		 */
		public __construct($id, $tel, $mail, $adresse, $codePostal, $ville, $actif, $raisonSociale) 
		{
			parent($id, $tel, $mail, $adresse, $codePostal, $ville, $actif);
			$this->raisonSociale = $raisonSociale;
		}
	}
?>