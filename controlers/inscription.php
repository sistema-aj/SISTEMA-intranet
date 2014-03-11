<?php
	ViewManager::setActiveCss(array('general'));
	
	$data->msg = "";
	$data->error = "";

	if(Administration::issetCandidatParams($_REQUEST)) {
		var_dump($_REQUEST);
		echo "=========================";
		if(Administration::checkCandidatParams($_REQUEST)) {
			var_dump($_REQUEST);
			try {
				//Administration::creerCandidat($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['mail'], $_REQUEST['telephone'], $_REQUEST['adresse'], $_REQUEST['codePostal'], $_REQUEST['ville'], $_REQUEST['promo']);
			} catch (Exception $e) {
				
			}
		} else {
			$data->error = "Veuillez saisir toutes les données.";
		}
	}


	ViewManager::displayHeader();
	ViewManager::displayViews(array('inscription'));
	ViewManager::displayFooter();
?>