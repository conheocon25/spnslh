<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Supplier extends Object{

    private $Id;
	private $IdType;
	private $Name;
	private $Code;
	private $Represent;
	private $Tel;
    private $Fax;
    private $Email;    
    private $Web;
	private $TaxCode;
	private $DebtLimit;
	private $Address;
	private $Note;	
	private $Avatar;
	private $Enable;
		
    function __construct( 
		$Id=null, 
		$IdType=null, 
		$Name=null, 
		$Code=null,
		$Represent=null,
		$Tel=null, 
		$Fax=null, 
		$Email=null, 		
		$Web=null,
		$TaxCode=null, 
		$DebtLimit=null,
		$Address=null,
		$Note=null,		
		$Avatar=null,
		$Enable=null
	) {
        $this->Id 		= $Id;
		$this->IdType 	= $IdType;
		$this->Name 	= $Name;
		$this->Code		= $Code;
		$this->Represent= $Represent;
		$this->Tel 		= $Tel;
		$this->Fax 		= $Fax;
		$this->Email 	= $Email;		
		$this->Web 		= $Web;
		$this->TaxCode 	= $TaxCode;
		$this->DebtLimit = $DebtLimit;
		$this->Address	= $Address;
		$this->Note		= $Note;		
		$this->Avatar	= $Avatar;
		$this->Enable	= $Enable;		
	
        parent::__construct( $Id );
    }
	function setId( $Id){return $this->Id = $Id;}
    function getId( ) 	{return $this->Id;}
	
	function setIdType( $IdType){return $this->IdType = $IdType;}
    function getIdType( ) 		{return $this->IdType;}
	function getType( ){
		$mSupplierType = new \MVC\Mapper\SupplierType();
		$Type = $mSupplierType->find($this->IdType);
		return $Type;
	}
	
	function getName(){return $this->Name;}	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	
	function setCode( $Code ) {$this->Code = $Code; $this->markDirty();}
	function getCode(){return $this->Code;}
	
	function setRepresent( $Represent ) {$this->Represent = $Represent; $this->markDirty();}
	function getRepresent(){return $this->Represent;}
			
	function getFax(){return $this->Fax;}	
    function setFax( $Fax ) {$this->Fax = $Fax;$this->markDirty();}
		
	function getEmail(){return $this->Email;}	
    function setEmail( $Email ) {$this->Email = $Email;$this->markDirty();}
	
	function getTaxCode(){return $this->TaxCode;}	
    function setTaxCode( $TaxCode ) {$this->TaxCode = $TaxCode;$this->markDirty();}
		
	function getTel(){return $this->Tel;}
    function setTel( $Tel ) {$this->Tel = $Tel;$this->markDirty();}
			
    function setWeb( $Web ) {$this->Web = $Web;$this->markDirty();}
	function getWeb(){return $this->Web;}
		
	function setDebtLimit( $DebtLimit ) {$this->DebtLimit = $DebtLimit;$this->markDirty();}
	function getDebtLimit(){return $this->DebtLimit;}
				
    function setAddress( $Address ) {$this->Address = $Address;$this->markDirty();}
	function getAddress(){return $this->Address;}
	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setEnable( $Enable ) {$this->Enable = $Enable; $this->markDirty();}
	function getEnable(){return $this->Enable;}
		
	function setAvatar( $Avatar ) {$this->Avatar = $Avatar; $this->markDirty();}
	function getAvatar(){return $this->Avatar;}
	
	function getInvoiceImportAll(){
		$mInvoiceImport	= new	\MVC\Mapper\InvoiceImport();
		$InvoiceAll 	= $mInvoiceImport->findBySupplier(array($this->Id));
		return $InvoiceAll;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),	
			'IdType' 		=> $this->getIdType(),	
			'Name'			=> $this->getName(),
			'Code'			=> $this->getCode(),
			'Represent'		=> $this->getRepresent(),
			'Tel'			=> $this->getTel(),
			'Fax'			=> $this->getFax(),
			'Email'			=> $this->getEmail(),			
			'Web'			=> $this->getWeb(),
			'TaxCode'		=> $this->getTaxCode(),
			'DebtLimit'		=> $this->getDebtLimit(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),						
			'Avatar'		=> $this->getAvatar(),
			'Enable'		=> $this->getEnable()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){		
		$this->Id 			= $Data[0];
		$this->IdType 		= $Data[1];
		$this->Name 		= $Data[2];
		$this->Code			= $Data[3];
		$this->Represent	= $Data[4];
		$this->Tel 			= $Data[5];
		$this->Fax 			= $Data[6];
		$this->Email 		= $Data[7];
		$this->Web 			= $Data[8];
		$this->TaxCode 		= $Data[9];
		$this->DebtLimit 	= $Data[10];
		$this->Address		= $Data[11];
		$this->Note			= $Data[12];
		$this->Avatar		= $Data[13];
		$this->Enable		= $Data[14];
    }
					
	//=================================================================================
	function getURLImport(){return "/ql-kho-hang/lenh-nhap/".$this->getId();}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>