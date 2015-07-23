<html>
<head>
    <title>Home | eCommerce</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
    .container .row .card .collapsible-body ul>li {
        padding: 3% 15%;
    }
    .container .row .small-search{
        margin-top: 15px;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.collapsible').collapsible();
        $.post('/album_table_search',function(res){
            $('#main-content').html(res);
        });
        $('.collapsible').collapsible({
            accordion : false
        });
        $(".small-search").keyup(function(){
            $('#main_search').val($(this).val());
            $.post('/album_table_search',$('#search_form').serialize(),function(res){
                $('#main-content').html(res);
            });
        });
        $(".search").keyup(function(){
            $.post('/album_table_search',$('#search_form').serialize(),function(res){
                $('#main-content').html(res);
            });
        });
        $(".artist").click(function(){
            $('#form_artist').val($(this).attr('data-artistid'));
            console.log($('#form_artist').val());
            $.post('/album_table_search',$('#search_form').serialize(),function(res){
                $('#main-content').html(res);
            });
        });
        $(".genre").click(function(){
            $('#form_genre').val($(this).attr('data-genreid'));
            console.log($('#form_genre').val());
            $.post('/album_table_search',$('#search_form').serialize(),function(res){
                $('#main-content').html(res);
            });
        });
    });
</script>
</head>
<body>
    <nav>
        <a href="" class=" brand-logo">Website Title</a>
        <ul class='right'>
            <li><a href="">Login</a></li>
            <li><a href="/cart">Shopping Cart (<?= count($this->session->userdata("cart")) ?>)</a></li>
        </ul>
        <ul id='slide-out' class='side-nav'>
            <li class='no-padding'>
                <ul class='collapsible collapsible-accordian'>
                    <li>
                        <a class='collapsible-header'>Artists<i class="mdi-navigation-arrow-drop-down"></i></a>
                        <div class='collapsible-body'>
                            <ul>
<?php                      foreach ($artists as $artist) { ?>
                                    <li><a class='artist' data-artistid=<?=$artist['id']?>><?=$artist['artist']?></a></li>
<?php                      } ?>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class='collapsible-header active'>Genres<i class="mdi-navigation-arrow-drop-down"></i></a>
                        <div class='collapsible-body'>
                            <ul>
<?php                      foreach ($genres as $genre) { ?>
                                    <li><a class='genre' data-genreid=<?=$genre['id']?>><?=$genre['genre']?></a></li>
<?php                      } ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <a href='' data-activates='slide-out' class='button-collapse hide-on-large-only'><i class='mdi-navigation-menu'></i></a>
    </nav>
    <?php /*var_dump($artists);
    var_dump($genres);*/ ?>
    <div class='container'>
        <div class='row'>
            <div class='col s3'>
                <h3> Albums </h3>
            </div>
            <div class='col s8 offset-s1 hide-on-large-only'>
                <input type='search' class='small-search search' placeholder='Search'/>
            </div>
        </div>
        <div class='row'>
            <div class='col l3 hide-on-med-and-down card'>
                <p>
                    <form id="search_form">
                        <input type='search' class='search' placeholder='Search' id='main_search' name='keyword'/>
                        <input type='hidden' name='page' value='1' id='page_num'/>
                        <input type='hidden' name='artistid' id='form_artist' value=''/>
                        <input type='hidden' name='genreid' id='form_genre' value=''/>
                    </form>
                    <!-- <h5>Categories</h5> -->
                    <ul class='collapsible z-depth-0' data-collapsible='accordian'>
                        <li>
                            <div class='collapsible-header'>Artists</div>
                            <div class='collapsible-body'>
                                <ul>
<?php                      foreach ($artists as $artist) { ?>
                                    <li><a class='artist' data-artistid=<?=$artist['id']?>><?=$artist['artist']?></a></li>
<?php                      } ?>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class='collapsible-header active'>Genres</div>
                            <div class='collapsible-body'>
                                <ul>
<?php                      foreach ($genres as $genre) { ?>
                                    <li><a class='genre' data-genreid=<?=$genre['id']?>><?=$genre['genre']?></a></li>
<?php                      } ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </p>
            </div>
            <div class='col l8 offset-l1 s12' id='main-content'>
            </div>
        </div>
    </div>

</body>
</html>