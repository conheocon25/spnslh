<?php 
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Session extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdTracking;
	private $IdStudent;
	private $DateJoined;
	private $CountMonth;
	private $State;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdTracking=null, $IdStudent=null, $DateJoined=null, $CountMonth=null, $State=null){
		$this->Id 			= $Id;		
		$this->IdTracking 	= $IdTracking;
		$this->IdStudent 	= $IdStudent;
		$this->DateJoined 	= $DateJoined;
		$this->CountMonth 	= $CountMonth;
		$this->State 		= $State;
			
		parent::__construct( $Id );
	}		
	function getId() {return $this->Id;}
			
	function setIdTracking($IdTracking) {$this->IdTracking = $IdTracking;$this->markDirty();}
	function getIdTracking() {return $this->IdTracking;}
	function getTracking(){
		$mTracking 	= new \MVC\Mapper\Tracking();
		$Tracking 	= $mTracking->find($this->getIdTracking());
		return $Tracking;
	}
	
	function setIdStudent($IdStudent) {$this->IdStudent = $IdStudent;$this->markDirty();}
	function getIdStudent() {return $this->IdStudent;}		
	function getStudent(){
		$mStudent = new \MVC\Mapper\Student();
		$Student = $mStudent->find($this->getIdStudent());
		return $Student;
	}
	
	function setDateJoined($DateJoined) 	{$this->DateJoined = $DateJoined;$this->markDirty();}
	function getDateJoined() 		{return $this->DateJoined;}		
	function getDateJoinedPrint(){
		$Date = new \MVC\Library\Date($this->DateJoined); return $Date->getDateFormat();	
		return $Date;
	}		
	
	function setCountMonth($CountMonth) 	{$this->CountMonth = $CountMonth; $this->markDirty();}
	function getCountMonth() 				{return $this->CountMonth;}
	
	function setState($State) 	{$this->State = $State;$this->markDirty();}
	function getState() 		{return $this->State;}		
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdTracking'	=> $this->getIdTracking(),
			'IdStudent'		=> $this->getIdStudent(),
			'DateJoined'	=> $this->getDateJoined(),
			'CountMonth'	=> $this->getCountMonth(),
			'State'			=> $this->getState()
		);
		return json_encode($json);							
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdTracking 	= $Data[1];
		$this->IdStudent 	= $Data[2];
		$this->DateJoined 	= $Data[3];
		$this->CountMonth 	= $Data[4];
		$this->State		= $Data[5];
    }
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
}
?>