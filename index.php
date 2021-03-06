<?php
	define('URL_ROOT', str_replace('index.php', '', "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));
	define('DIR_ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	// GENERIC REPOSITORIES
	define('CTR', DIR_ROOT.'controlers/');
	define('VIEWS', DIR_ROOT.'views/');	
	define('MODELS',DIR_ROOT.'models/');
	define('APP',DIR_ROOT.'app/');
	define('ASSETS', DIR_ROOT.'assets/');

	session_start();
	include_once APP."Core.php";
	$data = new Registry;
	
	ViewManager::init($data);
	Router::init($data);
	Core::init($data);
?>
