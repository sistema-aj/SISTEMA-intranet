
<div id="adminMenu">
	<nav class="navbar navbar-inverse" style="border-radius:0;">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	        </div>
	        
	        <!-- Collection of nav links and other content for toggling -->
	        <div id="navbarCollapse" class="collapse navbar-collapse">
	            <ul class="nav navbar-nav">    
					<li class="active"><a href="<?php echo URL_ROOT; ?>home"><img src="assest/img/homeIcon.png" width="20px"/>  Accueil</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo URL_ROOT; ?>adherents">Gestion adhérents <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo URL_ROOT; ?>adherents/liste">Liste complète</a></li>
								<li><a href="<?php echo URL_ROOT; ?>adherents/adhesions">Adhésions SISTEMA</a></li>
								<li><a href="<?php echo URL_ROOT; ?>adherents/adhesions-projets">Affectation projets</a></li>
							</ul>
					</li>						
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo URL_ROOT; ?>clients">Gestion clients <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo URL_ROOT; ?>clients/liste">Liste complète</a></li>
								<li><a href="<?php echo URL_ROOT; ?>clients/ajout">Ajout d'un client</a></li>
							</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo URL_ROOT; ?>projets">Gestion projets <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo URL_ROOT; ?>projets/liste">Liste complète</a></li>
								<li><a href="<?php echo URL_ROOT; ?>projets/actifs-termines">Projets Actifs / Terminés</a></li>
								<li><a href="<?php echo URL_ROOT; ?>projets/non-affectes">Projets non-affectes</a></li>
								<li><a href="<?php echo URL_ROOT; ?>projets/ajout">Ajout d'un projet</a></li>
							</ul>
					</li> 
	            </ul>
	            <ul class="nav navbar-nav navbar-right">
	                <li><a href="<?php echo URL_ROOT; ?>/deconnexion"><img src="assest/img/logoutIcon.png" width="20px"/> Déconnexion</a></li>
	            </ul>
			</div>
	</nav>
</div>
<div class="container">