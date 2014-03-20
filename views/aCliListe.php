<h1 class="title"> Liste des clients </h1>
<hr class="hrTitle"/>
<?php if($data->error != "")
{
	echo "<div class=\"alert-message fade in error\" id=\"diverror\" style=\"display:block;\">$data->error<a href=\"#\" onclick=\"fermeture('#diverror');return false;\" class=\"close\">x</a></div>";
}
 if($data->succes != "")
{
	echo "<div class=\"alert-message fade in succes\" id=\"divsucces\" style=\"display:block;\">$data->succes<a href=\"#\" onclick=\"fermeture('#divsucces');return false;\" class=\"close\">x</a></div>";
}
?>
<table class="table table-bordered table-striped" id="aCliListe" style="width:100%">
	<tr>
		<th>RaisonSociale</th>
		<th>Adresse</th>
		<th>Code Postal</th>
		<th>Ville</th>
		<th>Téléphone</th>
		<th>Mail</th>
	</tr>
	<?php foreach ($data->clients as $client) { ?>
	<tr>
		<td><?php echo $client->raisonSociale; ?></td>
		<td><?php echo $client->adresse; ?></td>
		<td><?php echo $client->codePostal; ?></td>
		<td><?php echo $client->ville; ?></td>
		<td><?php echo $client->telephone; ?></td>
		<td><?php echo $client->mail; ?></td>
	</tr>
	<?php } ?>
</table>
<script type="text/javascript">
    function fermeture(div)
	{
        $(div).css('display','none');  
    }
</script>