<html>
<head>
	<title>Order</title>
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
    .customer_info{
    	border: 2px solid black;
    }
    .customer_info p{
    	padding-left: 5px;
    }
    .bold{
    	font-weight: bold;
    }
    .column_names{
    	border-bottom: 1px solid silver;
    }
    .column_names td{
    	font-weight: bold;
    }
    .p {
    	background-color: #b3e5fc;
    	display: inline-block;
    	vertical-align: top;
    	border: 1px solid black;
    	padding-left: 5px;
    	padding-right: 5px;
    }
    .s {
    	background-color: #fff59d;
    	display: inline-block;
    	vertical-align: top;
    	border: 1px solid black;
    	padding-left: 5px;
    	padding-right: 5px;
    }
    .c {
    	background-color: #b2ff59;
    	display: inline-block;
    	vertical-align: top;
    	border: 1px solid black;
    	padding-left: 5px;
    	padding-right: 5px;
    }
    .d {
    	background-color: #f44336;
    	display: inline-block;
    	vertical-align: top;
    	border: 1px solid black;
    	padding-left: 5px;
    	padding-right: 5px;
    }
    .total{
    	display: inline-block;
    	margin-left: 220px;
    	border: 1px solid black;
    	padding-left: 5px;
    	padding-right: 5px;
    }
    .table{
    	margin-bottom: 20px;
    }
    .order_id_title{
    	color: #2bbbad;
    }
     </style>
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
	<div class = "container">
		<h3 class = "order_id_title">Order ID: <?= $order[0]['id'] ?></h3>
		<div class = "row">
			<div class = "col s4">
				<div class = "customer_info">
					<p class = "bold">Cutomer shipping info:</p>
					<p>Name: <?= $ship['first_name'].' '.$ship['last_name'] ?></p>
					<p>Address: <?= $ship['address'] ?></p>
					<p>City: <?= $ship['city'] ?></p>
					<p>State: <?= $ship['state'] ?></p>
					<p>Zip: <?= $ship['zip'] ?></p>
					<br>
					<p class = "bold">Cutomer shipping info:</p>
					<p>Name: <?= $bill['first_name']. ' '.$bill['last_name'] ?></p>
					<p>Address: <?= $bill['address'] ?></p>
					<p>City: <?= $bill['city'] ?></p>
					<p>State: <?= $bill['state'] ?></p>
					<p>Zip: <?= $bill['zip'] ?></p>
				</div>
			</div>
			<div class = "col s8">
				<div class = "table">
					<table>
						<tr class = "column_names">
							<td>ID</td>
							<td>Album</td>
							<td>Price</td>
							<td>Quantity</td>
							<td>Total</td>
						</tr>
						<?php
						$total = 0;
						for($i = 0; $i < count($order); $i++)
						{
							?>
							<tr>
								<td><?= $order[$i]['album_id'] ?></td>
								<td><?= $order[$i]['title'] ?></td>
								<td>$<?= $order[$i]['price'] ?></td>
								<td><?= $order[$i]['quantity'] ?></td>
								<td>$<?= $order[$i]['price']*$order[$i]['quantity'] ?></td>
							</tr>
							<?php
							$total += $order[$i]['price']*$order[$i]['quantity'];
						}
						?>
					</table>
				</div>
<?php 			if($order[0]['state'] == 'p')
				{
					$order_state = 'Order in process';
				}
				else if($order[0]['state'] == 'c')
				{
					$order_state = 'Order completed';
				}
				else if($order[0]['state'] == 'd')
				{
					$order_state = "Order deleted";
				}
				else
				{
					$order_state = 'Order shipped';
				} ?>
				<div class = <?= $order[0]['state'] ?>>
					<p>Status: <?= $order_state ?></p>
				</div>
				<div class = "total">
					<p>Sub Total: $<?= $total ?></p>
					<p>Shipping: $2.00</p>
					<p>Total: $<?= $total+2 ?></p>
				</div>
			</div>
		</div>
		<div class = "row">
			<div class = "col s2 offset-s10">
				<a href="/admin_orders">Back to Orders</a>
			</div>
		</div>
	</div>
</body>
</html>