<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class News extends Object{

    private $Id;
	private $IdCategory;
	private $Name;
	private $Date;	
	private $Description;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null , $Name=null, $Date=null, $Description=null, $Key=null){
        $this->Id = $Id;
		$this->IdCategory = $IdCategory;
		$this->Name = $Name;
		$this->Date = $Date;		
		$this->Description = $Description;
		$this->Key = $Key;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}
		
    function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}   
	function getIdCategory( ) {return $this->IdCategory;}
	function getProject(){$mProject = new \MVC\Mapper\Project();$Project = $mProject->find($this->getIdCategory());return $Project;}
			
	function setDate( $Date ){$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ){$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	
	function setDescription( $Description ){$this->Description = $Description;$this->markDirty();}   
	function getDescription( ) {return $this->Description;}
	function getDescriptionReduce( ){$S = new \MVC\Library\String($this->Description);return $S->reduceHTML(350);}
	
	function setName( $Name ){$this->Name = $Name;$this->markDirty();}
	function getName( ) {return $this->Name;}
			
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'Name' 			=> $this->getName(),
			'Date'			=> $this->getDate(),
			'Description'	=> $this->getDescription(),	
			'Key'			=> $this->getKey()
		);
		
		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory 	= $Data[1];
		$this->Name 		= $Data[2];
		$this->Date 		= \date('Y-m-d H:i:s');		
		$this->Description 	= $Data[3];
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