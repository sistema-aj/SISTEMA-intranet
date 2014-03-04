<?php
switch ($_REQUEST["page"]) {
	case 'adherents': ?>
		<div id="adminSubMenu">
			<ul>
				<li><a href="<?php echo URL_ROOT; ?>adherents/liste">Liste complète</a></li>
				<li><a href="<?php echo URL_ROOT; ?>adherents/adhesions">Adhésions SISTEMA</a></li>
				<li><a href="<?php echo URL_ROOT; ?>adherents/adhesions-projets">Adhésions Projets</a></li>
			</ul>
		</div>
	<?php break;
	case 'clients': ?>
		<div id="adminSubMenu">
			<ul>
				<li><a href="<?php echo URL_ROOT; ?>clients/liste">Liste complète</a></li>
				<li><a href="<?php echo URL_ROOT; ?>clients/ajout">Ajout d'un client</a></li>
			</ul>
		</div>
	<?php break;
	case 'projets': ?>
		<div id="adminSubMenu">
			<ul>
				<li><a href="<?php echo URL_ROOT; ?>projets/liste">Liste complète</a></li>
				<li><a href="<?php echo URL_ROOT; ?>projets/actifs-termines">Projets Actifs / Terminés</a></li>
				<li><a href="<?php echo URL_ROOT; ?>projets/ajout">Ajout d'un projet</a></li>
			</ul>
		</div>
	<?php break; 
}
?>