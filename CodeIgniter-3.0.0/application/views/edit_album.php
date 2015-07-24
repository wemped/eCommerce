<html>
<head>
    <title>Edit Album</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/override.css">
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
    	height: 150px;
    }
    </style>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('select').material_select();
            $.post('/load_nav',function(res){
                $('#navbar').html(res);
            });
            $('#album_cover').change(function(){
    			var str = $('#album_cover').val();
    			$('div.cover_art img').attr('src', str);
    		});
    	});
    </script>
</head>
<body>
    <nav>
        <ul class='left'>
        	<li><a href="/" class=" brand-logo"><img class="logo" src="/assets/img/logo.png"></a></li>
        </ul>
        <ul class='right'>
        	<li><a href="/admin_orders">Orders</a></li>
        	<li><a href="/">Shopping Home</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
        <ul id='slide-out' class='side-nav'>
            <li class='no-padding'>
                <ul class='collapsible collapsible-accordian'>
                    <li>
                        <a class='collapsible-header active'>Categories<i class="mdi-navigation-arrow-drop-down"></i></a>
                        <div class='collapsible-body'>
                            <ul>
                                <li><a>Orders</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <a href='' data-activates='slide-out' class='button-collapse hide-on-large-only'><i class='mdi-navigation-menu'></i></a>
    </nav>
	<?php
	echo $this->session->flashdata("errors");
	echo $this->session->flashdata("genre_error");
	echo $this->session->flashdata("artist_error");
	?>
	<div class = "container">
		<a href="/admin_home" class="right">Return to admin home</a>
		<h3>Edit Album</h3>
		<form action = "edit_album" method = "post">
			<h5>Album Information</h5>
			<div class = "row">
				<div class = "input-field col s12">
					<label class = "active" for = "title">Album title</label>
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
			<h5>Artist</h5>
			<div class = "row">
				<div class = "input-field col s5">
					<label class = "active">Choose from the list</label>
					<select class="browser-default" name = "artist_list">
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
				<div class="col s2 center">
					<h6>- Or -</h6>
				</div>
				<div class = "input-field col s5">
					<label >Add a new artist</label>
					<input type = "text" name = "new_artist">
				</div>
			</div>
			<h5>Genre</h5>
			<div class = "row">
				<!-- <div class = "col s3"> -->
				<div class="col s5">
<?php 			$open = TRUE;
				$len = count($all_genres);
				$half = ceil($len/2);
				$counter = 0;
				for($i = 0; $i < $len; $i++)
				{
					if($open == TRUE)
					{?>
						<div class = "col s6">
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
						<p>
							<input type = "checkbox" id = "<?= 'genre'.$all_genres[$i]['id']?>" name = <?= 'genre'.$i ?> value = <?= $all_genres[$i]['id'] ?> checked = "checked">
							<label for = "<?= 'genre'.$all_genres[$i]['id']?>"><?= $all_genres[$i]['genre'] ?></label>
						</p>
<?php 				}
					else
					{?>
						<p>
							<input type = "checkbox" id = "<?= 'genre'.$all_genres[$i]['id']?>" name = <?= 'genre'.$i ?> value = <?= $all_genres[$i]['id'] ?>>
							<label for = "<?= 'genre'.$all_genres[$i]['id']?>"><?= $all_genres[$i]['genre'] ?></label>
						</p>
<?php 				}
					if($counter == $half)
					{?>
						</div>
<?php 					$open = TRUE;
					}
				}?>
						</div>
					</div>
				<!-- </div> -->
				<div class="col s2 center">
					<h6>- Or -</h6>
				</div>
				<div class = "input-field col s5">
					<label>Add a new genre</label>
					<input type = "text" name = "new_genre">
				</div>
			</div>
			<div class = "row">

			</div>
			<div class = "row">
				<div class = " cover_art col s3">
					<p>Current Album Cover</p>
					<img src=<?= $album['img_src'] ?> class = "album_cover">
				</div>
				<div class = "col s9">
					<label class = "active" for = "album_cover">Cover art (URL)</label>
					<input id = "album_cover" type = "text" name = "album_cover" value = "<?= $album['img_src'] ?>">
					<label class = "active" for = "description">Description</label>
					<textarea id = "description" name = "description" ><?= $album['description'] ?></textarea>
				</div>
			</div>
			<input type = "hidden" name = "album_id" value = <?= $album['id'] ?>>
			<button class = "btn right" type = "submit">Save Changes</button>
		</form>
	</div>
</body>
</html>