<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Restaurant extends Object{
    private $Id;
	private $Introduction;
	private $Count;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $Introduction=null, $Count=null){
        $this->Id 				= $Id;
		$this->Introduction 	= $Introduction;	
		$this->Count 	= $Count;	
				
        parent::__construct( $Id );
    }
    function getId() {return $this->Id;}	
    	
	function setIntroduction( $Introduction ){$this->Introduction = $Introduction;$this->markDirty();}   
	function getIntroduction( ) {return $this->Introduction;}
	function getIntroductionReduce(){$S = new \MVC\Library\String($this->Introduction);return $S->reduceHTML(320);}
		
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
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $this->Introduction, $matches)){
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
			'IdUser' 		=> $this->getIdUser(),
			'Author' 		=> $this->getAuthor(),
			'DateTime'		=> $this->getDateTime(),
			'Introduction'		=> $this->getIntroduction(),	
			'Title'			=> $this->getTitle(),
			'Count'			=> $this->getCount(),
			'Key'			=> $this->getKey()
		);
		
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdUser 		= $Data[1];
		$this->Author 		= $Data[2];
		$this->DateTime 	= \DateTime('Y-m-d H:i:s');		
		$this->Introduction	 	= $Data[4];		
		$this->Title	 	= $Data[5];
		$this->Count	 	= $Data[6];
		$this->reKey();
    }

	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
	
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLUpdLoad(){	return "/quan-ly/quan-ly-nha-hang/info-load";}
	function getURLUpdExe(){	return "/quan-ly/quan-ly-nha-hang/info-exe";}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>