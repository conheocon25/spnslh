<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php");

class CourseLog extends Object{
    private $Id;	
	private $IdTable;
	private $IdCourse;	
	private $DateTime;
	private $Count;
	private $State;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null, 		
		$IdTable	= null, 
		$IdCourse	= null, 
		$DateTime	= null, 		
		$Count		= null,
		$State		= null) 
	{
        $this->Id 		= $Id;
		$this->IdTable 	= $IdTable;	
		$this->IdCourse = $IdCourse;		
		$this->DateTime = $DateTime;		
		$this->Count 	= $Count;
		$this->State 	= $State;
		
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
	
	function setIdTable( $IdTable ) {$this->IdTable = $IdTable;$this->markDirty();}
	function getIdTable( ) {return $this->IdTable;}
	function getTable( ){$mTable = new \MVC\Mapper\Table(); $Table = $mTable->find($this->IdTable);return $Table;}
	
	function setIdCourse( $IdCourse ) {$this->IdCourse = $IdCourse;$this->markDirty();}
	function getIdCourse( ) {return $this->IdCourse;}
	function getCourse( ){$mCourse = new \MVC\Mapper\Course();$Course = $mCourse->find($this->IdCourse);return $Course;}
	
    function setDateTime( $DateTime ) {$this->DateTime = $DateTime;$this->markDirty();}
	function getDateTime( ) {return $this->DateTime;}
	function getDateTimePrint( ){
		$D = date('H:i d/m', strtotime($this->getDateTime()) );
		return $D;
	}
	
	function getRemainWaiting(){
		$Value = (int)(strtotime(\date("Y-m-d H:i:s")) - strtotime($this->getDateTime()));
		return round($Value/60,0);
	}
	
	function setCount( $Count ) {$this->Count = $Count; $this->markDirty();}
	function getCount( ) {return $this->Count;}
	function getCountPrint( ){$num = new Number($this->Count);return $num->formatCurrency();}
	
	function setState( $State ) {$this->State = $State; $this->markDirty();}
	function getState( ) {return $this->State;}
	function getStatePrint( ){
		$Arr = array("Mới", "Bếp", "Đã xong");
		return $Arr[$this->getState()];
	}
	
	public function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdTable'		=> $this->getIdTable(),
			'IdCourse'		=> $this->getIdCourse(),
		 	'DateTime'		=> $this->getDateTime(),
		 	'Count'			=> $this->getCount(),
			'State'			=> $this->getState()
		);
		return json_encode($json);
	}
	function setArray( $Data ){
        $this->Id 			= $Data[0];		
		$this->IdTable 		= $Data[1];
		$this->IdCourse 	= $Data[2];		
		$this->DateTime 	= $Data[3];		
		$this->Count 		= $Data[4];
		$this->State 		= $Data[5];
    }
		
	//----------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ){$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>