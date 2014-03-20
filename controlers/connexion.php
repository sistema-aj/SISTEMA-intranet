<?php
	ViewManager::setActiveCss(array('general'));

	// initiate all data (IMPORTANT)
	$data->error = "";

	if(isset($_REQUEST['login']) && isset($_REQUEST['pwd'])) {
		if($_REQUEST['login'] != "" && $_REQUEST['pwd'] != "") {
			$user = bdd::getLogin($_REQUEST['login'], $_REQUEST['pwd']);
			if(!empty($user)) {
				// on enregistre ses données en variable SESSION
				$_SESSION['user_id'] = $user->user;
				$_SESSION['user_type'] = $user->type;
				// redirection vers l'accueil
				header('Location: home');
			} else { // affiche message erreur : données incorrectes
				$data->error = "Le login ou mot de passe est incorrect";
			}
		} else { // affiche message erreur : manque données
			$data->error = "Veuillez saisir tous les champs";
		}
	}
	
	ViewManager::displayHeaderLogin();
	ViewManager::displayViews(array('connexion'));
?>