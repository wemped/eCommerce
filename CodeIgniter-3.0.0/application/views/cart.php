<?php
var_dump($this->session->userdata());
?>
<html>
<head>
    <title>Checkout | eCommerce</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/override.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script type="text/javascript" src="/assets/js/address.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.collapsible').collapsible();
    });
    </script>
</head>
<body>
<!--  Temp Nav -->
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo"><img class="logo" src="/assets/img/logo.png"></a>
        </div>
    </nav>
    <div class="container">
        <table class="striped responsive-table">
            <thead>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </thead>
            <tbody>
<?php

?>
            </tbody>
        </table>
        <div class="row">
            <form action="/charge" method="POST">
                <div class="col s6">
                    <h3 class="ship">Shipping Information</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="First" id="ship_first_name" name="ship_first_name" type="text" value="<?= $this->session->userdata('first_name') ?>">
                            <label for="ship_first_name">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Last" id="ship_last_name" name="ship_last_name" type="text" value="<?= $this->session->userdata('last_name') ?>">
                            <label for="ship_last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Address" id="ship_address" name="ship_address" type="text">
                            <label for="ship_address">Address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Apt/Unit" id="ship_address2" name="ship_address2" type="text">
                            <label for="ship_address2">Apt/Unit#</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="City" id="ship_city" name="ship_city" type="text">
                            <label for="ship_city">City</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select class="req states browser-default" id="ship_state" name="ship_state">
                            </select>
                            <label class="active" for="ship_state">State</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Zip" id="ship_zip" name="ship_zip" type="text">
                            <label for="ship_zip">Zipcode</label>
                        </div>
                    </div>
                </div>
                <div class="col s6">
                    <h3>Billing Information</h3>
                    <button id="addressmatch" class="btn right" type="button">Same as shipping</button>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="First" id="bill_first_name" name="bill_first_name" type="text" value="<?= $this->session->userdata('first_name') ?>">
                            <label for="bill_first_name">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Last" id="bill_last_name" name="bill_last_name" type="text" value="<?= $this->session->userdata('last_name') ?>">
                            <label for="bill_last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Address" id="bill_address" name="bill_address" type="text">
                            <label for="bill_address">Address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Apt/Unit" id="bill_address2" name="bill_address2" type="text">
                            <label for="bill_address2">Apt/Unit#</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="City" id="bill_city" name="bill_city" type="text">
                            <label for="bill_city">City</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select class="req states browser-default" id="bill_state" name="bill_state">
                            </select>
                            <label class="active" for="bill_state">State</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Zip" id="bill_zip" name="bill_zip" type="text">
                            <label for="bill_zip">Zipcode</label>
                        </div>
                    </div>
                    <!-- <button class="btn waves-effect waves-light right" type="submit">Pay</button> -->
                </div>
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button right"
                    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
                    data-image="/img/documentation/checkout/marketplace.png"
                    data-name="TuneSphere"
                    data-description="Checkout Payment"
                    data-amount="2000">
                </script>
            </form>
        </div>
    </div>
</body>
</html>