<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			ViewManager::displayViews(array());
			break;
		default:
			# code...
			break;	
	}

	ViewManager::displayFooter();
?>