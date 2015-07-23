$(document).ready(function(){
	$('form button.stripe-button-el').attr('disabled', 'disabled');

	$.get('/orders/states', function(res) {
		$('.states').html(res);
	});

	$('#addressmatch').click(function(){
		$('#bill_first_name').val($('#ship_first_name').val());
		$('#bill_last_name').val($('#ship_last_name').val());
		$('#bill_address').val($('#ship_address').val());
		$('#bill_address2').val($('#ship_address2').val());
		$('#bill_city').val($('#ship_city').val());
		$('#bill_state').val($('#ship_state').val());
		$('#bill_zip').val($('#ship_zip').val());
		// $('form button.stripe-button-el').removeAttr('disabled');
		$('#bill_zip').focus();
	});

	$('form :input').focus(function(){
		var complete = true;
		$('input.req').each(function(){
			if(complete == true)
			{
				console.log($(this).val());
				if($(this).val() === "")
				{
					complete = false;
				}
			}
		});
		if(complete == true)
		{
			$('form button.stripe-button-el').removeAttr('disabled');
		}
	});

});