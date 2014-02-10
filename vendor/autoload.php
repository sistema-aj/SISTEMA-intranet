<?php
	function __autoload($classname) {
		$arr = array(MODELS,VENDOR);
		foreach ($arr as $elt) {
			$filename = $elt.$classname.'.php';
			
			if(file_exists($filename)) {			
				include_once($filename);
				return;
			}
		}
	}
?>
