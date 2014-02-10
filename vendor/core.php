<?php
	define('DIR_ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	// GENERIC REPOSITORIES
	define('CTR', DIR_ROOT.'controlers/');
	define('VIEWS', DIR_ROOT.'views/');	
	define('MODELS',DIR_ROOT.'models/');
	define('VENDOR',DIR_ROOT.'vendor/');

	class Core {
	// CLASS ATTRIBUTES
		private static $_appname = 'Intranet SISTEMA';
		private static $_activeCss = array();

	/* GETTERS */
		public static function getAppName() { return self::$_appname;}
		public static function getActiveCss() { return self::$_activeCss; }

	/* SETTERS */
		public static function setActiveCss($cssArray) {			
			if(is_array($cssArray)) {				
				foreach($cssArray as $elt)					
					self::$_activeCss[count(self::$_activeCss)] = $elt; 		
			}			
		}

	/* MAIN STATIC METHODS */
		public static function init() {
			self::emptyCss();
			bdd::init();
			
			// redirect to appropriate controler
			$controler = ($_REQUEST["page"] == "") ? "home" : $_REQUEST["page"];			
			if(file_exists(CTR.$controler.'.php'))
				include_once CTR.$controler.'.php';
			else {
				Core::setActiveCss(array('general'));
				View::displayHeader();
				View::displayViews(array('404'));
				View::displayFooter();
			}
		}
		
	/* VIEW METHOD */
		public static function emptyCss() { 
			self::$_activeCss = array(); 
		}
	}

	include_once 'autoload.php';
?>
