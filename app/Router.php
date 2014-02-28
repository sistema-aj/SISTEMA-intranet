<?php
	class Router {
		private static $_data;

		public static function init(&$data) {
			self::$_data = &$data;
		}

		public static function load() {
			$data = self::$_data;
			// redirect to appropriate controler
			if(isset($_SESSION['user_id']))
				$controler = ($_REQUEST["page"] == "") ? "home" : $_REQUEST["page"];			
			else
				$controler = "connexion";
			
			if(file_exists(CTR.$controler.'.php'))
				include_once CTR.$controler.'.php';
			else {
				ViewManager::setActiveCss(array('general'));
				ViewManager::displayHeader();
				ViewManager::displayViews(array('404'));
				ViewManager::displayFooter();
			}
		}
	}
?>