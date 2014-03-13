<div id="aProAjout">
	<form name="addProjet" action="<?php echo URL_ROOT; ?>projets/ajout-action" method="post">

		<label>Titre :</label>	
		<br/>
		<input type="text" name="titre">	
		<br/>

		<label>Type :</label>
		<br/>
		<select name="type">
			<option>  site vitrine </option>
			<option>  intranet </option>
			<option>  application mobile </option>
			<option>  client lourd </option>
		</select>
		</br>

		<label>Description :</label>
		<br/>
		<textarea name="description"></textarea>  
		<br/>

		<label>Client :</label>
		<br/>
		<select name="client">
			<?php 
				foreach ($data->clients as $client) 
				{
					echo '<option value='.$client->id.'>'. $client->raisonSociale .'</option>';
				}
			 ?>
		</select>

		</br>
		</br>

		<input type ="submit" value="Creer le Projet"/>
	</form>
</div>		