<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDailyBranch extends Object{

    private $Id;
	private $IdTrack;
	private $IdBranch;
	private $Date;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id				= null,
		$IdTrack		= null, 
		$IdBranch		= null, 
		$Date			= null
	){
        $this->Id 			= $Id;
		$this->IdTrack 		= $IdTrack;
		$this->IdBranch 	= $IdBranch;
		$this->Date 		= $Date;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}
		
    function setIdTrack( $IdTrack ) 	{$this->IdTrack = $IdTrack;$this->markDirty();}   
	function getIdTrack( ) 				{return $this->IdTrack;}
	function getTrack( ){
		$mTrack 	= new \MVC\Mapper\Track();
		$Track 		= $mTrack->find($this->IdTrack);
		return $Track;
	}
			
	function setIdBranch( $IdBranch ) {$this->IdBranch = $IdBranch;$this->markDirty();}   
	function getIdBranch( ) {return $this->IdBranch;}
	function getBranch( ){
		$mBranch = new \MVC\Mapper\Branch();
		$Branch = $mBranch->find($this->IdBranch);
		return $Branch;
	}
		
	function setDate( $Date ) {$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ) {$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	function getDateShortPrint( ) {return date('d/m',strtotime($this->Date));}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function generate(){
		$mTDBCustomer 	= new \MVC\Mapper\TrackDailyBranchCustomer();
		$CustomerAll 	= $this->getBranch()->getCustomerAll();
		while ($CustomerAll->valid()){
			$Customer = $CustomerAll->current();
			
			$TDBCustomer = new \MVC\Domain\TrackDailyBranchCustomer(
				null,
				$this->getId(),
				$Customer->getId(),
				0,
				0,
				0
			);
			$mTDBCustomer->insert($TDBCustomer);
			
			$CustomerAll->next();
		}
	}
	
	function getTDBCustomerAll(){
		$mTDBCustomer 	= new \MVC\Mapper\TrackDailyBranchCustomer();
		$TDBCustomerAll = $mTDBCustomer->findBy(array($this->getId()));
		return $TDBCustomerAll;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLCustomer()	{return "/don-vi/".$this->getBranch()->getKey()."/bao-cao/".$this->getIdTrack()."/khach-hang/".$this->getId();}
	function getURLWarehouse()	{return "/don-vi/".$this->getBranch()->getKey()."/bao-cao/".$this->getIdTrack()."/kho-hang/".$this->getId();}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>