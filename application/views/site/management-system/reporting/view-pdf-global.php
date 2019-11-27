<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	foreach($data_vacant as $row)
		$total_vacant = $row->TOTAL;
	foreach($data_applicant as $row)
		$total_applicant = $row->TOTAL;
	foreach($data_proses as $row)
		$total_proses = $row->TOTAL;
	foreach($data_passed as $row)
		$total_passed = $row->TOTAL;
	foreach($data_failed as $row)
		$total_failed = $row->TOTAL;
	foreach($data_going as $row)
		$total_going = $row->TOTAL;
?>
<!Doctype html>
<html lang="en">
	<head>
		<title>Report Global</title>
		<style type="text/css">
			body{
				font-size:100%;
				font-family:Arial !important;
			}
			
			label{font-weight:bold;}
			.text-center{text-align:center;}
			.color-green{
				color :#008c00;
				font-weight : bold;
			}
			.color-red{
				color :#b30000;
				font-weight : bold;
			}
			.color-yellow{
				color :#d9d900;
				font-weight : bold;
			}
			.color-black{
				color :#000000;
				font-weight : bold;
				padding-top:8px;
				padding-bottom:8px;
			}
		</style>
	</head>
	<body>
		<table style="width:100%;">
			<tr>
				<td style="width:100%;text-align:center;">
					<img src="media/site/images/logo_metrotv.png" />
					<h3>PT Media Televisi Indonesia</h3>
					<hr />
				</td>
			</tr>
		</table>
		<table style="width:100%;" cellspacing="0" cellpadding="0">			
			<tr>
				<td class="color-black" style="width:40%;">Total Vacancy (<?php echo $data_year?>)</td> <td style="width:60%;"><?php echo $total_vacant?> Vacancies</td>
			</tr>
			<tr>
				<td class="color-black">Total Candidate Applies (<?php echo $data_year?>)</td> <td><?php echo $total_applicant?> Person/s</td>
			</tr>
			<tr>
				<td class="color-black">Total Candidate Processed (<?php echo $data_year?>)</td> <td><?php echo $total_proses?> Person/s</td>				
			</tr>
			<tr>
				<td class="color-black">Total Candidates Completed (<?php echo $data_year?>)</td> <td><?php echo $total_passed?> Person/s</td>
			</tr>
			<tr>
				<td class="color-black">Total Candidates Unfinished (<?php echo $data_year?>)</td> <td><?php echo $total_going?> Person/s</td>
			</tr>
			<tr>
				<td class="color-black">Total Candidates Failed (<?php echo $data_year?>)</td> <td><?php echo $total_failed?> Person/s</td>
			</tr>
		</table>
		<table style="width:100%;">
			<tr>
				<td style="width:100%;font-size:8px;">
					<hr />
					<span>&copy; PT. Media Televisi Indonesia <?php echo date('Y')?>. All rights reserved.</span>
				</td>
			</tr>
		</table>
	</body>
</html>