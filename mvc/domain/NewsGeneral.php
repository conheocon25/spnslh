<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class NewsGeneral extends Object{
    private $Id;
	private $IdCategory;	
	private $Date;
	private $Content;
	private $Title;
	private $Type;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCategory=null , $Date=Null, $Content=null, $Title=null, $Type=null, $Key=null){
        $this->Id = $Id;
		$this->IdCategory = $IdCategory;
		$this->Date = $Date;
		$this->Content = $Content;
		$this->Title = $Title;
		$this->Type = $Type;
		$this->Key = $Key;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}   
	function getIdCategory( ) {return $this->IdCategory;}
	function getCategory(){
		$mCategory = new \MVC\Mapper\Category();
		$Category = $mCategory->find($this->getIdCategory());
		return $Category;
	}
			
	function setDate( $Date ){$this->Date = $Date;$this->markDirty();}   
	function getDate( ) {return $this->Date;}
	function getDatePrint( ){$D = new \MVC\Library\Date($this->Date);return $D->getDateFormat();}
	
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
	function getContentReduce( ){$S = new \MVC\Library\String($this->Content);		return $S->reduceHTML(350);}
	function getContentReduceTop( ){$S = new \MVC\Library\String($this->Content);		return $S->reduceHTML(150);}
	
	function setTitle( $Title ){$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}
	function getTitleReduce( ){$S = new \MVC\Library\String($this->Title);return $S->reduce(50);}
	
	function setType( $Type ){$this->Type = $Type;$this->markDirty();}   
	function getType( ) {return $this->Type;}
	function isVIP(){if ($this->Type == 1)return true;return false;}
	
	function getImage(){		
		$first_img = '';
		\ob_start();
		\ob_end_clean();
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $this->Content, $matches)){
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
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){
		return "/general/".$this->getIdCategory()."/".$this->getId();
	}
	
	function getURLUpdLoad(){
		return "/setting/category/general/".$this->getIdCategory()."/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){		
		return "/setting/category/general/".$this->getIdCategory()."/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){		
		return "/setting/category/general/".$this->getIdCategory()."/".$this->getId()."/del/load";
	}	
	function getURLDelExe(){		
		return "/setting/category/general/".$this->getIdCategory()."/".$this->getId()."/del/exe";
	}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>