<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('standings_load'))
{
    function get_standings($var = '')
    {
        // query classifica 
		$CI =& get_instance();
		$punti=$CI->pronostici->calcolaClassifica();
		$standings=[];
		foreach ($punti as $val) {
			$standings[$val->id_user]=$val->punti;
		}
		
		return $standings; // array
    }   
}
