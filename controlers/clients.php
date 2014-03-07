<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'liste':
						$data->clients = ClientsDataLayer::getClients();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aCliListe"));
						break;
					case 'ajout':
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aCliAjout"));
						break;
					default:
						ViewManager::displayViews(array("aMenu", "aSubMenu", "404"));
						break;
				}
			} else {
				$data->clients = ClientsDataLayer::getClients();
				ViewManager::displayViews(array("aMenu", "aSubMenu", "aCliListe"));
			}
			break;
		default:
			ViewManager::displayViews(array("404"));
			break;	
	}

	ViewManager::displayFooter();
?>