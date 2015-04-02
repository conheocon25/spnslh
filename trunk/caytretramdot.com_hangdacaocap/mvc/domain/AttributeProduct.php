<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class AttributeProduct extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	private $Material;
	private $Name;
	private $Size;
	private $Color;
	private $Guarantee;
	private $Note;

	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Name=null, $Material=null, $Size=null, $Color=null, $Guarantee=null, $Note=null) {
		$this->Id 				= $Id;
		$this->Material			= $Material;
		$this->Name 			= $Name;
		$this->Size 			= $Size;
		$this->Color 			= $Color;
		$this->Guarantee 		= $Guarantee;
		$this->Note 			= $Note;		
		parent::__construct( $Id );
	}
		
	function getId() {return $this->Id;}
	
	function setMaterial($Material) {$this->Material = $Material;$this->markDirty();}
	function getMaterial() 				{return $this->Material;}
	
	function setName($Name) {$this->Name = $Name;$this->markDirty();}
	function getName() 		{return $this->Name;}
	
	function setSize($Size){$this->Size = $Size;$this->markDirty();}
	function getSize() 	{return $this->Size;}
	
	function setColor($Color){$this->Color = $Color;$this->markDirty();}
	function getColor() 	{return $this->Color;}
	
	function setGuarantee($Guarantee){$this->Guarantee = $Guarantee;$this->markDirty();}
	function getGuarantee() 	{return $this->Guarantee;}
	function getGuaranteePrint() 	{return ($this->Guarantee . " tháng");}
	
	function setNote($Note){$this->Note = $Note;$this->markDirty();}
	function getNote() 	{return $this->Note;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),			
			'Name'			=> $this->getName(),
			'Material'		=> $this->getMaterial(),
			'Size'			=> $this->getSize(),	
			'Color'			=> $this->getColor(),	
			'Guarantee'		=> $this->getGuarantee(),	
			'Note'			=> $this->getNote()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Name 		= $Data[1];		
		$this->Material 	= $Data[2];				
		$this->Size			= $Data[3];
		$this->Color		= $Data[4];
		$this->Guarantee	= $Data[5];
		$this->Note			= $Data[6];
    }
	
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>