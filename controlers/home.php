<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			$data->inactiveUser = bdd::getInactiveAdh();
			$data->adhesionsPro = bdd::getAdhesionsPro();
			ViewManager::displayViews(array("aMenu", "aSubMenu", "aHome"));
			break;
		case 'C':
			ViewManager::displayViews(array());
			break;
		case 'E':
			ViewManager::displayViews(array());
			break;	
	}

	ViewManager::displayFooter();
?>
