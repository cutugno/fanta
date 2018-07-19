<?php defined('BASEPATH') OR exit('No direct script access allowed');

	if ( ! function_exists('convertDate')) {
		function convertDate ($date) {
			$date=explode("-",$date);
			$date=$date[2]."/".$date[1]."/".$date[0];
			return $date;
		}
	}
	
	if ( ! function_exists('revertDate')) {
		function revertDate ($date) {
			$date=explode("/",$date);
			$date=$date[2]."-".$date[1]."-".$date[0];
			return $date;
		}
	}
	
	if ( ! function_exists('cleanDate')) {
		// tolgo orario
		function cleanDate ($date) {
			$date=explode(" ",$date);
			$date=$date[0];
			return $date;
		}
	}	
	
	if ( ! function_exists('cleanDateSeconds')) {
		// tolgo secondi da orario
		function cleanDateSeconds ($date) {
			$date=explode(" ",$date);
			$time=explode(":",$date[1]);
			$time=$time[0].":".$time[1];
			return $date[0]." ".$time;
		}
	}	
	
	if ( ! function_exists('convertDateTime')) {
		function convertDateTime ($datetime,$cleanseconds=FALSE) {
			$datetime=explode(" ",$datetime);
			$date=convertDate($datetime[0]);
			$time=$datetime[1];
			if ($cleanseconds) $time=substr($datetime[1],0,-3);
			
			return $date." ".$time;			
		}
		
	}	
	
	if ( ! function_exists('revertDateTime')) {
		function revertDateTime ($datetime,$cleanseconds=FALSE) {
			$datetime=explode(" ",$datetime);
			$date=revertDate($datetime[0]);
			$time=$datetime[1];
			if ($cleanseconds) $time=substr($time,0,-3);
			
			return $date." ".$time;			
		}
		
	}	
	
	
	if ( ! function_exists('calcWeekDays')) {
		function calcWeekDays($days) {
			$days=explode(",",$days);		
			$c=0;
			foreach ($days as $key=>$val) {
				if ($val==1) $c+=pow(2,$key);
			}
			return $c;
		}
	}
	
	if ( ! function_exists('daysToBin')) {
		function daysToBin($days) {
			$week_days=(string) decbin($days);
			$l=strlen($week_days);
			$zeri="";
			if ($l<7) {
				for ($x=0;$x<(7-$l);$x++) {
					$zeri.="0";
				}
			}
			return strrev($zeri.$week_days);
			
		}
	}
	
	if ( ! function_exists('readableDate')) {
		function readableDate($date) {
			$year=substr($date,0,4);
			$month=substr($date,4,2);
			
			return $month."/".$year;
		}
	}
	
	if ( ! function_exists('readableCompleteDate')) {
		function readableCompleteDate($date) {
			$year=substr($date,0,4);
			$month=substr($date,4,2);
			$day=substr($date,6,2);
			return $day."/".$month."/".$year;
		}
		
	}
	
	if ( ! function_exists('readableTime')) {
		function readableTime($time) {
			$hours=substr($time,0,2);
			$minutes=substr($time,2,2);
			return $hours.":".$minutes;
		}
	}


	if ( ! function_exists('dateRange')) {
		//Return array con 2 date in formato diverso
		function dateRange ($f, $t) {

			$date_f=$date_t=0;

			if (!empty($f)){
				$f=explode("-",$f);
				$date_f=$f[2]."-".$f[1]."-".$f[0];
			}

			if (!empty($t)){
				$t=explode("-",$t);
				$date_t=$t[2]."-".$t[1]."-".$t[0];
			}

			$date_array= array("from"=>$date_f, "to"=>$date_t);
			return $date_array;
		}
	}


	if ( ! function_exists('dateFormatIT')) {
		//Format date H 01/01/2018 20:20.
		function dateFormatIT ($date) {
			return date("d/m/Y H:i", strtotime($date));
		}
	}


	if ( ! function_exists('IsoToDate')) {
		function IsoToDate($iso) {
			$format = "Y-m-d H:i:s"; 
			return date($format, strtotime($iso));
		}
	}

	
	if ( ! function_exists('epochToDate')) {
		// trasforma epoch in timestamp
		function epochToDate ($epoch) {
			if (strlen($epoch)==13)	$epoch=substr($epoch,0,10);
			$dt = new DateTime("@$epoch");
			return $dt->format("Y-m-d H:i:s");			
		}
	}
	
	if ( ! function_exists('dateToEpoch')) {
		// trasforma epoch in timestamp
		function dateToEpoch ($date) {
			$dt = new DateTime("$date");
			return $dt->format("U");			
		}
	}

	if ( ! function_exists('compareDates')) {
		function compareDates($start,$operator,$end) { 
			/* $start $operator $end */
			// operator < == >
			$permitted_operators=["<","==","!=",">"];
			if ($op=array_search($operator,$permitted_operators)===false) {
				audit_log("operator not permitted");
				return false;			
			}
			if (!$start = DateTime::createFromFormat("d/m/Y H:i", $start)) {
				audit_log("start is not a valid date");
				return false;
			}
			if (!$end = DateTime::createFromFormat("d/m/Y H:i", $end)) {
				audit_log("end is not a valid date");
				return false;
			}
			switch ($op) {
				case 0: // <
					return $start < $end;
					break;
				case 1: // ==
					return $start == $end;
					break;
				case 2: // !=
					return $start != $end;
					break;
				case 3: // >
					return $start > $end;
					break;
			}
		}
	}
?>
