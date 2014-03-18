<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::displayHeader();
	$data->error = "";
	$data->succes = "";
	switch ($_SESSION['user_type']) 
	{
		case 'A':
			if(isset($_REQUEST["action"])) 
			{
				
				switch ($_REQUEST["action"]) 
				{
					
					case 'liste':
						// instanciation des variables à communiquer
						$data->clients = ClientsDataLayer::getClients();
						ViewManager::displayViews(array("aMenu", "aCliListe"));
						break;
					case 'ajout':
							ViewManager::displayViews(array("aMenu","aCliAjout"));						
						break;
					case 'ajoutClient':
						// vérification de la présence de toutes les variables nécessaires pour la création
						try
						{
							// création du client
							Administration::creerClient($_REQUEST['raisonSociale'], $_REQUEST['telephone'], $_REQUEST['mail'],
							$_REQUEST['adresse'], $_REQUEST['codePostal'], $_REQUEST['ville']);
							$data->succes = "Enregistrement effectué";
							$data->clients = ClientsDataLayer::getClients();
							ViewManager::displayViews(array("aMenu","aCliListe"));
						}
						catch(Exception $e) 
						{
							// message d'erreur personnalisé
							$data->error = $e->getMessage();
							ViewManager::displayViews(array("aMenu", "aSubMenu", "aCliAjout"));
						}										
						break;				
					default:
						ViewManager::displayViews(array("aMenu", "404"));
						break;
				}
			} 
			else 
			{
				$data->clients = ClientsDataLayer::getClients();
				ViewManager::displayViews(array("aMenu", "aCliListe"));
			}
			break;
		default:
			ViewManager::displayViews(array("404"));
			break;	
	}
	ViewManager::displayFooter();
?>