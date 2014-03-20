<div id="connexion">
	<div class="container">
		<div class="col-sm-4"></div>
		<div class="col-sm-5" id="formConnexion">
				<?php if($data->error != "") { ?>
				<div class="alert alert-error alertLogin"> 
						<?php echo $data->error; ?>
				</div>
			<?php } ?>
			<form  class="form" name="connect" action="" method="post">
				<div class="form-group">
					<label>Identifiant :</label>
					<input class="form-control" type="text" name="login">
				</div>
				<div class="form-group">
					<label>Mot de passe :</label>
					<input class="form-control" type="password" name="pwd"><br/>
				</div>
				<div class="form-group">
					<input class="btn btn-info btn-lg btn-block" type ="submit" value="Connexion"/>
				</div>
			</form>
		<br/>
		<p><a href="<?php echo URL_ROOT; ?>inscription">Pas encore adhérent ?</a></p>
		</div>
		<div class="col-sm-3"></div>

	</div>
</div>