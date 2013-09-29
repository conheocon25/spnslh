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
	private $DateTime;
	private $DateTimeEnd;
	private $Note;
	private $Status;
	private $DiscountValue;
	private $DiscountPercent;
	private $Surtax;
	private $Payment;
	private $Value;
	
	private $Table;
	private $Employee;

	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdTable=null, $IdUser=null, $IdCustomer=null, $DateTime=null, $DateTimeEnd=null, $Note=null, $Status=null, $DiscountValue=null, $DiscountPercent=null, $Surtax=null, $Payment=null, $Value=null ) {
        $this->Id = $Id;
		$this->IdTable = $IdTable;
		$this->IdUser = $IdUser;
		$this->IdCustomer = $IdCustomer;
		$this->DateTime = $DateTime;
		$this->DateTimeEnd = $DateTimeEnd;
		$this->Note = $Note;
		$this->Status = $Status;
		$this->DiscountValue = $DiscountValue;
		$this->DiscountPercent = $DiscountPercent;
		$this->Surtax = $Surtax;
		$this->Payment = $Payment;
		$this->Value = $Value;
		
        parent::__construct( $Id );
    }
	
	function setId( $Id) {
        return $this->Id = $Id;
    }
    function getId( ){
        return $this->Id;
    }
				
	function getIdTable( ) {
        return $this->IdTable;
    }	
	function setIdTable( $IdTable ) {
        $this->IdTable = $IdTable;
        $this->markDirty();
    }
	function getTable(){
		if (!isset($this->Table)){
			$mTable = new \MVC\Mapper\Table();
			$this->Table = $mTable->find($this->IdTable);
		}
		return $this->Table;
	}
		
	function setIdUser( $IdUser ) {
        $this->IdUser = $IdUser;
        $this->markDirty();
    }
	function getIdUser( ) {
        return $this->IdUser;
    }
	function getUser( ) {
		if (!isset($this->User)){
			$mUser = new \MVC\Mapper\User();
			$this->User = $mUser->find($this->IdUser);
		}
        return $this->User;
    }
	
	function getIdCustomer( ) {
        return $this->IdCustomer;
    }
	function getCustomer( ) {
		$mCustomer = new \MVC\Mapper\Customer();
		$Customer = $mCustomer->find($this->IdCustomer);
        return $Customer;
    }		
	function setIdCustomer( $IdCustomer ) {
        $this->IdCustomer = $IdCustomer;
        $this->markDirty();
    }
		
	//Giờ bắt đầu
	function setDateTime( $DateTime ) {
        $this->DateTime = $DateTime;
        $this->markDirty();
    }
	
	function getDateTime( ){
        return $this->DateTime;
    }
	function getDatePrint( ) {
		$date = new Date($this->getDateTime());
        return $date->getDateFormat();
    }
    function getDateTimePrint( ){
		return date('d/m H:i',strtotime($this->DateTime));
    }
		
	//Giờ kết thúc
	function setDateTimeEnd( $DateTime ) {
        $this->DateTimeEnd = $DateTime;
        $this->markDirty();
    }
	function getDateTimeEnd( ) {		
		if (!isset($this->DateTimeEnd) ){
			return $this->DateTimeEnd = \date("Y-m-d H:i:s");
		}
		else{
			return $this->DateTimeEnd;
		}
    }	
	function getDateTimeEndPrint( ) {
		return date('d/m H:i',strtotime($this->getDateTimeEnd()));
    }
			
	function getTimeRangePrint(){
		$DS = date('d/m H:i',strtotime($this->getDateTime()));
		$DE = date('H:i',strtotime($this->getDateTimeEnd()));
		return $DS." - ".$DE;
	}
	function getCurrentDatePrint(){
		$date = new Date();
		return $date->getCurrentDateVN();
	}
	
	//Ghi chú
	function getNote( ) {return $this->Note;}	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	
	//Giảm giá
	function setDiscountValue( $DiscountValue ) {$this->DiscountValue = $DiscountValue;$this->markDirty();}
	function getDiscountValue( ){return $this->DiscountValue;}
	function getDiscountValuePrint(){$num = new Number($this->getDiscountValue());return $num->formatCurrency()." đ";}
	
	function setDiscountPercent( $DiscountPercent ){
        $this->DiscountPercent = $DiscountPercent;
        $this->markDirty();
    }
	function getDiscountPercent( ){return $this->DiscountPercent;}
	function getDiscountPercentPrint(){
		$num = new Number($this->getDiscountPercent());
		return $num->formatCurrency()." %";
	}
	function getDiscountPercentValue( ){
		return (int)((($this->DiscountPercent*$this->getPreValue())/100)/1000)*1000;
	}
	function getDiscountPercentValuePrint(){
		$num = new Number($this->getDiscountPercentValue());
		return $num->formatCurrency()." đ";
	}
	
	//Phụ thu
	function setSurtax( $Surtax ) {$this->Surtax = $Surtax;$this->markDirty();}
	function getSurtax( ) {return $this->Surtax;}
	function getSurtaxPrint(){$num = new Number($this->getSurtax());return $num->formatCurrency()." đ";}
		
	//Tình trạng
	function getStatus( ) {return $this->Status;}	
	function setStatus( $Status ) {$this->Status = $Status;$this->markDirty();}
			
	function getStatusPrint(){if ( isset($this->DateTime) )return "Đang có khách";else return "Chưa có khách";}
	
	//Tiền khách trả
	function getPayment( ) {return $this->Payment;}	
	function setPayment( $Payment ) {$this->Payment = $Payment;$this->markDirty();}	
	function getPaymentPrint( ){$N = new \MVC\Library\Number($this->Payment);return $N->formatCurrency()." đ";}
	
	function getRemain( ){$Remain = $this->getPayment() - $this->getValue(); return $Remain;}	
	function getRemainPrint( ){$N = new \MVC\Library\Number( $this->getRemain() ); return $N->formatCurrency()." đ";}
	
	//Tính ra tiền giờ làm tròn 15 phút
	function getHours(){	
		$diff = strtotime($this->getDateTimeEnd()) - strtotime($this->getDateTime());
		$H = floor($diff/3600);
		$M = round(($diff - $H*3600)/60,0);
		return $H." giờ ".$M." phút";		
	}
	function getValueHours(){			
		return 0;
	}
	function getValueHoursPrint(){		
		$num = new Number($this->getValueHours());
		return $num->formatCurrency()." đ";
	}
	
	//---------------------------------------------------------										
	function getDetails(){
		$mSD = new \MVC\Mapper\SessionDetail();
		$SDs = $mSD->findBySession(array($this->getId()));
		return $SDs;
	}
	
	function setValue($Value){
		$this->Value = $Value;
		$this->markDirty();
	}
	
	function getValue(){
		$mSD = new \MVC\Mapper\SessionDetail();
		$Value = $this->getSurtax() + (int)(($mSD->evaluate(array($this->getId())) + 500 + $this->getValueHours() - $this->getDiscountValue())*(1.0 - $this->getDiscountPercent()/100.0)/1000)*1000;
		return $Value;
	}
			
	function getValuePrint(){
		$num = new Number($this->getValue());
		return $num->formatCurrency()." đ";
	}
	
	function getValueStrPrint(){
		$num = new Number($this->getValue());
		return $num->readDigit()." đồng";
	}
			
	function getValueBase(){
		$Value = 0;
		$SDs = $this->getDetails();
		while($SDs->valid()){
			$Value += $SDs->current()->getValueBase();
			$SDs->next();
		}
		return $Value;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLCheckoutLoad(){
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/".$this->getId()."/checkout/load";
    }
	
	function getURLCheckoutExe(){
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/".$this->getId()."/checkout/exe";
    }
	
	function getURLUpdLoad(){
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/log/".$this->getId()."/upd/load";
    }
	
	function getURLUpdExe(){		
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/log/".$this->getId()."/upd/exe";
    }
	
	function getURLDelLoad(){		
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/log/".$this->getId()."/del/load";
    }
	
	function getURLDelExe(){		
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/log/".$this->getId()."/del/exe";
    }
	
	function getURLDetail(){		
		$Domain = $this->getTable()->getDomain();
		return "/selling/".$Domain->getId()."/".$this->getIdTable()."/log/".$this->getId()."/detail";
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
