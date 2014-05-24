<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Question extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Content;	
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Content=null) {
		$this->Id 		= $Id;
		$this->Content 	= $Content;
		
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setContent($Content) {$this->Content = $Content;$this->markDirty();}
	function getContent() 		{return $this->Content;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Content'		=> $this->getContent()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Content 	= $Data[1];		
    }
	
	function getURLUpdLoad(){
		return "/admin/setting/question/".$this->getId()."/upd/load";
	}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>