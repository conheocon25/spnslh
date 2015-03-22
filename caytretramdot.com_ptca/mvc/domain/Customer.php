<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Customer extends Object{

    private $Id;
	private $IdGroup;
	private $Name;
	private $Tel;
    private $Fax;
    private $Email;    
    private $Web;
	private $TaxCode;
	private $DebtLimit;
	private $Address;
	private $Note;
	private $Visible;
	private $Serial;
	private $Avatar;
		
    function __construct( 
		$Id=null, 
		$IdGroup=null, 
		$Name=null, 
		$Tel=null, 
		$Fax=null, 
		$Email=null, 		
		$Web=null,
		$TaxCode=null, 
		$DebtLimit=null,
		$Address=null,
		$Note=null,
		$Visible=null,
		$Serial=null,
		$Avatar=null
	) {
        $this->Id 		= $Id;
		$this->IdGroup 	= $IdGroup;
		$this->Name 	= $Name;
		$this->Tel 		= $Tel;
		$this->Fax 		= $Fax;
		$this->Email 	= $Email;		
		$this->Web 		= $Web;
		$this->TaxCode 	= $TaxCode;
		$this->DebtLimit = $DebtLimit;
		$this->Address	= $Address;
		$this->Note		= $Note;
		$this->Visible	= $Visible;
		$this->Serial	= $Serial;
		$this->Avatar	= $Avatar;
	
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
	
	function getFax(){return $this->Fax;}	
    function setFax( $Fax ) {$this->Fax = $Fax;$this->markDirty();}
	function getFaxPrint(){
		$Arr = array("Hệ thống", "Nhà", "Thường");
		return $Arr[$this->Fax];		
	}
	
	function getEmail(){return $this->Email;}	
    function setEmail( $Email ) {$this->Email = $Email;$this->markDirty();}
	
	function getTaxCode(){return $this->TaxCode;}	
    function setTaxCode( $TaxCode ) {$this->TaxCode = $TaxCode;$this->markDirty();}
	
	function getName(){return $this->Name;}	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}

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
	
	function setVisible( $Visible ) {$this->Visible = $Visible; $this->markDirty();}
	function getVisible(){return $this->Visible;}
	
	function setSerial( $Serial ) {$this->Serial = $Serial; $this->markDirty();}
	function getSerial(){return $this->Serial;}
	
	function setAvatar( $Avatar ) {$this->Avatar = $Avatar; $this->markDirty();}
	function getAvatar(){
		if ($this->Avatar=="")
			return "/data/image/user.png";
		return $this->Avatar;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdGroup' 		=> $this->getIdGroup(),
			'Name'			=> $this->getName(),
			'Tel'			=> $this->getTel(),
			'Fax'			=> $this->getFax(),
			'Email'			=> $this->getEmail(),			
			'Web'			=> $this->getWeb(),
			'TaxCode'		=> $this->getTaxCode(),
			'DebtLimit'		=> $this->getDebtLimit(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),			
			'Visible'		=> $this->getVisible(),
			'Serial'		=> $this->getSerial(),
			'Avatar'		=> $this->getAvatar()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id 			= $Data[0];
		$this->IdGroup		= $Data[1];
		$this->Name 		= $Data[2];
		$this->Tel			= $Data[3];
		$this->Fax			= $Data[4];
		$this->Email		= $Data[5];		
		$this->Web			= $Data[6];
		$this->TaxCode		= $Data[7];
		$this->DebtLimit	= $Data[8];
		$this->Address		= $Data[9];
		$this->Note			= $Data[10];
		$this->Visible		= $Data[11];
		$this->Serial		= $Data[12];
		$this->Avatar		= $Data[13];
    }
			
	function getInvoiceSellAll(){
		$mInvoiceSell 	= new	\MVC\Mapper\InvoiceSell();
		$InvoiceAll 	= $mInvoiceSell->findByCustomerTop12(array($this->Id));
		return $InvoiceAll;
	}
					
	//=================================================================================	
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>