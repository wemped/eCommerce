<html>
<head>
	<title>test</title>
</head>
<body>
	<a href="/add_album_page">Add Album</a>
	<?php
	var_dump($albums);
	echo $this->session->flashdata("delete_success");
	echo $this->session->flashdata("album_success");
	?>
	<table>
		<tr>
			<td>Picture</td>
			<td>ID</td>
			<td>Title</td>
			<td>Artist</td>
			<td>Genre</td>
			<td>Inventory</td>
			<td>action</td>
		</tr>
		<?php
		for($i = 0; $i < count($albums); $i++)
		{
			?>
			<tr>
				<td>PICTURE</td>
				<td><?= $albums[$i]['id'] ?></td>
				<td><?= $albums[$i]['title'] ?></td>
				<td><?= $albums[$i]['artist'] ?></td>
				<td><?= $albums[$i]['genre'] ?></td>
				<td><?= $albums[$i]['inventory'] ?></td>
				<td><a href=<?= '/edit_album_page/'.$albums[$i]['id'] ?>>edit</a>   <a href=<?= '/delete_album_page/'.$albums[$i]['id'] ?>>delete</a></td>
			</tr>
			<?php
		}
		?>
	</table>
</body>
</html>