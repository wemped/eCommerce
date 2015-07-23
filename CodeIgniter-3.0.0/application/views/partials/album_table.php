
<script type="text/javascript">
$(document).ready(function(){
    $('.page_link').click(function(){
        $('#page_num').val($(this).attr('id'));
        $.post('/album_table_search',$('#search_form').serialize(),function(res){
            $('.table_partial').html(res);
        });
    });
});
</script>
<style type="text/css">
.container .row .album{
    vertical-align: bottom;
}
    .container .row .album img{
        width: 100%;
    }
    .container .row .album .album-title{
        color: black;
        margin: 0px;
    }
    .container .row .album .album-artist{
        color:silver;
        margin: 0px;
    }
</style>
<div class='row'>
    <div class='col s12 l6 offset-l6'>
        <ul class='pagination right'>
<?php for ($i = 1; $i<=$num_pages; $i++) {
                if($i == $curr_page){ ?>
                    <li class='active page_link' id=<?=$i?>><a href='#'><?=$i?></a></li>
<?php      }else{?>
                    <li class='waves-effect page_link' id=<?=$i?>><a href="#"><?=$i?></a></li>
<?php   }
            } ?>
        </ul>
    </div>
</div>
<?php
if($this->session->flashdata('err')){
    echo $this->session->flashdata('err');
} ?>

<?php $cnt = 0;
if(sizeof($albums)>0){
    foreach ($albums as $album) {
        if($cnt % 3 == 0){?>
            <div class='row'>
 <?php }?>

        <div class='col s4 album' data-albumid=<?=$album['id']?>>
            <a href=<?="album_page/{$album['id']}"?>>
                <img src=<?=$album['img_src']?> />
                <p class='album-title'><?=$album['title']?></p>
                <p class='album-artist'><?=$album['artist']?></p>
            </a>
        </div>
<?php if($cnt % 3 == 2){ ?>
            </div>
<?php }?>
<?php $cnt++;
    }
}else{?>
    <h3>No results found</h3>
 <?php } ?>