<html>
<head>
	<title><?= $album['title'] ?></title>
</head>
<body>
	<a href="">Go Back</a>
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
				<input type = "submit" value = "Buy">
			</form>
		</div>
	</div>
	<h4>Similar Items</h4>
	<div class = "row">
		
	</div>
</body>
</html>