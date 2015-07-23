<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
	}

	public function index(){

		$this->load->view('login');
	}

	public function login()
	{
		if($this->input->post('formid') == 'login')
		{
			if($this->User->login())
			{
				redirect('/');
			}
		}
		$this->load->view('login');
	}

	public function register()
	{
		if($this->input->post('formid') == 'register')
		{
			if($this->User->register())
			{
				redirect('/');
			}
		}
		redirect('/login');
	}


}
