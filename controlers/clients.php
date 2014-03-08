<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'liste':
						// instanciation des variables à communiquer
						$data->clients = ClientsDataLayer::getClients();
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aCliListe"));
						break;
					case 'ajout':
						// instanciation des variables à communiquer
						$data->error = "";
						// vérification de la présence de toutes les variables nécessaires pour la création
						if(Administration::checkClientParams($_REQUEST)) {
							// création du client
							Administration::creerClient($_REQUEST['raisonSociale'], $_REQUEST['telephone'], $_REQUEST['mail'],
								$_REQUEST['adresse'], $_REQUEST['codePostal'], $_REQUEST['ville']);
						} else {
							// message d'erreur personnalisé
							$data->error = "Echec de la création : veuillez indiquer toutes les données.";
						}
						ViewManager::displayViews(array("aMenu", "aSubMenu", "aCliAjout"));
						break;
					default:
						ViewManager::displayViews(array("aMenu", "aSubMenu", "404"));
						break;
				}
			} else {
				$data->clients = ClientsDataLayer::getClients();
				ViewManager::displayViews(array("aMenu", "aSubMenu", "aCliListe"));
			}
			break;
		default:
			ViewManager::displayViews(array("404"));
			break;	
	}

	ViewManager::displayFooter();
?>