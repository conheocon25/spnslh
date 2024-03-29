<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class ProductInfo extends Object{

    private $Id;
	private $IdProduct;	
	private $Info;
	private $InfoEx01;
	private $InfoEx02;
	private $InfoEx03;
	private $InfoEx04;
	private $InfoEx05;
	private $InfoEx06;
	private $InfoEx07;
	private $InfoEx08;
	private $InfoEx09;
	private $InfoEx10;
	private $InfoEx11;
	private $InfoEx12;
	private $InfoEx13;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id			=null, 
		$IdProduct	=null,		
		$Info		=null,
		$InfoEx01	=null,
		$InfoEx02	=null,
		$InfoEx03	=null,
		$InfoEx04	=null,
		$InfoEx05	=null,
		$InfoEx06	=null,
		$InfoEx07	=null,
		$InfoEx08	=null,
		$InfoEx09	=null,
		$InfoEx10	=null,
		$InfoEx11	=null,
		$InfoEx12	=null,
		$InfoEx13	=null)
	{        		
		$this->Id				= $Id;
		$this->IdProduct		= $IdProduct;		
		$this->Info				= $Info;
		$this->InfoEx01			= $InfoEx01;
		$this->InfoEx02			= $InfoEx02;
		$this->InfoEx03			= $InfoEx03;
		$this->InfoEx04			= $InfoEx04;
		$this->InfoEx05			= $InfoEx05;
		$this->InfoEx06			= $InfoEx06;
		$this->InfoEx07			= $InfoEx07;
		$this->InfoEx08			= $InfoEx08;
		$this->InfoEx09			= $InfoEx09;
		$this->InfoEx10			= $InfoEx10;
		$this->InfoEx11			= $InfoEx11;
		$this->InfoEx12			= $InfoEx12;
		$this->InfoEx13			= $InfoEx13;
				
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
			
	function getIdProduct( ) {return $this->IdProduct;}
    function setIdProduct( $IdProduct ) {$this->IdProduct = $IdProduct;$this->markDirty();}
	function getProduct(){
		$mProduct 	= new \MVC\Mapper\Product();
		$Product 	= $mProduct->find( $this->getIdProduct() );
		return $Product;
	}
	
	function setImage( $Image ) 	{$this->Image = $Image;$this->markDirty();}
    function getImage( ){		
		return "/data/images/default1.jpg";		
	}
			
    function setInfo( $Info ) 		{$this->Info = $Info;$this->markDirty();}
    function getInfo( ) 			{return $this->Info;}
	function getInfoReduce()		{$S = new \MVC\Library\String($this->Info);return $S->reduceHTML(320);}
	
	function setInfoEx01( $InfoEx01){$this->InfoEx01 = $InfoEx01;$this->markDirty();}
    function getInfoEx01( ) 		{return $this->InfoEx01;}
	function getInfoEx01Print( )	{
		if ($this->InfoEx01==0) return "--";
		return $this->InfoEx01." m";
	}
	
	function setInfoEx02( $InfoEx02){$this->InfoEx02 = $InfoEx02; $this->markDirty();}
    function getInfoEx02( ) 		{return $this->InfoEx02;}
	function getInfoEx02Print( )	{
		if ($this->InfoEx02==0) return "--";
		return $this->InfoEx02." m";
	}
	
	function getInfoEx13()			{return $this->InfoEx13;}
	function setInfoEx13( $InfoEx13){$this->InfoEx13 = $InfoEx13; $this->markDirty();}
	function getInfoEx13Print()		{
		if ($this->InfoEx13==0) return "--";
		return $this->getInfoEx13()." m<sup>2</sup>";
	}
	
	function setInfoEx03( $InfoEx03){$this->InfoEx03 = $InfoEx03; $this->markDirty();}
    function getInfoEx03( ) 		{return $this->InfoEx03;}
	function getInfoEx03Print( ){
		$Arr = array("--", "Đông", "Tây", "Nam", "Bắc", "Đông Bắc", "Đông Nam", "Tây Bắc", "Tây Nam");
		return $Arr[$this->InfoEx03];
	}
	
	function setInfoEx04( $InfoEx04){$this->InfoEx04 = $InfoEx04; $this->markDirty();}
    function getInfoEx04( ) 		{return $this->InfoEx04;}
	function getInfoEx04Print( ){
		if ($this->InfoEx04==0)
			return "--";			
		return $this->getInfoEx04( )." m";
	}
	
	function setInfoEx05( $InfoEx05){$this->InfoEx05 = $InfoEx05; $this->markDirty();}
    function getInfoEx05( ) 		{return $this->InfoEx05;}
	function getInfoEx05Print( )	{return $this->InfoEx05==1?'có':'--';}
	
	function setInfoEx06( $InfoEx06){$this->InfoEx06 = $InfoEx06; $this->markDirty();}
    function getInfoEx06( ) 		{return $this->InfoEx06;}
	function getInfoEx06Print( )	{
		$Arr = array("--", "1 lầu", "2 lầu", "3 lầu", "4 lầu", "5 lầu", "6 lầu");
		return $Arr[$this->InfoEx06];
	}
	
	function setInfoEx07( $InfoEx07){$this->InfoEx07 = $InfoEx07; $this->markDirty();}
    function getInfoEx07( ) 		{return $this->InfoEx07;}
	function getInfoEx07Print( ){		
		$Arr = array("--", "1 phòng", "2 phòng", "3 phòng", "4 phòng", "5 phòng", "6 phòng");
		return $Arr[$this->InfoEx07];		
	}
	
	function setInfoEx08( $InfoEx08){$this->InfoEx08 = $InfoEx08; $this->markDirty();}
    function getInfoEx08( ) 		{return $this->InfoEx08;}
	function getInfoEx08Print( )	{return $this->InfoEx08==1?'có':'--';}
	
	function setInfoEx09( $InfoEx09){$this->InfoEx09 = $InfoEx09; $this->markDirty();}
    function getInfoEx09( ) 		{return $this->InfoEx09;}
	function getInfoEx09Print( )	{return $this->InfoEx09==1?'có':'--';}
	
	function setInfoEx10( $InfoEx10){$this->InfoEx10 = $InfoEx10; $this->markDirty();}
    function getInfoEx10( ) 		{return $this->InfoEx10;}
	function getInfoEx10Print( )	{return $this->InfoEx10==1?'có':'--';}
	
	function setInfoEx11( $InfoEx11){$this->InfoEx11 = $InfoEx11; $this->markDirty();}
    function getInfoEx11( ) 		{return $this->InfoEx11;}
	function getInfoEx11Print( )	{return $this->InfoEx11==1?'có':'--';}
	
	function setInfoEx12( $InfoEx12){$this->InfoEx12 = $InfoEx12; $this->markDirty();}
    function getInfoEx12( ) 		{return $this->InfoEx12;}
	function getInfoEx12Print( )	{return $this->InfoEx12==1?'có':'--';}
		
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),	
			'IdProduct'			=> $this->getIdProduct(),						
			'Info'				=> $this->getInfo(),
			'InfoEx01'			=> $this->getInfoEx01(),
			'InfoEx02'			=> $this->getInfoEx02(),
			'InfoEx03'			=> $this->getInfoEx03(),
			'InfoEx04'			=> $this->getInfoEx04(),
			'InfoEx05'			=> $this->getInfoEx05(),
			'InfoEx06'			=> $this->getInfoEx06(),
			'InfoEx07'			=> $this->getInfoEx07(),
			'InfoEx08'			=> $this->getInfoEx08(),
			'InfoEx09'			=> $this->getInfoEx09(),
			'InfoEx10'			=> $this->getInfoEx10(),			
			'InfoEx11'			=> $this->getInfoEx11(),
			'InfoEx12'			=> $this->getInfoEx12(),
			'InfoEx13'			=> $this->getInfoEx13()
		);		
		return json_encode($json);
	}
	
	function setArray( $Data ){        	
		$this->Id				= $Data[0];
		$this->IdProduct		= $Data[1];				
		$this->Info				= $Data[2];
		$this->InfoEx01			= $Data[3];
		$this->InfoEx02			= $Data[4];
		$this->InfoEx03			= $Data[5];
		$this->InfoEx04			= $Data[6];
		$this->InfoEx05			= $Data[7];
		$this->InfoEx06			= $Data[8];
		$this->InfoEx07			= $Data[9];
		$this->InfoEx08			= $Data[10];
		$this->InfoEx09			= $Data[11];
		$this->InfoEx10			= $Data[12];
		$this->InfoEx11			= $Data[13];
		$this->InfoEx12			= $Data[14];
		$this->InfoEx13			= $Data[15];
    }
	
	function getURLSettingExe(){
		return "/admin/setting/supplier/".$this->getProduct()->getIdSupplier()."/".$this->getIdProduct()."/info/exe";
	}
	
	//-------------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>