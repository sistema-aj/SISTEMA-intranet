<?php
	Core::setActiveCss(array('general'));

	// ici -> ajout script utilisateur

	View::displayHeader();
	View::displayViews(array('home'));
	View::displayFooter();
?>
