<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
	private $orders_per_page = 5;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Order');
	}
	public function admin(){
		if($this->session->userdata('admin') != 1)
		{
			redirect('/');
		}
	    $this->load->view('admin_orders');
	}

	public function admin_search(){
	            $viewdata['orders'] = $this->Order->search($this->orders_per_page);
	            $viewdata['num_pages'] = ceil($this->Order->count_search()['num_orders']/$this->orders_per_page);
	            if($this->input->post('page')){
	                $viewdata['curr_page'] = $this->input->post('page');
	            }else{
	                $viewdata['curr_page'] = 1;
	            }
	            $this->load->view('partials/admin_orders_table',$viewdata);
	}
	public function admin_edit_status($order_id,$status){
		$this->Order->edit_state($order_id,$status);
	}
	public function details()
	{
		if($this->session->userdata('userid') > 1)
		{
			$view_data['ship'] = $this->Order->fetch_address('shipping_addresses');
			$view_data['bill'] = $this->Order->fetch_address('billing_addresses');
		}
		else
		{
			$view_data['ship'] = array('address' => "",
									   'unit' => "",
									   'city' => "",
									   'state' => "",
									   'zip' => "",
									   'first_name' => "",
									   'last_name' => "");
			$view_data['bill'] = array('address' => "",
									   'unit' => "",
									   'city' => "",
									   'state' => "",
									   'zip' => "",
									   'first_name' => "",
									   'last_name' => "");
		}
		$this->load->view('cart', $view_data);
	}

	public function states()
	{
		$this->load->view('partials/states');
	}

	public function validate_order()
	{
		if($this->session->userdata('cart') == null)
		{
			redirect('/');
		}
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
		$total = $this->session->userdata('order_total');
		$this->Order->complete_order($shipID, $billID, $email,$total);
		$this->session->unset_userdata('cart');
		redirect('/');
	}

	public function summary_table()
	{
		$view_data['products'] = $this->Order->order_info();
		$this->load->view('partials/order_table', $view_data);
	}

	//remove item from cart and reload the orders table or redirect to home if empty
	public function trash($id)
	{
		$cart = $this->session->userdata('cart');
		unset($cart[$id]);
		if(count($cart) == 0)
		{
			$this->session->unset_userdata('cart');
			return 'cart empty';
		}
		else
		{
			$this->session->set_userdata('cart', $cart);
		}
		$this->summary_table();
	}

	public function add_unit($id)
	{
		$cart = $this->session->userdata('cart');
		$cart[$id] += 1;
		$this->session->set_userdata('cart', $cart);
		$this->summary_table();
	}

	public function minus_unit($id)
	{
		$cart = $this->session->userdata('cart');
		$cart[$id] -= 1;
		$this->session->set_userdata('cart', $cart);
		$this->summary_table();
	}

	public function single_order_page($id)
	{
		$shipping_info = $this->Order->get_shipping_info_for_order($id);
		$billing_info = $this->Order->get_billing_info_for_order($id);
		$order_info = $this->Order->get_order_info_for_order($id);
		$this->load->view('single_order', array("ship" => $shipping_info, "bill" => $billing_info, "order" => $order_info));
	}
}
