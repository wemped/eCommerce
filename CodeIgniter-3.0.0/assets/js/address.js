$(document).ready(function(){
	$('form button.stripe-button-el').attr('disabled', 'disabled');

	check_input_fields();

	$('#addressmatch').click(function(){
		$('#bill_first_name').val($('#ship_first_name').val());
		$('#bill_last_name').val($('#ship_last_name').val());
		$('#bill_address').val($('#ship_address').val());
		$('#bill_address2').val($('#ship_address2').val());
		$('#bill_city').val($('#ship_city').val());
		$('#bill_state').val($('#ship_state').val());
		$('#bill_zip').val($('#ship_zip').val());
		// $('form button.stripe-button-el').removeAttr('disabled');
		check_input_fields();
	});

	$('form :input').change(function(){
		check_input_fields();
	});
	$('form :input').keyup(function(){
		check_input_fields();
	});

	function check_input_fields(){
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
		}else{
			var attr_exists = $('form button.stripe-button-el').attr('disabled');
			if (!attr_exists){
				$('form button.stripe-button-el').attr('disabled','disabled');
			}
		}
	}
});