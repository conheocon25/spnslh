<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDaily extends Object{

    private $Id;
	private $IdTrack;
	private $Date;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			= null,
		$IdTrack	= null, 
		$Date		= null		
	){
        $this->Id 			= $Id;
		$this->IdTrack 		= $IdTrack;
		$this->Date 		= $Date;				
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}
		
    function setIdTrack( $IdTrack ) {$this->IdTrack = $IdTrack;$this->markDirty();}   
	function getIdTrack( ) {return $this->IdTrack;}
			
	function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ) {$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	function getDateShortPrint( ) {return date('d/m',strtotime($this->Date));}
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getBranchAll(){
		$mTDB 	= new \MVC\Mapper\TrackDailyBranch();
		$TDBAll = $mTDB->findByDate(array($this->getDate()));
		return $TDBAll;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------		
	function getURLSale()		{return "/ql-bao-cao/".$this->getIdTrack()."/".$this->getDate()."/ban-hang";}
	function getURLWarehouse()	{return "/ql-bao-cao/".$this->getIdTrack()."/".$this->getDate()."/kho-hang";}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>