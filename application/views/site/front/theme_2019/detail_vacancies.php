<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d4bcccb6fa675b0"></script> -->
<?php
if (isset($data_vacancies) and $data_vacancies != 0){
    foreach ($data_vacancies as $row){
        require_once "header_detail_vacancies.php";
        ?>
        <div class="bg_pattern">
            <div class="frame">
                <div class="wrap">
                    <div class="detail">
                        <div class="poster"><img src="<?php echo base_url(); ?>assets/vacancy/<?php echo $row->url_poster ?>" alt="poster"/></div>
                        <div class="detail_info">
                            <h1>Requirements:</h1>
                            <p><?php echo $row->vacant_criteria ?></p>
                            <ul class="sosc">
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox_jrvr"></div>
                            </ul>
                            <div class="apply">
                                <?php
                                if ($isLogin) {
                                    ?>
                                    <a class="btn_apply" href="<?php echo site_url('Applicant/?v='.$row->vacant_id); ?>" title="apply">APPLY</a>
                                    <?php 
                                }else{
                                    ?>
                                    <a id="btnApply" class="btn_apply" href="#" title="apply">APPLY</a>
                                    <?php 
                                } 
                                ?>
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