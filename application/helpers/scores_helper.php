<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_scores'))
{

	function get_scores($id_giornata) 
	{
		// recupero punteggi per giornata
		$CI =& get_instance();
		$matches_scores=[];
		if ($scores=$CI->pronostici->getGiornataPronostici($id_giornata)) {
			foreach ($scores as $val) {
				switch ($val->punteggio) {
					case 0:
						$val->class="danger";
						break;
					case 3:	
						$val->class="info";
						break;
					case 5:
						$val->class="success";
						break;
				}
				$match_scores[$val->id_partita][$val->id_user][]=$val;
			}
		}
				
		return $match_scores;
	}
     
}
