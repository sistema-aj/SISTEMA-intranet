<?php

	class Config
	{
		private static $_nomSite		= "SISTEMA" ;
		private static $_bdName			= "sistema";
		private static $_bdUser			= "root";
		private static $_bdHote			= "127.0.0.1";
		private static $_bdPort			= "3306";
		private static $_bdPassword		= "";



		public function __get($var)
		{

			if(isset($this->$var))
				return $this->$var;
			else
				throw new Exception('Variable de configuration "' + $var +'" non définie');
		}


	}

?>