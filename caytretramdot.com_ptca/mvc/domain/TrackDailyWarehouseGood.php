<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDailyWarehouseGood extends Object{

    private $Id;
	private $IdTDW;
	private $IdGood;
	private $Old;
	private $Import;
	private $Export;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null,
		$IdTDW		= null, 
		$IdGood		= null, 
		$Old		= null, 
		$Import		= null, 
		$Export		= null		
	){
        $this->Id 		= $Id;
		$this->IdTDW 	= $IdTDW;
		$this->IdGood 	= $IdGood;
		$this->Old 		= $Old;
		$this->Import 	= $Import;
		$this->Export 	= $Export;
				
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}
		
    function setIdTDW( $IdTDW ) 	{$this->IdTDW = $IdTDW;$this->markDirty();}   
	function getIdTDW( ) 			{return $this->IdTDW;}
	function getTDW( ){
		$mTDW 	= new \MVC\Mapper\TrackDailyWarehouse();
		$TDW 	= $mTDW->find($this->IdTDW);
		return $TDW;
	}
			
	function setIdGood( $IdGood ) {$this->IdGood = $IdGood;$this->markDirty();}   
	function getIdGood( ) {return $this->IdGood;}
	function getGood( ){
		$mGood 	= new \MVC\Mapper\Good();
		$Good 	= $mGood->find($this->IdGood);
		return $Good;
	}
	
	function setOld( $Import ) {$this->Old = $Old;$this->markDirty();}   
	function getOld( ) {return $this->Old;}
	function getOldPrint( ) {
		$num = number_format($this->getOld(), 0, ',', ' ');
		return $num;
	}
	
	function setImport( $Import ) {$this->Import = $Import;$this->markDirty();}   
	function getImport( ) {return $this->Import;}
	function getImportPrint( ) {
		$num = number_format($this->getImport(), 0, ',', ' ');
		return $num;
	}
	
	function setExport( $Import ) 	{$this->Export = $Export;$this->markDirty();}   
	function getExport( ) 			{return $this->Export;}
	function getExportPrint( ) {
		$num = number_format($this->getExport(), 0, ',', ' ');
		return $num;
	}
	
	function setNew( $Import ) {$this->New = $New;$this->markDirty();}   
	function getNew( ) {return $this->New;}
	function getNewPrint( ) {
		$num = number_format($this->getNew(), 0, ',', ' ');
		return $num;
	}
					
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
				
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>