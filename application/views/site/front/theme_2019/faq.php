<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

<div class="style_box1">
    <div id="accordion1" class="panel-group acc_faq">
        <div class="title_left">
            <h2>Frequently Asked Question</h2>
        </div>
        <?php
        if (isset($data_faq) and $data_faq != 0) {
            $a = 1;
            foreach ($data_faq as $row) {
                ?>
                <div class="panel faq_style">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a id="<?php echo $row->faq_id; ?>" href="<?php echo '#question'.$row->faq_id; ?>" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1"><?php echo $row->question; ?></a>
                        </h4>
                    </div>
                    <div id="<?php echo 'question'.$row->faq_id; ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p><?php echo $row->answer; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } 
        ?>
    </div>
    <a class="bt_more" id="btnFMore">
        <span>More</span>
    </a>
    <div id="loadF" class="ajax-load text-center" style="display:none">
        <p><img src="<?php echo base_url(); ?>assets/icon/loader.gif">Loading More post</p>
    </div>
</div>