<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PostLinked extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdPost1;	
	private $IdPost2;
	private $IdLinked;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdPost1=null, $IdPost2=null, $IdLinked=null) {
		$this->Id 		= $Id;
		$this->IdPost1 	= $IdPost1;
		$this->IdPost2 	= $IdPost2;
		$this->IdLinked = $IdLinked;
		
		parent::__construct( $Id );
	}		
	function getId() {return $this->Id;}
		
	function setIdPost1($IdPost1) {$this->IdPost1 = $IdPost1;$this->markDirty();}
	function getIdPost1() 		{return $this->IdPost1;}
	function getPost1(){
		$mPost 	= new \MVC\Mapper\Post();
		$Post 	= $mPost->find($this->getIdPost1() );
		return $Post;
	}
	
	function setIdPost2($IdPost2) {$this->IdPost2 = $IdPost2;$this->markDirty();}
	function getIdPost2() 		{return $this->IdPost2;}
	function getPost2(){
		$mPost 	= new \MVC\Mapper\Post();
		$Post 	= $mPost->find($this->getIdPost2() );
		return $Post;
	}
	
	function setIdLinked($IdLinked){$this->IdLinked = $IdLinked;$this->markDirty();}
	function getIdLinked() 	{return $this->IdLinked;}
	function getLinked(){
		$mLinked = new \MVC\Mapper\Linked();
		$Linked = $mLinked->find($this->getIdLinked() );
		return $Linked;
	}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdPost1'		=> $this->getIdPost1(),
			'IdPost2'		=> $this->getIdPost2(),
			'IdLinked'		=> $this->getIdLinked()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdPost1 	= $Data[1];		
		$this->IdPost2 	= $Data[2];		
		$this->IdLinked	= $Data[3];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){	return "admin/post/".$this->getIdLinked()."/".$this->getIdPost1()."/upd/load";}
	function getURLUpdExe() {	return "admin/post/".$this->getIdLinked()."/".$this->getIdPost1()."/upd/exe";}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead()	{return "/bai-viet/".$this->getLinked()->getKey()."/".$this->getPost()->getKey();}
	function getURLSetting(){return "/admin/setting/PostLinked/".$this->getId();}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>