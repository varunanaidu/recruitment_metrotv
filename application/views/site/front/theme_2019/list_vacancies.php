<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<div class="grey_space pac60">
    <div class="frame">
        <div class="sc_vacant">
            <form action="" id="search_job" class="form-validation">
                <div class="box_search">
                    <div class="sel_dropdown">
                        <div class="col-md-12 col-lg-6 mb-3 mb-lg-0 form-group">
                            <select class="form-control custom-select my_select" name="unit" id="unit">
                                <option value="" disabled=""> -- UNIT --</option>
                                <?php
                                if (isset($tr_vacant_unit) and $tr_vacant_unit != 0) {
                                    foreach ($tr_vacant_unit as $row) {
                                        ?>
                                        <option value="<?php echo $row->vacant_unit_id; ?>" <?=(ist($row->unit_name) == 'METRO TV') ? 'selected' : '' ?>><?php echo $row->unit_name; ?></option>
                                        <?php 
                                    }
                                } 
                                ?>        
                            </select>
                        </div>
                        <div class="col-md-12 col-lg-6 mb-3 mb-lg-0 form-group">
                            <select class="form-control custom-select my_select" name="position" id="position">
                                <option value=""> -- ALL --</option>
                                <?php
                                if (isset($tr_vacant_group) and $tr_vacant_group != 0) {
                                    foreach ($tr_vacant_group as $row) {
                                        ?>
                                        <option value="<?php echo $row->vacant_group_id; ?>"><?php echo $row->name; ?></option>
                                        <?php 
                                    }
                                } 
                                ?>  
                            </select>
                        </div>
                    </div>
                    <div class="sel_search">
                        <div class="form-group">
                            <button id="searchBtn">search</button>
                            <input type="text" name="search" placeholder="Search for Jobs ..">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="loadFVacancy">
            <ul class="list_job">
                <?php 
                if (isset($data_vacancies) and $data_vacancies != 0) {
                    foreach ($data_vacancies as $row) {
                        ?>
                        <li class="list_r">
                            <h3><?php echo $row->c ?></h3>
                            <a href="javascript:;" class="cat_job"><?php echo $row->d ?></a>
                            <div class="app">
                                <a href="<?php echo site_url('site/detailVacant/'.$row->a); ?>" class="apply">Apply</a>
                                <ul class="share">
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u=https://career.metrotvnews.com" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/share?url=https://career.metrotvnews.com&amp;text=MetroTV%20Career&amp;hashtags=metrotvcareer" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/share?url=https://career.metrotvnews.com" target="_blank"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/shareArticle?url=//career.metrotvnews.com&title=Career%20Metrotv&summary=<SUMMARY>&source=//career.metrotvnews.com"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                        <li>
                                            <a href="whatsapp://send?text=Career%20MetroTV!"><i class="fa fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php 
                        }
                    }else if(isset($type) and $type == 'filterVacancy'){
                        require_once 'filter_vacancies.php';
                    }
                    ?>
                </ul>
            </div>
            <a class="bt_more" id="btnVMore">
                <span>More</span>
            </a>
            <div id="loadV" class="ajax-load text-center" style="display:none">
                <p><img src="<?php echo base_url(); ?>assets/icon/loader.gif">Loading More post</p>
            </div>
        </div>
    </div>