<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Tracking extends Object{
    private $Id;
	private $DateStart;
	private $DateEnd;
	
	private $Collect1;
	private $Collect2;
	private $Collect3;
	
	private $Paid1;
	private $Paid2;
	private $Paid3;
	
	private $Value;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
			$Id=null,
			$DateStart=null, 
			$DateEnd=null,
			$Collect1=null,
			$Collect2=null,
			$Collect3=null,
			$Paid1=null,
			$Paid2=null,
			$Paid3=null,
			$Value=null
	){
			$this->Id 				= $Id; 
			$this->DateStart 		= $DateStart; 
			$this->DateEnd 			= $DateEnd;
			
			$this->Collect1 		= $Collect1;
			$this->Collect2 		= $Collect2;
			$this->Collect3 		= $Collect3;
			
			$this->Paid1 			= $Paid1;
			$this->Paid2 			= $Paid2;
			$this->Paid3 			= $Paid3;
			
			$this->Value 			= $Value;
									
			parent::__construct( $Id );
	}
    function setId($Id) {return $this->Id = $Id;}
	function getId() {return $this->Id;}
	function getName(){$Name = 'THÁNG '.\date("m/Y", strtotime($this->getDateStart()));return $Name;}
	
    function setDateStart( $DateStart ) {$this->DateStart = $DateStart;$this->markDirty();}   
	function getDateStart( ) {return $this->DateStart;}	
	function getDateStartPrint( ) {$D = new \MVC\Library\Date($this->DateStart);return $D->getDateFormat();}
	
	function setDateEnd( $DateEnd ) {$this->DateEnd= $DateEnd;$this->markDirty();}   
	function getDateEnd( ) {return $this->DateEnd;}	
	function getDateEndPrint( ) {$D = new \MVC\Library\Date($this->DateEnd);return $D->getDateFormat();}
	
	function setPaid1( $Paid1 ) {$this->Paid1 = $Paid1; $this->markDirty();}   
	function getPaid1( ) {return $this->Paid1;}
	function getPaid1Print( ) {$N = new \MVC\Library\Number($this->Paid1);return $N->formatCurrency();}
	
	function setPaid2( $Paid2 ) {$this->Paid2 = $Paid2; $this->markDirty();}   
	function getPaid2( ) {return $this->Paid2;}
	function getPaid2Print( ) {$N = new \MVC\Library\Number($this->Paid2);return $N->formatCurrency();}
	
	function setPaid3( $Paid3 ) {$this->Paid3 = $Paid3; $this->markDirty();}   
	function getPaid3( ) {return $this->Paid3;}
	function getPaid3Print( ) {$N = new \MVC\Library\Number($this->Paid3);return $N->formatCurrency();}
	
	function setCollect1( $Collect1 ) {$this->Collect1 = $Collect1; $this->markDirty();}
	function getCollect1( ) {return $this->Collect1;}
	function getCollect1Print( ) {$N = new \MVC\Library\Number($this->Collect1);return $N->formatCurrency();}

	function setCollect2( $Collect2 ) {$this->Collect2 = $Collect2; $this->markDirty();}
	function getCollect2( ) {return $this->Collect2;}
	function getCollect2Print( ) {$N = new \MVC\Library\Number($this->Collect2);return $N->formatCurrency();}
	
	function setCollect3( $Collect3 ) {$this->Collect3 = $Collect3; $this->markDirty();}
	function getCollect3( ) {return $this->Collect3;}
	function getCollect3Print( ) {$N = new \MVC\Library\Number($this->Collect3);return $N->formatCurrency();}

	function setValue( $Value ) {$this->Value = $Value; $this->markDirty();}
	function getValue( ) {return $this->Value;}
	function getValuePrint( ) {$N = new \MVC\Library\Number($this->Value);return $N->formatCurrency();}	
	function reValue( ){
		$mTracking = new \MVC\Mapper\Tracking();
		$TrackingPre = $mTracking->findPre(array($this->getDateStart()));
		
		$TDAll = $this->getDailyAll();
		
		$Collect1 = 0;
		$Collect2 = 0;
		$Collect3 = 0;
		
		$Paid1 = 0;
		$Paid2 = 0;
		$Paid3 = 0;
		
		$Value = 0;
		
		while ($TDAll->valid())
		{
			$TD = $TDAll->current();
			$Collect1 += $TD->getCollect1();
			$Collect2 += $TD->getCollect2();
			$Collect3 += $TD->getCollect3();
			
			$Paid1 += $TD->getPaid1();
			$Paid2 += $TD->getPaid2();
			$Paid3 += $TD->getPaid3();
			if ($TD->getValue()>0) $Value = $TD->getValue();
			
			$TDAll->next();	
		}		
		$this->Collect1 = $Collect1;
		$this->Collect2 = $Collect2;
		$this->Collect3 = $Collect3;
		$this->Paid1 = $Paid1;
		$this->Paid2 = $Paid2;
		$this->Paid3 = $Paid3;
		
		if ($TrackingPre->count()>0){
			$this->Value = $Value + $TrackingPre->current()->getValue();
		}else{
			$this->Value = $Value;
		}
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->DateStart 	= $Data[1];
		$this->DateEnd 		= $Data[2];
		$this->Collect1		= $Data[3];
		$this->Collect2		= $Data[4];
		$this->Collect3		= $Data[5];
		$this->Paid1		= $Data[6];
		$this->Paid2		= $Data[7];
		$this->Paid3		= $Data[8];
		$this->Value		= $Data[9];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getPayRollAll(){
		$mPayRoll 	= new \MVC\Mapper\PayRoll();
		$PRAll		= $mPayRoll->findByTracking(array($this->getId()));
		return $PRAll;
	}
	
	function getDailyAll(){
		$mTD 	= new \MVC\Mapper\TrackingDaily();
		$TDAll 	= $mTD->findBy(array($this->getId()));
		return $TDAll;
	}
	
	function getCustomerAll(){
		$mTC 	= new \MVC\Mapper\TrackingCustomer();
		$TCAll 	= $mTC->findByTracking(array($this->getId()));
		return $TCAll;
	}
	
	function generateCustomer(){
		$Date = $this->getDateStart();
		$EndDate = $this->getDateEnd();
		$mTC = new \MVC\Mapper\TrackingCustomer();
		$mCustomer = new \MVC\Mapper\Customer();
		$CustomerAll = $mCustomer->findAll();
		
		while ($CustomerAll->valid())
		{
			$Customer = $CustomerAll->current();
			$TC = new \MVC\Domain\TrackingCustomer(
				null,
				$this->getId(), 
				$Customer->getId(),
				0, 0, 0, 0, 0, 0
			);
			$mTC->insert($TC);
			$CustomerAll->next();	
		}		
	}	
	
	function generateDaily(){
		$Date = $this->getDateStart();
		$EndDate = $this->getDateEnd();
		$mTD = new \MVC\Mapper\TrackingDaily();
		
		while (strtotime($Date) <= strtotime($EndDate)){
			$TD = new \MVC\Domain\TrackingDaily(
				null,
				$this->getId(), 
				$Date, 
				0, 
				0, 
				0, 
				0, 
				0,
				0,
				0
			);
			$mTD->insert($TD);
			$Date = \date("Y-m-d", strtotime("+1 day", strtotime($Date)));
		}
	}	
	
	//CÁC LIÊN KẾT CỦA CÁC NGÀY TRONG THÁNG
	function getURLDayAll(){
		$Data = array();
		$Date = $this->getDateStart();
		$EndDate = $this->getDateEnd();
		while (strtotime($Date) <= strtotime($EndDate)){
			$Data[] = array(
						\date("d/m", strtotime($Date)),
						"/report/selling/".$Date."/detail",
						"/report/log/".$Date,
						"/payroll/".$this->getId()."/absent/".$Date,
						"/payroll/".$this->getId()."/late/".$Date,
						$Date
					);
			$Date = \date("Y-m-d", strtotime("+1 day", strtotime($Date)));
		}
		return $Data;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/report/".$this->getId();}
	
	function getURLPayRoll(){return "/payroll/".$this->getId();}	
	function getURLPayRollEmployee( $Employee ){return "/payroll/".$this->getId()."/".$Employee->getId();}
			
	function getURLCustomer(){return "/report/".$this->getId()."/customer";}	
	function getURLSupplier(){return "/report/".$this->getId()."/supplier";}
	function getURLStore(){return "/report/".$this->getId()."/store";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>