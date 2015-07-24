$(document).ready(function(){
	load_table();


	$('.add').click(function(){
		var album = $(this).attr('data-album');
	});
});

function load_table()
{
	$.get('/orders/summary_table', function(res) {
			$('div.table').html(res);
	});
}

$(document).on('click', '.trash', function(){
	var album = $(this).attr('data-album');
	$.get('/orders/trash/'+album, function(res) {
		$('div.table').html(res);
	});
});

$(document).on('click', '.add', function(){
	var album = $(this).attr('data-album');
	$.get('/orders/add/'+album, function(res) {
		$('div.table').html(res);
	});
});

$(document).on('click', '.minus', function(){
	var album = $(this).attr('data-album');
	$.get('/orders/minus/'+album, function(res) {
		$('div.table').html(res);
	});
});