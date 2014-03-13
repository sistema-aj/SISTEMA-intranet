<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::setActiveJs(array('display-fiche'));
	
	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			$data->candidats = Administration::getCandidats();
			$data->adhesionsPro = ProjetsDataLayer::getAdhesions();
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
