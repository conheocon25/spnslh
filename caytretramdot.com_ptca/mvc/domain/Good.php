<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Good extends Object{

    private $Id;
	private $IdGroup;
	private $Name;	
	private $Vat;	
	private $Note;
	private $Visible;
			
    function __construct( 
		$Id=null, 
		$IdGroup=null, 
		$Name=null, 		
		$Vat=null, 		
		$Note=null,
		$Visible=null		
	) {
        $this->Id 		= $Id;
		$this->IdGroup 	= $IdGroup;
		$this->Name 	= $Name;
		$this->Vat 		= $Vat;		
		$this->Note		= $Note;
		$this->Visible	= $Visible;			
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
		
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setVisible( $Visible ) {$this->Visible = $Visible; $this->markDirty();}
	function getVisible(){return $this->Visible;}
			
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdGroup' 		=> $this->getIdGroup(),
			'Name'			=> $this->getName(),
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
		$this->Vat			= $Data[3];
		$this->Note			= $Data[4];
		$this->Visible		= $Data[5];
    }
					
	//=================================================================================	
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>