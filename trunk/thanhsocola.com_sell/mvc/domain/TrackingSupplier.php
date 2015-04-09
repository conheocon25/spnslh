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
	private $Value;
	private $ValueGlobal;
	
	private $Count;
	private $CountGlobal;
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdTracking	=null,
		$IdSupplier	=null, 		
		$ValueImport=null, 		
		$ValuePaid	=null,
		$ValueOld	=null,
		$Value		=null,
		$ValueGlobal=null,
		$Count		=null,
		$CountGlobal=null
	) {
        $this->Id 				= $Id;
		$this->IdTracking 		= $IdTracking;
		$this->IdSupplier 		= $IdSupplier;		
		$this->ValueImport 		= $ValueImport;
		$this->ValuePaid 		= $ValuePaid;
		$this->ValueOld 		= $ValueOld;
		$this->Value	 		= $Value;
		$this->ValueGlobal 		= $ValueGlobal;
		$this->Count 			= $Count;
		$this->CountGlobal		= $CountGlobal;
		
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
	
	function setValue( $Value ) {$this->Value = $Value;$this->markDirty();}
	function getValue( ) 		{return $this->Value;}
	function getValuePrint( ) 	{$N = new \MVC\Library\Number($this->Value);return $N->formatCurrency();}	
	
	function setValueGlobal( $ValueGlobal ) {$this->ValueGlobal = $ValueGlobal;$this->markDirty();}
	function getValueGlobal( ) {return $this->ValueGlobal;}
	function getValueGlobalPrint( ) {$N = new \MVC\Library\Number($this->ValueGlobal);return $N->formatCurrency();}	
	
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/report/".$this->IdTracking."/supplier/".$this->Id;}
	function getURLViewNext(){ 
		$mTS = new \MVC\Mapper\TrackingSupplier();
		$TSNextAll	= $mTS->findByNext(array($this->IdTracking, $this->getIdSupplier()));
		if ($TSNextAll->count()>0 ){
			$TSNext = $TSNextAll->current();
			return "/report/".$TSNext->getIdTracking()."/supplier/".$TSNext->getId();
		}
		return "/report/".$this->IdTracking."/supplier/".$this->Id;
	}
	function getURLViewPrevious(){ 
		$mTS 		= new \MVC\Mapper\TrackingSupplier();
		$TSPreAll	= $mTS->findByPre(array($this->IdTracking, $this->getIdSupplier()));
		if ($TSPreAll->count()>0 ){
			$TSPre = $TSPreAll->current();
			return "/report/".$TSPre->getIdTracking()."/supplier/".$TSPre->getId();
		}
		return "/report/".$this->IdTracking."/supplier/".$this->Id;
	}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>