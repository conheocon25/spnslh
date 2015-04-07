<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class BranchQuota extends Object{

    private $Id;
	private $IdBranch;
	private $Date;
	private $IdGood;
	private $Count1;
	private $Count2;
	private $Count3;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdBranch	=null, 
		$Date		=null, 
		$IdGood		=null,
		$Count1		=null,
		$Count2		=null,
		$Count3		=null
	){
        $this->Id 		= $Id;
		$this->IdBranch = $IdBranch;
		$this->Date 	= $Date;
		$this->IdGood 	= $IdGood;
		$this->Count1 	= $Count1;
		$this->Count2	= $Count2;
		$this->Count3	= $Count3;
		
        parent::__construct( $Id );
    }
			
    function getId( ) {return $this->Id;}
	
	function setIdBranch( $IdBranch ) 	{$this->IdBranch = $IdBranch;$this->markDirty();}
	function getIdBranch()				{return $this->IdBranch;}
	function getBranch(){
		$mBranch = new \MVC\Mapper\Branch();
		$Branch = $mBranch->find($this->IdBranch);
		return $Branch;
	}
	
	function setDate( $Date ) 	{$this->Date = $Date;$this->markDirty();}
	function getDate()			{return $this->Date;}
	
	function setIdGood( $IdGood ) 	{$this->IdGood = $IdGood;$this->markDirty();}
	function getIdGood()			{return $this->IdGood;}
	function getGood(){
		$mGood = new \MVC\Mapper\Good();
		$Good = $mGood->find($this->IdGood);
		return $Good;
	}
		
	function setCount1( $Count1 ) 	{$this->Count1 = $Count1;$this->markDirty();}
	function getCount1()			{return $this->Count1;}
	function getCount1Print( ){
		$num = number_format($this->getCount1(), 0, ',', ' ');
		return $num;
	}
	
	function setCount2( $Count2 ) {$this->Count2 = $Count2; $this->markDirty();}
	function getCount2()			{return $this->Count2;}
	function getCount2Print( ){
		$num = number_format($this->getCount2(), 0, ',', ' ');
		return $num;
	}
	function getPercentPrint(){return \round($this->getCount2()*100/$this->getCount1(), 0)."%";}	
	function getPercentPrint1(){return 'width:'.$this->getPercentPrint();}	
	
	function setCount3( $Count3 ) {$this->Count3 = $Count3; $this->markDirty();}
	function getCount3()			{return $this->Count3;}
	function getCount3Print( ){
		$num = number_format($this->getCount3(), 0, ',', ' ');
		return $num;
	}
	function reCount3(){
		$mInvoiceSellDetail = new \MVC\Mapper\InvoiceSellDetail();
		$DetailAll 			= $mInvoiceSellDetail->findByDateGood(array($this->getDate(), $this->getIdGood()));
		$Value = 0;		
		while ($DetailAll->valid()){
			$Detail = $DetailAll->current();
			$Value += $Detail->getCount();
			$DetailAll->next();
		}		
		$this->Count3 = $Value;
	}
	
	function getRemain()			{return $this->Count2 - $this->Count3;}
	function getRemainPrint( ){
		$num = number_format($this->getRemain(), 0, ',', ' ');
		return $num;
	}
			
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdBranch	= $Data[1];
		$this->Date 	= $Data[2];
		$this->IdGood	= $Data[3];
		$this->Count1	= $Data[4];
		$this->Count2 	= $Data[5];
		$this->Count3 	= $Data[6];
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdBranch' 		=> $this->getIdBranch(),
			'Date'			=> $this->getDate(),
			'IdGood'		=> $this->getIdGood(),
			'Count1'		=> $this->getCount1(),
			'Count2'		=> $this->getCount2(),
			'Count3'		=> $this->getCount3()
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