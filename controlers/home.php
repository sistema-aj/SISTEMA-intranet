<?php
	ViewManager::setActiveCss(array('general'));

	// ici -> ajout script utilisateur

	ViewManager::displayHeader();
	ViewManager::displayViews(array('home'));
	ViewManager::displayFooter();
?>
