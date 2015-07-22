<html>
<head>
	<title>test</title>
</head>
<body>
	<?php
	echo $this->session->flashdata("artist_error");
	echo $this->session->flashdata("genre_error");
	echo $this->session->flashdata("inventory_error");
	echo $this->session->flashdata("price_error");
	?>

	<form action = "add_album" method = "post">
		Inventory: <input type = "text" name = "inventory">
		Price: <input type = "text" name = "price">
		Album title: <input type = "text" name = "title">
		<p>Artist</p>
		<p>Choose from list</p>
		<select name = "artist_list">
			<?php
			for($i = 0;$i<count($artists);$i++)
			{
				?>
				<option value = <?= $artists[$i]['id'] ?>><?= $artists[$i]['artist'] ?></option>
				<?php
			}
			?>
		</select>
		<p>Or add a new artist</p>
		<input type = "text" name ="new_artist">
		
		<p>Genre</p>
		<p>Choose from the list</p>
		<?php
		for($i = 0; $i < count($genres); $i++)
		{
			?>
			<input type = "checkbox" name = <?= 'genre'.$i ?> value = <?= $genres[$i]['id'] ?>><?= $genres[$i]['genre'] ?>
			<br>
			<?php
		}
		?>
		<p>Or add a new genre</p>
		<input type = "text" name ="new_genre">
		<p>Add a cover url</p>
		<input type = "text" name = "album_cover">
		<p>Add a description</p>
		<textarea name = "description"></textarea>
		<br>
		<br>
		<input type = "submit" value = "Add Album">
	</form>
</body>
</html>