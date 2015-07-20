<?php 

class process extends CI_Model
{
	public function get_artist($id)
	{
		return $this->db->query("SELECT * FROM artists WHERE id = ?", array($id))->row_array();
	}

	public function add_artist($artist_details)
	{
		$query = "INSERT INTO artists (artist, created_at)
				  VALUES (?, NOW())";
		$values = array($artist_details['artist']);
		$this->db->query($query,$values);
	}

	public function get_new_id()
	{
		return $this->db->insert_id();
	}

	public function get_genre($id)
	{
		return $this->db->query("SELECT * FROM genres WHERE id = ?", array($id))->row_array();
	}

	public function add_genre($genre_details)
	{
		$query = "INSERT INTO genres (genre)
				  VALUES (?)";
		$values = array($genre_details['genre']);
		$this->db->query($query,$values);
	}

	public function add_album($album_details)
	{
		$query = "INSERT INTO albums (title, description, artist_id, created_at)
				  VALUES (?,?,?, NOW())";
		$values = array($album_details['title'],$album_details['description'],$album_details['artist_id']);
		$this->db->query($query,$values);
	}

	public function update_albums_has_genres($album_genre)
	{
		$query = "INSERT INTO albums_has_genres (album_id, genre_id)
				  VALUES (?,?)";
		$values = array($album_genre['album_id'],$album_genre['genre_id']);
		$this->db->query($query,$values);
	}

	public function get_all_albums()
	{
		return $this->db->query("SELECT * FROM albums")->result_array();
	}

	public function get_all_artists()
	{
		return $this->db->query("SELECT * FROM artists")->result_array();
	}

	public function get_all_genres()
	{
		return $this->db->query("SELECT * FROM genres")->result_array();
	}
}


 ?>