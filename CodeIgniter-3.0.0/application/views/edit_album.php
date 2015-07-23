<html>
<head>
    <title>Edit Album</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
    .preview_img{
        max-width: 100px;
        max-height: 100px;
    }
    .container .row .search{
        margin-top: 18px;
    }
    .container .row button{
       margin-top: 22px;
       margin-left: 5%;
    }
    .album_cover{
    	height: 200px;
    	width: 200px;
    }
    </style>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('select').material_select();
    	});
            $.post('/load_nav',function(res){
                $('#navbar').html(res);
            });
    </script>
</head>
<body>
    <div id='navbar'>
    </div>
	<?php
	echo $this->session->flashdata("errors");
	echo $this->session->flashdata("genre_error");
	echo $this->session->flashdata("artist_error");
	?>
	<div class = "container">
		<h1>Edit Album</h1>

		<form action = "edit_album" method = "post">
			<div class = "row">
				<div class = "input-field col s1">
					<label class = "active" for = "inventory">Inventory</label>
					<input type = "text" id = "inventory" name = "inventory" value = "<?= $album['inventory'] ?>">
				</div>
			</div>
			<br>
			<br>
			<p>Current Price: <?= $album['price'] ?></p>
			Change Price <input type = "text" name = "price" value = <?= $album['price'] ?>>
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
			<img src=<?= $album['img_src'] ?> class = "album_cover">
			<input type = "text" name = "album_cover" value = "<?= $album['img_src'] ?>">

			<p>Change description</p>
			<textarea name = "description" ><?= $album['description'] ?></textarea>
			<br>
			<input type = "hidden" name = "album_id" value = <?= $album['id'] ?>>
			<br>
			<input type = "submit" value = " Save Changes">
		</form>
	</div>
</body>
</html>