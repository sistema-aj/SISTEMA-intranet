
<h1> 
	<?php 
		echo $data->titre;
	?>
</h1>

<table id="aProListe" style="width:100%">

	<tr>
		<th> Titre 	</th>
		<th> Type 	</th>
		<th> Client	</th>
		<th> Status	</th>
		<th>	 	</th>
	</tr>

	<?php 
		foreach ($data->projets as $projet) 
		{ 
	?>

		<tr>
			<td>	
				<?php echo $projet->titre; ?>		 
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

	 		<td>	
	 			<!-- Image contenant les propriétés necessaires à l'appel de la fonction Js Display-fiche -->				
				<a style='cursor:pointer' class = 'file-button' type = 'projet' id = '<?php echo $projet->id; ?>' >
					 <img src="file.png"/> 
				</a>
			</td>

		</tr>

	<?php 
		}
    ?>
    
</table>

<!-- propriétés recupérés par la fonction js Display-fiche -->
<div id="file" style="z-index:2">
	<span id="content"></span>
	<img id='x-mark' src="x-mark.png"/>
</div>
<div id="shadowing" style="z-index:1"></div>