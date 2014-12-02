<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingCustomer extends Object{

    private $Id;
	private $IdTracking;	
	private $IdCustomer;
	private $ValuePaid;		
	private $ValueCollect;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdTracking=null, 		
		$IdCustomer=null, 
		$ValuePaid=null,		
		$ValueCollect=null
	) {
        $this->Id 				= $Id;
		$this->IdTracking 		= $IdTracking;
		$this->IdCustomer 		= $IdCustomer;
		$this->ValuePaid 		= $ValuePaid;		
		$this->ValueCollect 	= $ValueCollect;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
		
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer;$this->markDirty();}   
	function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer(){ $mCustomer = new \MVC\Mapper\Customer(); $Customer = $mCustomer->find( $this->getIdCustomer() ); return $Customer;}
	
	function setValuePaid( $ValuePaid ) {$this->ValuePaid = $ValuePaid;$this->markDirty();}   
	function getValuePaid( ) {return $this->ValuePaid;}
	function getValuePaidPrint( ) {$N = new \MVC\Library\Number($this->ValuePaid);return $N->formatCurrency();}
	
	function setValueCollect( $ValueCollect ) {$this->ValueCollect = $ValueCollect;$this->markDirty();}   
	function getValueCollect( ) {return $this->ValueCollect;}
	function getValueCollectPrint( ) {$N = new \MVC\Library\Number($this->ValueCollect); return $N->formatCurrency();}
	
	function getValue(){return ($this->getValuePaid() - $this->getValueCollect());}
	function getValuePrint( ) {$N = new \MVC\Library\Number($this->getValue()); return $N->formatCurrency();}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>