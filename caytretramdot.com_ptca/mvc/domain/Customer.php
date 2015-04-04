<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Customer extends Object{

    private $Id;
	private $IdGroup;
	private $IdBranch;
	private $Name;
	private $Code;
	private $Represent;
	private $Tel;
    private $Fax;
    private $Email;
	private $TaxCode;
    private $Web;	
	private $DebtLimit;
	private $Address;
	private $Note;
	private $Avatar;	
	private $ContractId;
	private $ContractFrom;
	private $ContractTo;
	private $PaymentMethod;
	private $Public;
	private $Enable;
		
    function __construct( 
		$Id				=null,
		$IdGroup		=null,
		$IdBranch		=null,
		$Name			=null,
		$Code			=null,
		$Represent		=null,
		$Tel			=null,
		$Fax			=null,
		$Email			=null,
		$TaxCode		=null,
		$Web			=null,	
		$DebtLimit		=null,
		$Address		=null,
		$Note			=null,
		$Avatar			=null,	
		$ContractId		=null,
		$ContractFrom	=null,
		$ContractTo		=null,
		$PaymentMethod	=null,
		$Public			=null,
		$Enable			=null
	) {
        $this->Id 			= $Id;
		$this->IdGroup 		= $IdGroup;
		$this->IdBranch		= $IdBranch;
		$this->Name 		= $Name;
		$this->Code 		= $Code;
		$this->Represent	= $Represent;
		$this->Tel 			= $Tel;
		$this->Fax 			= $Fax;
		$this->Email 		= $Email;
		$this->TaxCode 		= $TaxCode;
		$this->Web 			= $Web;		
		$this->DebtLimit 	= $DebtLimit;
		$this->Address		= $Address;
		$this->Note			= $Note;
		$this->Avatar		= $Avatar;
		$this->ContractId 	= $ContractId;
		$this->ContractFrom	= $ContractFrom;
		$this->ContractTo	= $ContractTo;
		$this->PaymentMethod= $PaymentMethod;
		$this->Public		= $Public;
		$this->Enable		= $Enable;
		
        parent::__construct( $Id );
    }
	function setId( $Id){return $this->Id = $Id;}
    function getId( ) 	{return $this->Id;}
	
	function setIdGroup( $IdGroup) {return $this->IdGroup= $IdGroup;}
    function getIdGroup( ) {return $this->IdGroup;}
	function getGroup(){
		$mCustomerGroup = new \MVC\Mapper\CustomerGroup();
		$Group = $mCustomerGroup->find($this->IdGroup);
		return $Group;
	}
	
	function setIdBranch( $IdBranch) {return $this->IdBranch = $IdBranch;}
    function getIdBranch( ) {return $this->IdBranch;}
	function getBranch(){
		$mBranch 	= new \MVC\Mapper\Branch();
		$Branch 	= $mBranch->find($this->IdBranch);
		return $Branch;
	}
	
	function getName(){return $this->Name;}	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	
	function setCode( $Code ) {$this->Code = $Code; $this->markDirty();}
	function getCode(){return $this->Code;}
	
	function getRepresent(){return $this->Represent;}
    function setRepresent( $Represent ) {$this->Represent = $Represent; $this->markDirty();}
	
	
	function getFax(){return $this->Fax;}	
    function setFax( $Fax ) {$this->Fax = $Fax;$this->markDirty();}
	function getFaxPrint(){
		$Arr = array("Hệ thống", "Nhà", "Thường");
		return $Arr[$this->Fax];		
	}
	
	function getTel(){return $this->Tel;}
    function setTel( $Tel ) {$this->Tel = $Tel;$this->markDirty();}
	
	function getEmail(){return $this->Email;}	
    function setEmail( $Email ) {$this->Email = $Email;$this->markDirty();}
	
	function getTaxCode(){return $this->TaxCode;}	
    function setTaxCode( $TaxCode ) {$this->TaxCode = $TaxCode;$this->markDirty();}
					
    function setWeb( $Web ) {$this->Web = $Web;$this->markDirty();}
	function getWeb(){return $this->Web;}
			
	function setDebtLimit( $DebtLimit ) {$this->DebtLimit = $DebtLimit;$this->markDirty();}
	function getDebtLimit(){return $this->DebtLimit;}
				
    function setAddress( $Address ) {$this->Address = $Address;$this->markDirty();}
	function getAddress(){return $this->Address;}
	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setAvatar( $Avatar ) {$this->Avatar = $Avatar; $this->markDirty();}
	function getAvatar(){
		if ($this->Avatar=="")
			return "/data/image/user.png";
		return $this->Avatar;
	}
	
	function setContractId( $ContractId ) {$this->ContractId = $ContractId;$this->markDirty();}		
	function getContractId(){return $this->ContractId;}
	
	function setContractFrom( $ContractFrom ) {$this->ContractFrom = $ContractFrom; $this->markDirty();}
	function getContractFrom(){return $this->ContractFrom;}
	
	function setContractTo( $ContractTo ) {$this->ContractTo = $ContractTo; $this->markDirty();}
	function getContractTo(){return $this->ContractTo;}
	
	function setPublic( $Public ) {$this->Public = $Public; $this->markDirty();}
	function getPublic(){return $this->Public;}
	
	function setPaymentMethod( $PaymentMethod ) {$this->PaymentMethod = $PaymentMethod; $this->markDirty();}
	function getPaymentMethod(){return $this->PaymentMethod;}
		
	function setEnable( $Enable ) {$this->Enable = $Enable; $this->markDirty();}
	function getEnable(){return $this->Enable;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdGroup' 		=> $this->getIdGroup(),
			'IdBranch' 		=> $this->getIdBranch(),
			'Name'			=> $this->getName(),
			'Code'			=> $this->getCode(),
			'Represent'		=> $this->getRepresent(),
			'Tel'			=> $this->getTel(),
			'Fax'			=> $this->getFax(),
			'Email'			=> $this->getEmail(),
			'TaxCode'		=> $this->getTaxCode(),			
			'Web'			=> $this->getWeb(),			
			'DebtLimit'		=> $this->getDebtLimit(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),			
			'Avatar'		=> $this->getAvatar(),
			'ContractId'	=> $this->getContractId(),
			'ContractFrom'	=> $this->getContractFrom(),
			'ContractTo'	=> $this->getContractTo(),
			'PaymentMethod'	=> $this->getPaymentMethod(),
			'Public'		=> $this->getPublic(),
			'Enable'		=> $this->getEnable()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){				
		$this->Id 			= $Data[0];
		$this->IdGroup 		= $Data[1];
		$this->IdBranch		= $Data[2];
		$this->Name 		= $Data[3];
		$this->Code 		= $Data[4];
		$this->Represent	= $Data[5];
		$this->Tel 			= $Data[6];
		$this->Fax 			= $Data[7];
		$this->Email 		= $Data[8];
		$this->TaxCode 		= $Data[9];
		$this->Web 			= $Data[10];
		$this->DebtLimit 	= $Data[11];
		$this->Address		= $Data[12];
		$this->Note			= $Data[13];
		$this->Avatar		= $Data[14];
		$this->ContractId 	= $Data[15];
		$this->ContractFrom	= $Data[16];
		$this->ContractTo	= $Data[17];
		$this->PaymentMethod= $Data[18];
		$this->Public		= $Data[19];
		$this->Enable		= $Data[20];
    }
	
	function getSaleCommandAll(){
		$mSaleCommand 		= new \MVC\Mapper\SaleCommand();
		$SaleCommandAll 	= $mSaleCommand->findByCustomerTop12(array($this->Id));
		return $SaleCommandAll;
	}
	
	function getInvoiceSellAll(){
		$mInvoiceSell 	= new	\MVC\Mapper\InvoiceSell();
		$InvoiceAll 	= $mInvoiceSell->findByCustomerTop12(array($this->Id));
		return $InvoiceAll;
	}
	
	function getCollectAll(){
		$mCustomerCollect 	= new \MVC\Mapper\CustomerCollect();
		$CollectAll 		= $mCustomerCollect->findByCustomer(array($this->Id));
		return $CollectAll;
	}
	
	function getInit(){
		$mCustomerInit 	= new \MVC\Mapper\CustomerInit();
		$CustomerInit	= $mCustomerInit->check($this->getId());
		return $CustomerInit;
	}
	
	function getCPAll(){
		$mCustomerPrice = new \MVC\Mapper\CustomerPrice();
		$CPAll			= $mCustomerPrice->findBy(array($this->getId()));
		return $CPAll;
	}
	
	function getURLBranchInvoiceLoad()	{return "/don-vi/".$this->getBranch()->getKey()."/ban-hang/".$this->getId();}	
	function getURLBranchInvoiceInsExe(){return "/don-vi/".$this->getBranch()->getKey()."/ban-hang/".$this->getId()."/them";}
	
	function getURLBranchCollectLoad(){
		return "/don-vi/".$this->getBranch()->getKey()."/thu-tien/khach-hang/".$this->getId();
	}
	
	function getURLSettingInit(){return "/ql-thiet-lap/khach-hang/".$this->getIdBranch()."/".$this->getId();}
	function getURLPrice(){return "/ql-ban-hang/gia-ban/".$this->getIdBranch()."/".$this->getId();}
					
	//=================================================================================	
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>