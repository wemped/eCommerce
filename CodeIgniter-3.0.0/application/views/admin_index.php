<html>
<head>
    <title>Admin | eCommerce</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.collapsible').collapsible();
        $.post('/admin_table_search',function(res){
            $('.table_partial').html(res);
        });
        $("#search").keyup(function(){
            $.post('/admin_table_search',$('#search_form').serialize(),function(res){
                $('.table_partial').html(res);
            });
        });
    });
</script>
</head>
<body>
    <nav>
        <ul class='left'>
            <li><a href="/admin_orders">Orders</a></li>
        </ul>
        <ul class='right'>
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
    <div class='container'>
        <div class='row'>
            <div class='col s12 l3'>
                <h3> Albums </h3>
            </div>
            <div class='col s6 l6 search'>
                <form method='post' id="search_form">
                    <input type='search' name='keyword' placeholder="Search" id='search'/>
                    <input type='hidden' name='page' value='1' id='page_num'/>
                </form>
            </div>
            <div class='col s6 l3'>
                <a href='/add_album_page'><button class='btn'>Add Album</button></a>
            </div>
            <div class='table_partial'>
            </div>
            </div>
        </div>
    </div>

</body>
</html>