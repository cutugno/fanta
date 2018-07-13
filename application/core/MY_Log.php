<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Log extends CI_Log {

        public function __construct() {
			parent::__construct();

			
        }
        
        public function write_custom_log($msg) {
			if ($this->_enabled === FALSE)
			{
				return FALSE;
			}

			$filepath = $this->_log_path.CUSTOMLOG.'.'.$this->_file_ext;
			$message = '';

			if ( ! file_exists($filepath))
			{
				$newfile = TRUE;
				// Only add protection to php files
				if ($this->_file_ext === 'php')
				{
					$message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
				}
			}

			if ( ! $fp = @fopen($filepath, 'ab'))
			{
				return FALSE;
			}

			$event_log_date_fmt="M d H:i:s";
			// Instantiating DateTime with microseconds appended to initial date is needed for proper support of this format
			if (strpos($event_log_date_fmt, 'u') !== FALSE)
			{
				$microtime_full = microtime(TRUE);
				$microtime_short = sprintf("%06d", ($microtime_full - floor($microtime_full)) * 1000000);
				$date = new DateTime(date('Y-m-d H:i:s.'.$microtime_short, $microtime_full));
				$date = $date->format($event_log_date_fmt);
			}
			else
			{
				$date = date($event_log_date_fmt);
			}

			// Recupero indirizzo IP
			$ip_address=$_SERVER['REMOTE_ADDR'];

			// Creo messaggio
			$message .= $date.' '.$ip_address.' '.$msg."\n";

			flock($fp, LOCK_EX);

			for ($written = 0, $length = strlen($message); $written < $length; $written += $result)
			{
				if (($result = fwrite($fp, substr($message, $written))) === FALSE)
				{
					break;
				}
			}

			flock($fp, LOCK_UN);
			fclose($fp);

			if (isset($newfile) && $newfile === TRUE)
			{
				chmod($filepath, $this->_file_permissions);
			}

			return is_int($result);
		}
        
}

?>
