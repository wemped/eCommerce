<html>
<head>
	<title>test</title>
</head>
<body>
	<a href="/add_album_page">Add Album</a>
	<?php
	echo $this->session->flashdata("album_success");
	var_dump($albums);
	var_dump($artists);
	var_dump($genres);
	?>
</body>
</html>