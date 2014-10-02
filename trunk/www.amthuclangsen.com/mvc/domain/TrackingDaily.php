<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingDaily extends Object{

    private $Id;
	private $IdTracking;
	private $Date;
	private $Ticket1;
    private $Ticket2;
    private $Paid1;
    private $Paid2;
	private $Debt;
	private $Paid1Remain;
    private $Paid2Remain;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null,
		$IdTracking	= null, 
		$Date		= null, 
		$Ticket1	= null, 
		$Ticket2	= null, 
		$Paid1		= null,
		$Paid2		= null,
		$Debt		= null,
		$Paid1Remain= null,
		$Paid2Remain= null
	) {
        $this->Id 			= $Id;
		$this->IdTracking 	= $IdTracking;
		$this->Date 		= $Date;
		$this->Ticket1 		= $Ticket1;
		$this->Ticket2 		= $Ticket2;
		$this->Paid1 		= $Paid1;
		$this->Paid2 		= $Paid2;
		$this->Debt 		= $Debt;
		$this->Paid1Remain	= $Paid1Remain;
		$this->Paid2Remain	= $Paid2Remain;
			
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
	
	function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ) {$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	function getDateShortPrint( ) {return date('d/m',strtotime($this->Date));}
	function getDayName(){
		$Arr = array(
			"Sunday"	=>"CN",
			"Monday"	=>"T.Hai",
			"Tuesday"	=>"T.Ba",
			"Wednesday"	=>"T.Tư",
			"Thursday"	=>"T.Năm",
			"Friday"	=>"T.Sáu",
			"Saturday"	=>"T.Bảy"
		);
		return $Arr[\date('l', strtotime( $this->Date))];
	}
	
	function setTicket1( $Ticket1 ) {$this->Ticket1 = $Ticket1;$this->markDirty();}   
	function getTicket1( ) {return $this->Ticket1;}
	function getTicket1Print( ){$N = new \MVC\Library\Number($this->Ticket1);return $N->formatCurrency();}
	
	function setTicket2( $Ticket2 ) {$this->Ticket2 = $Ticket2;$this->markDirty();}   
	function getTicket2( ) {return $this->Ticket2;}
	function getTicket2Print( ){$N = new \MVC\Library\Number($this->Ticket2);return $N->formatCurrency();}
	
	function getTicketD(){return $this->Ticket1 - $this->Ticket2;}
	function getTicketDPrint(){
		$N = new \MVC\Library\Number($this->getTicketD());
		return 	$N->formatCurrency();
	}
	
	function getTicketValue(){return 	$this->getTicketD()*9000; }
	function getTicketValuePrint(){
		$N = new \MVC\Library\Number($this->getTicketValue());
		return 	$N->formatCurrency();
	}
	
	function setPaid1( $Paid1 ) {$this->Paid1 = $Paid1; $this->markDirty();}   
	function getPaid1( ) {return $this->Paid1;}
	function getPaid1Print( ) {$N = new \MVC\Library\Number($this->Paid1);return $N->formatCurrency();}
	
	function setPaid2( $Paid2 ) {$this->Paid2 = $Paid2; $this->markDirty();}   
	function getPaid2( ) {return $this->Paid2;}
	function getPaid2Print( ) {$N = new \MVC\Library\Number($this->Paid2);return $N->formatCurrency();}
	
	function setDebt( $Debt ) {$this->Debt = $Debt; $this->markDirty();}
	function getDebt( ) {return $this->Debt;}
	function getDebtPrint( ) {$N = new \MVC\Library\Number($this->Debt);return $N->formatCurrency();}
	
	function setPaid1Remain( $Paid1Remain ) {$this->Paid1Remain = $Paid1Remain; $this->markDirty();}   
	function getPaid1Remain( ) {return $this->Paid1Remain;}
	function getPaid1RemainPrint( ) {$N = new \MVC\Library\Number($this->Paid1Remain);return $N->formatCurrency();}
	
	function setPaid2Remain( $Paid2Remain ) {$this->Paid2Remain = $Paid2Remain; $this->markDirty();}   
	function getPaid2Remain( ) {return $this->Paid2Remain;}
	function getPaid2RemainPrint( ) {$N = new \MVC\Library\Number($this->Paid2Remain);return $N->formatCurrency();}
	
	function getValue(){return $this->Paid1Remain + $this->Paid2Remain;}
	function getValuePrint(){
		$N = new \MVC\Library\Number($this->getValue());
		return 	$N->formatCurrency();
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getLotoAll(){
		$mLoto = new \MVC\Mapper\Loto();
		$LotoAll = 	$mLoto->findBy(array($this->getId()));
		return $LotoAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLReport()				{return "/report/".$this->getIdTracking()."/".$this->getId();}
	function getURLReportSelling()		{return "/report/".$this->getIdTracking()."/".$this->getId()."/selling";}
	function getURLReportSellingExe()	{return "/report/".$this->getIdTracking()."/".$this->getId()."/selling/exe";}
	function getURLResult()				{return "/result/".$this->getIdTracking()."/".$this->getId();}
	function getURLResultView()			{return "/result/".$this->getIdTracking()."/".$this->getId()."/view";}
	function getURLResultPrint()		{return "/result/".$this->getIdTracking()."/".$this->getId()."/print";}
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>