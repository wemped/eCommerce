<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {
	private $albums_per_page_admin = 5;
	private $albums_per_page = 9;

	public function __construct(){
		parent::__construct();
		$this->load->model('Album');
	}

	public function index()
	{
		$viewdata['artists'] = $this->album->get_all_artists();
		$viewdata['genres'] = $this->album->get_all_genres();
		$this->load->view('index', $viewdata);
	}

	public function admin(){
		$this->load->view('admin_index');
	}

	public function admin_search(){
	    $viewdata['albums'] = $this->Album->search($this->albums_per_page_admin);
	    $viewdata['num_pages'] = ceil($this->Album->count_search()['num_albums']/$this->albums_per_page_admin);
	    if($this->input->post('page')){
	        $viewdata['curr_page'] = $this->input->post('page');
	    }else{
	        $viewdata['curr_page'] = 1;
	    }
	    $this->load->view('partials/admin_table',$viewdata);
	}

	public function search(){
	    $viewdata['albums'] = $this->Album->search($this->albums_per_page);
	    $viewdata['num_pages'] = ceil($this->Album->count_search()['num_albums']/$this->albums_per_page);
	    if($this->input->post('page')){
	        $viewdata['curr_page'] = $this->input->post('page');
	    }else{
	        $viewdata['curr_page'] = 1;
	    }
	    $this->load->view('partials/album_table',$viewdata);
	}

	public function add_album_page()
	{
		$albums = $this->album->get_all_albums();
		$artists = $this->album->get_all_artists();
		$genres = $this->album->get_all_genres();
		$this->load->view('add_album', array("albums" => $albums,"artists"=> $artists,"genres" => $genres));
	}
	public function add_album()
	{
		$this->form_validation->set_rules("title", "Title", "required");
		$this->form_validation->set_rules("inventory", "Inventory", "required|numeric");
		$this->form_validation->set_rules("price", "Price", "required|numeric");
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata("errors", validation_errors());

			// $this->session->set_flashdata("title_error", "Title field must be filled out<br>");
			// $this->session->set_flashdata("inventory_error", "Inventory must be a number<br>");
			// $this->session->set_flashdata("price_error", "Price must be a number<br>");
			redirect('/add_album_page');
		}

		if (empty($this->input->post('new_artist')))
		{
			$id = $this->input->post('artist_list');
			$artist = $this->album->get_artist($id);
		}
		else
		{
			$this->form_validation->set_rules("new_artist", "Artist", "is_unique[artists.artist]");
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("artist_error", "Artist already in list");
				redirect('/add_album_page');
			}
		}
		if(empty($this->input->post('new_genre')))
		{
			$all_genres = $this->album->get_all_genres();
			$genre_array = [];
			for($i = 0; $i < count($all_genres); $i++)
			{
				if($this->input->post('genre'.$i) != null)
				{
					$genre_array[] = $this->input->post('genre'.$i);
				}
			}
		}
		else
		{
			$this->form_validation->set_rules("new_genre", "Genre", "is_unique[genres.genre]");
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("genre_error", "Genre already in list");
				redirect('/add_album_page');
			}
			$genre_info = array("genre" => $this->input->post('new_genre'));
			$this->album->add_genre($genre_info);
			$new_genre_id = $this->album->get_new_id();
			$all_genres = $this->album->get_all_genres();
			$genre_array = [];
			for($i = 0; $i < count($all_genres); $i++)
			{
				if($this->input->post('genre'.$i) != null)
				{
					$genre_array[] = $this->input->post('genre'.$i);
				}
			}
			$genre_array[] = $new_genre_id;
		}

		if(!empty($this->input->post('new_artist')))
		{
			$artist_info = array("artist" => $this->input->post('new_artist'));
			$this->album->add_artist($artist_info);
			$artist_id = $this->album->get_new_id();
			$artist = $this->album->get_artist($artist_id);
		}

		$album_details =  array(
			"title" => $this->input->post('title'),
			"album_cover" => $this->input->post('album_cover'),
			"description" => $this->input->post('description'),
			"artist_id" => $artist['id'],
			"inventory" => $this->input->post('inventory'),
			"price" => $this->input->post('price')
			);

		$this->album->add_album($album_details);

		$album_id = $this->album->get_new_id();
		for($i = 0; $i < count($genre_array); $i++)
		{
			$album_genre = array("genre_id" => $genre_array[$i],"album_id" => $album_id);
			$this->album->update_albums_has_genres($album_genre);
		}

		$this->session->set_flashdata("album_success", "You have successfully added a new album! Thank you for your contribution!");
		//redirect('/home');
		redirect('/admin_home');
	}

	public function edit_album_page($id)
	{
		$album = $this->album->get_single_album($id);
		$artist = $this->album->get_album_artist($id);
		$genre = $this->album->get_album_genre($id);
		$all_artists = $this->album->get_all_artists();
		$all_genres = $this->album->get_all_genres();

		$this->load->view('edit_album', array("album" => $album, "artist" => $artist, "genre" => $genre,"all_artists" => $all_artists,"all_genres" => $all_genres));
	}

	public function edit_album()
	{
		$this->form_validation->set_rules("title", "Title", "required");
		$this->form_validation->set_rules("inventory", "Inventory", "required|numeric");
		$this->form_validation->set_rules("price", "Price", "required|numeric");
		if($this->form_validation->run() === FALSE)
		{

			$this->session->set_flashdata("title_error", "Title field must be filled out<br>");
			$this->session->set_flashdata("inventory_error", "Inventory must be a number<br>");
			$this->session->set_flashdata("price_error", "Price must be a number<br>");

			redirect('/edit_album_page/'.$this->input->post('album_id'));
		}
		if (empty($this->input->post('new_artist')))
		{
			$id = $this->input->post('artist_list');
			$artist = $this->album->get_artist($id);
		}
		else
		{
			$this->form_validation->set_rules("new_artist", "Artist", "is_unique[artists.artist]");
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("artist_error", "Artist already in list");
				redirect('/edit_album_page/'.$this->input->post('album_id'));
			}
		}

		if(empty($this->input->post('new_genre')))
		{
			$all_genres = $this->album->get_all_genres();
			$genre_array = [];
			for($i = 0; $i < count($all_genres); $i++)
			{
				if($this->input->post('genre'.$i) != null)
				{
					$genre_array[] = $this->input->post('genre'.$i);
				}
			}
		}
		else
		{
			$this->form_validation->set_rules("new_genre", "Genre", "is_unique[genres.genre]");
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("genre_error", "Genre already in list");
				redirect('/edit_album_page/'.$this->input->post('album_id'));
			}
			$genre_info = array("genre" => $this->input->post('new_genre'));
			$this->album->add_genre($genre_info);
			$new_genre_id = $this->album->get_new_id();
			$all_genres = $this->album->get_all_genres();
			$genre_array = [];
			for($i = 0; $i < count($all_genres); $i++)
			{
				if($this->input->post('genre'.$i) != null)
				{
					$genre_array[] = $this->input->post('genre'.$i);
				}
			}
			$genre_array[] = $new_genre_id;
		}

		if(!empty($this->input->post('new_artist')))
		{
			$artist_info = array("artist" => $this->input->post('new_artist'));
			$this->album->add_artist($artist_info);
			$artist_id = $this->album->get_new_id();
			$artist = $this->album->get_artist($artist_id);
		}

		$album_details =  array(
			"title" => $this->input->post('title'),
			"album_cover" => $this->input->post('album_cover'),
			"description" => $this->input->post('description'),
			"artist_id" => $artist['id'],
			"inventory" => $this->input->post('inventory'),
			"id" => $this->input->post('album_id'),
			"price" => $this->input->post('price')
			);


		$this->album->update_album($album_details);
		// delete albums_has_genres

		$albums_has_genres = $this->album->get_all_albums_has_genres();
		for($i = 0; $i < count($albums_has_genres); $i++)
		{
			$valid = 0;
			for($j = 0; $j < count($genre_array); $j++)
			{
				if($albums_has_genres[$i]['genre_id'] == $genre_array[$j] && $albums_has_genres[$i]['album_id'] == $this->input->post('album_id'))
				{
					$valid = 1;
				}
			}
			if($valid == 0)
			{
				$album_genre = array("genre_id" => $albums_has_genres[$i]['genre_id'],"album_id" => $this->input->post('album_id'));
				$this->album->delete_albums_has_genres($album_genre);
			}
		}
		// update albums_has_genres
		$albums_has_genres = $this->album->get_all_albums_has_genres();
		for($i = 0; $i < count($genre_array); $i++)
		{
			$valid = 0;
			for($j = 0; $j < count($albums_has_genres); $j++)
			{
				if($albums_has_genres[$j]['genre_id'] == $genre_array[$i] && $albums_has_genres[$j]['album_id'] == $this->input->post('album_id'))
				{
					$valid = 1;
				}
			}
			if($valid == 0)
			{
				$album_genre = array("genre_id" => $genre_array[$i],"album_id" => $this->input->post('album_id'));
				$this->album->update_albums_has_genres($album_genre);
			}
		}
		redirect('/admin_home');
	}

	public function delete_album_page($id)
	{
		$album = $this->album->get_single_album($id);
		$this->load->view('delete', array("album" => $album));
	}

	public function delete_album($id)
	{
		$album = $this->album->get_single_album($id);
		$this->album->delete_albums_has_genres_of_album($id);
		$this->album->delete_album($id);
		$this->session->set_flashdata("delete_success", "You have successfully deleted ".$album['title']);
		redirect('/admin_home');
	}

	public function single_album_page($id)
	{
		$album = $this->Album->get_single_album($id);
		$similar_albums = $this->Album->get_similar_albums($id);
		$this->load->view('product_display', array("album" => $album, "similar_albums" => $similar_albums));
	}

	public function add_to_cart()
	{
		$cart = $this->session->userdata('cart');
		$cart[$this->input->post('album_id')] =  $this->input->post('quantity');
		$this->session->set_userdata('cart',$cart);
		redirect('/');
	}
}
