<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function search($orders_per_page){
		if($this->input->post('keyword')){
		    $keyword  = '%' . $this->input->post('keyword') . '%';
		}else{
		    $keyword = '%';
		}
		if($this->input->post('page')){
		    $page = ($this->input->post('page') -1) * $orders_per_page;
		}else{
		    $page = 0;
		}
		$query = "SELECT orders.id, orders.created_at,orders.total,orders.state AS status,
                                                    billing_addresses.unit,billing_addresses.address,billing_addresses.city,
                                                    billing_addresses.state,billing_addresses.zip,users.first_name,users.last_name
                                        FROM orders
                                        JOIN billing_addresses ON orders.billing_address_id = billing_addresses.id
                                        JOIN users ON billing_addresses.user_id = users.id
                                        WHERE orders.id LIKE ?
                                            OR CONCAT(users.first_name, ' ', users.last_name) LIKE ?
                                            OR CONCAT(billing_addresses.unit, ' ', billing_addresses.address, ' ', billing_addresses.city, ' ', billing_addresses.state, ' ', billing_addresses.zip) LIKE ?
                                        GROUP BY orders.id
                                        LIMIT ? OFFSET ?";
                        $values = array($keyword,$keyword,$keyword,$orders_per_page,$page);
                        return $this->db->query($query,$values)->result_array();
	}

            public function count_search(){
                if($this->input->post('keyword')){
                    $keyword  = '%' . $this->input->post('keyword') . '%';
                }else{
                    $keyword = '%';
                }
                $query ="SELECT COUNT(DISTINCT orders.id) as num_orders
                                FROM orders
                                JOIN billing_addresses ON orders.billing_address_id = billing_addresses.id
                                JOIN users ON billing_addresses.user_id = users.id
                                WHERE orders.id LIKE ?
                                    OR CONCAT(users.first_name, ' ', users.last_name) LIKE ?
                                    OR CONCAT(billing_addresses.unit, ' ', billing_addresses.address, ' ', billing_addresses.city, ' ', billing_addresses.state, ' ', billing_addresses.zip) LIKE ?;";
                $values = array($keyword,$keyword,$keyword);
                return $this->db->query($query,$values)->row_array();
            }

	public function order_info()
	{
		$cart = $this->session->userdata('cart');
		$count = 1;
		$where = " WHERE albums.id IN (";
		foreach($cart as $album => $quantity)
		{
			if($count == 1)
			{
				$where .= "$album";
			} else
			{
				$where .= ", $album";
			}
			$count ++;
		}
		$where .= ")";
		$query = "SELECT id, title, album_cover, price FROM albums".$where;
		return $this->db->query($query)->result_array();
	}

	public function is_valid_address($address, $type)
	{
		$this->form_validation->set_rules($type.'_first_name', 'First name', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules($type.'_last_name', 'Last name', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules($type.'_address', 'Address', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules($type.'_address2', 'Apt/Unit', 'trim|max_length[45]');
		$this->form_validation->set_rules($type.'_city', 'City', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules($type.'_state', 'State', 'required');
		$this->form_validation->set_rules($type.'_zip', 'Zipcode', 'trim|required|exact_length[5]');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata($type, validation_errors());
			return true;
		}
		return false;
	}

	public function create_address($address, $table)
	{
		if($this->session->userdata('userid')){
			$userid = $this->session->userdata('userid');
		}	else {
			$userid = 1; //guest user
		}
		$query = "INSERT INTO ".$table." (address, unit, city, state, zip, first_name, last_name, user_id) VALUES (?,?,?,?,?,?,?,?)";
		$values = array($address['address'], $address['address2'], $address['city'], $address['state'], $address['zip'], $address['first_name'], $address['last_name'], $userid);
		return $this->db->insert_id($this->db->query($query, $values));
	}

	public function complete_order($ship, $bill, $email,$total)
	{
		$query = "INSERT INTO orders (email, shipping_address_id, billing_address_id,created_at,total,state) VALUES (?,?,?,NOW(),?,?)";
		$values = array($email, $ship, $bill,$total,'Order in process');
		$orderID = $this->db->insert_id($this->db->query($query, $values));
		$albums = $this->session->userdata('cart');
		foreach ($albums as $id => $quantity) {
			$albumdata = array($id, $orderID, $quantity);
			$this->db->query('INSERT INTO albums_has_orders (album_id, order_id, quantity) VALUES (?,?,?)', $albumdata);
		}
	}
}
