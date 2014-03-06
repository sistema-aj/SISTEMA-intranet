<?php

	/**
	 * @package Models
	 */
	class Projets 
	{
		private $titre;
		private $description;
		private $type;
		private $status;
		
		function __construct($titre, $description, $type, $status)
		{
			$this->titre = $titre;
			$this->description = $description;
			$this->type = $type;
			$this->status = $status;
		}

	}
?>
