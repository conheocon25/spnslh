<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TermPaid extends Object{

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
	function getIdPrint(){return "c" . $this->getId();}	
	
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
	function getPaids(){
		$mPaidGeneral = new \MVC\Mapper\PaidGeneral();
		$PGs = $mPaidGeneral->findBy(array($this->getId()));
		return $PGs;
	}	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------	
	function getURLUpdExe(){return "/setting/termpaid/".$this->getId()."/upd/exe";}	
	function getURLDelExe(){return "/setting/termpaid/".$this->getId()."/del/exe";}
	
	function getURLDetail(){return "/money/paid/general/".$this->getId();}
	
	function getURLPaidInsLoad(){return "/money/paid/general/".$this->getId()."/ins/load";}
	function getURLPaidInsExe(){return "/money/paid/general/".$this->getId()."/ins/exe";}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>