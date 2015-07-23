<html>
<head>
	<title><?= $album['title'] ?></title>
</head>
<body>
	<a href="/home">Go Back</a>
	<h3><?= $album['title'] ?></h3>
	<img src=<?= $album['album_cover'] ?>>
	<div>
		<p><?= $album['description'] ?></p>
	</div>
	<div class = 'row'>
		<div>
			<form action = "buy_album" method = "post">
				<select name = 'quantity'>
				<?php
				for($i = 1; $i <= $album['inventory']; $i++)
				{
					?>
					<option value = <?= $i ?>><?= $i.' ($'.$album['price']*$i.')'?></option>
					<?php
				}
				?>
				</select>
				<input type = "hidden" name = "album_id" value = <?= $album['id'] ?>>
				<input type = "submit" value = "Buy">
			</form>
		</div>
	</div>
	<h4>Similar Items</h4>
	<div class = "row">
		<?php
		for($i = 0; $i < 7; $i++)
		{
			if(array_key_exists($i, $albums_of_genres))
			{
				?>
				<div>
					<img src= <?= $albums_of_genres[$i]['album_cover'] ?>>
					<p>$<?= $albums_of_genres[$i]['price'] ?></p>
					<a href=<?= '/album_page/'.$albums_of_genres[$i]['id'] ?>><?= $albums_of_genres[$i]['title'] ?></a>
				</div>
				<?php
			}
			else
			{
				break;
			}
		}
		?>
	</div>
</body>
</html>