<?php
	ViewManager::setActiveCss(array('general'));

	// initiate all data (IMPORTANT)
	$data->error = "";

	if(isset($_REQUEST['login']) && isset($_REQUEST['pwd'])) {
		if($_REQUEST['login'] != "" && $_REQUEST['pwd'] != "") {
			// traitement de la connexion
		} else { // affiche page connexion
			$data->error = "Veuillez saisir tous les champs";
		}
	}
	
	ViewManager::displayHeader();
	ViewManager::displayViews(array('connexion'));
	ViewManager::displayFooter();
?>