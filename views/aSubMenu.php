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
				<li><a href="clients/liste">Liste complète</a></li>
				<li><a href="clients/ajout">Ajout d'un client</a></li>
			</ul>
		</div>
	<?php break;
	case 'projets': ?>
		<div id="adminSubMenu">
			<ul>
				<li><a href="projets/liste">Liste complète</a></li>
				<li><a href="projets/actifs-termines">Projets Actifs / Terminés</a></li>
				<li><a href="projets/ajout">Ajout d'un projet</a></li>
			</ul>
		</div>
	<?php break; 
}
?>