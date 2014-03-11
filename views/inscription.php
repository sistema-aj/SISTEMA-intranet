<div id="inscription">
	<?php if($data->msg == "" || $data->error != "") { ?>
	<!-- Si aucun message personnalisé à afficher -->
		<form name="inscription" action="" method="post">
			<label>Nom :</label><br/>
			<input type="text" name="nom"><br/>
			<label>Prenom :</label><br/>
			<input type="text" name="prenom"><br/>
			<label>Promo :</label><br/>
			<select name="promo">
				<option value="L3G">L3G</option>
				<option value="L3I">L3I</option>
				<option value="M1">M1</option>
				<option value="M2">M2</option>
			</select><br/>
			<label>Telephone :</label><br/>
			<input type="text" name="telephone"><br/>
			<label>Mail :</label><br/>
			<input type="text" name="mail"><br/>
			<label>Adresse :</label><br/>
			<input type="text" name="adresse"><br/>
			<label>Code Postal :</label><br/>
			<input type="text" name="codePostal"><br/>
			<label>Ville :</label><br/>
			<input type="text" name="ville"><br/>
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