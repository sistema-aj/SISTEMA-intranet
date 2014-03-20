<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::displayHeader();
	$data->succes ="";
	$data->error = "";
	switch ($_SESSION['user_type']) 
	{
		case 'A':
			if(isset($_REQUEST["action"])) 
			{
				switch ($_REQUEST["action"]) 
				{
					case 'valider-candidat':
						try
						{
							Administration::validationCandidat($_REQUEST['id'], $_REQUEST['mail']);
							$data->succes = "Enregistrement effectué";
							$data->candidats = Administration::getCandidats();
							ViewManager::displayViews(array("aMenu", "aAdhAdhesions"));
						}
						catch(Exception $e)
						{
							$data->error = "Une erreur est survenue, veuillez réessayer";
							ViewManager::displayViews(array("aMenu", "aAdhAdhesions"));
						}
						break;
					case 'refuser-candidat':
					
						// ACTUELLEMENT : suppression totale de la base.
						// A VOIR : si on continue de supprimer ou si on garde en mémoire.
						try
						{			
							$e = Administration::refusCandidat($_REQUEST['id'], $_REQUEST['mail']);
							$data->succes = "Enregistrement effectué";			
							$data->candidats = Administration::getCandidats();
							ViewManager::displayViews(array("aMenu", "aAdhAdhesions"));
						}
						catch(Exception $e)
						{
							$data->error = "Une erreur est survenue, veuillez réessayer";
							ViewManager::displayViews(array("aMenu", "aAdhAdhesions"));
						}
						break;
					case 'valider-candidatPro':
						try
						{	
							Administration::accepterCandidatureProjet($_REQUEST['id'], $_REQUEST['projet']);
							$data->succes = "Enregistrement effectué";
							ViewManager::displayViews(array("aMenu", "aAdhProjets"));							
						}
						catch(Exception $e)
						{
							$data->error = "Une erreur est survenue, veuillez réessayer";
							ViewManager::displayViews(array("aMenu", "aAdhProjets"));
						}
						break;
					case 'refuser-candidatPro':
						try
						{
							Administration::refuserCandidatureProjet($_REQUEST['id'], $_REQUEST['projet']);
							$data->succes = "Enregistrement effectué";
							ViewManager::displayViews(array("aMenu", "aAdhProjets"));
						}
						catch(Exception $e)
						{
							$data->error = "Une erreur est survenue, veuillez réessayer";
							ViewManager::displayViews(array("aMenu", "aAdhProjets"));
						}
						break;
				}
			}
			break;	
	}
	// header('Location: '.$_SERVER['HTTP_REFERER']);
	ViewManager::displayFooter();
?>