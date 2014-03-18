<?php if($data->error != "")
{
	echo "<div class=\"alert-message fade in error\" id=\"diverror\" style=\"display:block;\">$data->error<a href=\"#\" onclick=\"fermeture('#diverror');return false;\" class=\"close\">x</a></div>";
}
?>
<div id="connexion">
	<div id="container">
		<form name="connect" action="" method="post">
			<label>Identifiant :</label><br/>
			<input type="text" name="login"><br/>
			<label>Mot de passe :</label><br/>
			<input type="password" name="pwd"><br/>
			<input type ="submit" value="Connexion"/>
		</form>
		<p>Pas encore adhérent ? <a href="<?php echo URL_ROOT; ?>inscription">Inscription</a></p>
	</div>
</div>
<script type="text/javascript">
    function fermeture(div)
	{
        $(div).css('display','none');  
    }
</script>