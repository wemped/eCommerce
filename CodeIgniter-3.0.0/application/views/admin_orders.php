<html>
<head>
    <title>Admin Orders | eCommerce</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/override.css">
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
    .container .row #status{
        margin-top: 21px;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.collapsible').collapsible();
        $.post('/admin_order_search',function(res){
            $('.table_partial').html(res);
        });
        $("#search").keyup(function(){
            $.post('/admin_order_search',$('#search_form').serialize(),function(res){
                $('.table_partial').html(res);
            });
        });
        $('#status').change(function(){
            $('#form_status').val($(this).val());
            $.post('/admin_order_search',$('#search_form').serialize(),function(res){
                $('.table_partial').html(res);
            });
        });
    });
</script>
</head>
<body>
    <nav>
        <ul class='left'>
            <li><a href="/" class=" brand-logo"><img class="logo" src="/assets/img/logo.png"></a></li>
        </ul>
        <ul class='right'>
            <li><a href="/">Shopping Home</a></li>
            <li><a href="">Logout</a></li>
        </ul>
        <ul id='slide-out' class='side-nav'>
            <li class='no-padding'>
                <ul class='collapsible collapsible-accordian'>
                    <li>
                        <a class='collapsible-header active'>Categories<i class="mdi-navigation-arrow-drop-down"></i></a>
                        <div class='collapsible-body'>
                            <ul>
                                <li><a>Albums</a></li>
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
            <a href="/admin_home" class="right">Return to admin home</a>
            <div class='col s12 l3'>
                <h3> Orders </h3>
            </div>
            <div class='col s6 l6 search'>
                <form method='post' id="search_form">
                    <input type='search' name='keyword' placeholder="Search" id='search'/>
                    <input type='hidden' name='page' value='1' id='page_num'/>
                    <input type='hidden' name='status' value='' id='form_status' />
                </form>
            </div>
            <div class='col s6 l3'>
                <select class='browser-default' id='status'>
                    <option value='' selected='selected'>Show All</option>
                    <option value='p'>Process</option>
                    <option value='s'>Shipped</option>
                    <option value='c'>Complete</option>
                    <option value='d'>Cancled</option>
                </select>
            </div>
            <div class='table_partial'>
            </div>
            </div>
        </div>
    </div>
</body>
</html>