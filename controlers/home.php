<?php
	ViewManager::setActiveCss(array('general'));

	ViewManager::displayHeader();

	switch ($_SESSION['user_type']) {
		case 'A':
			ViewManager::displayViews(array());
			break;
		case 'C':
			ViewManager::displayViews(array());
			break;
		case 'E':
			ViewManager::displayViews(array());
			break;	
	}

	ViewManager::displayFooter();
?>
