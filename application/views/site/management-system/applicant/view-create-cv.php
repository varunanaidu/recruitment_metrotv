<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	//SETUP
	$array_religion = [
		'I'	=> 'Islam',
		'H'	=> 'Hindu',
		'B'	=> 'Budha',
		'K'	=> 'Katolik',
		'P'	=> 'Kristen Protestan',
		'O'	=> 'Others'
	];

	$array_edu = ["S2", "S2", "D3", "SMU"];
	
	$nama = "";
	$photo = "";
	//current address
	$curr_add = "";
	$ca_zipcode = "";
	$ca_phone = "";
	//permanent address
	$pa_add = "";
	$pa_zipcode = "";
	$pa_phone = "";
	
	$email = "";	
	$pob = "";
	$dob = "";
	$religion = "";
	$blood = "";
	$nation = "";
	$gender = "";
	$weight = "";
	$height = "";
	$ktp = "";
	$marital_status = "";
	$marital_date = "";
	$spouse_name= "";
	$spouse_dob = "";
	$spouse_edu = "";
	$spouse_occu = "";
	$salary = "";
	$hobby = "";
	$describe = "";
	if ( isset($data_cnd) and $data_cnd != '0' ){
		foreach($data_cnd as $row){
			$nama = $row->candidat_name;
			if ( empty($row->candidat_foto) )
				$photo = "media/site/images/no_photo.png";
			else
				$photo = "media/candidate/{$row->candidat_foto}";
			
			//current address
			$curr_add = $row->curr_address;
			$ca_zipcode = $row->ca_zip_code;
			$ca_phone = $row->ca_ph;
			
			//permanent address
			$pa_add = $row->per_address;
			$pa_zipcode = $row->pa_zip_code;
			$pa_ph = $row->pa_ph;
			
			$email = $row->candidat_email;
			$pob = $row->pob;
			$dob = date('d F Y', strtotime($row->dob));
			$religion = $array_religion[$row->religion_id];
			$blood = $row->blood_id;
			$nation = $row->nationality;
			$gender = ($row->gender == "M") ? "Male" : "Female";
			$weight = $row->weight;
			$height = $row->height;
			$ktp = $row->id_number;
			$marital_status = $row->marital_status;
			$marital_date = $row->marital_date;
			$spouse_name = $row->spouse_name;
			$spouse_dob = $row->spouse_dob;
			$spouse_edu = $row->spouse_edu;
			$spouse_occu = $row->spouse_occupation;
			$salary = $row->expect_salary;
			$hobby = $row->candidat_hobby;
			$describe = $row->candidat_describe;
		}
	}
	
	$s2		= ["S2", " ", " ", " "];
	$s1		= ["S1", " ", " ", " "];
	$d3		= ["D3", " ", " ", " "];
	$smu	= ["SMU", " ", " ", " "];
	
	if ( isset($data_edu) and $data_edu != '0' ){
		foreach($data_edu as $row){
			if ( $row->edu_title == "S2" )
				$s2 = ["S2 {$row->edu_institute}", "{$row->edu_major}", date("Y", strtotime($row->edu_start))." - ".date("Y", strtotime($row->edu_end)), $row->gpa];			
			else if ( $row->edu_title == "S1" )
				$s1 = ["S1 {$row->edu_institute}", "{$row->edu_major}", date("Y", strtotime($row->edu_start))." - ".date("Y", strtotime($row->edu_end)), $row->gpa];	
			else if ( $row->edu_title == "D3" )
				$d3 = ["D3 {$row->edu_institute}", "{$row->edu_major}", date("Y", strtotime($row->edu_start))." - ".date("Y", strtotime($row->edu_end)), $row->gpa];		
			else if ( $row->edu_title == "SMU" )
				$smu = ["SMU {$row->edu_institute}", "{$row->edu_major}", date("Y", strtotime($row->edu_start))." - ".date("Y", strtotime($row->edu_end)), $row->gpa];
		}
	}
?>
<!Doctype html>
<html lang="en">
	<head>
		<title>Candidat CV</title>
		<style type="text/css">
		body{
			font-size:100%;
			font-family:Arial !important;
		}
		
		label{font-weight:bold;display:block;line-height:25px;}
		.text-center{text-align:center;}
		table{
			width:100%;
		}
		
		span { font-weight:bold; }
		div{
			width:100%;
			height:700px;
		}
		</style>
	</head>
	<body>
		<div>
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td style="width:50%;">
						<img src="media/site/images/logo_metrotv.png" alt="Media Televisi Indonesia" style="width:60%;" />
						<p style="font-size:16px;">PT Media Televisi Indonesia</p>
					</td>
					<td style="width:50%;text-align:right;">
						<img src="<?php echo $photo?>" style="height:80px;" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>
			</table>
			<br />
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2" style="width:100%;border-bottom:1px solid #000;">
						<label>Name</label><br />
						<?php echo strtoupper($nama)?>
					</td>
				</tr>
				<tr>
					<td valign="top" style="width:70%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Current Address</label><br />
						<?php echo strtoupper($curr_add)?>
						<span>Zip Code: </span><?php echo $ca_zipcode?>
					</td>
					<td valign="top" style="width:30%;border-bottom:1px solid #000;">
						<label>Phone:</label><br />
						<?php echo $ca_phone?>
					</td>
				</tr>
				<tr>
					<td valign="top" style="width:70%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Permanent Address</label><br />
						<?php echo strtoupper($pa_add)?>
						<span>Zip Code: </span><?php echo $pa_zipcode?>
					</td>
					<td valign="top" style="width:30%;border-bottom:1px solid #000;">
						<label>Phone:</label><br />
						<?php echo $pa_phone?>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="width:100%;border-bottom:1px solid #000;">
						<label>Email</label><br />
						<?php echo strtoupper($email)?>
					</td>
				</tr>
			</table>
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td style="width:35%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Place & Date of Birth</label><br />
						<?php echo strtoupper($pob.", ".$dob)?>
					</td>
					<td style="width:25%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Religion</label><br />
						<?php echo strtoupper($religion)?>
					</td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Blood Type</label><br />
						<?php echo $blood?>
					</td>
					<td style="width:25%;border-bottom:1px solid #000;">
						<label>Nationality</label><br />
						<?php echo $nation?>
					</td>
				</tr>
				<tr>
					<td style="width:35%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Sex</label><br />
						<?php echo strtoupper($gender)?>
					</td>
					<td style="width:25%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Weight</label><br />
						<?php echo $weight?>
					</td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Height</label><br />
						<?php echo $height?>
					</td>
					<td style="width:25%;border-bottom:1px solid #000;">
						<label>ID Number</label><br />
						<?php echo $ktp?>
					</td>
				</tr>
				<tr>
					<td valign="top" style="width:35%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Marital Status</label><br />
						<?php echo strtoupper($marital_status)?>, <?php echo $marital_status == "Single" ? "" : strtoupper(date('d F Y', strtotime($marital_date)));?>
					</td>
					<td valign="top" colspan="3" style="width:65%;border-bottom:1px solid #000;">
						<label>Spouse (If married)</label><br />
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td style="width:30%;"><span>Name:</span></td>
								<td style="width:70%;border-bottom:1px solid #000;"><?php echo strtoupper($spouse_name)?></td>
							</tr>
							<tr>
								<td style="width:30%;"><span>Date of Birth:</span></td>
								<td style="width:70%;border-bottom:1px solid #000;"><?php echo empty($spouse_dob) ? "" : strtoupper(date("d F Y", strtotime($spouse_dob)))?></td>
							</tr>
							<tr>
								<td style="width:30%;"><span>Education:</span></td>
								<td style="width:70%;border-bottom:1px solid #000;"><?php echo strtoupper($spouse_edu)?></td>
							</tr>
							<tr>
								<td style="width:30%;"><span>Occupation:</span></td>
								<td style="width:70%;border-bottom:1px solid #000;"><?php echo strtoupper($spouse_occu)?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;"><span>Children</span></td>
					<td style="width:20%;border-bottom:1px solid #000;"><span>Date of Birth</span></td>
					<td style="width:15%;border-bottom:1px solid #000;"><span>Sex</span></td>
					<td style="width:25%;border-bottom:1px solid #000;"><span>Education</span></td>
				</tr>
				<?php
					$counter = 0;
					if ( isset($data_child) and $data_child != '0' ){
						foreach($data_child as $row){
				?>
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo ($counter+1).". ".strtoupper($row->child_name)?></td>
					<td style="width:20%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper(date("d F Y", strtotime($row->child_dob)))?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo $row->child_gender == "M" ? "MALE" : "FEMALE"?></td>
					<td style="width:25%;border-bottom:1px solid #000;"><?php echo strtoupper($row->child_edu)?></td>
				</tr>
				<?php
							$counter++;
						}
					}
					if ( $counter < 4 ){
						for($i = $counter; $i < 4; $i++){
				?>
				<tr>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo ($i+1)?>.&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;">&nbsp;</td>
				</tr>
				<?php
						}
					}
				?>
			</table>
			<br />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;"><span>Family(parents, siblings)</span></td>
					<td style="width:20%;border-bottom:1px solid #000;"><span>Date of Birth</span></td>
					<td style="width:15%;border-bottom:1px solid #000;"><span>Sex</span></td>
					<td style="width:25%;border-bottom:1px solid #000;"><span>Education</span></td>
				</tr>
				<?php
					$counter = 0;
					if ( isset($data_fam) and $data_fam != '0' ){
						foreach($data_fam as $row){
				?>
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo ($counter+1).". ".strtoupper($row->family_name)?></td>
					<td style="width:20%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper(date("d F Y", strtotime($row->family_dob)))?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo $row->family_gender == "M" ? "MALE" : "FEMALE"?></td>
					<td style="width:25%;border-bottom:1px solid #000;"><?php echo strtoupper($row->family_edu)?></td>
				</tr>
				<?php
							$counter++;
						}
					}
					if ( $counter < 5 ){
						for($i = $counter; $i < 5; $i++){
				?>
				<tr>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo ($i+1)?>.&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;">&nbsp;</td>
				</tr>
				<?php
						}
					}
				?>
			</table>
			<br />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" style="border-bottom:1px solid #000;"><span>EDUCATIONAL BACKGROUND</span></td>
				</tr>
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>School / Institution</span></td>
					<td style="width:20%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Major</span></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Start (From-to)</span></td>
					<td style="width:25%;border-bottom:1px solid #000;"><span>Remark / GPA</span></td>
				</tr>			
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($s2[0])?></td>
					<td style="width:20%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($s2[1])?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo $s2[2]?></td>
					<td style="width:25%;border-bottom:1px solid #000;"><?php echo $s2[3]?></td>
				</tr>
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($s1[0])?></td>
					<td style="width:20%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($s1[1])?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo $s1[2]?></td>
					<td style="width:25%;border-bottom:1px solid #000;"><?php echo $s1[3]?></td>
				</tr>
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($d3[0])?></td>
					<td style="width:20%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($d3[1])?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo $d3[2]?></td>
					<td style="width:25%;border-bottom:1px solid #000;"><?php echo $d3[3]?></td>
				</tr>
				<tr>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($smu[0])?></td>
					<td style="width:20%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($smu[1])?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo $smu[2]?></td>
					<td style="width:25%;border-bottom:1px solid #000;"><?php echo $smu[3]?></td>
				</tr>
			</table>
		</div>
		<div>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="3" style="border-bottom:1px solid #000;"><span>FOREIGN LANGUAGE SKILLS</span></td>
				</tr>
				<tr>
					<td rowspan="2" valign="middle" style="text-align:center;width:54%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Language</span></td>
					<td colspan="2" style="text-align:center;width:46%;border-bottom:1px solid #000;"><span>Capabilities</span></td>
				</tr>
				<tr>
					<td style="width:23%;border-bottom:1px solid #000;border-right:1px solid #000;text-align:center;"><span>Spoken</span></td>
					<td style="width:23%;border-bottom:1px solid #000;text-align:center;"><span>Written</span></td>
				</tr>
				<?php
					$counter = 0;
					if ( isset($data_lang) and $data_lang != '0' ){
						foreach($data_lang as $row){
				?>
				<tr>
					<td style="width:54%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->lang_name)?></td>
					<td style="width:23%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->cap_spoken)?></td>
					<td style="width:23%;border-bottom:1px solid #000;"><?php echo strtoupper($row->cap_written)?></td>
				</tr>
				<?php
							$counter++;
						}
					}
					if ( $counter < 4 ){
						for($i = $counter; $i < 4; $i++){
				?>
				<tr>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;">&nbsp;</td>
				</tr>
				<?php
						}
					}
				?>
			</table>
			<br />			
			<table>
				<tr>
					<td colspan="5" style="width:100%;border-bottom:1px solid #000;"><span>EMPLOYMENT BACKGROUND</span></td>
				</tr>
				<?php
					if ( isset($data_exp) and $data_exp != '0' ){
						foreach($data_exp as $row){
				?>
				<tr>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>From - To</span></td>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Company</span></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Title</span></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Report To</span></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Last Salary</span></td>					
				</tr>
				<tr>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo date("Y", strtotime($row->work_exp_from)). " - ".date("Y", strtotime($row->work_exp_to))?></td>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->company_name)?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->work_exp_title)?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->report_to)?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo number_format($row->last_salary, 0, '.', ',')?></td>
				</tr>
				<tr>
					<td valign="top" colspan="3" style="width:70%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Job Description</label><br />
						<?php echo strtoupper($row->job_desc)?>
					</td>
					<td valign="top" colspan="2" style="width:30%;border-bottom:1px solid #000;border-right:1px solid #000;">
						<label>Reason for Leaving</label><br />
						<?php echo strtoupper($row->reason_leaving)?>
					</td>
				</tr>
				<tr>
					<td colspan="5" style="width:100%;">
						<label>Contact Previous Employee</label><br />
						<?php echo $row->may_contact == "Y" ? "YES" : "NO"?>, <?php echo strtoupper($row->reason_deny)?>
						<br /><br /><br /><br />
					</td>
				</tr>
				<?php }}?>
			</table>
			<br />
			<table>
				<tr>
					<td style="width:40%;"><span>What is your salary expectation?</span></td><td style="width:60%;"><?php echo number_format($salary, 0, '.', ',')?></td>
				</tr>
			</table>
		</div>
		<div>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" style="border-bottom:1px solid #000;"><span>ORGANIZATIONAL EXPERIENCES</span></td>
				</tr>
				<tr>
					<td style="width:30%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Activities</span></td>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Type of Organization</span></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Year / Period</span></td>
					<td style="width:15%;border-bottom:1px solid #000;"><span>Position</span></td>
				</tr>
				<?php
					$counter = 0;
					if ( isset($data_org) and $data_org != '0' ){
						foreach($data_org as $row){
				?>
				<tr>
					<td style="width:30%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->activities)?></td>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->type_of_org)?></td>
					<td style="width:15%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper(date("Y", strtotime($row->org_year_start)). " - " . date("Y", strtotime($row->org_year_end)));?></td>
					<td style="width:15%;border-bottom:1px solid #000;"><?php echo strtoupper($row->org_pos);?></td>
				</tr>
				<?php
							$counter++;
						}
					}
					if ( $counter < 3 ){
						for($i = $counter; $i < 3; $i++){
				?>
				<tr>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;">&nbsp;</td>
				</tr>
				<?php
						}
					}
				?>
			</table>
			<br />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:100%;border-bottom:1px solid #000;"><span>OTHER ACTIVITIES</span></td>
				</tr>
				<tr>
					<td style="width:100%;border-bottom:1px solid #000;"><label>Hobby & Interest</label><br /><?php echo $hobby?></td>
				</tr>
			</table>
			<br />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" style="border-bottom:1px solid #000;"><span>ACHIEVEMENT</span></td>
				</tr>
				<tr>
					<td style="width:45%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Title / Type of Achievement</span></td>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><span>Organization</span></td>
					<td style="width:15%;border-bottom:1px solid #000;"><span>Year / Period</span></td>
				</tr>
				<?php
					$counter = 0;
					if ( isset($data_achiev) and $data_achiev != '0' ){
						foreach($data_achiev as $row){
				?>
				<tr>
					<td style="width:30%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->achievement_title)?></td>
					<td style="width:40%;border-bottom:1px solid #000;border-right:1px solid #000;"><?php echo strtoupper($row->achievement_org)?></td>
					<td style="width:15%;border-bottom:1px solid #000;"><?php echo $row->achievement_year?></td>
				</tr>
				<?php
							$counter++;
						}
					}
					if ( $counter < 3 ){
						for($i = $counter; $i < 3; $i++){
				?>
				<tr>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;border-right:1px solid #000;">&nbsp;</td>
					<td style="border-bottom:1px solid #000;">&nbsp;</td>
				</tr>
				<?php
						}
					}
				?>
			</table>
			<br />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:100%;border-bottom:1px solid #000;"><label>Describe yourself (strength, weakness, etc.) & explain why we should hire you</label><br /><?php echo nl2br($describe)?></td>
				</tr>
			</table>
		</div>
	</body>
</html>