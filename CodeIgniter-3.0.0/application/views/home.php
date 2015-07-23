<html>
<head>
	<title>test</title>
</head>
<body>
	<a href="/add_album_page">Add Album</a>
	<?php
	echo $this->session->flashdata("delete_success");
	echo $this->session->flashdata("album_success");
	var_dump($this->session->userdata('cart'));
	?>
	<table>
		<tr>
			<td>Picture</td>
			<td>ID</td>
			<td>Title</td>
			<td>Artist</td>
			<td>Genre</td>
			<td>Inventory</td>
			<td>Price</td>
			<td>Number sold</td>
			<td>action</td>
		</tr>
		<?php
		for($i = 0; $i < count($albums); $i++)
		{
			?>
			<tr>

				<td>PICTURE</td>
				<td><?= $albums[$i]['id'] ?></td>
				<td><a href=<?= '/album_page/'. $albums[$i]['id']?>><?= $albums[$i]['title'] ?></a></td>
				<td><?= $albums[$i]['artist'] ?></td>
				<td><?= $albums[$i]['genre'] ?></td>
				<td><?= $albums[$i]['inventory'] ?></td>
				<td>$<?= $albums[$i]['price'] ?></td>
				<td><?= $albums[$i]['sold'] ?></td>
				<td><a href=<?= '/edit_album_page/'.$albums[$i]['id'] ?>>edit</a>   <a href=<?= '/delete_album_page/'.$albums[$i]['id'] ?>>delete</a></td>
			</tr>
			<?php
		}
		?>
	</table>
</body>
</html>