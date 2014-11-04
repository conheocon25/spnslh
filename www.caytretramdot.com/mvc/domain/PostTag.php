<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class PostTag extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $IdPost;	
	private $IdTag;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $IdPost=null, $IdTag=null) {
		$this->Id 		= $Id;
		$this->IdPost 	= $IdPost;
		$this->IdTag 	= $IdTag;
		
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
		
	function setIdPost($IdPost) {$this->IdPost = $IdPost;$this->markDirty();}
	function getIdPost() 		{return $this->IdPost;}
	function getPost(){
		$mPost 	= new \MVC\Mapper\Post();
		$Post 	= $mPost->find($this->getIdPost() );
		return $Post;
	}
	
	function setIdTag($IdTag){$this->IdTag = $IdTag;$this->markDirty();}
	function getIdTag() 	{return $this->IdTag;}
	function getTag(){
		$mTag = new \MVC\Mapper\Tag();
		$Tag = $mTag->find($this->getIdTag() );
		return $Tag;
	}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdPost'		=> $this->getIdPost(),
			'IdTag'			=> $this->getIdTag()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->IdPost 	= $Data[1];		
		$this->IdTag	= $Data[2];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){	return "admin/post/".$this->getIdTag()."/".$this->getIdPost()."/upd/load";}
	function getURLUpdExe() {	return "admin/post/".$this->getIdTag()."/".$this->getIdPost()."/upd/exe";}
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLView()	{return "/bai-viet/".$this->getTag()->getKey()."/".$this->getPost()->getKey();}
	function getURLSetting(){return "/admin/post/".$this->getIdTag()."/".$this->getIdPost();}
	function getURLSettingTag(){return "/admin/post/".$this->getIdTag()."/".$this->getIdPost()."/tag";}
	function getURLSettingLinked(){return "/admin/post/".$this->getIdTag()."/".$this->getIdPost()."/linked";}
	function getURLSettingMap(){return "/admin/post/".$this->getIdTag()."/".$this->getIdPost()."/map";}
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>