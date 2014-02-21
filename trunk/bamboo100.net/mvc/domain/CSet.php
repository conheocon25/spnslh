<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class CSet extends Object{
    private $Id;
	private $IdCBook;
	private $Name;
	private $Content;	
	private $Count;
	private $Key;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdCBook=null , $Name=null, $Content=null, $Count=null, $Key=null){
        $this->Id 		= $Id;
		$this->IdCBook 	= $IdCBook;				
		$this->Name 	= $Name;
		$this->Content 	= $Content;	
		$this->Count 	= $Count;	
		$this->Key 		= $Key;
		
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
		
    function setIdCBook( $IdCBook ) {$this->IdCBook = $IdCBook;$this->markDirty();}   
	function getIdCBook( ) {return $this->IdCBook;}
	function getCBook(){$mCB = new \MVC\Mapper\CBook();$CB = $mCB->find($this->getIdCBook());return $CB;}
			
	function setContent( $Content ){$this->Content = $Content;$this->markDirty();}   
	function getContent( ) {return $this->Content;}
	function getContentReduce(){$S = new \MVC\Library\String($this->Content);return $S->reduceHTML(320);}
	
	function setName( $Name ){$this->Name = $Name;$this->markDirty();}   
	function getName( ) {return $this->Name;}	
	function getNameReduce(){$S = new \MVC\Library\String($this->Name);return $S->reduce(45);}
	
	function setCount( $Count ){$this->Count = $Count;$this->markDirty();}   
	function getCount( ) {return $this->Count;}
	function getCountPrint( ){
		$N = new \MVC\Library\Number($this->Count);
		return $N->formatCurrency();
	}
		
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
		$Str = new \MVC\Library\String($this->Name." ".$this->getId());
		$this->Key = $Str->converturl();
	}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCBook' 		=> $this->getIdCBook(),
			'Name'			=> $this->getName(),
			'Content'		=> $this->getContent(),				
			'Count'			=> $this->getCount(),
			'Key'			=> $this->getKey()
		);
		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCBook 		= $Data[1];
		$this->Name	 		= $Data[2];
		$this->Content	 	= $Data[3];				
		$this->Count	 	= $Data[4];
		$this->reKey();
    }

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){return "/tin-tuc/".$this->getCategory()->getKey()."/".$this->getKey();}
	
	function getURLUpdLoad(){	return "/quan-ly/co-tuong/".$this->getIdCBook()."/van-co/".$this->getId()."/upd-load";}
	function getURLUpdExe(){	return "/quan-ly/co-tuong/".$this->getIdCBook()."/van-co/".$this->getId()."/upd-exe";}
	function getURLDelLoad(){	return "/quan-ly/co-tuong/".$this->getIdCBook()."/van-co/".$this->getId()."/del-load";}
	function getURLDelExe(){	return "/quan-ly/co-tuong/".$this->getIdCBook()."/van-co/".$this->getId()."/del-exe";}
	
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>