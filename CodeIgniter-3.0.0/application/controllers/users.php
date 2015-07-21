<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
	}

	public function index()
	{
		$albums = $this->process->get_all_albums();
		$artists = $this->process->get_all_artists();
		$genres = $this->process->get_all_genres();
		$this->load->view('home', array("albums" => $albums,"artists"=> $artists,"genres" => $genres));
	}

	public function add_album_page()
	{
		$albums = $this->process->get_all_albums();
		$artists = $this->process->get_all_artists();
		$genres = $this->process->get_all_genres();
		$this->load->view('add_album', array("albums" => $albums,"artists"=> $artists,"genres" => $genres));
	}

	public function add_album()
	{
		// This checks to see if the new_artist input field is empty
		if (empty($this->input->post('new_artist')))
		{
			// if the new_artist field is empty it gets the info of the artist selected in the select field
			$id = $this->input->post('artist_list'); //artist_list will be the value of the id of the specific artist
			$artist = $this->process->get_artist($id);
		}
		// if the new_artist field is not empty this checks to make sure the info is unique
		else
		{
			$this->form_validation->set_rules("new_artist", "Artist", "trim|required|is_unique[artists.artist]");
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("artist_error", "Artist already in list");
				redirect('/add_album_page');
			}
			// if the info is unique then we add the artist to the table and pull the id/info out right away
			$artist_info = array("artist" => $this->input->post('new_artist'));
			$this->process->add_artist($artist_info);
			$artist_id = $this->process->get_new_id();
			$artist = $this->process->get_artist($artist_id);
		}
	
		// same validation sequence for genre
		if(empty($this->input->post('new_genre')))
		{
			$id = $this->input->post('genre_list');
			$genre = $this->process->get_genre($id);
		}
		else
		{
			$this->form_validation->set_rules("new_genre", "Genre", "required|is_unique[genres.genre]");
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("genre_error", "Genre already in list");
				redirect('/add_album_page');
			}
			$genre_info = array("genre" => $this->input->post('new_genre'));
			$this->process->add_genre($genre_info);
			$genre_id = $this->process->get_new_id();
			$genre = $this->process->get_genre($genre_id);
		}
		// now we add in the album
		$album_details =  array(
			"title" => $this->input->post('title'),
			// "album_covor" => $this->input->post('album_url'),
			"description" => $this->input->post('description'),
			"artist_id" => $artist['id']
			);

		$this->process->add_album($album_details);
		
		// use this function to get the id of the new album we just added
		$album_id = $this->process->get_new_id();
		$album_genre = array("genre_id" => $genre['id'],"album_id" => $album_id);
		
		// update the albums_has_genres table
		$this->process->update_albums_has_genres($album_genre);
		
		// redirect back to the home page
		$this->session->set_flashdata("album_succes", "You have successfully added a new album! Thank you for your contribution!");
		redirect('/');

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
