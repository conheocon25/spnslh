<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Project extends Object{

    private $Id;
	private $Name;	
	private $Description;
	private $Type;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Name=null, $Description=null, $Type=null, $Key=null){
        $this->Id = $Id;
		$this->Name = $Name;		
		$this->Description = $Description;	
		$this->Type = $Type;
		$this->Key = $Key;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
	function setDescription( $Description ){$this->Description = $Description;$this->markDirty();}   
	function getDescription( ) {return $this->Description;}
	function getDescriptionReduce( ){$S = new \MVC\Library\String($this->Description);return $S->reduceHTML(350);}
	
	function setName( $Name ){$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}
	
	function setType( $Type ){$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	function isVIP(){if ($this->Type == 1)return true;return false;}
	
	function getImage(){		
		$first_img = '';
		\ob_start();
		\ob_end_clean();
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $this->Description, $matches)){
			$first_img = $matches[1][0];
		}
		else {
			$first_img = "/data/images/no_image.png";
		}
		return $first_img;
	}
			
	function setKey( $Key ) {$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ) {
		$Str = new \MVC\Library\String($this->Name);
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name' 			=> $this->getName(),			
			'Description'	=> $this->getDescription(),
			'Type'			=> $this->getType(),
			'Key'			=> $this->getKey()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];	
		$this->Name 		= $Data[1];			
		$this->Description 	= $Data[2];
		$this->Type 		= $Data[3];
		
		$this->reKey();
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	function getNewsAll(){
		$mNews = new \MVC\Mapper\PNews();
		$NewsAll = $mNews->findBy(array($this->getId()));
		return $NewsAll;
	}
	
	function getProductAll(){
		$mPProduct = new \MVC\Mapper\PProduct();
		$ProductAll = $mPProduct->findBy(array($this->getId()));
		return $ProductAll;
	}
	
	function getDocumentAll(){
		$mDoc = new \MVC\Mapper\PDocument();
		$DocAll = $mDoc->findBy(array($this->getId()));
		return $DocAll;
	}
	
	function getAlbumAll(){
		$mAlbum = new \MVC\Mapper\PAlbum();
		$AlbumAll = $mAlbum->findBy(array($this->getId()));
		return $AlbumAll;
	}
	function getVideoAll(){
		$mVideo = new \MVC\Mapper\PVideo();
		$VideoAll = $mVideo->findBy(array($this->getId()));
		return $VideoAll;
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------	
	function getURLSettingNews(){return "/setting/project/".$this->getId()."/news";}
	function getURLSettingAlbum(){return "/setting/project/".$this->getId()."/album";}
	function getURLSettingVideo(){return "/setting/project/".$this->getId()."/video";}
	function getURLSettingProduct(){return "/setting/project/".$this->getId()."/product";}
	function getURLSettingDocument(){return "/setting/project/".$this->getId()."/document";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>