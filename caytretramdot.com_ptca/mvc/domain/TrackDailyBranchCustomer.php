<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDailyBranchCustomer extends Object{

    private $Id;
	private $IdTDB;	
	private $IdCustomer;
	private $DebtOld;
	private $Sale;
	private $Collect;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct(
		$Id				= null,
		$IdTDB			= null,
		$IdCustomer		= null,
		$DebtOld		= null,
		$Sale			= null,
		$Collect		= null
	){
        $this->Id 			= $Id;
		$this->IdTDB 		= $IdTDB;		
		$this->IdCustomer 	= $IdCustomer;
		$this->DebtOld 		= $DebtOld;
		$this->Sale 		= $Sale;
		$this->Collect 		= $Collect;
		
        parent::__construct( $Id );
    }

    function getId() {return $this->Id;}
		
    function setIdTDB( $IdTDB ) 	{$this->IdTDB = $IdTDB;$this->markDirty();}   
	function getIdTDB( ) 				{return $this->IdTDB;}
	function getTDB( ){
		$mTrackDailyBranch 	= new \MVC\Mapper\TrackDailyBranch();
		$TDB 				= $mTrackDailyBranch->find($this->IdTDB);
		return $TDB;
	}
		
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer; $this->markDirty();}
	function getIdCustomer( ) {return $this->IdCustomer;}
	function getCustomer( ){
		$mCustomer 	= new \MVC\Mapper\Customer();
		$Customer 	= $mCustomer->find($this->IdCustomer);
		return $Customer;
	}
	
	function setDebtOld( $DebtOld ) {$this->DebtOld = $DebtOld; $this->markDirty();}
	function getDebtOld( ) 			{return $this->DebtOld;}
	function getDebtOldPrint( ){
		$num = number_format($this->getDebtOld(), 0, ',', ' ');
		return $num;
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
	
	function getDebtNew( ){
		return ($this->DebtOld + $this->Sale - $this->Collect);
	}
	function getDebtNewPrint( ){
		$num = number_format($this->getDebtNew(), 0, ',', ' ');
		return $num;
	}
	function getDebtNewStrPrint( ){
		$num = new \MVC\Library\Number($this->getDebtNew());
		return $num->readDigit();		
	}
					
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView(){
		$TDB 	= $this->getTDB();
		$Branch = $TDB->getBranch();
		$Track 	= $TDB->getTrack();		
		return "/don-vi/".$Branch->getKey()."/bao-cao/".$Track->getId()."/khach-hang/".$this->getIdTDB()."/".$this->getId();
	}
	
	function getURLPrint(){
		$TDB 	= $this->getTDB();
		$Branch = $TDB->getBranch();
		$Track 	= $TDB->getTrack();		
		return "/don-vi/".$Branch->getKey()."/bao-cao/".$Track->getId()."/khach-hang/".$this->getIdTDB()."/".$this->getId()."/in";
	}
	
	function getURLExe(){
		$TDB 	= $this->getTDB();
		$Branch = $TDB->getBranch();
		$Track 	= $TDB->getTrack();		
		return "/don-vi/".$Branch->getKey()."/bao-cao/".$Track->getId()."/khach-hang/".$this->getIdTDB()."/".$this->getId()."/exe";
	}
	
	function getURLReport(){
		$TDB 	= $this->getTDB();
		$Branch = $TDB->getBranch();
		$Track 	= $TDB->getTrack();
		return "/ql-bao-cao/".$Track->getId()."/".($TDB->getDate())."/ban-hang/".$TDB->getId()."/".$this->getId();
	}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>