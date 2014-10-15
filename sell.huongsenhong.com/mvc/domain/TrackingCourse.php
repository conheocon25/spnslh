<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingCourse extends Object{

    private $Id;
	private $IdTracking;
	private $IdTD;
	private $IdCourse;
	private $Count;	
	private $Price;
	private $Value;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdTracking=null, 
		$IdTD=null, 
		$IdCourse=null, 
		$Count=null, 		
		$Price=null, 		
		$Value=Null
	) {
        $this->Id 			= $Id;
		$this->IdTracking 	= $IdTracking;
		$this->IdTD 		= $IdTD;
		$this->IdCourse 	= $IdCourse;
		$this->Count 		= $Count;		
		$this->Price 		= $Price;
		$this->Value 		= $Value;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
	
	function setIdTD( $IdTD ) {$this->IdTD = $IdTD;$this->markDirty();}   
	function getIdTD( ) {return $this->IdTD;}
	
	function setIdCourse( $IdCourse ) {$this->IdCourse = $IdCourse;$this->markDirty();}   
	function getIdCourse( ) {return $this->IdCourse;}
	function getCourse(){ $mCourse = new \MVC\Mapper\Course(); $Course = $mCourse->find( $this->getIdCourse() ); return $Course;}
	
	function setCount( $Count ) {$this->Count = $Count;$this->markDirty();}   
	function getCount( ) {return $this->Count;}
	function getCountPrint( ) { return \round($this->Count,1);}
	
	function setPrice( $Price ) {$this->Price = $Price;$this->markDirty();}   
	function getPrice( ) {return $this->Price;}
	function getPricePrint( ) {$N = new \MVC\Library\Number($this->Price);return $N->formatCurrency();}
	
	function setValue( $Value ) {$this->Value = $Value;$this->markDirty();}   
	function getValue( ) {return $this->Value;}
	function getValuePrint( ) {$N = new \MVC\Library\Number($this->Value); return $N->formatCurrency();}
	
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