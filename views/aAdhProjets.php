<h1 class="title"> Demande d'adhésion à un projet </h1>
<hr class="hrTitle"/>
<?php 
 if($data->succes != "")
{
	echo "<div class=\"alert-message fade in succes\" id=\"divsucces\" style=\"display:block;\">$data->succes<a href=\"#\" onclick=\"fermeture('#divsucces');return false;\" class=\"close\">x</a></div>";
}
if($data->error != "")
{
	echo "<div class=\"alert-message fade in error\" id=\"diverror\" style=\"display:block;\">$data->error<a href=\"#\" onclick=\"fermeture('#diverror');return false;\" class=\"close\">x</a></div>";
}
if(!empty($data->adhesions)) 
{ 
?>
<table class="table table-bordered table-striped" id="aAdhProjets" style="width:100%">
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
			<a style="cursor:pointer" class="file-button" id="<?php echo $user->id; ?>" type="adherent">
				<img src="file.png"/>
			</a>
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

<div id="file" style="z-index:2">
	<span id="content"></span>
	<img id='x-mark' src="x-mark.png"/>
</div>
<div id="shadowing" style="z-index:1"></div>
<script type="text/javascript">
    function fermeture(div)
	{
        $(div).css('display','none');  
    }
</script>
