<?php
Namespace MVC\Library;
class Number {
	private $Value;
	
	function __construct( $Value) {        
		$this->Value = $Value;        
    }
		
	private function read3Digit($number){
		$arr = array("", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
		$n1 = intval($number/100);
		$n2 = intval(($number % 100)/10);
		$n3 = intval($number % 10);
		$s = "";
		if ($n1>0){	
			if ($n2==0)
			{
				if ($n3==0)
					$s	= $arr[$n1]." trăm ";
				else
					$s	= $arr[$n1]." trăm lẻ ".$arr[$n3];
			}
			else if ($n2==1){				
				if ($n3 == 5){
					$s	= $arr[$n1]." trăm mười lăm";
				}
				else
				{
					$s	= $arr[$n1]." trăm mười ".$arr[$n3];
				}				
			}
			else{			
				if ($n3 == 5){
					$s	= $arr[$n1]." trăm ".$arr[$n2]." mươi lăm";
				}
				else if ($n3 == 1){
					$s	= $arr[$n1]." trăm ".$arr[$n2]." mươi mốt";
				}
				else{
					$s	= $arr[$n1]." trăm ".$arr[$n2]." mươi ".$arr[$n3];
				}				
			}
		}
		else{		
			if ($n2==0){
				if ($n3==0)
				{
					$s = "";
				}
				else{
					$s	= $arr[$n3];
				}
			}
			else if ($n2==1){			
				if ($n3 == 5){
					$s	= "mười lăm";
				}
				else{
					$s	= $arr[$n1]." mười ".$arr[$n3];
				}				
			}
			else{
				if ($n3 == 5){
					$s	= $arr[$n2]." mươi lăm";
				}
				else if ($n3 == 1){
					$s	= $arr[$n2]." mươi mốt";
				}
				else{
					$s	= $arr[$n2]." mươi ".$arr[$n3];
				}				
			}
		}
		return $s;
	}	
	function readDigitNonSene($number)
	{		
		$arr = array("", "nghìn", "triệu", "tỉ");
		$ntemp = 0;
		$s = "";
		$index = 0;
		while($number > 0)
		{
			$ntemp = intval(fmod($number,1000));
			$s1 = self::read3DigitNonSene($ntemp);
			
			if ($s1!=""){
				$s = $s1." ".$arr[$index]." ".$s;
			}
			$number = intval($number/1000);			
			$index += 1;
		}
		return $s;
	}
	function read3DigitNonSene($number){
		$arr = array("", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
		$n1 = intval($number/100);
		$n2 = intval(($number % 100)/10);
		$n3 = intval($number % 10);
		$s = "";
		if ($n1>0){	
			if ($n2==0)
			{
				if ($n3==0)
					$s	= $arr[$n1]." tram ";
				else
					$s	= $arr[$n1]." tram le ".$arr[$n3];
			}
			else if ($n2==1){				
				if ($n3 == 5){
					$s	= $arr[$n1]." tram muoi lam";
				}
				else
				{
					$s	= $arr[$n1]." tram muoi ".$arr[$n3];
				}				
			}
			else{			
				if ($n3 == 5){
					$s	= $arr[$n1]." tram ".$arr[$n2]." muoi lam";
				}
				else if ($n3 == 1){
					$s	= $arr[$n1]." tram ".$arr[$n2]." muoi mot";
				}
				else{
					$s	= $arr[$n1]." tram ".$arr[$n2]." muoi ".$arr[$n3];
				}				
			}
		}
		else{		
			if ($n2==0){
				if ($n3==0)
				{
					$s = "";
				}
				else{
					$s	= $arr[$n3];
				}
			}
			else if ($n2==1){			
				if ($n3 == 5){
					$s	= "muoi lam";
				}
				else{
					$s	= $arr[$n1]." muoi ".$arr[$n3];
				}				
			}
			else{
				if ($n3 == 5){
					$s	= $arr[$n2]." muoi lam";
				}
				else if ($n3 == 1){
					$s	= $arr[$n2]." muoi mot";
				}
				else{
					$s	= $arr[$n2]." muoi ".$arr[$n3];
				}				
			}
		}
		return $s;
	}	
	public function readDigit()
	{		
		$arr = array("", "ngàn", "triệu", "tỉ");
		$ntemp = 0;
		$s = "";
		$index = 0;
		
		$number = $this->Value;
		while($number > 0)
		{
			$ntemp = intval(fmod($number,1000));
			$s1 = self::read3Digit($ntemp);
			
			if ($s1!=""){
				$s = $s1." ".$arr[$index]." ".$s;
			}
			$number = intval($number/1000);			
			$index += 1;
		}
		return $s;
	}
	/*
	---------------------------------------------------------------
	formatCurrency định dạng số ở dạng tiền tệ
		-		
	---------------------------------------------------------------
	*/
	function formatCurrency( ){
		$num = number_format($this->Value, 0, ',', '.');
        return $num;
	}
}

?>