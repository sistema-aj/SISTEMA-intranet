<?php
	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'adherent' :
						$data->adherent = AdherentsDataLayer::getAdherent($_REQUEST['id']);
						$data->competences = Competences::getCompetencesParAdh($_REQUEST['id']);
						$data->projetsAdh = ProjetsDataLayer::getProjetParAdherent($_REQUEST['id']);
						$data->projets = ProjetsDataLayer::getProjetsNonAffecteParAdherent($_REQUEST['id']);
						ViewManager::displayViews(array('aAdhDetails'));
						break;
					case 'projet' :
						$data->projet = ProjetsDataLayer::getDetailProjet($_REQUEST['id']);
						$data->adherents = ProjetsDataLayer::getAdherentsParProjet($_REQUEST['id']);
						ViewManager::displayViews(array('aProDetails'));
					break;
				}
			}
			break;

	}
?>