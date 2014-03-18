<h1 class="title"> Liste des adhérants </h1>
<hr class="hrTitle"/>
<table class="table table-bordered table-striped" id="aAdhListe" style="width:100%">

	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Promo</th>
		<th>Fiche</th>
	</tr>
	<?php foreach ($data->adherents as $user) { ?>
	<tr>
		<td><?php echo $user->nom; ?></td>
		<td><?php echo $user->prenom; ?></td>
		<td><?php echo $user->promo; ?></td>
		<td>
			<a style="cursor:pointer" class="file-button" id="<?php echo $user->id; ?>" type="adherent">
				<img src="file.png"/>
			</a>
		</td>
	</tr>

	<?php } ?>
</table>

<div id="file" style="z-index:2">
	<span id="content"></span>
	<img id='x-mark' src="x-mark.png"/>
</div>
<div id="shadowing" style="z-index:1"></div>