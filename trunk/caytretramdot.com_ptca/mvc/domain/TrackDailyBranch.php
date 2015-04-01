<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TrackDailyBranch extends Object{

    private $Id;
	private $IdTrack;
	private $IdBranch;
	private $Date;
	
	private $DebtOld;
	private $Sale;
	private $Collect;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id				= null,
		$IdTrack		= null, 
		$IdBranch		= null, 
		$Date			= null, 
		$DebtOld		= null, 
		$Sale			= null, 
		$Collect		= null
	){
        $this->Id 			= $Id;
		$this->IdTrack 		= $IdTrack;
		$this->IdBranch 	= $IdBranch;
		$this->Date 		= $Date;
		$this->DebtOld		= $DebtOld;
		$this->Sale			= $Sale;
		$this->Collect		= $Collect;
		
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
	
	function getQuotaAll(){	
		$mBranchQuota 	= new \MVC\Mapper\BranchQuota();
		$QuotaAll 		= $mBranchQuota->findByBranchDate(array($this->getIdBranch(), $this->getDate()));
		return $QuotaAll;
	}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLCustomer()	{return "/don-vi/".$this->getBranch()->getKey()."/bao-cao/".$this->getIdTrack()."/khach-hang/".$this->getId();}
	function getURLWarehouse()	{return "/don-vi/".$this->getBranch()->getKey()."/bao-cao/".$this->getIdTrack()."/kho-hang/".$this->getId();}
	function getURLQuota()		{return "/don-vi/".$this->getBranch()->getKey()."/bao-cao/".$this->getIdTrack()."/han-ngach/".$this->getId();}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>