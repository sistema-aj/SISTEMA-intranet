$(function() {
	$('#file').hide();
	$('#shadowing').hide();
	
	$('.file-button').click(function() {
		url = "http://localhost:81/SISTEMA-intranet/details/adherent";
		user = $(this).attr('user');
		$('#file #content').load(url,{"user":user}, function() {
			$('#file').show();
			$('#shadowing').show();
		});
	});

	$('#file img').click(function() {
		$('#file').hide();
		$('#shadowing').hide();
	});

	$(this).click(function(){
		if(!($('#file').is(':hover'))) {
			$('#file').hide();
			$('#shadowing').hide();
		}
	});
});