<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Customer extends Object{

    private $Id;
	private $Name;
	private $Phone;
    private $Type;
    private $Card;
    private $Note;
    private $Address;
	private $Discount;
	private $IdDomain;
	
	/*Hàm khởi tạo và thiet lap các thuoc tính*/
    function __construct( $Id=null, $Name=null, $Type=null, $Card=null, $Phone=null, $Address=null, $Note=null, $Discount=null, $IdDomain=null ) {
        $this->Id = $Id;
		$this->Name 	= $Name;
		$this->Type 	= $Type;
		$this->Card 	= $Card;
		$this->Phone 	= $Phone;
		$this->Address 	= $Address;
		$this->Note 	= $Note;
		$this->Discount = $Discount;
		$this->IdDomain = $IdDomain;
        parent::__construct( $Id );
    }
	function setId( $Id) {return $this->Id = $Id;}
    function getId( ) {return $this->Id;}
		
	function getType(){return $this->Type;}	
    function setType( $Type ) {$this->Type = $type;$this->markDirty();}
	function getTypePrint(){if ($this->Type==1)return "VIP"; return "Thường";}
	
	function getCard(){return $this->Card;}	
    function setCard( $Card ) {$this->Card = $Card;$this->markDirty();}
	
	function getNote(){return $this->Note;}	
    function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	
	function getName(){return \trim($this->Name);}
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}

	function getPhone(){return $this->Phone;}
    function setPhone( $Phone ) {$this->Phone = $Phone;$this->markDirty();}
			
    function setAddress( $Address ) {$this->Address = $Address;$this->markDirty();}
	function getAddress(){return $this->Address;}
		
	function setDiscount( $Discount ) {$this->Discount = $Discount;$this->markDirty();}
	function getDiscount(){return $this->Discount;}
	
	function setIdDomain( $IdDomain ) {$this->IdDomain = $IdDomain;$this->markDirty();}
	function getIdDomain(){return $this->IdDomain;}
	function getDomain(){
		$mDomain 	= new \MVC\Mapper\Domain();
		$Domain 	= $mDomain->find($this->IdDomain);
		return $Domain;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),
			'Type'			=> $this->getType(),
			'Card'			=> $this->getCard(),
			'Phone'			=> $this->getPhone(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),
			'Discount'		=> $this->getDiscount(),
			'IdDomain'		=> $this->getIdDomain()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Type		= $Data[2];
		$this->Card		= $Data[3];
		$this->Phone	= $Data[4];
		$this->Address	= $Data[5];
		$this->Note		= $Data[6];
		$this->Discount	= $Data[7];
		$this->IdDomain	= $Data[8];
    }
		
	function getCollectAll(){
		$mCC = new \MVC\Mapper\CollectCustomer();
		$CollectAll = $mCC->findBy(array($this->getId()));
		return $CollectAll;
	}
	function getLogActive(){
		$mCL 	= new \MVC\Mapper\CustomerLog();
		$CL 	= $mCL->findActive(array(\date('Y-m-d'), $this->getId()));
		return $CL;
	}
	function getLogAll(){
		$mCL 	= new \MVC\Mapper\CustomerLog();
		$CLAll = $mCL->findByCustomer(array($this->getId()));
		return $CLAll;
	}
	
	//=================================================================================	
	function getURLSelling(){return "/selling/".$this->getIdDomain()."/".$this->getId();}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>