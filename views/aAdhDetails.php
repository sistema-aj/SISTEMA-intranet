<div id="adh-details">
	<div id="identite">
		<p><strong><?php echo $data->adherent->nom; ?></strong>
		<?php echo $data->adherent->prenom; ?><br/>
		<?php echo $data->adherent->promo; ?></p>
	</div>

	<div id="coords">
		<p><u>Telephone :</u> <?php echo $data->adherent->tel; ?><br/>
		<u>Mail :</u> <?php echo $data->adherent->mail; ?><br/>
		<strong><?php echo $data->adherent->adresse . " " . $data->adherent->codePostal
		. " " . $data->adherent->ville ?></strong></p>
	</div>

	<div>
		<div style="float:left;width:50%">
			<p>Compétences :<br/>
			<?php if(count($data->competences) != 0) { 
				foreach ($data->competences as $elt) { ?>
					<span class="skill"><?php echo $elt->nom; ?></span>
			<?php }
			} else { ?>
				<span>Aucune compétence renseignée</span>
			<?php } ?>
			</p>
		</div>

		<div style="float:right">
			<p>Projets en cours :
				<ul>
				</ul>
			</p>

			<p>Affecter à un projet :</br>
				<select>
				</select>
			</p>
		</div>
	</div>
</div>