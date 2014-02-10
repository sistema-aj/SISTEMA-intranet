<?php

	class View {
		/* DISPLAY METHODS */
			public static function displayHeader() {
				// include start of skeleton			
				include_once VIEWS.'sk_top.php';
				include_once VIEWS.'header.php';
			}

			public static function displayFooter() {
				// include end of skeleton
				include_once VIEWS.'footer.php';
				include_once VIEWS.'sk_bottom.php';
			}

			public static function displayViews($viewsArray) {
				if(is_array($viewsArray)) {
					foreach($viewsArray as $elt)
						include_once VIEWS.$elt.'.php';
				}
			}

			public static function displayCssLinks() {
				$activeCss = Core::getActiveCss();
				foreach($activeCss as $elt)
					echo '<link rel="stylesheet" type="text/css" href="assets/css/'.$elt.'.css">
			';
			}
	}
?>