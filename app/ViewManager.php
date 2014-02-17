<?php

	class ViewManager {
		private static $_data;
		private static $_activeCss = array();
		private static $_activeJs = array();

		public static function init(&$data) {
			self::$_data = &$data;
		}

		/* 
		** GETTERS 
		*/
		public static function getActiveCss() { return self::$_activeCss; }
		public static function getActiveJs() { return self::$_activeJs; }

		/*
		** SETTERS 
		*/
		public static function setActiveCss($cssArray) {			
			if(is_array($cssArray)) {				
				foreach($cssArray as $elt)					
					self::$_activeCss[count(self::$_activeCss)] = $elt; 		
			}			
		}
		
		public static function emptyCss() { 
			self::$_activeCss = array(); 
		}
		
		public static function setActiveJs($jsArray) {			
			if(is_array($jsArray)) {				
				foreach($jsArray as $elt)					
					self::$_activeJs[count(self::$_activeJs)] = $elt; 		
			}			
		}

		/* 
		** DISPLAY METHODS 
		*/
		public static function displayHeader() {
			$data = self::$_data;
			// include start of skeleton			
			include_once VIEWS.'sk_top.php';
			include_once VIEWS.'header.php';
		}

		public static function displayFooter() {
			$data = self::$_data;
			// include end of skeleton
			include_once VIEWS.'footer.php';
			include_once VIEWS.'sk_bottom.php';
		}

		public static function displayViews($viewsArray) {
			$data = self::$_data;
			if(is_array($viewsArray)) {
				foreach($viewsArray as $elt)
					include_once VIEWS.$elt.'.php';
			}
		}

		public static function displayCssLinks() {
			$activeCss = self::getActiveCss();
			foreach($activeCss as $elt)
				echo '<link rel="stylesheet" type="text/css" href="assets/css/'.$elt.'.css">
		';
		}

		public static function displayJsLinks() {
			$activeJs = self::getActiveJs();
			foreach ($activeJs as $elt) {
				echo '<script src="assets/js/'.$elt.'.js"></script>';
			}
		}
	}
?>