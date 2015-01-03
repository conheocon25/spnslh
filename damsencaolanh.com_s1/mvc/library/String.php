<?php
Namespace MVC\Library;
class String {
	private $Value;
	
	function __construct( $Value) {        
		$this->Value = $Value;
    }
	
	function reduce($max = 50, $rep = '...'){
		$strlen = strlen($this->Value);
		if ($strlen <= $max){
			return $this->Value;
		}
		
		$lengthtokeep = $max - strlen($rep);
		$start = 0;
		$end = 0;
		
		if (($lengthtokeep % 2) == 0) {
			$start = $lengthtokeep / 2;
			$end = $start;
		}else{
			$start = intval($lengthtokeep / 2);
			$end = $start + 1;
		}
		$i = $start;
		$tmp_string = $this->Value;
		while ($i < $strlen) {
			if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
				$tmp_string = substr($tmp_string, 0, $i) . $rep;
				$return = $tmp_string;
			}
			$i++;
		}
		$i = $end;
		$tmp_string = strrev($this->Value);
		while ($i < $strlen){
			if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
				$tmp_string = substr($tmp_string, 0, $i);
				$return .= strrev ($tmp_string);
			}
			$i++;
		}
		return $return;		
	}
}
?>