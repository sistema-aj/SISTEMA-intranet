<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();
	Adherents::getDetailAdherent(8);
	exit;

	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'liste':
						$data->activeUser = bdd::getActiveAdh();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhListe"));
						break;
					case 'adhesions':
						$data->inactiveUser = bdd::getInactiveAdh();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhAdhesions"));
						break;
					case 'adhesions-projets':
						$data->adhesionsPro = bdd::getAdhesionsPro();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhProjets"));
						break;
					default:
						ViewManager::displayViews(array("aMenu", "aSubMenu", "404"));
						break;
				}
			} else {
				$data->activeUser = bdd::getActiveAdh();
				ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhListe"));
			}
			break;
		default:
			ViewManager::displayViews(array("404"));
			break;	
	}

	ViewManager::displayFooter();
?>