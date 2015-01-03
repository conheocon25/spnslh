<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TermCollect extends Object{

    private $Id;
	private $Name;
				
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null) {
        $this->Id = $Id;
		$this->Name = $Name;		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'Name'			=> $this->getName()
		);
		return json_encode($json);
	}
	function setArray( $Data ){
        $this->Id = $Data[0];
		$this->Name = $Data[1];		
    }	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getCollectAll(){
		$mCollectGeneral = new \MVC\Mapper\CollectGeneral();
		$CGAll = $mCollectGeneral->findBy(array($this->getId()));
		return $CGAll;
	}	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------	
	function getURLUpdExe(){return "/setting/termcollect/".$this->getId()."/upd/exe";}
	function getURLDelExe(){return "/setting/termcollect/".$this->getId()."/del/exe";}
	
	function getURLCollect(){return "/money/collect/general/".$this->getId();}
	function getURLCollectInsExe(){return "/money/collect/general/".$this->getId()."/ins/exe";}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}

?>
