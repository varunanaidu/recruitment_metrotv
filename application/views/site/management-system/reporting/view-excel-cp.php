<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
<!Doctype html>
<html lang="en">
	<head>
	<?php
		ini_set('memory_limit','-1');
		// file name for download
		$filename = "_Report-candidat-progress" . date('Ymd') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		
		foreach($data_vacant as $row){
			$vacant_title = $row->vacant_title;
			$row_a = $row->a;
			$row_b = $row->b;
		}
	?>
		<title>Report Candidat Progress</title>
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
				<td colspan="9"><?php echo $vacant_title . " ({$row_a} s/d {$row_b})"?></td>
			</tr>
			<tr>
				<td colspan="9">&nbsp;</td>
			</tr>
			<tr>
				<td class="text-center">Nomor</td>
				<td class="text-center">Nama</td>
				<td class="text-center">Interview User</td>
				<td class="text-center">Interview HR</td>
				<td class="text-center">Psikotest</td>
				<td class="text-center">Interview Accessor</td>
				<td class="text-center">MCU</td>
				<td class="text-center">Finalisasi</td>
				<td class="text-center">Status</td>
			</tr>
			<?php
				$num = 1;
				if ( isset($data) and $data != '0' ){
					foreach($data as $row){
						$iu_stat = ( ($row->iu_stat == "Passed") ? "color-green" : ( ($row->iu_stat == "Failed") ? "color-red" : ( ($row->iu_stat == "On Going") ? "color-yellow" : "color-black" ) ) );
						$ihr_stat = ( ($row->ihr_stat == "Passed") ? "color-green" : ( ($row->ihr_stat == "Failed") ? "color-red" : ( ($row->ihr_stat == "On Going") ? "color-yellow" : "color-black" ) ) );
						$psikotest_stat = ( ($row->psikotest_stat == "Passed") ? "color-green" : ( ($row->psikotest_stat == "Failed") ? "color-red" : ( ($row->psikotest_stat == "On Going") ? "color-yellow" : "color-black" ) ) );
						$ia_stat = ( ($row->ia_stat == "Passed") ? "color-green" : ( ($row->ia_stat == "Failed") ? "color-red" : ( ($row->ia_stat == "On Going") ? "color-yellow" : "color-black" ) ) );
						$mcu_stat = ( ($row->mcu_stat == "Passed") ? "color-green" : ( ($row->mcu_stat == "Failed") ? "color-red" : ( ($row->mcu_stat == "On Going") ? "color-yellow" : "color-black" ) ) );
						$final_stat = ( ($row->final_stat == "Passed") ? "color-green" : ( ($row->final_stat == "Failed") ? "color-red" : ( ($row->final_stat == "On Going") ? "color-yellow" : "color-black" ) ) );
						$applicant_status = ( ($row->applicant_status == "Passed") ? "color-green" : ( ($row->applicant_status == "Failed") ? "color-red" : ( ($row->applicant_status == "On Going") ? "color-yellow" : "color-black" ) ) );
						echo "
			<tr>
				<td>{$num}</td>
				<td>{$row->candidat_name}</td>
				<td class=\"{$iu_stat}\">{$row->iu_stat}</td>
				<td class=\"{$ihr_stat}\">{$row->ihr_stat}</td>
				<td class=\"{$psikotest_stat}\">{$row->psikotest_stat}</td>
				<td class=\"{$ia_stat}\">{$row->ia_stat}</td>
				<td class=\"{$mcu_stat}\">{$row->mcu_stat}</td>
				<td class=\"{$final_stat}\">{$row->final_stat}</td>
				<td class=\"{$applicant_status}\">{$row->applicant_status}</td>
			</tr>
						";
						$num++;
					}
				}
			?>
		</table>
	</body>
</html>