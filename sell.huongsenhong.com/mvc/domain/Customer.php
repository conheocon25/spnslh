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
	
	/*Hàm kh?i t?o và thi?t l?p các thu?c tính*/
    function __construct( $Id=null, $Name=null, $Type=null, $Card=null, $Phone=null, $Address=null, $Note=null, $Discount=null ) {
        $this->Id = $Id;
		$this->Name 	= $Name;
		$this->Type 	= $Type;
		$this->Card 	= $Card;
		$this->Phone 	= $Phone;
		$this->Address 	= $Address;
		$this->Note 	= $Note;
		$this->Discount = $Discount;
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
	
	function getName(){return $this->Name;}	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}

	function getPhone(){return $this->Phone;}
    function setPhone( $Phone ) {$this->Phone = $Phone;$this->markDirty();}
			
    function setAddress( $Address ) {$this->Address = $Address;$this->markDirty();}
	function getAddress(){return $this->Address;}
		
	function setDiscount( $Discount ) {$this->Discount = $Discount;$this->markDirty();}
	function getDiscount(){return $this->Discount;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),
			'Type'			=> $this->getType(),
			'Card'			=> $this->getCard(),
			'Phone'			=> $this->getPhone(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),
			'Discount'		=> $this->getDiscount()
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
    }
	
	function toXML($Doc){
		$Obj = $Doc->createElement( "customer" );
		$Obj->setAttributeNode(new \DOMAttr('id', $this->getId()));
						
		$Name = $Doc->createElement( "name" );
		$Name->appendChild($Doc->createTextNode( $this->getName() ));
		
		$Type = $Doc->createElement( "type" );
		$Type->appendChild($Doc->createTextNode( $this->getType() ));
		
		$Card = $Doc->createElement( "card" );
		$Card->appendChild($Doc->createTextNode( $this->getCard() ));
		
		$Phone = $Doc->createElement( "phone" );
		$Phone->appendChild($Doc->createTextNode( $this->getPhone() ));
		
		$Address = $Doc->createElement( "address" );
		$Address->appendChild($Doc->createTextNode( $this->getAddress() ));
		
		$Note = $Doc->createElement( "note" );
		$Note->appendChild($Doc->createTextNode( $this->getNote() ));
		
		$Discount = $Doc->createElement( "discount" );
		$Discount->appendChild($Doc->createTextNode( $this->getDiscount() ));
		
		$Obj->appendChild( $Name 		);
		$Obj->appendChild( $Type 		);
		$Obj->appendChild( $Card 		);
		$Obj->appendChild( $Phone 		);
		$Obj->appendChild( $Address 	);
		$Obj->appendChild( $Note 		);
		$Obj->appendChild( $Discount 	);
		
		return $Obj;
	}
	
	function getSessionAll(){
		$mSession = new	\MVC\Mapper\Session();
		$Sessions = $mSession->findByCustomer(array($this->Id));
		return $Sessions;
	}
	
	function getCollectAll(){
		$mCC = new \MVC\Mapper\CollectCustomer();
		$CollectAll = $mCC->findBy(array($this->getId()));
		return $CollectAll;
	}
	
	//=================================================================================
	function getURLCollect(){return "/money/collect/customer/".$this->getId();}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>