<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<ul class="list_job">
	<?php 
	if (isset($fData_vacancies) and !empty($fData_vacancies)) {
		foreach ($fData_vacancies as $row) {
			?>
			<li class="list_r">
				<h3><?php echo $row->c ?></h3>
				<a href="javascript:;" class="cat_job"><?php echo $row->d ?></a>
				<div class="app">
					<a href="<?php echo site_url('site/detailVacant/'.$row->a); ?>" class="apply">Apply</a>
					<ul class="share">
						<li>
							<a href="https://www.facebook.com/sharer/sharer.php?u=//career.metrotvnews.com"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="https://twitter.com/share?url=//career.metrotvnews.com&text=Career%20Metro%20TVvia=<USERNAME>"><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a href="https://plus.google.com/share?url=https://career.metrotvnews.com"><i class="fa fa-google-plus"></i></a>
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
			}			
			?>	
		</ul>