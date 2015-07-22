<html>
<head>
	<title>Edit Album</title>
</head>
<body>
	<?php
	echo $this->session->flashdata("artist_error");
	echo $this->session->flashdata("genre_error");
	var_dump($genre);
	?>
	<h1>Edit Album</h1>

	<form action = "edit_album" method = "post">
		<p>Current Inventory: <?= $album['inventory'] ?></p>
		Change Inventory <input type = "text" name = "inventory" value = "<?= $album['inventory'] ?>">
		<br>
		<br>
		<p>Current Album title: <?= $album['title'] ?></p>
		Change Album Title <input type = "text" name = "title" value = "<?= $album['title'] ?>">
		<br>
		<br>
		<p>Current Artist: <?= $artist['artist'] ?></p>
		<p>Change Artist: Choose from list</p>
		
		<select name = "artist_list">
			<option value = <?= $artist['id'] ?>><?= $artist['artist'] ?></option>
			<?php		
			for($i = 0 ; $i<count($all_artists) ; $i++)
			{
				if($all_artists[$i]['id'] != $artist['id'])
				{
				?>
				<option value = <?= $all_artists[$i]['id'] ?>><?= $all_artists[$i]['artist'] ?></option>
				<?php
				}
			}
			?>
		</select>
		<p>Or add a new artist</p>
		<input type = "text" name ="new_artist">
		<br>
		<br>


		<p>Current Genre(s):</p>
		<ul>
			<?php
			for($i = 0; $i < count($genre); $i++)
			{
				?>
				<li><?= $genre[$i]['genre'] ?></li>
				<?php
			}
			?>
		</ul>
		<p>Change Genre: Choose from the list</p>
		<?php
		for($i = 0; $i < count($all_genres); $i++)
		{
			$valid = 0;
			for($j = 0; $j < count($genre); $j++)
			{
				if($all_genres[$i]['id'] == $genre[$j]['id'])
				{
					$valid = 1;
				}
			}
			if($valid == 1)
			{
				?>
				<input type = "checkbox" name = <?= 'genre'.$i ?> value = <?= $all_genres[$i]['id'] ?> checked><?= $all_genres[$i]['genre'] ?>
				<br>
				<?php
				// break;
			}
			else
			{
				?>
				<input type = "checkbox" name = <?= 'genre'.$i ?> value = <?= $all_genres[$i]['id'] ?>><?= $all_genres[$i]['genre'] ?>
				<br>
				<?php
				// break;	
			}
		}
		?>

		<p>Or add a new genre</p>
		<input type = "text" name = "new_genre">
		<br>
		<br>
		<p>Change the album image url</p>
		<input type = "text" name = "album_covor" value = "<?= $album['album_cover'] ?>">

		<p>Change description</p>
		<textarea name = "description" ><?= $album['description'] ?></textarea>
		<br>
		<input type = "hidden" name = "album_id" value = <?= $album['id'] ?>>
		<br>
		<input type = "submit" value = " Save Changes">
	</form>
</body>
</html>