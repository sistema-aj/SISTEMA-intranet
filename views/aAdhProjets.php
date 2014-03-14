<?php if(!empty($data->adhesions)) { ?>
<table id="aAdhProjets" style="width:100%">
	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Promo</th>
		<th>Projet</th>
		<th>Fiche</th>
		<th>Validation</th>
	</tr>
	<?php foreach ($data->adhesions as $user) { ?>
	<tr>
		<td><?php echo $user->nom; ?></td>
		<td><?php echo $user->prenom; ?></td>
		<td><?php echo $user->promo; ?></td>
		<td><?php echo $user->titre; ?></td>
		<td>
			<a style="cursor:pointer" class="file-button" user="<?php echo $user->id; ?>"><img src="file.png"/></a>
		</td>
		<td>
			<form action="<?php echo URL_ROOT; ?>candidatures/valider-candidatPro" style="display:inline-block" method="POST">
				<input type="hidden" name="id" value="<?php echo $user->id; ?>" />
				<input type="hidden" name="projet" value="<?php echo $user->projet; ?>" />
				<a href="#" onclick="this.parentNode.submit()"><img src="check-mark.png"/></a>
			</form>
			<form action="<?php echo URL_ROOT; ?>candidatures/refuser-candidatPro" style="display:inline-block" method="POST">
				<input type="hidden" name="id" value="<?php echo $user->id; ?>" />
				<input type="hidden" name="projet" value="<?php echo $user->projet; ?>" />
				<a href="#" onclick="this.parentNode.submit()"><img src="x-mark.png"/></a>
			</form>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } else { ?>
	<div style="text-align:center">Aucune demande d'adhésion à un projet n'est en cours.</div>
<?php } ?>