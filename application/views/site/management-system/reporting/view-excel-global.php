<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
<!Doctype html>
<html lang="en">
	<head>
	<?php
		ini_set('memory_limit','-1');
		// file name for download
		$filename = "_Report-global" . date('Ymd') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		
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
			}
		</style>
	</head>
	<body>
		<table style="width:100%;" border="1" cellspacing="0" cellpadding="0">			
			<tr>
				<td class="color-black">Total Vacancy (<?php echo $data_year?>)</td> <td><?php echo $total_vacant?></td>
			</tr>
			<tr>
				<td class="color-black">Total Kandidat yang Melamar (<?php echo $data_year?>)</td> <td><?php echo $total_applicant?></td>
			</tr>
			<tr>
				<td class="color-black">Total Kandidat yang Diproses (<?php echo $data_year?>)</td> <td><?php echo $total_proses?></td>				
			</tr>
			<tr>
				<td class="color-black">Total Kandidat yang Sudah Selesai (<?php echo $data_year?>)</td> <td><?php echo $total_passed?></td>
			</tr>
			<tr>
				<td class="color-black">Total Kandidat yang Belum Selesai (<?php echo $data_year?>)</td> <td><?php echo $total_going?></td>
			</tr>
			<tr>
				<td class="color-black">Total Kandidat yang Gagal (<?php echo $data_year?>)</td> <td><?php echo $total_failed?></td>
			</tr>
		</table>
	</body>
</html>