<?php

	/**
	 * @author  Deleuil Maxime
	 * @package app
	 * @param   Array  $_data     Liste de variables à passer d'un controler à une vue
	 * @param   String $_appName  Nom du site
	 * @version 1.5.0 
	 */
	class Core {
	// CLASS ATTRIBUTES
		private static $_data;
		private static $_appname = 'Intranet SISTEMA';

	/**
	 * Getter 
	 * @return String 
	 */
		public static function getAppName() { return self::$_appname;}

	/**
	 * Initialise la solution, et les composants clés du MVC
	 * @param  Array &$data 
	 */
		public static function init(&$data) {
			self::$_data = &$data;
			ViewManager::emptyCss();
			bdd::init();
			
			Router::load();
		}
	}

	include_once 'Autoload.php';
?>
