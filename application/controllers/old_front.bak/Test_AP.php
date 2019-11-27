<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test_AP extends SITE_Controller {

	function __construct() {
		parent::__construct();
		
		
	}
	
	function testing_aja_cuy(){
		
		// sendEmail($to, $subject, $content, $alias='')
		$success = sendEmail(
			'internizti21@gmail.com',
			'Test Send Email 06-12-2017',
			'Sorry bro testing aja',
			'Career Metro TV'
		);
		echo ($success) ? 'done' : 'failed';
	}
}