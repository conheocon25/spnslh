<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Branch extends Object{

    private $Id;
	private $Name;
	private $Tel;
	private $Fax;
	private $Address;
	private $Visible;
				
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$Name=null, 
		$Tel=null,
		$Fax=null,
		$Address=null,
		$Visible=null
	){
        $this->Id 		= $Id;
		$this->Name 	= $Name;
		$this->Tel 		= $Tel;
		$this->Fax 		= $Fax;
		$this->Address	= $Address;
		$this->Visible	= $Visible;		
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 		= $Data[0];
		$this->Name 	= $Data[1];
		$this->Tel	 	= $Data[2];
		$this->Fax	 	= $Data[3];
		$this->Address 	= $Data[4];
		$this->Visible 	= $Data[5];
    }
	
    function getId( ) {return $this->Id;}
			
	function setName( $Name ) 	{$this->Name = $Name;$this->markDirty();}
	function getName()			{return $this->Name;}
	
	function setTel( $Tel ) 	{$this->Tel = $Tel;$this->markDirty();}
	function getTel()			{return $this->Tel;}
	
	function setFax( $Fax ) 	{$this->Fax = $Fax;$this->markDirty();}
	function getFax()			{return $this->Fax;}
	
	function setAddress( $Address ) {$this->Address = $Address; $this->markDirty();}
	function getAddress()			{return $this->Address;}
	
	function setVisible( $Visible ) {$this->Visible = $Visible; $this->markDirty();}
	function getVisible()			{return $this->Visible;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Name'			=> $this->getName(),
			'Tel'			=> $this->getTel(),
			'Fax'			=> $this->getFax(),
			'Address'		=> $this->getAddress(),
			'Visible'		=> $this->getVisible()
		);
		return json_encode($json);
	}
		
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------			
	function getURLSettingEmployee(){return "/admin/setting/branch/".$this->getId();}
	
}
?>