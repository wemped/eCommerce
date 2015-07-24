<nav>
    <a href="/" class=" brand-logo"><i class=' medium material-icons'>play_circle_outline</i></a>
        <ul class='right'>
<?php  if($this->session->userdata('userid')){ ?>
            <li><a href="/logout">Logout</a></li>
<?php  }else{ ?>
            <li><a href="/login">Login</a></li>
<?php  } ?>
<?php  if(empty($this->session->userdata("cart"))){ ?>
                <li><a href="#">Shopping Cart (0)</a></li>
<?php } else { ?>
                <li><a href="/cart">Shopping Cart (<?= count($this->session->userdata("cart")) ?>)</a></li>
<?php } ?>
        </ul>
</nav>