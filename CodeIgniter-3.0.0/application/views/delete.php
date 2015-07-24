<html>
<head>
	<title>Delete Album</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <script type="text/javascript">
            $(document).ready(function(){
                $.post('/load_nav',function(res){
                    $('#navbar').html(res);
                });
            });
            </script>
</head>
<body>
            <div id='navbar'>
            </div>
	<h2>Are you sure you want to delete <?= $album['title'] ?>?</h2>
	<a href=<?= '/delete_album/'.$album['id'] ?>><button class='btn'>Yes</button></a>
	<a href="/"><button class='btn'>No</button></a>
</body>
</html>