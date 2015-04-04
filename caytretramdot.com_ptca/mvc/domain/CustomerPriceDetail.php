<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class CustomerPriceDetail extends Object{

    private $Id;
	private $IdCP;	
	private $IdGood;
	private $Price;
	private $Commission;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCP=null, $IdGood=null, $Price=null, $Commission=null){
        $this->Id 			= $Id;	
		$this->IdCP 		= $IdCP;		
		$this->IdGood 		= $IdGood;
		$this->Price 		= $Price;
		$this->Commission 	= $Commission;
		
        parent::__construct( $Id );
    }
	function setId( $Id) {$this->Id = $Id;}
    function getId( ) {return $this->Id;}
			
	function setIdCP( $IdCP ) {$this->IdCP = $IdCP;$this->markDirty();}
	function getIdCP(){return $this->IdCP;}
	function getCP(){
		$mCustomerPrice = new \MVC\Mapper\CustomerPrice();
		$CP = $mCustomerPrice->find($this->IdCP);
		return $CP;
	}
	
	function setIdGood( $IdGood ) {$this->IdGood = $IdGood;$this->markDirty();}
	function getIdGood(){return $this->IdGood;}
	function getGood(){
		$mGood 	= new \MVC\Mapper\Good();
		$Good 	= $mGood->find($this->IdGood);
		return $Good;
	}
			
	function setPrice( $Price ) {$this->Price = $Price;$this->markDirty();}
	function getPrice(){return $this->Price;}	
	function getPricePrint( ){
		$num = number_format($this->getPrice(), 0, ',', ' ');
		return $num;
	}
	
	function setCommission( $Price ) {$this->Commission = $Commission;$this->markDirty();}
	function getCommission(){return $this->Commission;}	
	function getCommissionPrint( ){
		$num = number_format($this->getCommission(), 0, ',', ' ');
		return $num;
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];		
		$this->IdCP 		= $Data[1];
		$this->IdGood 		= $Data[2];		
		$this->Price 		= $Data[3];
		$this->Commission	= $Data[4];
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'IdCP'			=> $this->getIdCP(),			
			'IdGood'		=> $this->getIdGood(),
			'Price'			=> $this->getPrice(),
			'Commission'	=> $this->getCommission()
		);
		return json_encode($json);
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
}
?>