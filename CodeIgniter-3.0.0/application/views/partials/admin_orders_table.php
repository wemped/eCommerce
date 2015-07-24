
<script type="text/javascript">
$(document).ready(function(){
    $('select').material_select();
    $('.page_link').click(function(){
        $('#page_num').val($(this).attr('id'));
        $.post('/admin_orders_search',$('#search_form').serialize(),function(res){
            $('.table_partial').html(res);
        });
    });
    $('.status').change(function(){
        var status = $(this).find(":selected").text();
        var status_key = $(this).find(":selected").val();
        var orderid = $(this).data('orderid');
        var conf = confirm("Are you sure you want to set order " + orderid + "'s status to " + status + "?" );
        if(conf){
            $.post('/admin/edit_status/' + orderid + "/" + status_key);
        }else{
            $.post('/admin_order_search',function(res){
                $('.table_partial').html(res);
            });
        }
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
                    <td>
                        <select class='browser-default status' data-orderid=<?=$order['id']?>>
<?php                   if($order['status'] == 'p'){ ?>
                                <option value='p' selected='selected'>Processing</option>
<?php                   }else{ ?>
                                <option value='p'>Processing</option>
<?php                   }?>
<?php                   if($order['status'] == 's'){ ?>
                              <option value='s' selected='selected'>Shipped</option>
<?php                   }else{ ?>
                              <option value='s'>Shipped</option>
<?php                   }?>
<?php                   if($order['status'] == 'c'){ ?>
                                <option value='c' selected='selected'>Complete</option>
<?php                   }else{ ?>
                                <option value='c'>Complete</option>
<?php                   }?>
<?php                   if($order['status'] == 'd'){ ?>
                                <option value='d' selected='selected'>Cancled</option>
<?php                   }else{ ?>
                                <option value='d'>Canceled</option>
<?php                   }?>
                        </select>
                    </td>
                </tr>
<?php   } ?>
        </tbody>
    </table>
    <!-- <a href='add_product'><button class='btn waves-effect'>New Album</button></a> -->
 </div>
 <?php }else{ ?>
    <h3>No results found</h3>
 <?php } ?>