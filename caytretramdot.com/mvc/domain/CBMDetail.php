<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CBMDetail extends Object{

    private $Id;
	private $IdCBM;
	private $Move;	
	private $Name1;	
	private $State1;	
	private $Name2;	
	private $State2;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCBM=null, $Move=null,  $Name1=null, $State1=null, $Name2=null, $State2=null){
		$this->Id 		= $Id;
		$this->IdCBM 	= $IdCBM;
		$this->Move		= $Move; 
		$this->Name1 	= $Name1; 
		$this->State1	= $State1;
		$this->Name2 	= $Name2; 		
		$this->State2	= $State2;
				
		parent::__construct( $Id );
	}
    function getId() {return $this->Id;}	
	
	function setIdCBM( $IdCBM ) {$this->IdCBM = $IdCBM;$this->markDirty();}   
	function getIdCBM( ) {return $this->IdCBM;}
	function getCBM( ) {
		$mCBM 	= new \MVC\Mapper\CBM();
		$CBM 	= $mCBM->find($this->IdCBM);
		return $CBM;
	}
	
	function setMove( $Move ) {$this->Move = $Move;$this->markDirty();}   
	function getMove( ) {return $this->Move;}
	function getMove1( ) {return ($this->Move-1)*2;}
	function getMove2( ) {return ($this->Move-1)*2 + 1;}
	
    function setName1( $Name1 ) {$this->Name1 = $Name1;$this->markDirty();}   
	function getName1( ) {return $this->Name1;}
	
	function setState1( $State1 ) {$this->State1 = $State1;$this->markDirty();}
	function getState1( ) {return $this->State1;}
	
	function setName2( $Name2 ) {$this->Name2 = $Name2;$this->markDirty();}   
	function getName2( ) {return $this->Name2;}
	
	function setState2( $State2 ) {$this->State2 = $State2;$this->markDirty();}
	function getState2( ) {return $this->State2;}
			
	function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'IdCBM' 	=> $this->getIdCBM(),
			'Move'		=> $this->getMove(),	
			'Name1'		=> $this->getName1(),	
		 	'State1'	=> $this->getState1(),
			'Name2'		=> $this->getName2(),			 	
			'State2'	=> $this->getState2()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdCBM	= $Data[1];
		$this->Move		= $Data[2];
		$this->Name1 	= $Data[3];		
		$this->State1 	= $Data[4];		
		$this->Name2 	= $Data[5];		
		$this->State2 	= $Data[6];
    }
			
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
				
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
		
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>