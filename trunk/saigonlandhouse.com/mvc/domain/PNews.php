<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PNews extends Object{

    private $Id;
	private $IdProject;
	private $Name;
	private $Date;	
	private $Description;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdProject=null , $Name=null, $Date=null, $Description=null, $Key=null){
        $this->Id = $Id;
		$this->IdProject = $IdProject;
		$this->Name = $Name;
		$this->Date = $Date;		
		$this->Description = $Description;
		$this->Key = $Key;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}
		
    function setIdProject( $IdProject ) {$this->IdProject = $IdProject;$this->markDirty();}   
	function getIdProject( ) {return $this->IdProject;}
	function getProject(){$mProject = new \MVC\Mapper\Project();$Project = $mProject->find($this->getIdProject());return $Project;}
			
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
	
	function getImage(){		
		$first_img = '';
		\ob_start();
		\ob_end_clean();
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $this->Description, $matches)){
			$first_img = $matches[1][0];
		}
		else {
			$first_img = "/mvc/templates/theme/base/img/items/1.jpg";
		}
		return $first_img;
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdProject' 	=> $this->getIdProject(),
			'Name' 			=> $this->getName(),
			'Date'			=> $this->getDate(),
			'Description'	=> $this->getDescription(),	
			'Key'			=> $this->getKey()
		);
		
		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdProject 	= $Data[1];
		$this->Name 		= $Data[2];
		$this->Date 		= \date('Y-m-d H:i:s');		
		$this->Description 	= $Data[4];
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/du-an/".$this->getProject()->getKey()."/tin-tuc/".$this->getKey();}
	
	function getURLUpdLoad(){return "/setting/project/".$this->getIdProject()."/news/".$this->getId()."/upd-load";}
	function getURLUpdExe(){return "/setting/project/".$this->getIdProject()."/news/".$this->getId()."/upd-exe";}
	function getURLDelLoad(){return "/setting/project/".$this->getIdProject()."/news/".$this->getId()."/del-load";}
	function getURLDelExe(){return "/setting/project/".$this->getIdProject()."/news/".$this->getId()."/del-exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
}
?>