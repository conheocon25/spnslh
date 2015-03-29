<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class SaleCommandDetail extends Object{

    private $Id;
	private $IdCommand;
	private $IdGood;
	private $Count1;
	private $Count2;
	private $Count3;
				
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null,
		$IdCommand=null, 
		$IdGood=null,				
		$Count1=null,
		$Count2=null,		
		$Count3=null		
	){
        $this->Id 			= $Id;
		$this->IdCommand 	= $IdCommand;
		$this->IdGood 		= $IdGood;		
		$this->Count1 		= $Count1;
		$this->Count2 		= $Count2;		
		$this->Count3 		= $Count3;										
        parent::__construct( $Id );
    }
			
    function getId( ) 		{return $this->Id;}
	
	function setIdCommand( $IdCommand ) {$this->IdCommand = $IdCommand; $this->markDirty();}
	function getIdCommand(){return $this->IdCommand;}
	function getCommand(){
		$mSaleCommand 	= new \MVC\Mapper\SaleCommand();
		$Command 		= $mSaleCommand->find($this->IdCommand);
		return 			$Command;
	}
	
	function setIdGood( $IdGood ) {$this->IdGood = $IdGood; $this->markDirty();}
	function getIdGood(){return $this->IdGood;}
	function getGood(){
		$mGood 	= new \MVC\Mapper\Good();
		$Good 	= $mGood->find($this->IdGood);
		return $Good;
	}
		
	function setCount1( $Count1 ) {$this->Count1 = $Count1; $this->markDirty();}
	function getCount1(){return $this->Count1;}
	function getCount1Print( ){
		$num = number_format($this->getCount1(), 0, ',', ' ');
		return $num;
	}
			
	function setCount2($Count2 ) {$this->Count2 = $Count2; $this->markDirty();}
	function getCount2(){return $this->Count2;}
	function getCount2Print( ){
		$num = number_format($this->getCount2(), 0, ',', ' ');
		return $num;
	}
				
	function setCount3( $Count3 ) {$this->Count3 = $Count3;$this->markDirty();}
	function getCount3(){return $this->Count3;}
	function getCount3Print( ){
		$num = number_format($this->getCount3(), 0, ',', ' ');
		return $num;
	}
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCommand'		=> $this->getIdCommand(),
			'IdGood'		=> $this->getIdGood(),			
			'Count1'		=> $this->getCount1(),
			'Count2'		=> $this->getCount2(),			
			'Count3'		=> $this->getCount3()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCommand 	= $Data[1];
		$this->IdGood 		= $Data[2];		
		$this->Count1 		= $Data[3];
		$this->Count2 		= $Data[4];		
		$this->Count3 		= $Data[5];		
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