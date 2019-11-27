<?php
	header('Access-Control-Allow-Origin: *');
	$msg = array();
	$con = mysqli_connect("localhost","karir","karirDB-user","karir");
	if ( !$con ) {
		$msg['type'] = 'failed';
		$msg['msg'] = "Connection refused.";
	}
	else{
	
		$sql = "SELECT vacant_id AS A, vacant_title AS B, vacant_code AS C, vacant_criteria AS D FROM tr_vacant WHERE vacant_status = 'ACTIVE'";
		
		$q = mysqli_query($con, $sql);
		
		$row = mysqli_num_rows($q);
		if ( $row == 0 ){
			$msg['type'] = 'failed';
			$msg['msg'] = 'No vacancy available';
		}
		else{
			$data = array();
			while($row = mysqli_fetch_object($q)){				
				$push = array(
					"A" => $row->A,
					"B" => $row->B,
					"C" => $row->C,
					"D" => $row->D
				);
				
				array_push($data, $push);
			}
			
			$msg['type'] = 'done';
			$msg['msg'] = $data;
		}
	}
	echo json_encode($msg);