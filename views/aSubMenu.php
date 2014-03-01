<?php
switch ($_REQUEST["page"]) {
	case 'adherents': ?>
		<div id="adminSubMenu">
			<ul>
				<li><a href="adherents/liste">Liste complète</a></li>
				<li><a href="adherents/adhesions">Adhésions SISTEMA</a></li>
				<li><a href="adherents/adhesions-projets">Adhésions Projets</a></li>
			</ul>
		</div>
	<?php break;
	case 'clients': ?>
		<div id="adminSubMenu">
			<ul>
				<li><a href="clients">...</a></li>
				<li><a href="clients">...</a></li>
				<li><a href="clients">...</a></li>
			</ul>
		</div>
	<?php break;
	case 'projets': ?>
		<div id="adminSubMenu">
			<ul>
				<li><a href="projets">...</a></li>
				<li><a href="projets">...</a></li>
				<li><a href="projets">...</a></li>
			</ul>
		</div>
	<?php break; 
}
?>