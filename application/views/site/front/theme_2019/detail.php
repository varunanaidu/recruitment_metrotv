<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<?php
if (isset($data_editorial) and $data_editorial != 0){
    foreach ($data_editorial as $row){
        require_once "header_detail.php";
        ?>
        <div class="white_space">
            <div class="frame">
                <div class="wrap">
                    <div class="style_box1">
                        <div class="dl">
                            <div class="pic">
                                <img src="<?php echo base_url(); ?>assets/editorial/<?php echo $row->url_image ?>" alt="">
                            </div>
                            <div class="text">
                                <div class="date"><?php
                                $date = date_format(date_create($row->date), 'M d, Y');
                                echo $date;
                                ?></div>
                                <p><?php echo $row->content ?></p>
                            </div>
                        </div>
                    </div>
                    <?php require_once "testimoni.php";  ?>
                </div>
            </div>
        </div>
        <?php
    }
}else if(isset($data_activity) and $data_activity != 0){
    foreach ($data_activity as $row){
        require_once "header_detail.php";
        ?>
        <div class="white_space">
            <div class="frame">
                <div class="wrap">
                    <div class="style_box1">
                        <div class="dl">
                            <div class="pic">
                                <?php 
                                $exp = explode('.', $row->url_image);
                                $end = strtolower(end($exp));
                                if ($end == 'mp4') {
                                    ?>
                                    <video src="<?php echo base_url(); ?>assets/activity/<?php echo $row->url_image ?>" controls></video>
                                    <?php 
                                } else {
                                   ?>
                                   <img src="<?php echo base_url(); ?>assets/activity/<?php echo $row->url_image ?>" alt="">
                                   <?php 
                               }
                               ?>
                           </div>
                           <div class="text">
                            <div class="date"><?php
                            $date = date_format(date_create($row->date), 'M d, Y');
                            echo $date;
                            ?></div>
                            <p><?php echo $row->content ?></p>
                        </div>
                    </div>
                </div>
                <?php require_once "testimoni.php";  ?>
            </div>
        </div>
    </div>
    <?php
}
}
else if(isset($data_testimoni) and $data_testimoni != 0){
    foreach ($data_testimoni as $row){
        ?>
        <div class="pad">
            <div class="devine">
                <div class="frame">
                    <div class="wrap">
                        <h2><?php echo $row->name; ?></h2>
                        <!-- judul artikel -->
                    </div>
                </div>
            </div>
        </div>
        <div class="white_space">
            <div class="frame">
                <div class="wrap">
                    <div class="style_box1">
                        <div class="dl">
                            <div class="pic">
                                <img src="<?php echo base_url(); ?>assets/testimoni/<?php echo $row->url_image ?>" alt="">
                            </div>
                            <div class="text">
                               <div class="date"><?php
                               $date = date_format(date_create($row->created_date), 'M d, Y');
                               echo $date;
                               ?></div>
                               <h3 class="name"><?php echo $row->name ?> - <?php echo $row->batch ?></h3>
                               <p><?php echo $row->content ?></p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <?php
   }
}
?>
