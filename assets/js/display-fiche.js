$(function() {
	$('#file').hide();

	$('.file-button').click(function() {
		$('#file #content').load("http://localhost:81/SISTEMA-intranet/details/adherent", {"user":$(this).attr("user")}, function() {
			$('#file').show();
		});
	});

	$('#file img').click(function() {
		$('#file').hide();
	});

	$(this).click(function(){
		if(!($('#file').is(':hover')))
			$('#file').hide();
	});
});