<?php defined('BASEPATH') OR exit('No direct script access allowed');

	if ( ! function_exists('msg_log')) {
		function msg_log($msg) {			
			$msg="Message: $msg. (".$this->uri->uri_string().")";
			$this->write_custom_log($msg);
		}	
	}
	if ( ! function_exists('err_log')) {
		function err_log($msg) {			
			$msg="Error: $msg. (".$this->uri->uri_string().")";
			$this->write_custom_log($msg);
		}
	}
				
?>
