<?php
Namespace MVC\Domain;
use MVC\Library\Number;
use MVC\Library\Date;

require_once( "mvc/base/domain/DomainObject.php" );
class Session extends Object{

    private $Id;	
	private $IdTable;
	private $IdUser;
	private $IdCustomer;
	private $IdEmployee;
	private $DateTime;
	private $DateTimeEnd;
	private $Note;
	private $Status;
	private $DiscountValue;
	private $DiscountPercent;
	private $Surtax;
	private $Payment;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdTable=null, $IdUser=null, $IdCustomer=null, $IdEmployee=null, $DateTime=null, $DateTimeEnd=null, $Note=null, $Status=null, $DiscountValue=null, $DiscountPercent=null, $Surtax=null, $Payment=null ) {
        $this->Id 			= $Id;
		$this->IdTable 		= $IdTable;
		$this->IdUser 		= $IdUser;
		$this->IdCustomer 	= $IdCustomer;
		$this->IdEmployee 	= $IdEmployee;
		$this->DateTime 	= $DateTime;
		$this->DateTimeEnd 	= $DateTimeEnd;
		$this->Note 		= $Note;
		$this->Status 		= $Status;
		$this->DiscountValue = $DiscountValue;
		$this->DiscountPercent = $DiscountPercent;
		$this->Surtax 		= $Surtax;
		$this->Payment 		= $Payment;
		
        parent::__construct( $Id );
    }
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdTable'			=> $this->getIdTable(),			
			'IdUser'			=> $this->getIdUser(),						
			'IdCustomer'		=> $this->getIdCustomer(),
			'CustomerName'		=> $this->getCustomer()->getName(),
			'IdEmployee'		=> $this->getIdEmployee(),
			'DateTime'			=> $this->getDateTime(),
			'DateTimeEnd'		=> $this->getDateTimeEnd(),
			'Note'				=> $this->getNote(),
			'Status'			=> $this->getStatus(),
			'DiscountValue'		=> $this->getDiscountValue(),
			'DiscountPercent'	=> $this->getDiscountPercent(),
			'Surtax'			=> $this->getSurtax(),
			'Payment'			=> $this->getPayment()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdTable 			= $Data[1];
		$this->IdUser 			= $Data[2];
		$this->IdCustomer 		= $Data[3];
		$this->IdEmployee 		= $Data[4];
		$this->DateTime 		= $Data[5];
		$this->DateTimeEnd 		= $Data[6];
		$this->Note 			= $Data[7];
		$this->Status 			= $Data[8];
		$this->DiscountValue 	= $Data[9];
		$this->DiscountPercent 	= $Data[10];
		$this->Surtax 			= $Data[11];
		$this->Payment 			= $Data[12];
    }
		
	function setId( $Id) {return $this->Id = $Id;}
    function getId( ){return $this->Id;}
				
	function getIdTable( ) {return $this->IdTable;}	
	function setIdTable( $IdTable ) {$this->IdTable = $IdTable; $this->markDirty();}
	function getTable(){		
		$mTable = new \MVC\Mapper\Table();
		$Table = $mTable->find($this->IdTable);		
		return $Table;
	}
		
	function setIdUser( $IdUser ){$this->IdUser = $IdUser;$this->markDirty();}
	function getIdUser( ) {return $this->IdUser;}
	function getUser( ) {	
		$mUser = new \MVC\Mapper\User();
		$User = $mUser->find($this->IdUser);		
        return $User;
    }
	
	function getIdCustomer( ) {return $this->IdCustomer;}
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer;$this->markDirty();}
	function getCustomer( ) {
		$mCustomer = new \MVC\Mapper\Customer();
		$Customer = $mCustomer->find($this->IdCustomer);
        return $Customer;
    }		
	
	function getIdEmployee( ) {return $this->IdEmployee;}
	function setIdEmployee( $IdEmployee ) {$this->IdEmployee = $IdEmployee;$this->markDirty();}
	function getEmployee( ) {
		$mEmployee 	= new \MVC\Mapper\Employee();
		$Employee 	= $mEmployee->find($this->IdEmployee);
        return $Employee;
    }		
	
	//Giờ bắt đầu
	function setDateTime( $DateTime ) {$this->DateTime = $DateTime;$this->markDirty();}	
	function getDateTime( ){return $this->DateTime;}
	function getDatePrint( ) {$date = new Date($this->getDateTime());return $date->getDateFormat();}
    function getDateTimePrint( ){return date('d/m H:i',strtotime($this->DateTime));}
		
	//Giờ kết thúc
	function setDateTimeEnd( $DateTime ) {$this->DateTimeEnd = $DateTime;$this->markDirty();}
	function getDateTimeEnd( ) {
		if (!isset($this->DateTimeEnd) ){
			return $this->DateTimeEnd = \date("Y-m-d H:i:s");
		}
		else{
			return $this->DateTimeEnd;
		}
    }	
	function getDateTimeEndPrint( ) {return date('d/m H:i',strtotime($this->getDateTimeEnd()));}
			
	function getTimeRangePrint(){
		$DS = date('d/m H:i',strtotime($this->getDateTime()));
		$DE = date('H:i',strtotime($this->getDateTimeEnd()));
		return $DS." - ".$DE;
		//return $DS;
	}
	function getCurrentDatePrint(){$date = new Date();return $date->getCurrentDateVN();}
		
	//Ghi chú
	function getNote( ) {return $this->Note;}	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	
	//Giảm giá
	function setDiscountValue( $DiscountValue ) {
        $this->DiscountValue = $DiscountValue;
        $this->markDirty();
    }
	function getDiscountValue( ){
        return $this->DiscountValue;
    }
	function getDiscountValuePrint(){
		$num = new Number($this->getDiscountValue());
		return $num->formatCurrency();
	}
	
	function setDiscountPercent( $DiscountPercent ) {
        $this->DiscountPercent = $DiscountPercent;
        $this->markDirty();
    }
	function getDiscountPercent( ){return $this->DiscountPercent;}
	function getDiscountPercentPrint(){$num = new Number($this->getDiscountPercent());return $num->formatCurrency()." %";}
	
	//Phụ thu
	function setSurtax( $Surtax ) {$this->Surtax = $Surtax;$this->markDirty();}
	function getSurtax( ) {return $this->Surtax;}
	function getSurtaxPrint(){$num = new Number($this->getSurtax());return $num->formatCurrency();}
		
	//Tình trạng
	function getStatus( ) {return $this->Status;}	
	function setStatus( $Status ) {$this->Status = $Status;$this->markDirty();}
			
	function getStatusPrint(){if ( isset($this->DateTime) )return "Đang có khách";else return "Chưa có khách";}
	
	//Tiền khách trả
	function getPayment( ) {return $this->Payment;}	
	function setPayment( $Payment ) {$this->Payment = $Payment;
        $this->markDirty();
    }
	
	//Tính ra tiền giờ làm tròn 15 phút
	function getHoursReal(){	
		$diff = strtotime($this->getDateTimeEnd()) - strtotime($this->getDateTime());
		$H = round($diff/3600, 1);
		//$M = round(($diff - $H*3600)/60,0);
		return $H;
	}
	
	function getHours(){	
		$diff = strtotime($this->getDateTimeEnd()) - strtotime($this->getDateTime());
		$H = floor($diff/3600);
		$M = round(($diff - $H*3600)/60,0);
		return $H." giờ ".$M." phút";		
	}
	function getValueHours(){
		//Lấy thông số Config
		$mConfig = new \MVC\Mapper\Config();
			
		$IsVIP = $this->getTable()->getType();
		$Value = 0;
				
		if ($IsVIP==1){			
			$Price1 = $mConfig->findByName('PRICE_HOUR_VIP_1')->getValue();
			$Price2 = $mConfig->findByName('PRICE_HOUR_VIP_2')->getValue();									
		}else{
			$Price1 = $mConfig->findByName('PRICE_HOUR_NORMAL_1')->getValue();
			$Price2 = $mConfig->findByName('PRICE_HOUR_NORMAL_2')->getValue();			
		}
				
		$HDS = \date("H", strtotime($this->getDateTime())) + \date("i", strtotime($this->getDateTime()))/60;
		$HD = (strtotime($this->getDateTimeEnd()) - strtotime($this->getDateTime()))/3600;
		$HDE = $HDS + $HD;
		//echo $HDS."-".$HDE;
		if ($HDS >=7){
			//echo "TH1";
			//Giá ban ngày
			if ($HDE <19){
				$Value = ($HDE - $HDS)*$Price1;
			}else{				
				if ($HDS>=19){
					//echo "TH1.1:".$HDS." - ".$HDE.":";
					$Value = ($HDE - $HDS)*$Price2;
				}else{					
					$Value = ($HDE - 19)*$Price2;
					$Value += (19 - $HDS)*$Price1;
				}
			}
		}else{
			//echo "TH2 ".$HDE;
			//Vào chơi từ lúc qua ngày mới
			if ($HDE <7){
				//echo "TH21 ".($HDE - $HDS);
				$Value = ($HDE - $HDS)*$Price2;
			}else{
				//lố quá ngày mới, chưa có ngoại lệ			
				//echo "TH22";
			}
		}		
		return $Value;
	}
	function getValueHoursPrint(){		
		$num = new Number($this->getValueHours());
		return $num->formatCurrency()." đ";		
	}
	
	function getPaymentPrint( ){$N = new \MVC\Library\Number($this->Payment);return $N->formatCurrency()." đ";}	
	function getRemain( ){$Remain = $this->getPayment() - $this->getValue();return $Remain;}	
	function getRemainPrint( ){$N = new \MVC\Library\Number( $this->getRemain() );return $N->formatCurrency()." đ";}
			
	//---------------------------------------------------------										
	function getDetails(){
		$mSD = new \MVC\Mapper\SessionDetail();
		$SDs = $mSD->findBySession(array($this->getId()));
		return $SDs;
	}
			
	function getValue(){		
		$SDAll = $this->getDetails();
		$Sum1 = 0;
		$Sum2 = 0;
		
		while ($SDAll->valid()){
			$SD = $SDAll->current();
			if ($SD->getCourse()->getIsDiscount()==0){
				$Sum1 += $SD->getValue();	
			}else{
				$Sum2 += $SD->getValue();
			}
			$SDAll->next();
		}		
		$Value = $this->getSurtax() + (int)( ($Sum2 *(1.0 - $this->getDiscountPercent()/100.0) + $Sum1) /1000)*1000;
		return $Value;
	}
		
	function getValuePrint(){$num = new Number($this->getValue());return $num->formatCurrency();}
	function getValueStrPrint(){$num = new Number($this->getValue());return $num->readDigit()." đồng";}
	function getValueBase(){
		$Value = 0;
		$SDs = $this->getDetails();
		while($SDs->valid()){
			$Value += $SDs->current()->getValue();
			$SDs->next();
		}
		return $Value;
	}
	function getValueBasePrint(){$num = new Number($this->getValueBase());return $num->formatCurrency();}
			
	function findItem($IdCourse){
		$mSD = new \MVC\Mapper\SessionDetail();
		$SD = $mSD->findItem( array($this->getId(), $IdCourse) );
		return $SD;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------		
	function getURLCheckoutExe(){
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/".$this->getId()."/checkout/exe";
    }				
	
	function getURLPrint(){
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/".$this->getId()."/print";
    }
	
	//---------------------------------------------------------	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}	
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>
