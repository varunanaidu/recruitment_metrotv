<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('ist')){
	
	function ist(&$value, $default='', $prefix=false, $suffix=false){
		
		if(isset($value) and $prefix) $value = $prefix.$value;
		if(isset($value) and $suffix) $value = $value.$suffix;
		return isset($value) ? $value : $default ;
	}
}

if(!function_exists('esc')){
	
	function esc(&$value){
		
		$value = html_escape($value);
	}
}

if(!function_exists('xss_filter')){
	
	function xss_filter($array){
		
		array_walk($array, 'esc');
	}
}

if(!function_exists('isAjax')){
	
	function isAjax(){
		
		$CI = &get_instance();
		return $CI->input->is_ajax_request();
	}
}

if(!function_exists('isLogin')){
	
	function isLogin(){
		
		$CI = &get_instance();
		return $CI->session->userdata(SES_END);
	}
}

if(!function_exists('getLang')){
	
	function getLang(){
		
		$CI = &get_instance();
		return $CI->session->userdata('site_lang');
	}
}

if(!function_exists('sendEmail')){
	
	function sendEmail($to, $subject, $content, $alias=''){
		// ORIGINAL AUTHENTIC BUKAN KALENG KALENG ==============================================
		// $config = array(
		// 	'protocol' 		=> 'smtp',
		// 	'smtp_host' 	=> 'smtp.mandrillapp.com',
		// 	'smtp_port' 	=> 587,
		// 	'smtp_crypto' 	=> 'tls',
		// 	'smtp_user' 	=> 'medcom',
		// 	'smtp_pass' 	=> 'xg9jItZQBLJYqybrWibxwQ',
		// 	'mailtype' 		=> 'html',			
		// 	'charset' 		=> 'iso-8859-1',
		// 	'newline'		=> "\r\n",
		// 	'wordwrap' 		=> TRUE
		// );
		// $CI = &get_instance();
		// $CI->load->library('email', $config);		
		// $CI->email->from('noreply@myconsolenet.com', $alias);
		// $CI->email->to($to);
		// $CI->email->subject($subject);
		// $CI->email->message($content);
		// return $CI->email->send();
		// =====================================================================================

		$config = array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'mail.metrotvnews.com',
			'smtp_port' 	=> 25,
			'smtp_user' 	=> 'idocs@metrotvnews.com',
			'smtp_pass' 	=> '@Metrotv88',
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'newline'		=> "\r\n",
			'wordwrap' 		=> TRUE
		);
		$CI = &get_instance();
		$CI->load->library('email', $config);
		$CI->email->clear(TRUE);
		$CI->email->from('idocs@metrotvnews.com', 'IDOCS METRO TV');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($content);
		return $CI->email->send();


	}
}

if(!function_exists('html_cut')){
	
	/*
		untuk memotong string dengan tags
		example :
		string = "<p>hello world</p>";
		result = "<p>hello wor</p>";
	*/
	function html_cut($text, $max_length) {
		$tags   = array();
		$result = "";

		$is_open   = false;
		$grab_open = false;
		$is_close  = false;
		$in_double_quotes = false;
		$in_single_quotes = false;
		$tag = "";

		$i = 0;
		$stripped = 0;

		$stripped_text = strip_tags($text);

		while ($i < strlen($text) && $stripped < strlen($stripped_text) && $stripped < $max_length) {
			$symbol  = $text{$i};
			$result .= $symbol;

			switch ($symbol) {
				case '<':
					$is_open   = true;
					$grab_open = true;
					break;

				case '"':
					if ($in_double_quotes)
						$in_double_quotes = false;
					else
						$in_double_quotes = true;

					break;

				case "'":
					if ($in_single_quotes)
						$in_single_quotes = false;
					else
						$in_single_quotes = true;

					break;

				case '/':
					if ($is_open && !$in_double_quotes && !$in_single_quotes) {
						$is_close  = true;
						$is_open   = false;
						$grab_open = false;
					}
					break;

				case ' ':
					if ($is_open)
						$grab_open = false;
					else
						$stripped++;

					break;

				case '>':
					if ($is_open) {
						$is_open   = false;
						$grab_open = false;
						array_push($tags, $tag);
						$tag = "";
					}
					else if ($is_close) {
						$is_close = false;
						array_pop($tags);
						$tag = "";
					}
					break;

				default:
					if ($grab_open || $is_close)
						$tag .= $symbol;

					if (!$is_open && !$is_close)
						$stripped++;
			}
			$i++;
		}

		while ($tags)
			$result .= "</".array_pop($tags).">";

		return $result;
	}
}