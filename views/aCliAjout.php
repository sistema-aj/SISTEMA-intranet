<?php if($data->error != "")
{
	echo "<div class=\"alert-message fade in error\" id=\"diverror\" style=\"display:block;\">$data->error<a href=\"#\" onclick=\"fermeture('#diverror');return false;\" class=\"close\">x</a></div>";
}
?>
<h1 class="title"> Ajouter un client </h1>
<hr class="hrTitle"/>
<form class="form-horizontal" role="form" name="addCli" action="<?php echo URL_ROOT; ?>clients/ajoutClient"" method="post">
	<div class="form-group" id="aCliAjout">
		<div class="form-group">
			<label class="col-sm-2 control-label">Raison Sociale :</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="raisonSociale">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Telephone :</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="telephone">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Mail :</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="mail">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Adresse :</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="adresse">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Code Postal :</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="codePostal">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Ville :</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="ville">
			</div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
				<input type ="submit" class="btn btn-info btn-lg btn-block" value="Ajouter le client"/>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
    function fermeture(div)
	{
        $(div).css('display','none');  
    }
</script>

