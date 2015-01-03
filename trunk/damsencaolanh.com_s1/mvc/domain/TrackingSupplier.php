<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingSupplier extends Object{

    private $Id;
	private $IdTracking;	
	private $IdSupplier;
	private $ValuePaid;		
	private $ValueImport;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdTracking=null, 		
		$IdSupplier=null, 
		$ValueImport=null,		
		$ValuePaid=null
	) {
        $this->Id 				= $Id;
		$this->IdTracking 		= $IdTracking;
		$this->IdSupplier 		= $IdSupplier;
		$this->ValueImport 		= $ValueImport;
		$this->ValuePaid 		= $ValuePaid;						
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
		
	function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier;$this->markDirty();}   
	function getIdSupplier( ) {return $this->IdSupplier;}
	function getSupplier(){ $mSupplier = new \MVC\Mapper\Supplier(); $Supplier = $mSupplier->find( $this->getIdSupplier() ); return $Supplier;}
	
	function setValuePaid( $ValuePaid ) {$this->ValuePaid = $ValuePaid;$this->markDirty();}   
	function getValuePaid( ) {return $this->ValuePaid;}
	function getValuePaidPrint( ) {$N = new \MVC\Library\Number($this->ValuePaid);return $N->formatCurrency();}
	
	function setValueImport( $ValueImport ) {$this->ValueImport = $ValueImport;$this->markDirty();}   
	function getValueImport( ) {return $this->ValueImport;}
	function getValueImportPrint( ) {$N = new \MVC\Library\Number($this->ValueImport); return $N->formatCurrency();}
	
	function getValue(){return ($this->getValueImport() - $this->getValuePaid());}
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