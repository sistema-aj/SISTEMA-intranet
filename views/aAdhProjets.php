<table id="aAdhProjets" style="width:100%">
	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Promo</th>
		<th>Téléphone</th>
		<th>Mail</th>
		<th>Projet</th>
		<th>CV</th>
		<th>Validation</th>
	</tr>
	<?php foreach ($data->adhesionsPro as $user) { ?>
	<tr>
		<td><?php echo $user->nom; ?></td>
		<td><?php echo $user->prenom; ?></td>
		<td><?php echo $user->promo; ?></td>
		<td><?php echo $user->telephone; ?></td>
		<td><?php echo $user->mail; ?></td>
		<td><?php echo $user->titre; ?></td>
		<td>
			<a href=""><img src="file.png"/></a>
		</td>
		<td>
			<a href=""><img src="check-mark.png"/></a>
			<a href=""><img src="x-mark.png"/></a>
		</td>
	</tr>
	<?php } ?>
</table>