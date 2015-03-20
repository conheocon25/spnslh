<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Employee extends Object{

    private $Id;
	private $IdDepartment;
	private $Name;
    private $Gender;	
	private $Tel;
	private $Email;
	private $Address;
	private $Avatar;
	private $Serial;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null, 
		$IdDepartment=null, 
		$Name=null, 
		$Gender=null, 
		$Tel=null, 
		$Email=null,
		$Address=null,
		$Avatar=null,
		$Serial=null
	){
        $this->Id 			= $Id;
		$this->IdDepartment = $IdDepartment;
		$this->Name 		= $Name;
		$this->Gender 		= $Gender;	
		$this->Tel 			= $Tel;
		$this->Email 		= $Email;
		$this->Address 		= $Address;		
		$this->Avatar 		= $Avatar;
		$this->Serial 		= $Serial;
		
        parent::__construct( $Id );
    }
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdDepartment	= $Data[1];
		$this->Name 		= $Data[2];
		$this->Gender 		= $Data[3];		
		$this->Tel 			= $Data[4];
		$this->Email		= $Data[5];
		$this->Address 		= $Data[6];
		$this->Avatar	 	= $Data[7];
		$this->Serial 		= $Data[8];
    }
	
    function getId( ) {return $this->Id;}
	
	function setIdDepartment( $IdDepartment ) {$this->IdDepartment = $IdDepartment;$this->markDirty();}
	function getIdDepartment(){return $this->IdDepartment;}
	function getDepartment(){
		$mDepartment 	= new \MVC\Mapper\Department();
		$Department 	= $mDepartment->find($this->IdDepartment);
		return $Department;
	}
	
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}
	function getName(){return $this->Name;}
	
    function setGender( $Gender) {$this->Gender = $Gender;$this->markDirty();}
    function getGender( ){return $this->Gender;}
	function getGenderPrint( ){if ($this->Gender==0) return "Nam"; return "Nữ";}
	
	function setEmail( $Email) {$this->Email = $Email;$this->markDirty();}
    function getEmail( ){return $this->Email;}
	
    function setTel( $Tel ) {$this->Tel = $Tel;$this->markDirty();}	
    function getTel( ) {return $this->Tel;}
		
	function setAddress( $Address ) {$this->Address = $Address;$this->markDirty();}
	function getAddress( ) {return $this->Address;}
	
	function setAvatar( $Avatar ) {$this->Avatar = $Avatar;$this->markDirty();}
	function getAvatar( ) {return $this->Avatar;}
			
	function setSerial( $Serial ) {$this->Serial = $Serial;$this->markDirty();}
	function getSerial( ) {return $this->Serial;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdDepartment'	=> $this->getIdDepartment(),
			'Name'			=> $this->getName(),
			'Gender'		=> $this->getGender(),
			'Email'			=> $this->getEmail(),
			'Tel'			=> $this->getTel(),
			'Address'		=> $this->getAddress(),
			'Avatar'		=> $this->getAvatar(),
			'Serial'		=> $this->getSerial()
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
	
}
?>