<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::setActiveJs(array('display-fiche'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'liste':
						$data->adherents = AdherentsDataLayer::getAdherents();
						ViewManager::displayViews(array("aMenu", "aAdhListe"));
						break;
					case 'adhesions':
						$data->candidats = Administration::getCandidats();
						ViewManager::displayViews(array("aMenu", "aAdhAdhesions"));
						break;
					case 'adhesions-projets':
						$data->adhesions = ProjetsDataLayer::getAdhesions();
						ViewManager::displayViews(array("aMenu", "aAdhProjets"));
						break;
					case 'affecter-projet':
						Administration::affecterAuProjet($_REQUEST['user'], $_REQUEST['projet']);
						$data->adherents = AdherentsDataLayer::getAdherents();
						ViewManager::displayViews(array("aMenu", "aAdhListe"));
						break;
					default:
						ViewManager::displayViews(array("aMenu", "404"));
						break;
				}
			} else {
				$data->adherents = AdherentsDataLayer::getAdherents();
				ViewManager::displayViews(array("aMenu", "aAdhListe"));
			}
			break;
		default:
			ViewManager::displayViews(array("404"));
			break;	
	}

	ViewManager::displayFooter();
?>