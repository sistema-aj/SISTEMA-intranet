<?php
	function __autoload($classname) {
		$arr = array(MODELS,APP);
		foreach ($arr as $elt) {
			$filename = $elt.$classname.'.php';
			
			if(file_exists($filename)) {			
				include_once($filename);
				return;
			}
		}
	}
?>
