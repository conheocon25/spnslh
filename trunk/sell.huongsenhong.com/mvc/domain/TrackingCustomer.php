<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingCustomer extends Object{

    private $Id;
	private $IdTracking;	
	private $IdCustomer;
	private $ValueSession1;	
	private $ValueSession2;
	private $ValueCollect;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdTracking=null, 		
		$IdCustomer=null, 
		$ValueSession1=null,
		$ValueSession2=null, 		
		$ValueCollect=null
	) {
        $this->Id 				= $Id;
		$this->IdTracking 		= $IdTracking;
		$this->IdCustomer 		= $IdCustomer;
		$this->ValueSession1 	= $ValueSession1;
		$this->ValueSession2 	= $ValueSession2;
		$this->ValueCollect 	= $ValueCollect;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
		
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer;$this->markDirty();}   
	function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer(){ $mCustomer = new \MVC\Mapper\Customer(); $Customer = $mCustomer->find( $this->getIdCustomer() ); return $Customer;}
	
	function setValueSession1( $ValueSession1 ) {$this->ValueSession1 = $ValueSession1;$this->markDirty();}
	function getValueSession1( ) {return $this->ValueSession1;}
	function getValueSession1Print( ) {$N = new \MVC\Library\Number($this->ValueSession1);return $N->formatCurrency();}
	
	function setValueSession2( $ValueSession2 ) {$this->ValueSession2 = $ValueSession2;$this->markDirty();}   
	function getValueSession2( ) {return $this->ValueSession2;}
	function getValueSession2Print( ) {$N = new \MVC\Library\Number($this->ValueSession2);return $N->formatCurrency();}
	
	function setValueCollect( $ValueCollect ) {$this->ValueCollect = $ValueCollect;$this->markDirty();}   
	function getValueCollect( ) {return $this->ValueCollect;}
	function getValueCollectPrint( ) {$N = new \MVC\Library\Number($this->ValueCollect); return $N->formatCurrency();}
	
	function getValue(){return ($this->getValueSession2() - $this->getValueCollect());}
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