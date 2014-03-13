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
			<p><u>Compétences :</u><br/>
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
			<p>Affecter à un projet :</br>
				<select name="">
					<?php if(count($data->projets) != 0) { 
						foreach ($data->projets as $elt) { ?>
							<option value="<?php echo $elt->titre; ?>">
								<?php echo $elt->titre; ?>
							</option>
					<?php } 
					} ?>	
				</select>
			</p>
			
			<p><u>Projets en cours :</u><br/>
				<?php if(count($data->projetsAdh) != 0) { 
					foreach ($data->projetsAdh as $elt) { ?>
						<span class="projet"><?php echo $elt->titre; ?></span>
				<?php }
				} else { ?>
					<span>Aucune projet actif</span>
				<?php } ?>
			</p>
		</div>
	</div>
</div>