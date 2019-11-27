<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

<div class="style_box1">
    <div class="title_left">
        <h2>Editorial Picks</h2>
    </div>
    <div id="loadEditorial" class="box_full">
        <?php
        if (isset($data_editorial) and $data_editorial != 0){
            foreach ($data_editorial as $row){
                ?>
                <div class="box_full_l slot1">
                    <div class="pic">
                        <img src="<?php echo base_url(); ?>assets/editorial/<?php echo $row->url_image ?>" alt="">
                    </div>
                    <div class="text">
                        <div class="date"><?php
                            $date = date_format(date_create($row->created_date), 'M d, Y');
                            echo $date;
                            ?></div>
                        <h3><?php echo $row->title ?></h3>
                        <p><?php $content = strlen($row->content) >= 80 ? substr($row->content, 0, 80)."..." : $row->content;
                        echo $content;
                        ?></p>
                        <a href="<?php echo site_url('site/detailTips/'.$row->tipsntrick_id); ?>" title="">Read More</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <a class="bt_more" id="btnEMore">
        <span>More</span>
    </a>
    <div id="loadE" class="ajax-load text-center" style="display:none">
        <p><img src="<?php echo base_url(); ?>assets/icon/loader.gif">Loading More post</p>
    </div>
</div>