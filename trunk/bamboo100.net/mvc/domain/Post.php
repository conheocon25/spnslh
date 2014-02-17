<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Post extends Object{

    private $Id;
	private $IdUser;	
	private $DateTime;	
	private $Title;
	private $Content;	
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdUser=null , $DateTime=Null, $Title=null, $Content=null, $Key=null){
        $this->Id 		= $Id;
		$this->IdUser 	= $IdUser;		
		$this->DateTime = $DateTime;		
		$this->Title 	= $Title;
		$this->Content 	= $Content;	
		$this->Key 		= $Key;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
	function getIdPrint(){return "n" . $this->getId();}	
	
    function setIdUser( $IdUser ) {$this->IdUser = $IdUser;$this->markDirty();}   
	function getIdUser( ) {return $this->IdUser;}
	function getCategory(){$mCategory = new \MVC\Mapper\CategoryNews();$Category = $mCategory->find($this->getIdUser());return $Category;}
	
	function setAuthor( $Author ){$this->Author = $Author;$this->markDirty();}   
	function getAuthor( ) {return $this->Author;}
	
	function setDateTime( $DateTime ){$this->DateTime = $DateTime;$this->markDirty();}   
	function getDateTime( ) {return $this->DateTime;}
	function getDateTimePrint( ){$D = new \MVC\Library\Date($this->DateTime);return $D->getDateTimeFormat();}
	
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
	function getContentReduce(){$S = new \MVC\Library\String($this->Content);return $S->reduceHTML(320);}
	
	function setTitle( $Title ){$this->Title = $Title;$this->markDirty();}   
	function getTitle( ) {return $this->Title;}	
	function getTitleReduce(){$S = new \MVC\Library\String($this->Title);return $S->reduce(45);}
	
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
			$first_img = "/mvc/templates/theme/base/img/items/1.jpg";
		}
		return $first_img;
	}
	
	function setKey( $Key ){$this->Key = $Key;$this->markDirty();}
	function getKey( ) {return $this->Key;}
	function reKey( ){
		$Str = new \MVC\Library\String($this->Title." ".$this->getId());
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdUser' 	=> $this->getIdUser(),
			'Author' 		=> $this->getAuthor(),
			'DateTime'			=> $this->getDateTime(),
			'Content'		=> $this->getContent(),	
			'Title'			=> $this->getTitle(),	
			'Type'			=> $this->getType(),	
			'Key'			=> $this->getKey()
		);
		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdUser 	= $Data[1];
		$this->Author 		= $Data[2];
		$this->DateTime 		= \DateTime('Y-m-d H:i:s');		
		$this->Content	 	= $Data[4];		
		$this->Title	 	= $Data[5];		
		$this->Type		 	= $Data[6];		
		$this->reKey();
    }

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/tin-tuc/".$this->getCategory()->getKey()."/".$this->getKey();}
	
	function getURLUpdLoad(){return "/setting/category-n/".$this->getIdUser()."/news/".$this->getId()."/upd-load";}
	function getURLUpdExe(){return "/setting/category-n/".$this->getIdUser()."/news/".$this->getId()."/upd-exe";}
	
	function getURLDelLoad(){return "/setting/category-n/".$this->getIdUser()."/news/".$this->getId()."/del-load";}
	function getURLDelExe(){return "/setting/category-n/".$this->getIdUser()."/news/".$this->getId()."/del-exe";}

	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>