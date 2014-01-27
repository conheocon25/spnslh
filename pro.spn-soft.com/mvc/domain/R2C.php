<?php	
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php");
class R2C extends Object{

    private $Id;
	private $IdCourse;
	private $IdResource;
	private $Value1;
	private $Value2;

	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdCourse=null,
		$IdResource=null,
		$Value1=null,
		$Value2=null
	) 
	{
        $this->Id = $Id;
		$this->IdCourse = $IdCourse;
		$this->IdResource = $IdResource;		
		$this->Value1 = $Value1;
		$this->Value2 = $Value2;
		
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
		
	function setIdCourse( $IdCourse) {$this->IdCourse = $IdCourse;}
	function getIdCourse( ) {return $this->IdCourse;}
	function getCourse( ) {$mCourse = new \MVC\Mapper\Course();$Course = $mCourse->find($this->IdCourse);return $Course;}
	
    function setIdResource( $IdResource ) {$this->IdResource = $IdResource;$this->markDirty();}
	function getIdResource( ) {return $this->IdResource;}
	function getResource( ) {$mResource = new \MVC\Mapper\Resource();$Resource = $mResource->find($this->IdResource);return $Resource;}
		
	function setValue1( $Value1 ) {$this->Value1 = $Value1;$this->markDirty();}
	function getValue1( ) {return $this->Value1;}
	
	function setValue2( $Value2 ) {$this->Value2 = $Value2;$this->markDirty();}
	function getValue2( ) {return $this->Value2;}
	
	function getRate(){return ($this->getValue1()*$this->getValue2());}
	function getRate1(){return ($this->getValue1()/$this->getValue2());}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),	
			'IdCourse'		=> $this->getIdCourse(),
			'IdResource'	=> $this->getIdResource(),
			'Value1'		=> $this->getValue1(),
			'Value2'		=> $this->getValue2()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCourse 	= $Data[1];
		$this->IdResource 	= $Data[2];
		$this->Value1 		= $Data[3];
		$this->Value2 		= $Data[4];
    }	
		
	//----------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ){$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>