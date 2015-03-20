<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingCustomer extends Object{

    private $Id;
	private $IdTracking;
	private $IdCustomer;
	private $Collect;		
	private $Paid;	
	private $Value;
	private $ValueGlobal;
	private $Count;
	private $CountGlobal;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdTracking=null,
		$IdCustomer=null, 
		$Collect=null,
		$Paid=null,		
		$Value=null,
		$ValueGlobal=null,
		$Count=null,
		$CountGlobal=null
	) {
        $this->Id 				= $Id;
		$this->IdTracking 		= $IdTracking;
		$this->IdCustomer 		= $IdCustomer;
		$this->Collect 			= $Collect;
		$this->Paid 			= $Paid;		
		$this->Value 			= $Value;
		$this->ValueGlobal		= $ValueGlobal;
		$this->Count 			= $Count;
		$this->CountGlobal		= $CountGlobal;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
	
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer;$this->markDirty();}   
	function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer(){ $mCustomer = new \MVC\Mapper\Customer(); $Customer = $mCustomer->find( $this->getIdCustomer() ); return $Customer;}
	
	function setCollect( $Collect ) {$this->Collect = $Collect;$this->markDirty();}
	function getCollect( ) {return $this->Collect;}
	function getCollectPrint( ) {$N = new \MVC\Library\Number($this->Collect);return $N->formatCurrency();}
	
	function setPaid( $Paid ) {$this->Paid = $Paid;$this->markDirty();}
	function getPaid( ) {return $this->Paid;}
	function getPaidPrint( ) {$N = new \MVC\Library\Number($this->Paid);return $N->formatCurrency();}	
	
	function setValue( $Value ) {$this->Value = $Value;$this->markDirty();}
	function getValue( ) {return $this->Value;}
	function getValuePrint( ) {$N = new \MVC\Library\Number($this->Value);return $N->formatCurrency();}	
	
	function setValueGlobal( $ValueGlobal ) {$this->ValueGlobal = $ValueGlobal;$this->markDirty();}
	function getValueGlobal( ) {return $this->ValueGlobal;}
	function getValueGlobalPrint( ) {$N = new \MVC\Library\Number($this->ValueGlobal);return $N->formatCurrency();}	
	
	function setCount( $Count ) {$this->Count = $Count;$this->markDirty();}
	function getCount( ) {return $this->Count;}
	function getCountPrint( ) {		
		$N = number_format($this->Count, 1, ',', '.');
		return $N;
	}
	
	function setCountGlobal( $CountGlobal ) {$this->CountGlobal = $CountGlobal;$this->markDirty();}
	function getCountGlobal( ) {return $this->CountGlobal;}
	function getCountGlobalPrint( ) {		
		$N = number_format($this->CountGlobal, 1, ',', '.');
		return $N;
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/report/".$this->IdTracking."/customer/".$this->Id;}
	
	function getURLViewNext(){
		$mTC = new \MVC\Mapper\TrackingCustomer();
		$TCNextAll	= $mTC->findByNext(array($this->IdTracking, $this->getIdCustomer()));
		if ($TCNextAll->count()>0 ){
			$TCNext = $TCNextAll->current();
			return "/report/".$TCNext->getIdTracking()."/customer/".$TCNext->getId();
		}
		return "/report/".$this->IdTracking."/customer/".$this->Id;
	}
	function getURLViewPrevious(){
		$mTC = new \MVC\Mapper\TrackingCustomer();
		$TCPreAll	= $mTC->findByPre(array($this->IdTracking, $this->getIdCustomer()));
		if ($TCPreAll->count()>0 ){
			$TCPre = $TCPreAll->current();
			return "/report/".$TCPre->getIdTracking()."/customer/".$TCPre->getId();
		}
		return "/report/".$this->IdTracking."/customer/".$this->Id;
	}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>