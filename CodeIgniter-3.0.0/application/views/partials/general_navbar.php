<nav>
    <a href="/" class=" brand-logo"><img class="logo" src="/assets/img/logo.png"></a>
        <ul class='right'>
<?php if($this->session->userdata('admin') == 1){ ?>
			<li><a href="/admin_home">Admin Home</a></li>
<?php } ?>
<?php  if($this->session->userdata('userid') > 0){ ?>
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