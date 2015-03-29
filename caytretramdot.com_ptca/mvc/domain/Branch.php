<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Branch extends Object{

    private $Id;
	private $IdGroup;
	private $Name;
	private $Tel;
	private $Fax;
	private $Address;
	private $Key;
	private $Enable;
				
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdGroup	=null, 
		$Name		=null, 
		$Tel		=null,
		$Fax		=null,
		$Address	=null,
		$Key		=null,
		$Enable		=null
	){
        $this->Id 		= $Id;
		$this->IdGroup 	= $IdGroup;
		$this->Name 	= $Name;
		$this->Tel 		= $Tel;
		$this->Fax 		= $Fax;
		$this->Address	= $Address;
		$this->Key		= $Key;
		$this->Enable	= $Enable;		
        parent::__construct( $Id );
    }
			
    function getId( ) {return $this->Id;}
	
	function setIdGroup( $IdGroup ) {$this->IdGroup = $IdGroup;$this->markDirty();}
	function getIdGroup()			{return $this->IdGroup;}
	function getGroup(){
		$mBranchGroup = new \MVC\Mapper\BranchGroup();
		$Group = $mBranchGroup->find($this->IdGroup);
		return $Group;
	}
	
	function setName( $Name ) 	{$this->Name = $Name;$this->markDirty();}
	function getName()			{return $this->Name;}
	
	function setTel( $Tel ) 	{$this->Tel = $Tel;$this->markDirty();}
	function getTel()			{return $this->Tel;}
	
	function setFax( $Fax ) 	{$this->Fax = $Fax;$this->markDirty();}
	function getFax()			{return $this->Fax;}
	
	function setAddress( $Address ) {$this->Address = $Address; $this->markDirty();}
	function getAddress()			{return $this->Address;}
	
	function setKey( $Key )	{$this->Key = $Key;$this->markDirty();}
	function getKey( ) 		{return $this->Key;}
	function reKey( ){		
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function setEnable( $Enable ) {$this->Enable = $Enable; $this->markDirty();}
	function getEnable()			{return $this->Enable;}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdGroup	= $Data[1];
		$this->Name 	= $Data[2];
		$this->Tel	 	= $Data[3];
		$this->Fax	 	= $Data[4];
		$this->Address 	= $Data[5];		
		$this->Enable 	= $Data[6];
		$this->reKey();
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdGroup' 		=> $this->getIdGroup(),
			'Name'			=> $this->getName(),
			'Tel'			=> $this->getTel(),
			'Fax'			=> $this->getFax(),
			'Address'		=> $this->getAddress(),
			'Key'			=> $this->getKey(),
			'Enable'		=> $this->getEnable()
		);
		return json_encode($json);
	}		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getCommandAll(){
		$mSaleCommand 	= new \MVC\Mapper\SaleCommand();
		$BranchAll 		= $mSaleCommand->findByBranch(array($this->getId()));
		return $BranchAll;
	}
	
	function getQuotaAll(){
		$mBranchQuota 	= new \MVC\Mapper\BranchQuota();
		$QuotaAll 		= $mBranchQuota->findByBranch(array($this->getId()));
		return $QuotaAll;
	}
								
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLSaleCommand(){return "/don-vi/".$this->Key."/lenh-ban";}
	function getURLSaleCommandLoad(){return "/don-vi/".$this->Key."/lenh-ban/nap";}
	function getURLSaleCommandView(){return "/don-vi/".$this->Key."/lenh-ban/xem";}
	function getURLSaleCommandQuota(){return "/don-vi/".$this->Key."/lenh-ban/han-ngach";}
	
	function getURLSaleInvoice(){return "/don-vi/".$this->Key."/ban-hang";}
	function getURLReport(){return "/don-vi/".$this->Key."/bao-cao";}
	function getURLSetting(){return "/don-vi/".$this->Key."/thiet-lap";}
	
}
?>