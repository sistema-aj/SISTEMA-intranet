<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'liste':
						$data->adherents = AdherentsDataLayer::getAdherents();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhListe"));
						break;
					case 'adhesions':
						$data->candidats = Administration::getCandidats();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhAdhesions"));
						break;
					case 'valider-candidat':
						$data->candidats = Administration::getCandidats();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhAdhesions"));
						break;
					case 'refuser-candidat':
						$data->candidats = Administration::getCandidats();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhAdhesions"));
						break;
					case 'adhesions-projets':
						$data->adhesions = ProjetsDataLayer::getAdhesions();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhProjets"));
						break;
					case 'valider-candidatPro':
						$data->adhesions = ProjetsDataLayer::getAdhesions();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhProjets"));
						break;
					case 'refuser-candidatPro':
						$data->adhesions = ProjetsDataLayer::getAdhesions();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhProjets"));
						break;
					default:
						ViewManager::displayViews(array("aMenu", "aSubMenu", "404"));
						break;
				}
			} else {
				$data->adherents = AdherentsDataLayer::getAdherents();
				ViewManager::displayViews(array("aMenu", "aSubMenu", "aAdhListe"));
			}
			break;
		default:
			ViewManager::displayViews(array("404"));
			break;	
	}

	ViewManager::displayFooter();
?>