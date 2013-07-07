<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Province extends Object{

    private $Id;
	private $Name;
	private $X;
	private $Y;
	private $Order;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $X=null, $Y=null, $Order=null){
        $this->Id = $Id;		
		$this->Name = $Name;
		$this->X = $X;
		$this->Y = $Y;
		$this->Order = $Order;
		
        parent::__construct( $Id );
    }
    function getId() {
        return $this->Id;
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
	
	function setOrder( $Order ) {
        $this->Order = $Order;
        $this->markDirty();
    }   
	function getOrder( ) {
        return $this->Order;
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getDistricts(){
		$mDistrict = new \MVC\Mapper\District();
		$Districts = $mDistrict->findBy(array($this->getId()));
		return $Districts;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
				
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>
