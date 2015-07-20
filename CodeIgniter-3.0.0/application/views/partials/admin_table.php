
<script type="text/javascript">
$(document).ready(function(){
    $('.page_link').click(function(){
        //console.log($(this).attr('id'));
        $('#page_num').val($(this).attr('id'));
        $.post('/admin_table_search',$('#search_form').serialize(),function(res){
            $('.table_partial').html(res);
        });
    });
});
</script>

<div class='row'>
    <div class='col s12 l6 offset-l6'>
        <ul class='pagination right'>
            <!-- <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li> -->
<?php   for ($i = 1; $i<=$num_pages; $i++) {
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
<?php if(sizeof($products)>0){ ?>
    <table>
        <thead>
            <tr>
                <th>PREVIEW</th>
                <th>ID</th>
                <th>NAME</th>
                <th># INVENTORY</th>
                <th># SOLD</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
<?php   foreach ($products as $product) { ?>
                <tr>
                    <td>
                        <div >
                            <img class='preview_img' src=<?="'" . $product['img_src'] . "'"?>
                        </div>
                    </td>
                    <td><?=$product['id']?></td>
                    <td><?=$product['name']?></td>
                    <td><?=$product['quantity']?></td>
                    <td><?=$product['sold']?></td>
                    <td>
                        <a href=<?="'edit/product/" . $product['id'] . "'"?>>edit</a>
                        <a href=<?="'remove/product/" . $product['id'] . "'"?>>remove</a>
                    </td>
                </tr>
<?php   } ?>
        </tbody>
    </table>
    <a href='add_product'><button class='btn waves-effect'>New Product</button></a>
 </div>
 <?php }else{ ?>
    <h3>No results found</h3>
 <?php } ?>