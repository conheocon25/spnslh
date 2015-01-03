<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingSupplierDaily extends Object{

    public $Id;
	public $IdSupplier;
	public $Date;
	public $TicketImport;
    public $TicketImportBack;
	public $ValueImport;
    public $ValueImportBack;
    	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null,
		$IdSupplier	= null, 
		$Date		= null, 
		$TicketImport	= null, 
		$TicketImportBack	= null,
		$ValueImport		= null, 
		$ValueImportBack		= null	
	) {
        $this->Id 			= $Id;
		$this->IdSupplier 	= $IdSupplier;
		$this->Date 		= $Date;
		$this->TicketImport 		= $TicketImport;
		$this->TicketImportBack 		= $TicketImportBack;		
		$this->ValueImport 		= $ValueImport;
		$this->ValueImportBack 		= $ValueImportBack;
			
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdSupplier( $IdSupplier ) {$this->IdSupplier = $IdSupplier;$this->markDirty();}   
	function getIdSupplier( ) {return $this->IdSupplier;}
	function getSupplier( ) {
		$mSupplier = new \MVC\Mapper\Supplier();
		$Supplier = $mSupplier->find($this->IdSupplier);
		return $Supplier;
	}
	
	function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ) {$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	function getDateShortPrint( ) {return date('d/m',strtotime($this->Date));}
		
	function setTicketImport( $TicketImport ) {$this->TicketImport = $TicketImport;$this->markDirty();}   
	function getTicketImport( ) {return $this->TicketImport;}
	function getTicketImportPrint( ){$N = new \MVC\Library\Number($this->TicketImport);return $N->formatCurrency();}
	
	function setTicketImportBack( $TicketImportBack ) {$this->TicketImportBack = $TicketImportBack;$this->markDirty();}   
	function getTicketImportBack( ) {return $this->TicketImportBack;}
	function getTicketImportBackPrint( ){$N = new \MVC\Library\Number($this->TicketImportBack);return $N->formatCurrency();}
	
	function getTicketD(){return $this->TicketImport - $this->TicketImportBack;}
	function getTicketDPrint(){
		$N = new \MVC\Library\Number($this->getTicketD());
		return 	$N->formatCurrency();
	}
	
	function setValueImport( $ValueImport ) {$this->ValueImport = $ValueImport;$this->markDirty();}   
	function getValueImport( ) {return $this->ValueImport;}
	function getValueImportPrint( ){$N = new \MVC\Library\Number($this->ValueImport);return $N->formatCurrency();}
	
	function setValueImportBack( $ValueImportBack ) {$this->ValueImportBack = $ValueImportBack;$this->markDirty();}   
	function getValueImportBack( ) {return $this->ValueImportBack;}
	function getValueImportBackPrint( ){$N = new \MVC\Library\Number($this->ValueImportBack);return $N->formatCurrency();}
	
	function getValueD(){return $this->ValueImport - $this->ValueImportBack;}
	function getValueDPrint(){
		$N = new \MVC\Library\Number($this->getValueD());
		return 	$N->formatCurrency();
	}
	
		
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