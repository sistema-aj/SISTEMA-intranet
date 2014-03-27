<?php
	ViewManager::setActiveCss(array('general'));
	ViewManager::setActiveJs(array('display-fiche'));
	ViewManager::displayHeader();
	$data->succes ="";
	$data->error ="";
	switch ($_SESSION['user_type']) 
	{
		case 'A':
				if(isset($_REQUEST["action"])) 
				{
					switch ($_REQUEST["action"]) 
					{
						case 'ajout' : 
						$data->clients = ClientsDataLayer::getClients();
						ViewManager::displayViews(array("aMenu","aProAjout"));
						break;

						case 'ajout-action' : 						
								try 
								{
									ProjetsDataLayer::creerProjet($_REQUEST['titre'], $_REQUEST['description'], $_REQUEST['type'], $_REQUEST['client']);
									$data->succes = "Enregistrement effectué";
									$data->titre   = 'Projets en cours';
									$data->projets = ProjetsDataLayer::getProjetsNonArchives();
									ViewManager::displayViews(array("aMenu","aProListe"));
								} 
								catch (Exception $e) 
								{
										$data->error = "Une erreur est survenue, veuillez réessayer";
										ViewManager::displayViews(array("aMenu","aProAjout"));									
								}									
						break;

						case 'liste' : 
						$data->projets = ProjetsDataLayer::getProjetsNonArchives();
						$data->titre   = 'Projets en cours';
						ViewManager::displayViews(array("aMenu", "aProListe"));
						break;

						case 'actifs-termines' : 
						$data->projets = ProjetsDataLayer::getProjetsActifsTermines('titre');
						$data->titre   = 'Projets Actifs ou Terminés ';
						ViewManager::displayViews(array("aMenu", "aProListe"));
						break;

						case 'non-affectes' : 
						$data->projets = ProjetsDataLayer::getProjetsNonAffectes('titre');

						$data->titre   = 'Projets Non Affectes ';						
						ViewManager::displayViews(array("aMenu", "aProListe"));
						break;

						case 'changementCdP' :
						$data->adherent = $_REQUEST['chefProjet'];
						$data->projet   = $_REQUEST['id']
						$data->oldCdP	= ProjetsDataLayer::getChefProjet($data->projet);
						
						// suppression de l'adherent en tant que participant générique
						Administration::detacherDuProjet($data->adherent, $data->projet);

						// insertion en tant que chef de projet
						Administration::nommerChefProjet($data->adherent, $data->projet);

						if(isset($data->oldCdP))
						{
							// suppression du chef de projet actuel le cas echeant
							Administration::detacherDuProjet($data->oldCdP, $data->projet);

							// insertion en tant que participant générique
							Administration::affecterAuProjet($data->oldCdP, $data->projet);
						}
						break;

						default:
						ViewManager::displayViews(array("aMenu", "404"));
						break;
					}
				}
				else   // si pas d'actions demandées 
				{
					$data->projets = ProjetsDataLayer::getProjetsNonAffectes('titre');
					$data->titre   = 'Projets Non Affectes ';
					ViewManager::displayViews(array("aMenu", "aProListe"));
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
						ViewManager::displayViews(array("aMenu", "eProListe"));
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
						ViewManager::displayViews(array("aMenu", "cProListe"));
						break;

						default : ;
						break;

					}
				}
				else   // pseudo 'dashboard'
				{
					$data->projets = ProjetsDataLayer::getProjetsParClient();
					$data->titre   = 'Vos Projets';
					ViewManager::displayViews(array("aMenu", "cProListe"));
				}
			break;

		break;

		default:
			# code...
			break;	
	}
	ViewManager::displayFooter();
?>