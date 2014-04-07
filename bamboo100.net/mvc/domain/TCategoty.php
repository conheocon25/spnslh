<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class TCategory extends Object{
    private $Id;
	private $Name;
	private $Order;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null , $Order=Null, $Key=Null) {
        $this->Id 			= $Id;
		$this->Name 		= $Name;
		$this->Order 		= $Order;
		$this->Key 			= $Key;
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
    function getIdString() {return 'TCategory'.$this->Id;}	
			
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setOrder( $Order ) {$this->Order = $Order;$this->markDirty();}   
	function getOrder( ) {return $this->Order;}
	
			
    function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}   
	function getKey( ) {return $this->Key;}
	function reKey( ){		
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
		
	
	public function toJSON(){
		$json = array(
			'Id' 		=> $this->getId(),
			'Name' 		=> $this->getName(),			
			'Order' 	=> $this->getOrder(),
			'Key' 		=> $this->getKey()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];	
		$this->Name 	= $Data[1];
		$this->Order 	= $Data[2];
		$this->reKey();
    }

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getThemeAll(){
		$mTheme 	= new \MVC\Mapper\TTheme();
		$ThemeAll 	= $mTheme->findBy(array($this->getId()));
		return $ThemeAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------						
	function getURLSetting(){
		return "/quan-ly/theme/".$this->getId();
	}	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>