    <?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
    <div class="frame article">
        <div class="title_left">
            <h2>Activities</h2>
        </div>
        <div class="wrap">
            <div class="box_full" id="loadActivity">
                <?php
                if (isset($data_activities) and $data_activities != 0){
                    foreach ($data_activities as $row){
                        ?>
                        <div class="box_full_l slot3">
                            <?php
                            $exp = explode('.', $row->url_image);
                            $end = strtolower(end($exp));
                            if ($end == 'mp4') {
                                ?>
                                <div class="pic">
                                    <video class="article_pic" src="<?php echo base_url(); ?>assets/activity/<?php echo $row->url_image ?>" controls></video>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="pic">
                                    <img src="<?php echo base_url(); ?>assets/activity/<?php echo $row->url_image ?>" alt="" class="article_pic">
                                </div>
                                <?php 
                            }
                            ?>
                            <div class="text">
                                <div class="date">
                                    <?php
                                    $date = date_format(date_create($row->date), 'M d, Y');
                                    echo $date;
                                    ?>
                                </div>
                                <h3><?php echo $row->title ?></h3>
                                <p><?php $content = strlen($row->content) >= 80 ? substr($row->content, 0, 80)."..." : $row->content;
                                echo $content;
                                ?></p>
                                <a href="<?php echo site_url('site/detailAct/'.$row->activity_id); ?>" title="">Read More</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <a class="bt_more" id="btnAMore">
                <span>More</span>
            </a>
            <div id="loadA" class="ajax-load text-center" style="display:none">
                <p><img src="<?php echo base_url(); ?>assets/icon/loader.gif">Loading More post</p>
            </div>
        </div>
    </div>