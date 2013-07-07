<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class District extends Object{

    private $Id;
	private $IdProvince;
	private $Name;
	private $X;	
	private $Y;	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdProvince=null, $Name=null, $X=null, $Y=null) {
        $this->Id = $Id;		
		$this->IdProvince = $IdProvince;
		$this->Name = $Name;
		$this->X = $X;
		$this->Y = $Y;
		
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
    }		
	function setIdProvince( $IdProvince ) {
        $this->IdProvince = $IdProvince;
        $this->markDirty();
    }   
	function getIdProvince( ) {
        return $this->IdProvince;
    }
	
    function setName( $Name ) {
        $this->Name = $Name;
        $this->markDirty();
    }   
	function getName( ) {
        return $this->Name;
    }
	
	function setX( $X ) {
        $this->X = $X;
        $this->markDirty();
    }   
	function getX( ) {
        return $this->X;
    }
	
	function setY( $Y ) {
        $this->Y = $Y;
        $this->markDirty();
    }   
	function getY( ) {
        return $this->Y;
    }	
	function getPositionStr(){
		return $this->getX().", ".$this->getY();
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
				
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>
