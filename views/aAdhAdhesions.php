<h1 class="title"> Demande d'adhésion à SISTEMA </h1>
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
if(sizeof($data->candidats) != 0)
{
?>
<table class="table table-bordered table-striped" id="aAdhSistema" style="width:100%">
	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Promo</th>
		<th>Téléphone</th>
		<th>Mail</th>
		<th>Validation</th>
	</tr>
	<?php foreach ($data->candidats as $user) 
	{ 
	?>
	<tr>
		<td><?php echo $user->nom; ?></td>
		<td><?php echo $user->prenom; ?></td>
		<td><?php echo $user->promo; ?></td>
		<td><?php echo $user->telephone; ?></td>
		<td><?php echo $user->mail; ?></td>
		<td>
			<form action="<?php echo URL_ROOT; ?>candidatures/valider-candidat" style="display:inline-block" method="POST">
				<input type="hidden" name="id" value="<?php echo $user->id; ?>" />
				<input type="hidden" name="mail" value="<?php echo $user->mail; ?>" />
				<a href="#" onclick="this.parentNode.submit()"><img src="check-mark.png"/></a>
			</form>
			<form action="<?php echo URL_ROOT; ?>candidatures/refuser-candidat" style="display:inline-block" method="POST">
				<input type="hidden" name="id" value="<?php echo $user->id; ?>" />
				<input type="hidden" name="mail" value="<?php echo $user->mail; ?>" />
				<a href="#" onclick="this.parentNode.submit()"><img src="x-mark.png"/></a>
			</form>
		</td>
	</tr>
	<?php 
	} 
	?>
</table>
<?php 
} 
else 
{ 
?>
	<div style="text-align:center">Aucune demande d'adhésion à SISTEMA n'est en cours.</div>
<?php 
} 
?>
<script type="text/javascript">
    function fermeture(div)
	{
        $(div).css('display','none');  
    }
</script>
