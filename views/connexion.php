<div id="connexion">
	<div id="container">
		<form name="connect" action="" method="post">
			<label>Identifiant :</label><br/>
			<input type="text" name="login"><br/>
			<label>Mot de passe :</label><br/>
			<input type="password" name="pwd"><br/>
			<input type ="submit" value="Connexion"/>
		</form>
		<?php if($data->error != "") { ?>
			<span id="error" style="color:red">
				<?php echo $data->error; ?>
			</span>
		<?php } ?>
	</div>
</div>