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
				if($this->session->userdata('admin') == 1)
				{
					redirect('/admin_home');
				}
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

	public function logout(){
		$this->session->sess_destroy();
		redirect('/login');
	}
	public function nav_bar(){
		$this->load->view('partials/general_navbar');
	}
}
