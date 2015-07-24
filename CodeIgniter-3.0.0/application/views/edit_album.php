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
    #description{
    	height: 100px;
    }
    </style>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('select').material_select();
    	});
    </script>
</head>
<body>
	<?php
	echo $this->session->flashdata("errors");
	echo $this->session->flashdata("genre_error");
	echo $this->session->flashdata("artist_error");
	?>
	<div class = "container">
		<h3>Edit Album</h3>

		<form action = "edit_album" method = "post">
			<div class = "row">
				<div class = "input-field col s12">
					<label class = "active" for = "title">Album Title</label>
					<input type = "text" id = "title" name = "title" value = "<?= $album['title'] ?>">
				</div>
			</div>
			<div class = "row">
				<div class = "input-field col s6">
					<label class = "active" for = "inventory">Inventory</label>
					<input type = "text" id = "inventory" name = "inventory" value = "<?= $album['inventory'] ?>">
				</div>
				<div class = "input-field col s6">
					<label class = "active" for "price">Price</label>
					<input type = "text" id = "price" name = "price" value = <?= $album['price'] ?>>
				</div>

			</div>
			<div class = "row">
				<div class = "input-field col s6">
					<label class = "active">Select Artist From List</label>
					<select name = "artist_list">
						<option value = <?= $artist['id'] ?>><?= $artist['artist'] ?></option>
<?php					for($i = 0 ; $i<count($all_artists) ; $i++)
						{
							if($all_artists[$i]['id'] != $artist['id'])
							{?>
							<option value = <?= $all_artists[$i]['id'] ?>><?= $all_artists[$i]['artist'] ?></option>
<?php 						}
						}?>
					</select>
				</div>
				<div class = "input-field col s6">
					<label >Or Add A New Artist</label>
					<input type = "text" name = "new_artist">
				</div>
			</div>

			<div class = "row">
				<!-- <div class = "col s3"> -->
<?php 			$open = TRUE;
				$counter = 0;
				for($i = 0; $i < count($all_genres); $i++)
				{
					if($open == TRUE)
					{?>
						<div class = "col s3">
<?php 					$open = FALSE;
					}
					$counter += 1;				
					$valid = 0;
					for($j = 0; $j < count($genre); $j++)
					{
						if($all_genres[$i]['id'] == $genre[$j]['id'])
						{
							$valid = 1;
						}
					}
					if($valid == 1)
					{?>
						<input type = "checkbox" id = "<?= 'genre'.$all_genres[$i]['id']?>" name = <?= 'genre'.$i ?> value = <?= $all_genres[$i]['id'] ?> checked = "checked">
						<label for = "<?= 'genre'.$all_genres[$i]['id']?>"><?= $all_genres[$i]['genre'] ?></label>
						<br>
<?php 				}
					else
					{?>
						<input type = "checkbox" id = "<?= 'genre'.$all_genres[$i]['id']?>" name = <?= 'genre'.$i ?> value = <?= $all_genres[$i]['id'] ?>>
						<label for = "<?= 'genre'.$all_genres[$i]['id']?>"><?= $all_genres[$i]['genre'] ?></label>
						<br>
<?php 				}
					if($counter%6 == 0)
					{?>
						</div>
<?php 					$open = TRUE;
					}
				}?>
				<!-- </div> -->
			</div>
			<div class = "row">
				<div class = "input-field col s12">
					<label>Or Add A New Genre</label>
					<input type = "text" name = "new_genre">
				</div>
			</div>
			<div class = "row">
				<div class = "col s3">
					<p>Current Album Cover</p>
					<img src=<?= $album['img_src'] ?> class = "album_cover">
				</div>
				<div class = "col s9">
					<label class = "active" for = "album_cover">Album Cover URL</label>
					<input id = "album_cover" type = "text" name = "album_cover" value = "<?= $album['img_src'] ?>">
					<label class = "active" for = "description">Description</label>
					<textarea id = "description" name = "description" ><?= $album['description'] ?></textarea>
				</div>
			</div>
			<input type = "hidden" name = "album_id" value = <?= $album['id'] ?>>
			<div class = "row">
				<div class = "col s2 offset-s10">
					<input type = "submit" value = " Save Changes">
				</div>
			</div>
		</form>
	</div>
</body>
</html>