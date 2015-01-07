<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Tracking extends Object{
    private $Id;
	private $DateStart;
	private $DateEnd;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
			$Id=null,
			$DateStart=null, 
			$DateEnd=null			
	){
			$this->Id 					= $Id; 
			$this->DateStart 			= $DateStart; 
			$this->DateEnd 				= $DateEnd;						
									
			parent::__construct( $Id );
	}
    function setId($Id) {return $this->Id = $Id;}
	function getId() {return $this->Id;}
	function getName(){$Name = 'THÁNG '.\date("m/Y", strtotime($this->getDateStart()));return $Name;}
	
    function setDateStart( $DateStart ) {$this->DateStart = $DateStart;$this->markDirty();}   
	function getDateStart( ) {return $this->DateStart;}	
	function getDateStartPrint( ) {$D = new \MVC\Library\Date($this->DateStart);return $D->getDateFormat();}
	
	function setDateEnd( $DateEnd ) {$this->DateEnd= $DateEnd;$this->markDirty();}   
	function getDateEnd( ) {return $this->DateEnd;}	
	function getDateEndPrint( ) {$D = new \MVC\Library\Date($this->DateEnd);return $D->getDateFormat();}
					
	function toJSON(){
		$json = array(
			'Id' 					=> $this->getId(),			
			'DateStart'				=> $this->getDateStart(),
			'DateEnd'				=> $this->getDateEnd()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){        
		$this->Id 					= $Data[0];
		$this->DateStart 			= $Data[1];
		$this->DateEnd 				= $Data[2];		
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){return "/report/".$this->getId();}
					
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>