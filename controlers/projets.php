<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::setActiveJs(array('display-fiche'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
				if(isset($_REQUEST["action"])) 
				{
					switch ($_REQUEST["action"]) 
					{
						case 'ajout' : 
						$data->clients = ClientsDataLayer::getClients();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aProAjout"));
						break;

						case 'ajout-action' : 
						if(Projets::issetProjetsParams($_REQUEST)) 
						{
							if(Projets::checkProjetsParams($_REQUEST)) 
							{
								try 
								{
									ProjetsDataLayer::creerProjet($_REQUEST['titre'], $_REQUEST['description'], $_REQUEST['type'], $_REQUEST['client']);
									echo 'ajout effectué';
									$data->titre   = 'Projets en cours';
									$data->projets = ProjetsDataLayer::getProjetsNonArchives();
									//ViewManager::displayViews(array("aMenu", "aSubMenu", "aProListe"));
								} catch (Exception $e) 
								{
										$data->error = "Erreur survenue durant l'insertion en base de données";
										echo 'Erreur 1';
								}
							} 
							else 
							{
								$data->error = "Veuillez saisir toutes les données.";
								echo 'erreur 2';
							}
						}
						break;

						case 'liste' : 
						$data->projets = ProjetsDataLayer::getProjetsNonArchives();
						$data->titre   = 'Projets en cours';
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aProListe"));
						break;

						case 'actifs-termines' : 
						$data->projets = ProjetsDataLayer::getProjetsActifsTermines('titre');
						$data->titre   = 'Projets Actifs ou Terminés ';
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aProListe"));
						break;

						case 'non-affectes' : 
						$data->projets = ProjetsDataLayer::getProjetsNonAffectes('titre');
						$data->titre   = 'Projets Non Affectes ';
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aProListe"));
						break;

						default:
						ViewManager::displayViews(array("aMenu", "aSubMenu", "404"));
						break;
					}
				}
				else   // si pas d'actions demandées 
				{
					$data->projets = ProjetsDataLayer::getProjetsNonAffectes('titre');
					$data->titre   = 'Projets Non Affectes ';
					ViewManager::displayViews(array("aMenu", "aSubMenu", "aProListe"));
				}
			break;

		case 'E' :
			if(isset($_REQUEST["action"])) 
				{
					switch ($_REQUEST["action"]) 
					{
						
						case 'listeNonAffectes' : 
						$data->projets = ProjetsDataLayer::getProjetsNonAffectes();
						$data->titre   = 'Projets disponibles';
						ViewManager::displayViews(array("aMenu", "aSubMenu", "eProListe"));
						break;

						default : ;
						break;

					}
				}
				else   // pseudo 'dashboard'
				{

				}
			break;

		break;

		case 'C' : 
			if(isset($_REQUEST["action"])) 
				{
					switch ($_REQUEST["action"]) 
					{
						
						case 'liste' : 
						$data->projets = ProjetsDataLayer::getProjetsParClient();
						$data->titre   = 'Vos Projets';
						ViewManager::displayViews(array("aMenu", "aSubMenu", "cProListe"));
						break;

						default : ;
						break;

					}
				}
				else   // pseudo 'dashboard'
				{
					$data->projets = ProjetsDataLayer::getProjetsParClient();
					$data->titre   = 'Vos Projets';
					ViewManager::displayViews(array("aMenu", "aSubMenu", "cProListe"));
				}
			break;

		break;

		default:
			# code...
			break;	
	}

	ViewManager::displayFooter();
?>