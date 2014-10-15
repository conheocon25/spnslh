<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingSupplier extends Object{

    private $Id;
	private $IdTracking;	
	private $IdSupplier;	
	private $ValueImport;
	private $ValuePaid;
	private $ValueOld;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdTracking=null,
		$IdSupplier=null, 		
		$ValueImport=null, 		
		$ValuePaid=null,
		$ValueOld=null
	) {
        $this->Id 				= $Id;
		$this->IdTracking 		= $IdTracking;
		$this->IdSupplier 		= $IdSupplier;		
		$this->ValueImport 		= $ValueImport;
		$this->ValuePaid 		= $ValuePaid;
		$this->ValueOld 		= $ValueOld;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
		
	function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier;$this->markDirty();}   
	function getIdSupplier( ) {return $this->IdSupplier;}
	function getSupplier(){ $mSupplier = new \MVC\Mapper\Supplier(); $Supplier = $mSupplier->find( $this->getIdSupplier() ); return $Supplier;}
			
	function setValueImport( $ValueImport ) {$this->ValueImport = $ValueImport;$this->markDirty();}   
	function getValueImport( ) {return $this->ValueImport;}
	function getValueImportPrint( ) {$N = new \MVC\Library\Number($this->ValueImport);return $N->formatCurrency();}
	
	function setValuePaid( $ValuePaid ) {$this->ValuePaid = $ValuePaid;$this->markDirty();}   
	function getValuePaid( ) {return $this->ValuePaid;}
	function getValuePaidPrint( ) {$N = new \MVC\Library\Number($this->ValuePaid); return $N->formatCurrency();}
	
	function setValueOld( $ValueOld ) {$this->ValueOld = $ValueOld;$this->markDirty();}
	function getValueOld( ) {return $this->ValueOld;}
	function getValueOldPrint( ) {$N = new \MVC\Library\Number($this->ValueOld); return $N->formatCurrency();}
	
	function getValue(){
		return ($this->getValueOld() + $this->getValueImport() - $this->getValuePaid());
	}
	function getValuePrint( ) {$N = new \MVC\Library\Number($this->getValue()); return $N->formatCurrency();}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/report/".$this->IdTracking."/supplier/".$this->IdSupplier;}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>