<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<div class="pad">
  <div class="slide">
    <ul class="loop slide owl-carousel">
      <?php
      if (isset($data_slideshow) and $data_slideshow != 0) {
       foreach ($data_slideshow as $row) {
         ?>
         <li class="item">
          <img src="<?php echo base_url(); ?>assets/slideshow/<?php echo $row->slideshow_img ?>" alt="title"/>
          <div class="slide_info">
            <div class="text">
              <div class="title_slide">
                <a href="#" title="title">
                  <?php echo $row->slideshow_text ?>
                </a>
              </div>
            </div>
          </div>
        </li>
        <?php 
      }
    } 
    ?>
  </ul>
</div>
</div>