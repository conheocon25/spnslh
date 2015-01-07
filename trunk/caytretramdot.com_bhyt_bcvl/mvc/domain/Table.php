<?php
namespace MVC\Domain;
use MVC\Library\Number;

require_once( "mvc/base/domain/DomainObject.php" );
class Table extends Object{

    private $Id;
	private $IdDomain;
	private $Name;
	private $IdUser;
	private $Type;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------		
    function __construct( $Id=null, $IdDomain=null, $Name=null, $IdUser=null, $Type=null ) {
        $this->Id = $Id;
		$this->IdDomain = $IdDomain;
		$this->Name = $Name;
		$this->IdUser = $IdUser;
		$this->Type = $Type;
        parent::__construct( $Id );
    }
	
    function getId( ) {return $this->Id;}
	function getIdPrint( ) {return "t".$this->Id;}
		
	function getIdDomain( ) {return $this->IdDomain;}	
	function setIdDomain( $IdDomain ) {$this->IdDomain = $IdDomain;$this->markDirty();}

	function getName( ) {return $this->Name;}
	function setName( $Name ) {$this->Name = $Name;$this->markDirty();}

	function getIdUser( ) {return $this->IdUser;}	
    function setIdUser( $IdUser ) {$this->IdUser = $IdUser;$this->markDirty();}
	
	function getUser( ){$mUser = new \MVC\Mapper\User();$User = $mUser->find($this->IdUser);return $User;}

	//True: có khách, false: không có khách
    function getState() {
		$mSession = new	\MVC\Mapper\Session();
		$Session = $mSession->findLast(array($this->getId()));
		if (!isset($Session)){
			return false;
		}
		$count = $Session->getDetails()->count();
		if ($count==0)
			return false;
		return true;
    }
			
	function getType( ) {return $this->Type;}	
	function getTypePrint() {
		if ($this->Type==1)
			return "VIP";
        return "Thường";
    }
	
	function setType( $Type ){$this->Type = $Type; $this->markDirty();}			
	function getDomain(){
		$mDomain = new \MVC\Mapper\Domain();
		$Domain = $mDomain->find($this->IdDomain);
		return $Domain;
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------				
	function getStudentAll(){
		$mStudent = new \MVC\Mapper\Student();
		$StudentAll = $mStudent->findByTable(array($this->getId()));		
		return $StudentAll;
	}
		
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdDomain'		=> $this->getIdDomain(),
			'Name'			=> $this->getName(),
			'IdUser'		=> $this->getIdUser(),			
			'Type'			=> $this->getType()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->IdDomain 	= $Data[1];
		$this->Name 		= $Data[2];
		$this->IdUser 		= $Data[3];
		$this->Type 		= $Data[4];
    }
			
	//-------------------------------------------------------------------------------
	//DEFINE SELLING URL
	//-------------------------------------------------------------------------------	
	function getURLSetting()	{ return "/setting/domain/".$this->getIdDomain()."/".$this->getId();}
	function getURLChecking()	{ return "/checking/".$this->getIdDomain()."/".$this->getId();}
	function getURLCheckingInit()	{ return "/checking/".$this->getIdDomain()."/".$this->getId()."/init";}	

	//---------------------------------------------------------	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>