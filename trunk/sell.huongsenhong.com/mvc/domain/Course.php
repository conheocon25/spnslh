<?php
Namespace MVC\Domain;
use MVC\Library\Number;
require_once( "mvc/base/domain/DomainObject.php");

class Course extends Object{
    private $Id;
	private $IdCategory;
	private $Name;
	private $ShortName;
	private $Unit;
	private $Price1;
	private $Price2;
	private $Price3;
	private $Price4;
	private $Picture;
	private $Prepare;
	private $IsDiscount;
	private $Enable;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdCategory=null, 
		$Name=null, 
		$ShortName=null, 
		$Unit=null, 
		$Price1=null, 
		$Price2=null, 
		$Price3=null, 
		$Price4=null, 
		$Picture=null,
		$Prepare=null,
		$IsDiscount=null,
		$Enable=null) 
	{
        $this->Id 			= $Id;
		$this->IdCategory 	= $IdCategory;
		$this->Name 		= $Name;
		$this->ShortName 	= $ShortName;
		$this->Unit 		= $Unit;
		$this->Price1 		= $Price1;
		$this->Price2 		= $Price2;
		$this->Price3 		= $Price3;
		$this->Price4 		= $Price4;
		$this->Picture 		= $Picture;
		$this->Prepare 		= $Prepare;
		$this->IsDiscount 	= $IsDiscount;		
		$this->Enable 		= $Enable;
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
	
	function setIdCategory( $IdCategory ) {$this->IdCategory = $IdCategory;$this->markDirty();}
	function getIdCategory( ) {return $this->IdCategory;}
	function getCategory( ){$mCategory = new \MVC\Mapper\Category();$Category = $mCategory->find($this->IdCategory);return $Category;}
	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	function getName( ) {return $this->Name;}
	
	function setShortName( $ShortName ) {$this->ShortName = $ShortName;$this->markDirty();}
	function getShortName( ) {return $this->ShortName;}
		
	function setUnit( $Unit) {$this->Unit = $Unit;$this->markDirty();}		
	function getUnit( ) {return $this->Unit;}
	
	function setPrice1( $Price1 ) {$this->Price1 = $Price1;$this->markDirty();}
	function getPrice1( ) {return $this->Price1;}
	function getPrice1Print( ) {$num = new Number($this->Price1);return $num->formatCurrency()." đ";}
	
	function setPrice2( $Price2 ) {$this->Price2 = $Price2;$this->markDirty();}
	function getPrice2( ) {return $this->Price2;}
	function getPrice2Print( ) {$num = new Number($this->Price2);return $num->formatCurrency();}
	
	function setPrice3( $Price3 ) {$this->Price3 = $Price3;$this->markDirty();}
	function getPrice3( ) {return $this->Price3;}
	function getPrice3Print( ) {$num = new Number($this->Price3);return $num->formatCurrency();}
	
	function setPrice4( $Price4 ) {$this->Price4 = $Price4;$this->markDirty();}
	function getPrice4( ) {return $this->Price4;}
	function getPrice4Print( ){$num = new Number($this->Price4);return $num->formatCurrency();}
	
	function setPicture( $Picture ) {$this->Picture = $Picture;$this->markDirty();}	
	function getPicture( ) {return $this->Picture;}
	
	function setPrepare( $Picture ) {$this->Prepare = $Prepare;$this->markDirty();}	
	function getPrepare( ) {return $this->Prepare;}
	
	function setIsDiscount( $IsDiscount ) {$this->IsDiscount = $IsDiscount;$this->markDirty();}	
	function getIsDiscount( ) {return $this->IsDiscount;}
	
	function setEnable( $Enable ) {$this->Enable = $Enable;$this->markDirty();}	
	function getEnable( ) {return $this->Enable;}
	
	public function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory'	=> $this->getIdCategory(),
		 	'Name'			=> $this->getName(),
		 	'ShortName'		=> $this->getShortName(),
		 	'Unit'			=> $this->getUnit(),
		 	'Price1'		=> $this->getPrice1(),
		 	'Price2'		=> $this->getPrice2(),
		 	'Price3'		=> $this->getPrice3(),
		 	'Price4'		=> $this->getPrice4(),
		 	'Picture'		=> $this->getPicture(),
			'Prepare'		=> $this->getPrepare(),
			'IsDiscount'	=> $this->getIsDiscount(),
			'Enable'		=> $this->getEnable()
		);
		return json_encode($json);
	}
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdCategory 	= $Data[1];
		$this->Name 		= $Data[2];
		$this->ShortName 	= $Data[3];
		$this->Unit 		= $Data[4];
		$this->Price1 		= $Data[5];
		$this->Price2 		= $Data[6];
		$this->Price3 		= $Data[7];
		$this->Price4 		= $Data[8];
		$this->Picture 		= $Data[9];
		$this->Prepare 		= $Data[10];
		$this->IsDiscount 	= $Data[11];
		$this->Enable 		= $Data[12];
    }
	
	function getURLRecipe(){return "/setting/category/".$this->getIdCategory()."/".$this->getId()."/recipe";}	
	function getRecipeAll(){
		$mR2C = new \MVC\Mapper\R2C();
		$R2CAll = $mR2C->findBy(array($this->getId()));
		return $R2CAll;
	}
	//----------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ){$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>