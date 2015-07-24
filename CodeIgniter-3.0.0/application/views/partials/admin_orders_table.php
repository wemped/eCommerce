
<script type="text/javascript">
$(document).ready(function(){
    $('.page_link').click(function(){
        $('#page_num').val($(this).attr('id'));
        $.post('/admin_orders_search',$('#search_form').serialize(),function(res){
            $('.table_partial').html(res);
        });
    });
});
</script>

<div class='row'>
    <div class='col s12 l6 offset-l6'>
        <ul class='pagination right'>
            <!-- <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li> -->
<?php for ($i = 1; $i<=$num_pages; $i++) {
                if($i == $curr_page){ ?>
                    <li class='active page_link' id=<?=$i?>><a href='#'><?=$i?></a></li>
<?php      }else{?>
                    <li class='waves-effect page_link' id=<?=$i?>><a href="#"><?=$i?></a></li>
<?php   }
            } ?>
            <!-- <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li> -->
        </ul>
    </div>
</div>
<?php
//var_dump($curr_page);
if($this->session->flashdata('err')){
    echo $this->session->flashdata('err');
} ?>
<div class='row'>
<?php if(sizeof($orders)>0){ ?>
    <table>
        <thead>
            <tr>
                <th>ORDER ID</th>
                <th>NAME</th>
                <th>DATE</th>
                <th>BILLING ADDRESS</th>
                <th>TOTAL</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
<?php   foreach ($orders as $order) { ?>
                <tr class='hoverable'>
                    <td><a href=<?="order/" . $order['id']?>><?=$order['id']?></a></td>
                    <td><?=$order['first_name'] . ' ' . $order['last_name']?></td>
                    <td><?=$order['created_at']?></td>
                    <td><?=$order['unit'] . ' ' . $order['address'] . ' ' . $order['city'] . ' ' . $order['state'] . ' ' . $order['zip'] ?></td>
                    <td><?=$order['total']?></td>
                    <td><?= $order['status'] ?></td>
                </tr>
<?php   } ?>
        </tbody>
    </table>
    <!-- <a href='add_product'><button class='btn waves-effect'>New Album</button></a> -->
 </div>
 <?php }else{ ?>
    <h3>No results found</h3>
 <?php } ?>