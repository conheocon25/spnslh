<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackingDaily extends Object{

    private $Id;
	private $IdTracking;
	private $Date;
	private $Collect1;
	private $Collect2;
	private $Collect3;
	private $Paid1;
	private $Paid2;
	private $Paid3;
	private $Value;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null,
		$IdTracking	= null, 
		$Date		= null, 
		$Collect1	= null, 
		$Collect2	= null, 
		$Collect3	= null, 
		$Paid1		= null,
		$Paid2		= null,
		$Paid3		= null,
		$Value		= null		
	) {
        $this->Id 			= $Id;
		$this->IdTracking 	= $IdTracking;
		$this->Date 		= $Date;
		$this->Collect1 	= $Collect1;
		$this->Collect2 	= $Collect2;
		$this->Collect3 	= $Collect3;
		$this->Paid1 		= $Paid1;
		$this->Paid2 		= $Paid2;
		$this->Paid3 		= $Paid3;
		$this->Value 		= $Value;
				
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}	
		
    function setIdTracking( $IdTracking ) {$this->IdTracking = $IdTracking;$this->markDirty();}   
	function getIdTracking( ) {return $this->IdTracking;}
		
	function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ) {$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	function getDateShortPrint( ) {return date('d/m',strtotime($this->Date));}
			
	function setPaid1( $Paid1 ) {$this->Paid1 = $Paid1; $this->markDirty();}   
	function getPaid1( ) {return $this->Paid1;}
	function getPaid1Print( ) {$N = new \MVC\Library\Number($this->Paid1);return $N->formatCurrency();}
	
	function setPaid2( $Paid2 ) {$this->Paid2 = $Paid2; $this->markDirty();}   
	function getPaid2( ) {return $this->Paid2;}
	function getPaid2Print( ) {$N = new \MVC\Library\Number($this->Paid2);return $N->formatCurrency();}
	
	function setPaid3( $Paid3 ) {$this->Paid3 = $Paid3; $this->markDirty();}   
	function getPaid3( ) {return $this->Paid3;}
	function getPaid3Print( ) {$N = new \MVC\Library\Number($this->Paid3);return $N->formatCurrency();}
	
	function setCollect1( $Collect1 ) {$this->Collect1 = $Collect1; $this->markDirty();}
	function getCollect1( ) {return $this->Collect1;}
	function getCollect1Print( ) {$N = new \MVC\Library\Number($this->Collect1);return $N->formatCurrency();}

	function setCollect2( $Collect2 ) {$this->Collect2 = $Collect2; $this->markDirty();}
	function getCollect2( ) {return $this->Collect2;}
	function getCollect2Print( ) {$N = new \MVC\Library\Number($this->Collect2);return $N->formatCurrency();}
	
	function setCollect3( $Collect3 ) {$this->Collect3 = $Collect3; $this->markDirty();}
	function getCollect3( ) {return $this->Collect3;}
	function getCollect3Print( ) {$N = new \MVC\Library\Number($this->Collect3);return $N->formatCurrency();}

	function setValue( $Value ) {$this->Value = $Value; $this->markDirty();}
	function getValue( ) {return $this->Value;}
	function getValuePrint( ) {$N = new \MVC\Library\Number($this->Value);return $N->formatCurrency();}	
	function reValue( ){
		$mTrackingDaily = new \MVC\Mapper\TrackingDaily();		
		$TDAll = $mTrackingDaily->findByPre(array($this->getIdTracking(), $this->getDate()));		
		$ValueOld = 0;
		if ($TDAll->count()>0){
			$ValueOld = $TDAll->current()->getValue();
		}	
		$this->Value = $ValueOld + ($this->Collect1 + $this->Collect2 + $this->Collect3) - ($this->Paid1 + $this->Paid2 + $this->Paid3);
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLReport()			{return "/report/".$this->getIdTracking()."/".$this->getId();}
		
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>