<html>
<head>
    <title><?= $album['title'] ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript">
    </script>
    <style type="text/css">
    .container .row .album-artist {
        margin-top: 1px;
    }
   .container .row img{
        width: 100%;
    }
    .container .row .similar-album p{
        margin: 0px;
        padding: 0px;
        color: black;
    }
    .container .row .similar-album .similar-artist {
        color:silver;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
        $.post('/load_nav',function(res){
            $('#navbar').html(res);
        });
        $('select').material_select();
    });
    </script>
</head>
<body>
    <div id = 'navbar'>
    </div>
    <div class='container'>
        <div class='row valign-wrapper'>
            <div class='col s6 album-title'>
                <h2 class='right valign'><?=$album['title']?></h2>
            </div>
            <div class='col s6 album-artist'>
                <h3 class='light left valign'><?=$album['artist']?></h3>
            </div>
        </div>
        <div class='row'>
            <div class='col s4'>
                <img src=<?=$album['img_src']?> class='album-img' />
            </div>
            <div class='col s8 offset-m2 m2'>
                <form action = 'buy_album' method='post'>
                    <div class='input-field'>
                        <select name='quantity' class='browser-default'>
<?php               for($i=1; $i <= $album['inventory']; $i++){ ?>
                            <option value=<?= $i ?>><?= $i . " -  $" . $album['price']*$i?></option>
<?php               } ?>
                        </select>
                    </div>
                    <input type='hidden' name='album_id' value = <?= $album['id'] ?> />
                    <button type='submit' class='btn right'>Add to cart</button>
                </form>
            </div>
        </div>
        <div class='row'>
            <div class='col s8 offset-s2'>
                <p class='light'><?=$album['description']?></p>
            </div>
        </div>
        <div class='row'>
            <h4>Similar Items</h4>
            <div class='row'>
<?php
            if(sizeof($similar_albums)>0){
                for($i = 0; $i < 6; $i++)
                {
                    if(array_key_exists($i, $similar_albums))
                    {
                        ?>
                        <div class='col s4 m2 similar-album'>
                            <a href=<?= '/album_page/'.$similar_albums[$i]['id'] ?>>
                                <img src= <?= $similar_albums[$i]['img_src'] ?>>
                                <p>$<?= $similar_albums[$i]['price'] ?></p>
                                <p><?= $similar_albums[$i]['title'] ?></p>
                                <p class='similar-artist'><?= $similar_albums[$i]['artist'] ?></p>
                            </a>
                        </div>
                        <?php
                    }
                    else
                    {
                        break;
                    }
                }
            } else{ ?>
                <h5 class='light'>No similar items</h5>
 <?php }  ?>
            </div>
        </div>
    </div>
</body>
</html>