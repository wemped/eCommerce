<html>
<head>
	<title>Add an Album</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/override.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('select').material_select();

    		$('#album_cover').change(function(){
    			var str = $('#album_cover').val();
    			$('div.cover_art img').attr('src', str);
    		});
    	});

      $.post('/load_nav',function(res){
          $('#navbar').html(res);
      });
    </script>
    <style type="text/css">
    	#description
    	{
    		height: 150px;
    	}
    	img
    	{
    		height: 200px;
    	}
    </style>
</head>
<body>
	<div id="navbar">
	</div>
	<div class='container'>
		<h3>Add a new album</h3>
		<?php
		echo $this->session->flashdata("errors");
		echo $this->session->flashdata("genre_error");
		echo $this->session->flashdata("artist_error");
		?>
		<div class="row">
			<form class="col s12" action="add_album" method="post">
				<h5>Album Information</h5>
				<div class="row">
					<div class="input-field col s12">
						<input type = "text" id="title" name="title">
						<label for="title">Album title</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<input type="text" id="inventory" name="inventory">
						<label for="inventory">Inventory</label>
					</div>
					<div class="input-field col s6">
						<input type = "text" id="price" name="price">
						<label for="price">Price</label>
					</div>
				</div>
				<h5>Artist</h5>
				<div class="row">
					<div class="input-field col s5">
						<label class="active">Choose from the list</label>
						<select class="browser-default" name="artist_list">
							<option value="" disabled selected>select an artist</option>
							<?php
							for($i = 0;$i<count($artists);$i++)
							{
								?>
								<option value = <?= $artists[$i]['id'] ?>><?= $artists[$i]['artist'] ?></option>
								<?php
							}
							?>
						</select>

					</div>
					<div class="col s2 center">
						<h6>- Or -</h6>
					</div>
					<div class="input-field col s5">
						<input type="text" id="new_artist" name="new_artist">
						<label for="new_artist">Add a new artist</label>
					</div>
				</div>
				<h5>Genre</h5>
				<div class="row">
					<div class="col s5">
						<p>Choose from the list</p>
						<?php
						for($i = 0; $i < count($genres); $i++)
						{
							?>
							<p>
								<input type="checkbox" id="<?= 'genre'.$i ?>" name=<?= 'genre'.$i ?> value=<?= $genres[$i]['id'] ?>>
								<label for="<?= 'genre'.$i ?>"><?= $genres[$i]['genre'] ?></label>
							</p>
							<?php
						}
						?>
					</div>
					<div class="col s2">
						<h6 class="center">- Or -</h6>
					</div>
					<div class="input-field col s5">
						<input type = "text" id="new_genre" name ="new_genre">
						<label for="new_genre">Add a new genre</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type = "text" id="album_cover" name="album_cover">
						<label for="album_cover">Cover art (URL)</label>
					</div>
				</div>
				<div class="row">
					<div class="cover_art col s4">
						<img class="center" src="http://www.crossfitpulse.com/wp-content/uploads/2012/12/question-mark.jpg">
					</div>
					<div class="input-field col s8">
						<label class="active">Description</label>
						<textarea id="description" name="description"></textarea>
					</div>
				</div>
				<button type="submit" class="btn right">Add album</button>
			</form>
		</div>
	</div>
</body>
</html>