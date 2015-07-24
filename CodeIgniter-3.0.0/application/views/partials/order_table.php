<?php
if($this->session->userdata('cart'))
{ ?>
<h2>Order Summary</h2>
<table class="striped responsive-table">
    <thead>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </thead>
    <tbody>
<?php
$cart = $this->session->userdata('cart');
$order_total = 0;
foreach($products as $album)
{
    $quantity = $cart[$album['id']];
    $str = $quantity." <img data-album='".$album['id']."' class='small add' src='/assets/img/round_plus.png'>";
    if($quantity > 1)
    {
        $str .= " <img data-album='".$album['id']."' class='small minus' src='/assets/img/round_minus.png'>";
    }
    $str .= " <img data-album='".$album['id']."' class='small trash' src='/assets/img/trash.png'>";
    $total = $quantity * $album['price'];
    $order_total += $total;
?>
                <tr>
                    <td><img class="checkout" src="<?= $album['album_cover'] ?>"><p class="center"><?= $album['title'] ?></p></td>
                    <td>$<?= $album['price'] ?></td>
                    <td><?= $str ?></td>
                    <td>$<?= $total ?></td>
                </tr>
<?php
}
?>
    </tbody>
</table>
<p>Total: $<?= $order_total ?></p>
<?php
}
$this->session->set_userdata('order_total', $order_total);
?>