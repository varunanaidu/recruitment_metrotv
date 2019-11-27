<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	$vacant_name = "";
	$app_id = "";
	if ( isset($vacant) and $vacant != '0' ){
		foreach($vacant as $row){
			$app_id = $row->applicant_id;
			$vacant_name = $row->vacant_title;
		}
	}
	
	$content_email = "";
	if ( isset($data_email) and $data_email != '0' ){
		foreach($data_email as $row) $content_email = nl2br($row->template_content);
	}
	$exp = explode(";", $data_test);
	$ptname = "<strong>PT Media Televisi Indonesia</strong>";
		
	$content_datatest = "
		<br /><br /><br />
		<div class=\"detail-content\">
			<table style=\"width:100%;\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td style=\"width:30%;\"><strong>Day / Date</strong></td>
					<td><strong>{$exp[0]}</strong></td>
				</tr>
				<tr>
					<td><strong>Time</strong></td>
					<td><strong>{$exp[1]}</strong></td>
				</tr>
				<tr>
					<td valign=\"top\"><strong>Venue</strong></td>
					<td><strong>".nl2br($data_location)."</strong></td>
				</tr>
				<tr>
					<td><strong>PIC</strong></td>
					<td><strong>{$data_pic}</strong></td>
				</tr>
			</table>
		</div>
		<br /><br />
		<div class=\"detail-btn\">
			<a href=".base_url()."invitation/myinvitation/{$data_cnd_rg_key}/A/{$app_id}/{$data_apptype} target=\"_blank\" class=\"primary\">Accept Invitation</a> <a href=".base_url()."invitation/myinvitation/{$data_cnd_rg_key}/R/{$app_id}/{$data_apptype} target=\"_blank\" class=\"danger\">Decline</a>
		</div>
	";
	
	$document = "<strong style=\"background-color:#ffff00;\">The documents that you should bring:</strong>";
	
	$finder = array("CANDIDATNAME", "PTNAME", "JOBPOSITION", "CURRTEST", "DATATEST", "DOCUMENT");
	$replacer = array($data_cnd, $ptname, "<strong>{$vacant_name}</strong>", $data_subject, $content_datatest, $document);
	
?>
	<div id="content" style="padding:20px;background:#FCFCFC;">
	<?php echo str_replace($finder, $replacer, $content_email);?>
	</div>	