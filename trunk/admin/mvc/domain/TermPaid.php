<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TermPaid extends Object{

    private $Id;
	private $Name;
	private $Type;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $Type=Null) {
        $this->Id = $Id;
		$this->Name = $Name;
		$this->Type = $Type;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
	function getIdPrint(){return "c" . $this->getId();}	
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setType( $Type ) {$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	function getTypePrint( ){
		if ($this->Type==0)
			return "Không bán ra";
        return "Bán ra";
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
	function getURLUpdLoad(){return "/setting/termpaid/".$this->getId()."/upd/load";}
	function getURLUpdExe(){return "/setting/termpaid/".$this->getId()."/upd/exe";}
	
	function getURLDelLoad(){return "/setting/termpaid/".$this->getId()."/del/load";}
	function getURLDelExe(){return "/setting/termpaid/".$this->getId()."/del/exe";}
	
	function getURLDetail(){return "/money/paid/general/".$this->getId();}
	
	function getURLPaidInsLoad(){return "/money/paid/general/".$this->getId()."/ins/load";}
	function getURLPaidInsExe(){return "/money/paid/general/".$this->getId()."/ins/exe";}
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>