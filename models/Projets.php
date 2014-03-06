<?php

	/**
	 * @package Models
	 */
	class Projets 
	{

		private $titre;
		private $description;
		private $type;
		private $archive;
		private $idClient;

		private function __construct($titre, $description, $type, $archive) 
		{
			$this->titre 		= $titre;
			$this->description 	= $description;
			$this->type 		= $type;
			$this->archive 		= $archive;
		};


		
	}
?>



