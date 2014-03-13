<?php
	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'adherent' :
						$data->adherent = AdherentsDataLayer::getAdherent($_REQUEST['user']);
						$data->competences = Competences::getCompetencesParAdh($_REQUEST['user']);
						$data->projetsAdh = ProjetsDataLayer::getProjetParAdherent($_REQUEST['user']);
						$data->projets = ProjetsDataLayer::getProjetsNonAffecteParAdherent($_REQUEST['user']);
						ViewManager::displayViews(array('aAdhDetails'));
						break;
				}
			}
			break;	
	}
?>