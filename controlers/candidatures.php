<?php
	switch ($_SESSION['user_type']) {
		case 'A':
			if(isset($_REQUEST["action"])) {
				switch ($_REQUEST["action"]) {
					case 'valider-candidat':
						Administration::validationCandidat($_REQUEST['id'], $_REQUEST['mail']);
						break;
					case 'refuser-candidat':
						// ACTUELLEMENT : suppression totale de la base.
						// A VOIR : si on continue de supprimer ou si on garde en mémoire.
						Administration::refusCandidat($_REQUEST['id'], $_REQUEST['mail']);
						break;
					case 'valider-candidatPro':
						Administration::accepterCandidatureProjet($_REQUEST['id'], $_REQUEST['projet']);
						break;
					case 'refuser-candidatPro':
						Administration::refuserCandidatureProjet($_REQUEST['id'], $_REQUEST['projet']);
						break;
				}
			}
			break;	
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
?>