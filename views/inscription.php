<div id="inscription">
	<?php if($data->msg == "" || $data->error != "") { ?>
	<!-- Si aucun message personnalisé à afficher -->
		<form id="inscription-form" name="inscription" action="" method="post">
			<label>Nom :</label><br/>
			<input id="nom" type="text" name="nom"><br/>
			<label>Prenom :</label><br/>
			<input id="prenom" type="text" name="prenom"><br/>
			<label>Promo :</label><br/>
			<select name="promo">
				<option value="L3G">L3G</option>
				<option value="L3I">L3I</option>
				<option value="M1">M1</option>
				<option value="M2">M2</option>
			</select><br/>
			<label>Telephone :</label><br/>
			<input id="telephone" type="text" name="telephone"><br/>
			<label>Mail :</label><br/>
			<input id="mail" type="text" name="mail"><br/>
			<label>Adresse :</label><br/>
			<input id="adresse" type="text" name="adresse"><br/>
			<label>Code Postal :</label><br/>
			<input id="codePostal" type="text" name="codePostal"><br/>
			<label>Ville :</label><br/>
			<input id="ville" type="text" name="ville"><br/>
			<input type ="submit" value="Inscription"/>
		</form>
		<?php if($data->error != "") { ?>
			<div id="error" style="color:red">
				<?php echo $data->error; ?>
			</div>
		<?php } ?>
	<!-- Fin du bloc -->
	<?php } else { ?>
	<!-- Si il y a un message personnalisé à afficher -->
		<div id="message">
			<p><?php echo $data->msg; ?></p>
		</div>
	<!-- Fin du bloc -->
	<?php } ?>
</div>