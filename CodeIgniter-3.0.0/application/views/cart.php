<?php
if($this->session->userdata('cart') == null)
{
    redirect('/');
}
var_dump($this->session->userdata('userid'));
var_dump($ship['state']);
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
    <script type="text/javascript" src="/assets/js/cart.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.collapsible').collapsible();

        // var ship = ".ship_states option[value='";
        var ship = "<?= $ship['state'] ?>";
        var bill = "<?= $bill['state'] ?>";
        $('.ship_states').val(ship);
        $('.bill_states').val(bill);

        $.get('/orders/summary_table', function(res) {
            $('div.table').html(res);
        });
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
        <div class="table">
        </div>
        <a class="btn" href="/">Continue Shopping</a>
        <h2 class="border">Checkout</h2>
        <div class="row">
            <form action="/charge" method="POST">
                <div class="col s6">
                    <h4 class="ship">Shipping Info</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="First" id="ship_first_name" name="ship_first_name" type="text" value="<?= $ship['first_name'] ?>">
                            <label for="ship_first_name">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Last" id="ship_last_name" name="ship_last_name" type="text" value="<?= $ship['last_name'] ?>">
                            <label for="ship_last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Address" id="ship_address" name="ship_address" type="text" value="<?= $ship['address'] ?>">
                            <label for="ship_address">Address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Apt/Unit" id="ship_address2" name="ship_address2" type="text" value="<?= $ship['unit'] ?>">
                            <label for="ship_address2">Apt/Unit#</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="City" id="ship_city" name="ship_city" type="text" value="<?= $ship['city'] ?>">
                            <label for="ship_city">City</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select class="req ship_states browser-default" id="ship_state" name="ship_state">
                                <option value="" disabled="disabled">- state -</option>
                                <option value="AK">Alaska - AK</option>
                                <option value="AL">Alabama - AL</option>
                                <option value="AR">Arkansas - AR</option>
                                <option value="AZ">Arizona - AZ</option>
                                <option value="CA">California - CA</option>
                                <option value="CO">Colorado - CO</option>
                                <option value="CT">Connecticut - CT</option>
                                <option value="DC">District of Columbia - DC</option>
                                <option value="DE">Delaware - DE</option>
                                <option value="FL">Florida - FL</option>
                                <option value="GA">Georgia - GA</option>
                                <option value="HI">Hawaii - HI</option>
                                <option value="IA">Iowa - IA</option>
                                <option value="ID">Idaho - ID</option>
                                <option value="IL">Illinois - IL</option>
                                <option value="IN">Indiana - IN</option>
                                <option value="KS">Kansas - KS</option>
                                <option value="KY">Kentucky - KY</option>
                                <option value="LA">Lousiana - LA</option>
                                <option value="MA">Massachusetts - MA</option>
                                <option value="MD">Maryland - MD</option>
                                <option value="ME">Maine - ME</option>
                                <option value="MI">Michigan - MI</option>
                                <option value="MN">Minnesota - MN</option>
                                <option value="MO">Missouri - MO</option>
                                <option value="MS">Mississippi - MS</option>
                                <option value="MT">Montana - MT</option>
                                <option value="NC">North Carolina - NC</option>
                                <option value="ND">North Dakota - ND</option>
                                <option value="NE">Nebraska - NE</option>
                                <option value="NH">New Hampshire - NH</option>
                                <option value="NJ">New Jersey - NJ</option>
                                <option value="NM">New Mexico - NM</option>
                                <option value="NV">Nevada - NV</option>
                                <option value="NY">New York</option>
                                <option value="OH">Ohio - OH</option>
                                <option value="OK">Oklahoma - OK</option>
                                <option value="OR">Oregon - OR</option>
                                <option value="PA">Pennsylvania - PA</option>
                                <option value="RI">Rhode Island - RI</option>
                                <option value="SC">South Carolina - SC</option>
                                <option value="SD">South Dakota - SD</option>
                                <option value="TN">Tennessee - TN</option>
                                <option value="TX">Texas - TX</option>
                                <option value="UT">Utah - UT</option>
                                <option value="VA">Virginia - VA</option>
                                <option value="VT">Vermont - VT</option>
                                <option value="WA">Washington - WA</option>
                                <option value="WI">Wisconsin - WI</option>
                                <option value="WV">West Virginia - WV</option>
                                <option value="WY">Wyoming - WY</option>
                            </select>
                            <label class="active" for="ship_state">State</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Zip" id="ship_zip" name="ship_zip" type="text" value="<?= $ship['zip'] ?>">
                            <label for="ship_zip">Zipcode</label>
                        </div>
                    </div>
                </div>
                <div class="col s6">
                    <h4>Billing Info</h4>
                    <button id="addressmatch" class="btn" type="button">Same as shipping</button>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="First" id="bill_first_name" name="bill_first_name" type="text" value="<?= $bill['first_name'] ?>">
                            <label for="bill_first_name">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Last" id="bill_last_name" name="bill_last_name" type="text" value="<?= $bill['last_name'] ?>">
                            <label for="bill_last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Address" id="bill_address" name="bill_address" type="text" value="<?= $bill['address'] ?>">
                            <label for="bill_address">Address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Apt/Unit" id="bill_address2" name="bill_address2" type="text" value="<?= $bill['unit'] ?>">
                            <label for="bill_address2">Apt/Unit#</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="City" id="bill_city" name="bill_city" type="text" value="<?= $bill['city'] ?>">
                            <label for="bill_city">City</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select class="req bill_states browser-default" id="bill_state" name="bill_state">
                                <option value="" disabled="disabled">- state -</option>
                                <option value="AK">Alaska - AK</option>
                                <option value="AL">Alabama - AL</option>
                                <option value="AR">Arkansas - AR</option>
                                <option value="AZ">Arizona - AZ</option>
                                <option value="CA">California - CA</option>
                                <option value="CO">Colorado - CO</option>
                                <option value="CT">Connecticut - CT</option>
                                <option value="DC">District of Columbia - DC</option>
                                <option value="DE">Delaware - DE</option>
                                <option value="FL">Florida - FL</option>
                                <option value="GA">Georgia - GA</option>
                                <option value="HI">Hawaii - HI</option>
                                <option value="IA">Iowa - IA</option>
                                <option value="ID">Idaho - ID</option>
                                <option value="IL">Illinois - IL</option>
                                <option value="IN">Indiana - IN</option>
                                <option value="KS">Kansas - KS</option>
                                <option value="KY">Kentucky - KY</option>
                                <option value="LA">Lousiana - LA</option>
                                <option value="MA">Massachusetts - MA</option>
                                <option value="MD">Maryland - MD</option>
                                <option value="ME">Maine - ME</option>
                                <option value="MI">Michigan - MI</option>
                                <option value="MN">Minnesota - MN</option>
                                <option value="MO">Missouri - MO</option>
                                <option value="MS">Mississippi - MS</option>
                                <option value="MT">Montana - MT</option>
                                <option value="NC">North Carolina - NC</option>
                                <option value="ND">North Dakota - ND</option>
                                <option value="NE">Nebraska - NE</option>
                                <option value="NH">New Hampshire - NH</option>
                                <option value="NJ">New Jersey - NJ</option>
                                <option value="NM">New Mexico - NM</option>
                                <option value="NV">Nevada - NV</option>
                                <option value="NY">New York</option>
                                <option value="OH">Ohio - OH</option>
                                <option value="OK">Oklahoma - OK</option>
                                <option value="OR">Oregon - OR</option>
                                <option value="PA">Pennsylvania - PA</option>
                                <option value="RI">Rhode Island - RI</option>
                                <option value="SC">South Carolina - SC</option>
                                <option value="SD">South Dakota - SD</option>
                                <option value="TN">Tennessee - TN</option>
                                <option value="TX">Texas - TX</option>
                                <option value="UT">Utah - UT</option>
                                <option value="VA">Virginia - VA</option>
                                <option value="VT">Vermont - VT</option>
                                <option value="WA">Washington - WA</option>
                                <option value="WI">Wisconsin - WI</option>
                                <option value="WV">West Virginia - WV</option>
                                <option value="WY">Wyoming - WY</option>
                            </select>
                            <label class="active" for="bill_state">State</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="req" placeholder="Zip" id="bill_zip" name="bill_zip" type="text" value="<?= $bill['zip'] ?>">
                            <label for="bill_zip">Zipcode</label>
                        </div>
                    </div>
                </div>
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button right"
                    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
                    data-image="/img/documentation/checkout/marketplace.png"
                    data-name="TuneSphere"
                    data-description="Checkout Payment"
                    data-amount="<?= $this->session->userdata('order_total')*100 ?>">
                </script>
            </form>
        </div>
    </div>
</body>
</html>