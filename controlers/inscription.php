<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::setActiveJs(array('form-controles'));
	
	$data->msg = "";
	$data->error = "";

	if(Administration::issetCandidatParams($_REQUEST)) {
		if(Administration::checkCandidatParams($_REQUEST)) {
			try {
				//Administration::creerCandidat($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['mail'], $_REQUEST['telephone'], $_REQUEST['adresse'], $_REQUEST['codePostal'], $_REQUEST['ville'], $_REQUEST['promo']);
			} catch (Exception $e) {
				$data->error = "Erreur survenue durant l'insertion en base de données";
			}
		} else {
			$data->error = "Veuillez saisir toutes les données.";
		}
	}

	ViewManager::displayHeaderLogin();
	ViewManager::displayViews(array('inscription'));
?>