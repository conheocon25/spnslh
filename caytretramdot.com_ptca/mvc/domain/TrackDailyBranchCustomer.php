<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDailyBranchCustomer extends Object{

    private $Id;
	private $IdTrackDaily;
	private $IdBranch;
	private $IdCustomer;
	private $Sale;
	private $Collect;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id				= null,
		$IdTrackDaily	= null, 
		$IdBranch		= null,
		$IdCustomer		= null,
		$Sale			= null,
		$Collect		= null
	){
        $this->Id 			= $Id;
		$this->IdTrackDaily = $IdTrackDaily;
		$this->IdBranch 	= $IdBranch;
		$this->IdCustomer 	= $IdCustomer;
		$this->Sale 		= $Sale;
		$this->Collect 		= $Collect;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}
		
    function setIdTrackDaily( $IdTrackDaily ) 	{$this->IdTrackDaily = $IdTrackDaily;$this->markDirty();}   
	function getIdTrackDaily( ) 				{return $this->IdTrackDaily;}
	function getTrackDaily( ){
		$mTrackDaily = new \MVC\Mapper\TrackDaily();
		$TD = $mTrackDaily->find($this->IdTrackDaily);
		return $TD;
	}
			
	function setIdBranch( $IdBranch ) {$this->IdBranch = $IdBranch;$this->markDirty();}   
	function getIdBranch( ) {return $this->IdBranch;}
	function getBranch( ){
		$mBranch = new \MVC\Mapper\Branch();
		$Branch = $mBranch->find($this->IdBranch);
		return $Branch;
	}
	
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer; $this->markDirty();}   
	function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer( ){
		$mCustomer = new \MVC\Mapper\Customer();
		$Customer = $mCustomer->find($this->IdCustomer);
		return $Customer;
	}
	
	function setSale( $Sale ) 	{$this->Sale = $Sale; $this->markDirty();}
	function getSale( ) 		{return $this->Sale;}
	function getSalePrint( ){
		$num = number_format($this->getSale(), 0, ',', ' ');
		return $num;
	}
	
	function setCollect( $Collect ) {$this->Collect = $Collect; $this->markDirty();}
	function getCollect( ) 			{return $this->Collect;}
	function getCollectPrint( ){
		$num = number_format($this->getCollect(), 0, ',', ' ');
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