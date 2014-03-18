<div id="pro-details">

	<div id="informations">
		<p>	
			<strong> <?php echo $data->projet->titre; ?> </strong></br>
					 <?php echo $data->projet->description; ?><br/>
					 <?php echo $data->projet->client; ?>
		</p>
	</div>


	<form name="changeChefProjet" action="<?php echo URL_ROOT; ?>detail/changementCdP" method="post">

		<table class="table table-bordered table-striped">

			<tr>
				<th> Nom 	</th>
				<th> Prenom </th>
				<th> Promo	</th>
				<th>	 	</th>
			</tr>

			
			<?php 
				foreach ($data->adherents as $adherent) 
				{ 
					
			?>
				<tr>
						<td><?php echo $adherent->nom; ?></td>
						<td><?php echo $adherent->prenom; ?></td>
						<td><?php echo $adherent->promo; ?></td>

			<?php 
					if($adherent->chefProjet == 1)
					{
			?>
						<td> <a> <img src="chefProjet.png"/> </a> </td>

			<?php
					}
					else
					{
			?>
					<td> <input type='radio' group='chefProjet' value='<?php echo $adherent->id; ?>'> </td>
			<?php
					}
					echo '</tr>';
				}
			?>

		</table>
		<input type='submit' value ='Changer Chef de Projet' /> 
	</form>

</div>