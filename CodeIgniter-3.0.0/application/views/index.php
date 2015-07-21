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
    .container .row .main-content{
        margin-top: 8px;
        padding:  0px 35px;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.collapsible').collapsible();
    });
</script>
</head>
<body>
    <nav>
        <a href="" class=" brand-logo">Website Title</a>
        <ul class='right'>
            <li><a href="">Login</a></li>
            <li><a href="">Shopping Cart (2)</a></li>
        </ul>
        <ul id='slide-out' class='side-nav'>
            <li class='no-padding'>
                <ul class='collapsible collapsible-accordian'>
                    <li>
                        <a class='collapsible-header active'>Categories<i class="mdi-navigation-arrow-drop-down"></i></a>
                        <div class='collapsible-body'>
                            <ul>
                                <li><a>Cat 1</a></li>
                                <li><a>Cat 2</a></li>
                                <li><a>Cat 3</a></li>
                                <li><a>Cat 4</a></li>
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
            <h3> Products </h3>
            <div class='col l2 hide-on-med-and-down card'>
                <p>
                    <form>
                        <input type='search' placeholder='search products'/>
                    </form>
                    <h5>Categories</h5>
                    <ul>
                        <li class='hoverable'><a href=''>Cat 1</li>
                        <li class='hoverable'>Cat 2</li>
                        <li class='hoverable'>Cat 3</li>
                        <li class='hoverable'>Cat 4</li>
                    </ul>
                </p>
            </div>
            <div class='col l9 offset-l1 s12 main-content'>
                <div class='row'>
                    <ul class='pagination right'>
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class='active'><a href="">1</a></li>
                        <li class='waves-effect'><a href="">2</a></li>
                        <li class='waves-effect'><a href="">3</a></li>
                        <li class='waves-effect'><a href="">4</a></li>
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul>
                </div>
                <!-- This will be a partial -->
                <div class='row'>
                    <p>
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                        This will be main content
                    </p>
                 </div>
                 <!-- End partial -->
            </div>
        </div>
    </div>

</body>
</html>