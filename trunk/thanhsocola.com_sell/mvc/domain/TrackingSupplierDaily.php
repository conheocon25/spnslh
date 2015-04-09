<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingSupplierDaily extends Object{

    public $Id;
	public $IdTD;
	public $IdSupplier;
		
	private $ValueImport;
	private $ValuePaid;
	private $ValueOld;
    	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null,
		$IdTD		= null,
		$IdSupplier	= null, 		
		$ValueImport=null,
		$ValuePaid	=null,
		$ValueOld	=null
	) {
        $this->Id 			= $Id;
		$this->IdSupplier 	= $IdSupplier;		
		$this->ValueImport 	= $ValueImport;
		$this->ValuePaid 	= $ValuePaid;
		$this->ValueOld 	= $ValueOld;
			
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
	
	function setIdTD( $IdTD ) {$this->IdTD = $IdTD;$this->markDirty();}   
	function getIdTD( ) {return $this->IdTD;}
	function getTD( ) {
		$mTD 	= new \MVC\Mapper\TrackDaily();
		$TD 	= $mTD->find($this->IdTD);
		return $TD;
	}
	
    function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier;$this->markDirty();}   
	function getIdSupplier( ) {return $this->IdSupplier;}
	function getSupplier( ) {
		$mSupplier = new \MVC\Mapper\Supplier();
		$Supplier = $mSupplier->find($this->IdSupplier);
		return $Supplier;
	}
			
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
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>