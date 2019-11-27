<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>	

		<!-- RIGHT -->
		<div class="col-xs-12 col-sm-8 col-md-8 pull-right">
		
			<?php if (!$isLogin and isset($slide) and $slide != '0') { ?>
			<div class="card">
				<div class="body" style="padding:0;">
					<div id="carousel-example-generic_2" class="carousel fade" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php foreach($slide as $key => $s) { ?>
							<li data-target="#carousel-example-generic_2" data-slide-to="<?=$key?>" <?=($key == 0) ? "class='active'" : ""?>></li>
							<?php } ?>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<?php foreach($slide as $key => $s) { ?>
							<div class="item fc_carousel <?=($key == 0) ? "active" : ""?>">
								<img src="<?=base_url("media/slideshow/{$s->slideshow_img}")?>" />
							</div>
							<?php } ?>
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<div id="fc_wrapper_slide_text">
							<p>METRO TV looking for Professional and highly motivated Fresh Graduates to join our team</p>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<?php if ($isLogin and isset($application_applied) and $application_applied != '0') { ?>
			<div class="card fc_card">
				<div class="header bg-brown">
					<h2>Your Application Status</h2>
				</div>
				<div class="body" style="">
					<div class="table-responsive">
						<table class="table fc-table m-b-0 home-app" style="font-size:95%">
							<?php 
								$app = [];
								$progress = [];
								foreach ($application_applied as $a) {
									xss_filter($a);
									$app['title'][] = $a->vacant_title;
								}
								if ($application_inprogress != '0') {
									foreach ($application_inprogress as $in) { 
										xss_filter($in);
										if ($in->ihr_stat == 'On Going') {
											$progress[0]['step'] 	= 'Interview';
											$progress[0]['pic'] 	= $in->ihr_pic;
											$progress[0]['date']	= !empty($in->ihr_date) ? date('l, j F Y, h:iA', strtotime($in->ihr_date)) : '';
											$progress[0]['loc']		= $in->ihr_lokasi;
											$progress[0]['note']	= $in->ihr_ket;
										}
										if ($in->iu_stat == 'On Going') {
											$progress[1]['step']	 = 'Interview';
											$progress[1]['pic'] 	= $in->iu_pic;
											$progress[1]['date']	= !empty($in->iu_date) ? date('l, j F Y, h:iA', strtotime($in->iu_date)) : '';
											$progress[1]['loc']		= $in->iu_lokasi;
											$progress[1]['note']		= $in->iu_ket;
										}
										if ($in->ia_stat == 'On Going') {
											$progress[2]['step'] 	= 'Interview';
											$progress[2]['pic'] 	= $in->ia_pic;
											$progress[2]['date']	= !empty($in->ia_date) ? date('l, j F Y, h:iA', strtotime($in->ia_date)) : '';
											$progress[2]['loc']		= $in->ia_lokasi;
											$progress[2]['note']		= $in->ia_ket;
										}
										if ($in->mcu_stat == 'On Going') {
											$progress[3]['step'] 	= 'Medical Check Up';
											$progress[3]['pic'] 	= $in->mcu_pic;
											$progress[3]['date']	= !empty($in->mcu_date) ? date('l, j F Y, h:iA', strtotime($in->mcu_date)) : '';
											$progress[3]['loc']		= $in->mcu_lokasi;
											$progress[3]['note']		= $in->mcu_ket;
										}
										if ($in->psikotest_stat == 'On Going') {
											$progress[4]['step'] 	= 'Psychological Test';
											$progress[4]['pic'] 	= $in->psikotest_pic;
											$progress[4]['date']	= !empty($in->psikotest_date) ? date('l, j F Y, h:iA', strtotime($in->psikotest_date)) : '';
											$progress[4]['loc']	= $in->psikotest_lokasi;
											$progress[4]['note']	= $in->psikotest_ket;
										}
										if ($in->final_stat == 'On Going') {
											$progress[5]['step'] = 'Finalization';
											$progress[5]['pic'] 	= $in->final_pic;
											$progress[5]['date']	= !empty($in->final_date) ? date('l, j F Y, h:iA', strtotime($in->final_date)) : '';
											$progress[5]['loc']		= $in->final_lokasi;
											$progress[5]['note']	= $in->final_ket;
										}
									}
								}
							?>
							<tbody>
								<tr>
									<td class="strong" width="30%">Applied Position</td>
									<td class=""><?=isset($app['title']) ? implode('<br>', $app['title']) : '-' ?></td>
								</tr>
								<tr>
									<td class="strong">Progress</td>
									<td class="">
										<?php
											if (empty ($progress)) {
												echo '<em>Waiting to be processed</em>';
											}
											else {
												foreach ($progress as $p) {
													echo "<strong>{$p['step']}</strong>".(!empty($p['pic']) ? " (Contact Person : {$p['pic']})" : "")."<br>";
													echo "{$p['date']}".(!empty($p['loc']) ? " at {$p['loc']}" : "")."<br>";
													echo (!empty($p['note'])) ? "<em>Note : {$p['note']}</em>" : "";
													echo "<hr style='margin:5px 0;'>";
												}
											}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<?php
				if (isset($jobs) and $jobs != '0') {
					foreach($jobs as $job) {
			?>
			<div class="card fc_card fc_job">
				<div class="header bg-indigo">
					<h2><?=$job->vacant_title?></h2>
				</div>
				<div class="body">
					<p class="small strong">Requirements:</p>
					<?=$job->vacant_criteria?>
					<div class="row m-t-10">
						<div class="col-sm-12" style="margin-bottom:0">
							<div class="socialshare" style="display:inline-block"></div>
							<a class="btn btn-lg bg-blue waves-effect pull-right" href="<?=base_url('vacancy/apply').'/'.$job->vacant_id?>">APPLY</a>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				}
			?>
		</div>
		<!-- #END RIGHT -->
		<!-- LEFT -->
		<div class="col-xs-12 col-sm-4 col-md-4 pull-left">
			<?php
				if (!$isLogin) {
			?>					
			<div class="row clearfix m-b-5">
				<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
					<!-- PANEL 1 -->
					<div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true" style="margin-bottom:5px">
						<!-- PANEL SIGNIN -->
						<div class="panel panel-col-indigo">
							<div class="panel-heading" role="tab" id="headingTwo_17">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion_17" href="#fc_panel_signin" aria-expanded="true" aria-controls="fc_panel_signin">
										<i class="material-icons">person</i> Login
									</a>
								</h4>
							</div>
							<div id="fc_panel_signin" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo_17">
								<div class="panel-body">
									<?php echo form_open('', ['id' => 'frm_sign_in', 'class' => 'frm_main', 'autocomplete' => 'off'])?>
										<div id="signin_alert" class="alert alert-danger small collapse"></div>
										<div class="row m-t-10">
											<div class="col-sm-12">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="frm_email" data-rule-email="true" required>
														<label class="form-label">Email</label>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="password" class="form-control" name="frm_pwd" required>
														<label class="form-label">Password</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 text-center" style="margin:5px 0;">
												<div class="g-recaptcha" data-sitekey="" style="display:inline-block;"></div>
											</div>
										</div>
										<div class="row m-t-10">
											<div class="col-sm-12">
												<button class="btn btn-block btn-lg bg-indigo waves-effect btn-fc" type="submit" id="fc_btn_signin">LOGIN</button>
											</div>
										</div>
										<div class="row m-t-15 m-b-10">
											<div class="col-sm-12 small text-center">
												<a id="forgot_pass" class="" style="cursor:pointer" data-toggle="modal" data-target="#modal_forgot_pass">Forgot Password?</a>
											</div>
										</div>
									<?php echo form_close()?>
								</div>
							</div>
						</div>
						<!-- #END PANEL SIGNIN -->
						<!-- PANEL SIGNUP -->
						<div class="panel panel-col-orange">
							<div class="panel-heading" role="tab" id="headingFour_17">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#fc_panel_signup" aria-expanded="false" aria-controls="fc_panel_signup">
										<i class="material-icons">person_add</i><span class="hidden-sm hidden-xs">New user?</span> Register here
									</a>
								</h4>
							</div>
							<div id="fc_panel_signup" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour_17">
								<div class="panel-body">
									<?php echo form_open('', ['id' => 'frm_sign_up', 'autocomplete' => 'off'])?>
										<div id="signup_alert" class="alert alert-danger small collapse"></div>
										<div class="row m-t-10">
											<div class="col-sm-12">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="frm_su_email" data-rule-email="true" required>
														<label class="form-label">Email</label>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="password" class="form-control" name="frm_su_passw" data-rule-minlength="8" required>
														<label class="form-label">Password</label>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="password" class="form-control" name="frm_su_passc" data-rule-equalTo="[name='frm_su_passw']" required>
														<label class="form-label">Confirm Password</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 p-t-5">
												<div class="form-group">
													<input type="checkbox" name="terms" id="terms" class="filled-in chk-col-orange" required>
													<label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
												</div>
											</div>
										</div>
										<div class="row m-t-10">
											<div class="col-sm-12">
												<button class="btn btn-block btn-lg bg-orange waves-effect btn-fc" type="submit" id="fc_btn_signup">REGISTER</button>
											</div>
										</div>
										<div class="row m-t-15 m-b-10">
											<div class="col-sm-12 small text-center">
												<a id="resend_verification" class="" style="cursor:pointer" data-toggle="modal" data-target="#modal_resend_verification">Re-send Activation Email</a>
											</div>
										</div>
									<?php echo form_close()?>
								</div>
							</div>
						</div>
						<!-- #END PANEL SIGNUP -->
					</div>
					<!-- #END PANEL 1-->
				</div>
			</div>
			<?php
				} 
				else {
			?>
			<div class="row clearfix m-b-5">
				<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
					<a href="<?=base_url('applicant')?>" class="btn btn-block bg-brown btn-fc btn-lg waves-effect m-b-20"><i class="material-icons">assignment</i><span class="m-l-5" style="position:relative;top:-3px;">Fill your <strong>APPLICATION FORM</strong> here</span></a>
				</div>
			</div>
			<?php
				}
			?>
			
			<div class="card" style="background:#E9E9E9;">
				<div class="body" style="padding:30px">
					<div class="kontak_fr">
                        <h3 style="margin-top:0">CONTACT <span>US</span></h3>
                        <div class="" style="margin-top:20px">
                            <p style=""><b>PT Media Televisi Indonesia</b></p>
                            <p style="margin-bottom:3px">Jl. Pilar Mas Raya Kav. A-D</p>
                            <p style="margin-bottom:3px">Kedoya - Kebon Jeruk</p>
                            <p style="">Jakarta 11520 - Indonesia</p>
                            <p style=""><i class="material-icons" style="vertical-align:middle">email</i> <span style="vertical-align:middle">recruitment@metrotvnews.com</span></p>
                        </div>                        
                        <div class="" style="margin-top:20px">
                           <p><b>Follow Us</b></p>
						   <div class="">
								<!--img class="social" src="http://digital.metrotvnews.com/asset/karir/images2/twitter.png" alt="Logo Twitter"><a href="http://twitter.com/HRD_MetroTV">@HRD_MetroTV</a-->
								<a class="twitter-follow-button" href="https://twitter.com/HRD_MetroTV" data-size="large" data-show-count="true"></a>
						   </div>
						   <div class="">
								<!--img class="social" src="http://digital.metrotvnews.com/asset/karir/images2/facebook.png" alt="Logo Facebook"><a href="https://www.facebook.com/MetroTV.Career">@MetroTVCareer</a-->
								<div class="fb-follow" data-href="https://www.facebook.com/MetroTV.Career" data-width="300" data-layout="button_count" data-size="large" data-show-faces="false"></div>
						   </div>
                        </div> 
                    </div>
				</div>
			</div>
		</div>
		<!-- #END LEFT -->		