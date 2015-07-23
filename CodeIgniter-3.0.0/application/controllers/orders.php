<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Order');
	}

	public function details()
	{
		$this->load->view('cart');
	}

	public function states()
	{
		$this->load->view('partials/states');
	}

	public function validate_order()
	{
		$address = $this->input->post();
		foreach ($address as $key => $input) {
			if(preg_match('/^ship/', $key, $matches))
			{
				$new_key = str_replace('ship_', "", $key);
				$ship[$new_key] = $input;
			}
		}
		foreach ($address as $key => $input) {
			if(preg_match('/^bill/', $key, $matches))
			{
				$new_key = str_replace('bill_', "", $key);
				$bill[$new_key] = $input;
			}
		}
//check if the provided addresses pass our validation
//if they do NOT these functions will pass back a true
		$ship_check = $this->Order->is_valid_address($ship, 'ship');
		$bill_check = $this->Order->is_valid_address($bill, 'bill');
//Check if either one of these failed, and if it did redirect back to the cart page
		if($ship_check || $bill_check)
		{
			redirect('/cart');
		}
//address valdation passed, now create the addresses and the order
		$shipID = $this->Order->create_address($ship, 'shipping_addresses');
		$billID = $this->Order->create_address($bill, 'billing_addresses');
//now create the order and add the address IDs we just created
		$email = $this->input->post('stripeEmail');
		$this->Order->complete_order($shipID, $billID, $email);
		redirect('/');
	}


}
