<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function login()
	{
		//Set the validation rules for login
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('login_error', validation_errors());
			return false;
		}
		else
		{
			$query = "SELECT id, first_name, last_name, email, admin, password FROM users WHERE email = ?";
			$value = array($this->input->post('email'));
			$user = $this->db->query($query, $value)->row_array();
			if($user)
			{
				$encryptedPassword = md5($this->input->post('password'));
				if($user['password'] == $encryptedPassword)
				{
					$this->session->set_userdata('first_name', $user['first_name']);
					$this->session->set_userdata('last_name', $user['last_name']);
					$this->session->set_userdata('userid', $user['id']);
					$this->session->set_userdata('email', $user['email']);
					if($user['admin'] == 1)
					{
						$this->session->set_userdata('admin', true);
					}
					else
					{
						$this->session->set_userdata('admin', false);
					}
					return true;
				}
			}
		}
		$this->session->set_flashdata('login_error', 'Incorrect login credentials');
		return false;
	}

	public function register()
	{
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required|min_length[2]|max_length[45]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[45]|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[15]|matches[confirm]|md5');
		$this->form_validation->set_rules('confirm', 'Confirm', 'trim|required');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('reg_error', validation_errors());
			return false;
		}
		else
		{
			$query = "INSERT INTO users (first_name, last_name, email, password, admin, created_at, updated_at) VALUES (?,?,?,?, FALSE, NOW(), NOW())";
			$values = array($this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('email'), $this->input->post('password'));
			$user_id = $this->db->insert_id($this->db->query($query, $values));
			$this->session->set_userdata('first_name', $this->input->post('first_name'));
			$this->session->set_userdata('last_name', $this->input->post('last_name'));
			$this->session->set_userdata('email', $this->input->post('email'));
			$this->session->set_userdata('userid', $user_id);
			return true;
		}

	}
}
