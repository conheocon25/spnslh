<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Good extends Object{

    private $Id;
	private $IdGroup;
	private $Name;	
	private $PriceImport;
	private $PriceSale;
	private $Unit;
	private $Vat;
	private $Note;
	private $Visible;
			
    function __construct( 
		$Id=null, 
		$IdGroup=null, 
		$Name=null,
		$PriceImport=null,
		$PriceSale=null,
		$Unit=null,
		$Vat=null, 
		$Note=null,
		$Visible=null		
	) {
        $this->Id 			= $Id;
		$this->IdGroup 		= $IdGroup;
		$this->Name 		= $Name;
		$this->PriceImport 	= $PriceImport;
		$this->PriceSale 	= $PriceSale;
		$this->Unit 		= $Unit;
		$this->Vat 			= $Vat;
		$this->Note			= $Note;
		$this->Visible		= $Visible;
        parent::__construct( $Id );
    }
	function setId( $Id){return $this->Id = $Id;}
    function getId( ) 	{return $this->Id;}
	
	function setIdGroup( $IdGroup) {return $this->IdGroup= $IdGroup;}
    function getIdGroup( ) {return $this->IdGroup;}
	function getGroup(){
		$mGoodGroup = new \MVC\Mapper\GoodGroup();
		$Group = $mGoodGroup->find($this->IdGroup);
		return $Group;
	}
			
	function getVat(){return $this->Vat;}	
    function setVat( $Vat ) {$this->Vat = $Vat; $this->markDirty();}
	
	function getName(){return $this->Name;}	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	
	function setPriceImport( $PriceImport ) {$this->PriceImport = $PriceImport;$this->markDirty();}
	function getPriceImport(){return $this->PriceImport;}
	function getPriceImportPrint(){
		$num = number_format($this->PriceImport, 0, ',', ' ');
		return $num;		
	}
	
	function setPriceSale( $PriceSale ) {$this->PriceSale = $PriceSale; $this->markDirty();}
	function getPriceSale(){return $this->PriceSale;}
	function getPriceSalePrint(){
		$num = number_format($this->PriceSale, 0, ',', ' ');
		return $num;		
	}
	
	function setUnit( $Unit ) {$this->Unit = $Unit;$this->markDirty();}
	function getUnit(){return $this->Unit;}
	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setVisible( $Visible ) {$this->Visible = $Visible; $this->markDirty();}
	function getVisible(){return $this->Visible;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdGroup' 		=> $this->getIdGroup(),
			'Name'			=> $this->getName(),
			'PriceImport'	=> $this->getPriceImport(),
			'PriceSale'		=> $this->getPriceSale(),
			'Unit'			=> $this->getUnit(),
			'Vat'			=> $this->getVat(),
			'Note'			=> $this->getNote(),
			'Visible'		=> $this->getVisible()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id 			= $Data[0];
		$this->IdGroup		= $Data[1];
		$this->Name 		= $Data[2];
		$this->PriceImport	= $Data[3];
		$this->PriceSale	= $Data[4];
		$this->Unit			= $Data[5];
		$this->Vat			= $Data[6];
		$this->Note			= $Data[7];
		$this->Visible		= $Data[8];
    }
					
	//=================================================================================	
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>