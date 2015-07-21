<html>
<head>
	<title>test</title>
</head>
<body>
	<?php
	echo $this->session->flashdata("artist_error");
	echo $this->session->flashdata("genre_error");
	?>

	<form action = "add_album" method = "post">
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
		<select name = "genre_list">
			<?php
			for($i = 0;$i<count($genres);$i++)
			{
				?>
				<option value = <?= $genres[$i]['id'] ?>><?= $genres[$i]['genre'] ?></option>
				<?php
			}
			?>
		</select>
		<p>Or add a new genre</p>
		<input type = "text" name ="new_genre">

		<p>Add a description</p>
		<textarea name = "description"></textarea>
		<br>
		<br>
		<input type = "submit" value = "Add Album">
	</form>
</body>
</html>