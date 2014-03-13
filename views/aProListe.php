
<h1> 
	<?php 
		echo $data->titre;
	?>
</h1>

<table id="aProListe" style="width:100%">

	<tr>
		<th>Titre</th>
		<th></th>
		<th>Type</th>
		<th>Client</th>
		<th>Status</th>
	</tr>

	<?php 
		foreach ($data->projets as $projet) 
		{ 
	?>

		<tr>
			<td>	<?php echo $projet->titre; ?>		 </td>
			<td>
				<form action="<?php echo URL_ROOT; ?>projets/detail" style="display:inline-block" method="POST">
					<input type="hidden" name="projet" value="<?php echo $projet->id; ?>" />
					<a href="#" onclick="this.parentNode.submit()"><img src="file.png"/></a>
				</form>
			</td>
			<td> 	<?php echo $projet->type; ?>		 </td>
			<td>	<?php echo $projet->client; ?>		 </td>

			<td>	<?php 
						if($projet->status == 'N')
						{
							echo 'Non affecté';
						}
						else if ($projet->status == 'E')
						{
							echo 'En cours';
						}
					 ?>
	 		</td>

		</tr>

	<?php 
		}
    ?>
    
</table>