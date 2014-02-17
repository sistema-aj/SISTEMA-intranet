<?php
	class Core {
	// CLASS ATTRIBUTES
		private static $_data;
		private static $_appname = 'Intranet SISTEMA';

	/* GETTERS */
		public static function getAppName() { return self::$_appname;}

	/* MAIN STATIC METHODS */
		public static function init(&$data) {
			self::$_data = &$data;
			ViewManager::emptyCss();
			bdd::init();
			
			Router::load();
		}
	}

	include_once 'Autoload.php';
?>
