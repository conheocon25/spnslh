<?php
Namespace MVC\Library;
class Date{
	private $Value;
	
	function __construct( $Value=null){
		date_default_timezone_set('Asia/Jakarta');
		$this->Value = $Value;        
    }
	
	function getDateFormat(){
		return date('d/m/Y',strtotime($this->Value));	
	}
	
	function getDateTimeFormat(){
		return date('d/m H:i',strtotime($this->Value));
	}
	
	function getTimeFormat(){
		return date('H:i:s',strtotime($this->Value));
	}
	
	function getCurrentDateTime(){		
		$Today = \getdate();
        $d = $Today['year']."-".$Today['mon']."-".$Today['mday']." ".$Today['hours'].":".$Today['minutes'].":".$Today['seconds'];
		return $d;
	}
	function getCurrentDateVN(){	
		//date_default_timezone_set('Asia/Jakarta');
		$now = getdate();		
		$currentDate = $now["mday"] . "/" . $now["mon"] . "/" . $now["year"];       
		return $currentDate;
	}
	
	//Buổi sáng là từ 6h sáng đến trước 12h trưa
	function rangeMorning(){				
		$day = new \DateTime();		
		$day->setTime(6, 0, 0);
		$d1 = $day->format('Y-m-d H:i:s');
		$day->setTime(11, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Buổi trưa là từ 12h sáng đến trước 6h chiều
	function rangeAfternoon(){
		$day = new \DateTime();
		$day->setTime(12, 0, 0);
		$d1 = $day->format('Y-m-d H:i:s');
		$day->setTime(17, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Buổi tối là từ 18h đến trước 22h
	function rangeEvening(){				
		$day = new \DateTime();
		$day->setTime(18, 0, 0);
		$d1 = $day->format('Y-m-d H:i:s');
		$day->setTime(21, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Hôm nay
	function rangeToday(){			
		$day = new \DateTime();
		$day->setTime(0, 0, 0);
		$d1 = $day->format('Y-m-d H:i:s');
		$day->setTime(23, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Hôm qua
	function rangeYesterday(){				
		$day = new \DateTime();
		$day->sub(new \DateInterval('P1D'));
		$day->setTime(0, 0, 0);
		$d1 = $day->format('Y-m-d H:i:s');
		$day->setTime(23, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Tháng này
	function rangeThisMonth(){				
		$day = new \DateTime();		
		$day->setTime(0, 0, 0);
		$day->modify('first day of this month');
		$d1 = $day->format('Y-m-d H:i:s');
		$day->modify('last day of this month');
		$day->setTime(23, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Tháng trước
	function rangeBeforeMonth(){		
		$day = new \DateTime();
		$day->sub(new \DateInterval('P1M'));
		$day->setTime(0, 0, 0);
		$day->modify('first day of this month');
		$d1 = $day->format('Y-m-d H:i:s');
		$day->modify('last day of this month');
		$day->setTime(23, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Tuần này
	function rangeThisWeek(){				
		$day = new \DateTime();
		$day->setTime(0, 0, 0);
		$day->modify('last sunday');
		$d1 = $day->format('Y-m-d H:i:s');
		$day->modify('next saturday');
		$day->setTime(23, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Tuần trước
	function rangeBeforeWeek(){				
		$day = new \DateTime();
		$day->sub(new \DateInterval('P1W'));
		$day->setTime(0, 0, 0);
		$day->modify('last sunday');
		$d1 = $day->format('Y-m-d H:i:s');
		$day->modify('next saturday');
		$day->setTime(23, 59, 59);
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
	//Tính nợ cũ
	function rangeOldDebt($Date){
		$day = new \DateTime('2012-1-1');
		$d1 = $day->format('Y-m-d H:i:s');
		
		$day = new \DateTime($Date);
		$day->sub(new \DateInterval('P1D'));
		$d2 = $day->format('Y-m-d H:i:s');
		return array($d1, $d2);
	}
	
}
?>