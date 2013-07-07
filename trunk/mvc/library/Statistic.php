<?php
Namespace MVC\Library;
class Statistic{

    private $Id;
	private $Name;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( ){
                
    }
    static function getCount(){
		$CountPage = ("data/hit_counter.txt");
		$Hits = \file($CountPage);
		$Hits[0] ++;
		$fp = \fopen($CountPage , "w");
		\fputs($fp , "$Hits[0]");
		\fclose($fp);
		return $Hits[0];
	}
	static function getCountPrint(){
		$CountPage = ("data/hit_counter.txt");
		$Hits = \file($CountPage);
		$Hits[0] ++;
		$fp = \fopen($CountPage , "w");
		\fputs($fp , "$Hits[0]");
		\fclose($fp);				
		$N = new Number($Hits[0]);
		//return "<H3>".$N->formatCurrency()."</H3>";
		return $N->formatCurrency();
	}
	
	static function getOnlinePrint(){
		
		$mGuest = new \MVC\Mapper\Guest();
		//Lấy tham số về
		$IP = $_SERVER['REMOTE_ADDR'];
		$Agent = $_SERVER['REMOTE_ADDR']; //$_SERVER['USER_AGENT'];
		$EntryTime = \time();
		$ExitTime= \time()+(60*60*24);
		if (!isset($Agent))
			$Agent = "";
		
		//Kiểm tra dữ liệu có thực
		if(!empty($IP) || !empty($Agent)){
		
			//Kiểm tra IP có tồn tại trong CSDL hay chưa ?
			$Guests = $mGuest->findByIP(array($IP));
		
			//Nếu chưa có thì thêm mới vào CSDL
			if($Guests->count() == 0){
				$Guest = new \MVC\Domain\Guest(
					null,
					$IP,
					$Agent,
					$EntryTime,
					$ExitTime
				);
				$mGuest->insert($Guest);
			}
			$Guests = $mGuest->findAll();
			$N = new Number($Guests->count());
			$mGuest->delete(array($EntryTime));								
						
			return $N->formatCurrency();
		}
		return 0;
	}
}	
?>