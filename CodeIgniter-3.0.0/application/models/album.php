<?php

class album extends CI_Model
{
	public function search($albums_per_page){
                if($this->input->post('keyword')){
                    $keyword  = '%' . $this->input->post('keyword') . '%';
                }else{
                    $keyword = '%';
                }
                if($this->input->post('page')){
                    $page = ($this->input->post('page') -1) * $albums_per_page;
                }else{
                    $page = 0;
                }


                $query = "SELECT albums.title,albums.description,albums.id,albums.sold,albums.album_cover AS img_src,
                                    albums.inventory,artists.artist,genres.genre
                                FROM albums
                                    JOIN albums_has_genres ON albums.id = albums_has_genres.album_id
                                    JOIN genres ON albums_has_genres.genre_id = genres.id
                                    JOIN artists ON albums.artist_id = artists.id
                                WHERE (albums.title LIKE ?
                                    OR albums.description LIKE ?
                                    OR genres.genre LIKE ?
                                    OR artists.artist LIKE ?) ";
                $values = array($keyword,$keyword,$keyword,$keyword);

                $added_sql = '';
                if($this->input->post('artistid')){
                    $added_sql .= ' AND (artists.id = ?) ';
                    $values[] = $this->input->post('artistid');
                }
                if($this->input->post('genreid')){
                    $added_sql .= ' AND (genres.id = ?) ';
                    $values[] = $this->input->post('genreid');
                }
                $query.= $added_sql . " GROUP BY albums.id LIMIT ? OFFSET ?;";
                $values[] = $albums_per_page;
                $values[] = $page;
                //echo $query; die();
                return $this->db->query($query,$values)->result_array();
            }

            public function count_search(){
                if($this->input->post('keyword')){
                    $keyword  = '%' . $this->input->post('keyword') . '%';
                }else{
                    $keyword = '%';
                }
                if($this->input->post('artistid')){
                    $artistid = $this->input->post('artistid');
                }else{
                    $artistid = "@artists.id";
                }
                if($this->input->post('genreid')){
                    $genreid = $this->input->post('genreid');
                }else{
                    $genreid = "@genres.id";
                }
                $query = "SELECT COUNT(DISTINCT albums.id) as num_albums
                                FROM albums
                                    JOIN albums_has_genres ON albums.id = albums_has_genres.album_id
                                    JOIN genres ON albums_has_genres.genre_id = genres.id
                                    JOIN artists ON albums.artist_id = artists.id
                                WHERE (albums.title LIKE ?
                                    OR albums.description LIKE ?
                                    OR genres.genre LIKE ?
                                    OR artists.artist LIKE ?);";
                $values = array($keyword,$keyword,$keyword,$keyword);
                return $this->db->query($query,$values)->row_array();
            }

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
		$query = "INSERT INTO albums (title, description, artist_id, album_cover, inventory, price, sold, created_at)
				  VALUES (?,?,?,?,?,?,0, NOW())";
		$values = array($album_details['title'],$album_details['description'],$album_details['artist_id'],$album_details['album_cover'],$album_details['inventory'],$album_details['price']);
		$this->db->query($query,$values);
	}

	public function update_albums_has_genres($album_genre)
	{
		$query = "INSERT INTO albums_has_genres (album_id, genre_id)
				  VALUES (?,?)";
		$values = array($album_genre['album_id'],$album_genre['genre_id']);
		$this->db->query($query,$values);
	}

	public function get_all_artists()
	{
		return $this->db->query("SELECT * FROM artists")->result_array();
	}

	public function get_all_genres()
	{
		return $this->db->query("SELECT * FROM genres")->result_array();
	}

	public function get_all_albums()
	{
		$query = "SELECT albums.title, genres.genre, artists.artist, albums.id, albums.album_cover, albums.inventory, albums.description, albums.price, albums.sold
				  FROM albums
				  JOIN artists
				  ON albums.artist_id = artists.id
				  JOIN albums_has_genres
				  ON albums.id = albums_has_genres.album_id
				  JOIN genres
				  ON albums_has_genres.genre_id = genres.id
				  ORDER BY albums_has_genres.album_id asc";
		return $this->db->query($query)->result_array();
	}

	public function get_single_album($id)
	{
		return $this->db->query("SELECT albums.title,albums.description,albums.album_cover AS img_src,
                                                                             albums.price,albums.inventory,albums.id AS id, artists.artist
                                                                 FROM albums
                                                                 JOIN artists ON albums.artist_id=artists.id
                                                                 WHERE albums.id = ?", array($id))->row_array();
	}

	public function get_album_artist($id)
	{
		$query = "SELECT artists.artist, artists.id, artists.description
				  FROM albums
				  JOIN artists
				  ON albums.artist_id = artists.id
				  WHERE albums.id = '{$id}'";
		return $this->db->query($query)->row_array();
	}

	public function get_album_genre($id)
	{
		$query = "SELECT genres.genre, genres.id
				  FROM albums
				  JOIN albums_has_genres
				  ON albums.id = albums_has_genres.album_id
				  JOIN genres
				  ON albums_has_genres.genre_id = genres.id
				  WHERE albums.id = '{$id}'";
		return $this->db->query($query)->result_array();
	}

	public function update_album($album_details)
	{
		$query = "UPDATE albums
				  SET title = ?,album_cover = ?, description = ?, artist_id = ?, inventory = ?, price = ?, updated_at = NOW()
				  WHERE id = '{$album_details['id']}'";
		$values = array($album_details['title'],$album_details['album_cover'],$album_details['description'],$album_details['artist_id'],$album_details['inventory'],$album_details['price']);
		$this->db->query($query, $values);
	}

	public function get_all_albums_has_genres()
	{
		return $this->db->query("SELECT * FROM albums_has_genres")->result_array();
	}

	public function delete_albums_has_genres($album_genre)
	{
		$query = "DELETE FROM albums_has_genres
				  WHERE albums_has_genres.genre_id = ? and albums_has_genres.album_id = ?";
		$values = array($album_genre['genre_id'],$album_genre['album_id']);
		$this->db->query($query, $values);
	}

	public function delete_albums_has_genres_of_album($id)
	{
		$query = "DELETE FROM albums_has_genres
				  WHERE albums_has_genres.album_id = '{$id}'";
		$this->db->query($query);
	}

	public function delete_album($id)
	{
		$query = "DELETE FROM albums
				  WHERE albums.id = '{$id}'";
		$this->db->query($query);
	}

            /*Given an album id, this returns every album that has a genre in common, or is by the same artist*/
            public function get_similar_albums($id){
                $query = "SELECT albums.title, albums.price, albums.album_cover AS img_src, albums.id, artists.artist
                                FROM albums
                                JOIN albums_has_genres ON albums_has_genres.album_id = albums.id
                                JOIN artists ON artists.id = albums.artist_id
                                WHERE ((albums_has_genres.genre_id IN
                                    (SELECT albums_has_genres.genre_id
                                     FROM albums_has_genres
                                     JOIN albums ON albums.id = albums_has_genres.album_id
                                     WHERE albums.id = ?))
                                OR  (albums.artist_id =
                                         (SELECT albums.artist_id
                                          FROM albums
                                          WHERE albums.id = ?)))
                                AND NOT(albums.id = ?)
                                GROUP BY albums.id;";
                return $this->db->query($query,array($id,$id,$id))->result_array();
            }
}
 ?>