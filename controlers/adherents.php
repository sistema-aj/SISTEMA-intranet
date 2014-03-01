<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'liste':
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhListe"));
						break;
					case 'adhesions':
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhAdhesions"));
						break;
					case 'adhesions-projets':
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhProjets"));
						break;
					default:
						ViewManager::displayViews(array("aMenu", "aSubMenu", "404"));
						break;
				}
			} else
				ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhListe"));
			break;
		default:
			ViewManager::displayViews(array("404"));
			break;	
	}

	ViewManager::displayFooter();
?>