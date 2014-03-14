$(function() {
	$('#file').hide();
	$('#shadowing').hide();
	
	$('.file-button').click(function() {
		id = $(this).attr('id');
		type = $(this).attr('type');
		url = "http://localhost:81/SISTEMA-intranet/details/"+type;
		$('#file #content').load(url,{"id":id}, function() {
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