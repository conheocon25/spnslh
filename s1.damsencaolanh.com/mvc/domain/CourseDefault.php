<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php");

class CourseDefault extends Object{
    private $Id;		
	private $IdCourse;		
	private $Count;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null, 				
		$IdCourse	= null, 		
		$Count		= null)
	{
        $this->Id 		= $Id;		
		$this->IdCourse = $IdCourse;				
		$this->Count 	= $Count;
				
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}

	function setIdCourse( $IdCourse ) {$this->IdCourse = $IdCourse;$this->markDirty();}
	function getIdCourse( ) {return $this->IdCourse;}
	function getCourse( ){$mCourse = new \MVC\Mapper\Course();$Course = $mCourse->find($this->IdCourse);return $Course;}
	
	function setCount( $Count ) {$this->Count = $Count; $this->markDirty();}
	function getCount( ) {return $this->Count;}
	function getCountPrint( ){$num = new Number($this->Count);return $num->formatCurrency();}

	public function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'IdCourse'		=> $this->getIdCourse(),		 	
		 	'Count'			=> $this->getCount()			
		);
		return json_encode($json);
	}
	function setArray( $Data ){
        $this->Id 			= $Data[0];				
		$this->IdCourse 	= $Data[1];				
		$this->Count 		= $Data[2];
    }
		
	//----------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ){$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>