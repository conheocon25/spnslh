<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class NewsMarket extends Object{

    private $Id;
	private $IdCategory;
	private $IdEstate;
	private $Price;
	private $IdProvince;
	private $IdDistrict;
	private $Date;
	private $Content;
	private $Title;
	private $Type;
	private $X;
	private $Y;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 	$Id=null, 
							$IdCategory=null, 
							$IdEstate=null,							
							$Price=null,
							$IdProvince=null,
							$IdDistrict=null,
							$Date=Null, 
							$Content=null, 
							$Title=null,
							$Type=null,
							$X=null,
							$Y=null)
	{
        $this->Id = $Id;
		$this->IdCategory = $IdCategory;
		$this->IdEstate = $IdEstate;
		$this->Price = $Price;
		$this->IdProvince = $IdProvince;
		$this->IdDistrict = $IdDistrict;
		$this->Date = $Date;
		$this->Content = $Content;
		$this->Title = $Title;
		$this->Type = $Type;
		$this->X = $X;
		$this->Y = $Y;
		
        parent::__construct( $Id );
    }
	function setId($Id) {
        $this->Id = $Id;
    }	
    function getId() {
        return $this->Id;
    }	
		
    function setIdCategory( $IdCategory ) {
        $this->IdCategory = $IdCategory;
        $this->markDirty();
    }   
	function getIdCategory( ) {
        return $this->IdCategory;
    }
	function getCategory(){
		$mCategory = new \MVC\Mapper\CategoryMarket();
		$Category = $mCategory->find($this->getIdCategory());
		return $Category;
	}
	
	function setIdEstate( $IdEstate ) {
        $this->IdEstate = $IdEstate;
        $this->markDirty();
    }   
	function getIdEstate( ) {
        return $this->IdEstate;
    }
	function getEstate(){
		$mCategory = new \MVC\Mapper\CategoryEstate();
		$Category = $mCategory->find($this->getIdEstate());
		return $Category;
	}
	
	function setPrice( $Price ) {
        $this->Price = $Price;
        $this->markDirty();
    }   
	function getPrice( ) {
        return $this->Price;
    }
	function getPricePrint( ) {
		if ($this->Price==0)
			return "Thỏa thuận";
		$N = new \MVC\Library\Number($this->Price);
		
        return $N->readDigit1();
    }
			
	function setIdProvince( $IdProvince ) {
        $this->IdProvince = $IdProvince;
        $this->markDirty();
    }   
	function getIdProvince( ) {
        return $this->IdProvince;
    }
	function getProvince( ) {
		$mProvince = new \MVC\Mapper\Province();
		$Province = $mProvince->find($this->IdProvince);
        return $Province;
    }
	
	function setIdDistrict( $IdDistrict ) {
        $this->IdDistrict = $IdDistrict;
        $this->markDirty();
    }   
	function getIdDistrict( ) {
        return $this->IdDistrict;
    }
	function getDistrict( ) {
		$mDistrict = new \MVC\Mapper\District();
		$District = $mDistrict->find($this->IdDistrict);
        return $District;
    }
	function getPosition(){
		$Provice = $this->getProvince();
		$District = $this->getDistrict();
		if (!isset($Provice)) $Provice1 = "sai tỉnh"; else $Provice1 = $Provice->getName();
		if (!isset($District)) $District1 = "sai huyện";  else $District1 = $District->getName();
		return $District1." ".$Provice1;
	}
	
	function setDate( $Date ){
        $this->Date = $Date;
        $this->markDirty();
    }   
	function getDate( ) {
        return $this->Date;
    }
	function getDatePrint( ){
		$D = new \MVC\Library\Date($this->Date);
        return $D->getDateFormat();
    }
	
	function setContent( $Content ){
        $this->Content = $Content;
        $this->markDirty();
    }   
	function getContent( ) {
        return $this->Content;
    }
	
	function setTitle( $Title ){
        $this->Title = $Title;
        $this->markDirty();
    }   
	function getTitle( ) {
        return $this->Title;
    }
	function getTitleReduce( ){
		$S = new \MVC\Library\String($this->Title);
		return $S->reduce(42);
    }
	function getTitleReduce1( ){
		$S = new \MVC\Library\String($this->Title);
		return $S->reduce(72);
    }
	
	function setType( $Type ){
        $this->Type = $Type;
        $this->markDirty();
    }   
	function getType( ) {
        return $this->Type;
    }
	function isVIP(){
		if ($this->Type == 1)
			return true;
		return false;
	}
	
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
	
	function setX( $X ){
        $this->X = $X;
        $this->markDirty();
    }   
	function getX( ) {
        return $this->X;
    }
	
	function setY( $Y ){
        $this->Y = $Y;
        $this->markDirty();
    }   
	function getY( ) {
        return $this->Y;
    }
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLRead(){
		return "/market/".$this->getIdCategory()."/".$this->getId();
	}
	
	function getURLUpdLoad(){
		return "/setting/category/market/".$this->getIdCategory()."/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){		
		return "/setting/category/market/".$this->getIdCategory()."/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){		
		return "/setting/category/market/".$this->getIdCategory()."/".$this->getId()."/del/load";
	}	
	function getURLDelExe(){
		return "/setting/category/market/".$this->getIdCategory()."/".$this->getId()."/del/exe";
	}
			
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>