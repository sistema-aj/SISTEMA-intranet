<?php if($data->error != "")
{
	echo "<div class=\"alert-message fade in error\" id=\"diverror\" style=\"display:block;\">$data->error<a href=\"#\" onclick=\"fermeture('#diverror');return false;\" class=\"close\">x</a></div>";
}
?>
<form class="form-horizontal" name="addProjet" action="<?php echo URL_ROOT; ?>projets/ajout-action" method="post">
	<div class="form-group" id="aProAjout">
		<div class="form-group">
			<label class="col-sm-2 control-label">Titre :</label>
			<div class="col-sm-10">	
				<input class="form-control" type="text" name="titre">
			</div>
		</div>	
		<div class="form-group">
			<label class="col-sm-2 control-label">Type :</label>
			<div class="col-sm-10">	
				<select class="form-control" name="type">
					<option>  site vitrine </option>
					<option>  intranet </option>
					<option>  application mobile </option>
					<option>  client lourd </option>
				</select>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-sm-2 control-label">Description :</label>
			<div class="col-sm-10">	
				<textarea class="form-control" name="description"></textarea>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-sm-2 control-label">Client :</label>
			<div class="col-sm-10">	
				<select class="form-control" name="client">
					<?php 
						foreach ($data->clients as $client) 
						{
							echo '<option value='.$client->id.'>'. $client->raisonSociale .'</option>';
						}
				 	?>
				</select>
			</div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
				<input type ="submit" class="btn btn-info btn-lg btn-block" value="Creer le Projet"/>
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