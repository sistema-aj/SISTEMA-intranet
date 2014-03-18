<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::setActiveJs(array('form-controles'));
	
	$data->succes = "";
	$data->error = "";

	if(Administration::issetCandidatParams($_REQUEST)) 
	{
		if(Administration::checkCandidatParams($_REQUEST)) 
		{
			try 
			{
				Administration::creerCandidat($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['mail'], $_REQUEST['telephone'], $_REQUEST['adresse'], $_REQUEST['codePostal'], $_REQUEST['ville'], $_REQUEST['promo']);
			} 
			catch (Exception $e) 
			{
				$data->error = "Une erreur est survenue, veuillez réessayer";
			}
		} else 
		{
			$data->error = "Veuillez saisir toutes les données.";
		}
	}

	ViewManager::displayHeader();
	ViewManager::displayViews(array('inscription'));
	ViewManager::displayFooter();
?>