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
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdBranch	=null, 
		$Date		=null, 
		$IdGood		=null,
		$Count1		=null,
		$Count2		=null		
	){
        $this->Id 		= $Id;
		$this->IdBranch = $IdBranch;
		$this->Date 	= $Date;
		$this->IdGood 	= $IdGood;
		$this->Count1 	= $Count1;
		$this->Count2	= $Count2;
		
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
	function getPercentPrint(){
		return \round($this->getCount2()*100/$this->getCount1(), 0)."%";
	}
	
	function getPercentPrint1(){
		return 'width:'.$this->getPercentPrint();
	}	
		
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdBranch	= $Data[1];
		$this->Date 	= $Data[2];
		$this->IdGood	= $Data[3];
		$this->Count1	= $Data[4];
		$this->Count2 	= $Data[5];		
    }
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdBranch' 		=> $this->getIdBranch(),
			'Date'			=> $this->getDate(),
			'IdGood'		=> $this->getIdGood(),
			'Count1'		=> $this->getCount1(),
			'Count2'		=> $this->getCount2()			
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