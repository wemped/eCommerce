<?php

?>
<html>
<head>
    <title>Login | eCommerce</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/override.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.collapsible').collapsible();
        $.post('/load_nav',function(res){
            $('#navbar').html(res);
        });
    });
</script>
</head>
<body>
    <div id='navbar'>
    </div>
    <div class="container">
        <div class="row">
    <!-- Registration -->
            <div class="col s6">
                <h3>Register</h3>
<?php
if($this->session->flashdata('reg_error'))
{ ?>
                <div class="error">
                    <?= $this->session->flashdata('reg_error') ?>
                </div>
<?php
}
?>
                <form action="/register" method="post">
                    <input type="hidden" name="formid" value="register" />
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="First" id="first_name" name="first_name" type="text" class="validate">
                            <label for="first_name">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Last" id="last_name" name="last_name" type="text" class="validate">
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" name="email" class="validate" placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" name="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="confirm" name="confirm" type="password" class="validate">
                            <label for="confirm">Confirm Password</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light right" type="submit">Register</button>
                </form>
            </div>
    <!-- Login -->
            <div class="col s6">
                <h3>Login</h3>
<?php
if($this->session->flashdata('login_error'))
{ ?>
                <div class="error">
                    <?= $this->session->flashdata('login_error') ?>
                </div>
<?php
} ?>
                <form action="/login" method="post">
                    <input type="hidden" name="formid" value="login" />
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="email" class="validate" placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" name="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light right" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>