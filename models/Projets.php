<?php

	/**
	 * @author Guemas Anthony
	 * @package Models
	 * @param String $titre
	 * @param String $description
	 * @param String $type
	 * @param String $status
	 * @param String $client
	 * @version 1.2.0
	 */
	class Projets 
	{
		private $titre;
		private $description;
		private $type;
		private $status;
		private $client;
		
		function __construct($titre, $description, $type, $status, $client)
		{
			$this->titre = $titre;
			$this->description = $description;
			$this->type = $type;
			$this->status = $status;
			$this->client = $client;
		}

		
		/**
		 * verifie que les variables necessaires à la creation d'un projet soient presentes 
		 * @author  Guemas Anthony
		 * @param   Array $data 
		 * @return  boolean
		 * @version 1.1.0
		 */
		public static function issetProjetsParams($data)
		{
			return isset($data['titre']) && isset($data['description']) && isset($data['client']);
		}


		/**
		 * verifie que les variables necessaires à la creation d'un projet soient du bon type
		 * @author  Guemas Antony
		 * @param   Array $data 
		 * @return  boolean
		 * @version 1.1.0
		 */
		public static function checkProjetsParams($data)
		{
			// teste si les variables ne sont pas nulles
			if( isset($data['titre']) != "" &&
				isset($data['description']) != "" &&
				isset($data['client']) != ""
			   )
			{
				// tests d'integrité 
				return true;
			}
			else 
			{
				return false;
			}
		}
	}
?>
