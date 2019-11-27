<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<div class="style_box2">
    <div class="title_left">
        <h2>Testimonials</h2>
    </div>
    <div id="scrollbox" class="box_full">
        <?php
        if (isset($data_testimoni) and $data_testimoni != 0){
            foreach ($data_testimoni as $row){
                ?>
                <div class="box_full_r">
                    <div class="pic">
                        <img src="<?php echo base_url(); ?>assets/testimoni/<?php echo $row->url_image ?>" alt="">
                    </div>
                    <div class="text">
                        <div class="date"><?php
                            $date = date_format(date_create($row->created_date), 'M d, Y');
                            echo $date;
                            ?></div>
                        <h3 class="name"><?php echo $row->name ?> - <?php echo $row->batch ?></h3>
                        <p><?php $content = strlen($row->content) >= 60 ? substr($row->content, 0, 60)."..." : $row->content;
                        echo $content;
                        ?></p>
                        <a href="<?php echo site_url('site/detailTesti/'.$row->testimoni_id); ?>" title="" class="">Read More</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>