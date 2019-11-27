<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<div id="home" class="section">
    <?php require_once "hero_slider.php"; ?>
    <?php require_once "hiw.php"; ?>
</div>
<div class="grey_space pac60" id="vacancies">
    <div class="frame">
        <div class="wrap">
            <div class="title title_dark">
                <h2>Vacancies</h2>
                <span>Find Your Job Here</span>
            </div>
            <?php require_once "list_vacancies.php"; ?>
        </div>
    </div>
</div>
<div class="white_space section" id="tipsntrick">
    <div class="frame article">
        <div class="wrap">
            <?php require_once "editorial.php"; ?>
            <?php require_once "testimoni.php"; ?>
        </div>
    </div>
</div>
<div class="white_space section" id="activities">
    <?php require_once "activities.php"; ?>
</div>
<div class="white_space section" id="faq">
    <div class="frame article">
        <div class="wrap">
            <?php require_once "faq.php"; ?>
            <div class="style_box2">
                <div class="title_left">
                    <h2>Twitter @HRD_MetroTV</h2>
                </div>
                <a class="twitter-timeline" data-width="375" data-height="600px" href="https://twitter.com/CareerMetrotv?ref_src=twsrc%5Etfw">Tweets by HRD_MetroTV</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </div>
</div>