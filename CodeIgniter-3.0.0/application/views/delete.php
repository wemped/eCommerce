<html>
<head>
	<title>Delete Album</title>
</head>
<body>
	<h2>Are you sure you want to delete <?= $album['title'] ?>?</h2>
	<a href=<?= '/delete_album/'.$album['id'] ?>><button>Yes</button></a>
	<a href="/"><button>No</button></a>
</body>
</html>