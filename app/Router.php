<?php
	class Router {
		private static $_data;

		public static function init(&$data) {
			self::$_data = &$data;
		}

		public static function load() {
			// redirect to appropriate controler
			$controler = ($_REQUEST["page"] == "") ? "home" : $_REQUEST["page"];			
			$data = self::$_data;

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