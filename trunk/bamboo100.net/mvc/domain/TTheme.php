<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TTheme extends Object{
    private $Id;
	private $IdCategory;
	private $Name;
	private $Note;
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null, $Name=null , $Note=null , $Order=Null, $Key=Null){
        $this->Id 			= $Id;
		$this->IdCategory 	= $IdCategory;
		$this->Name 		= $Name;
		$this->Note 		= $Note;
		$this->Order 		= $Order;		
		$this->Key 			= $Key;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
    
	function setIdCategory( $IdCategory ) 	{$this->IdCategory = $IdCategory;$this->markDirty();}   
	function getIdCategory( ) 				{return $this->IdCategory;}
	function getCategory( ) 				{
		$mTCategory = new \MVC\Mapper\TCategory();
		$Category 	= $mTCategory->find($this->IdCategory);
		return $Category;
	}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setOrder( $Order ) {$this->Order = $Order;$this->markDirty();}   
	function getOrder( ) {return $this->Order;}
	
	function setNote( $Note ) {	$this->Note = $Note;$this->markDirty();}
	function getNote( ) {return $this->Note;}
	
    function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}   
	function getKey( ) {return $this->Key;}
	function reKey( ){		
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}		
	
	public function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getId(),
			'Name' 			=> $this->getName(),			
			'Order' 		=> $this->getOrder(),
			'Note' 			=> $this->getNote(),
			'Key' 			=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];	
		$this->IdCategory	= $Data[1];	
		$this->Name 		= $Data[2];
		$this->Note 		= $Data[3];
		$this->Order 		= $Data[4];
		$this->reKey();
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