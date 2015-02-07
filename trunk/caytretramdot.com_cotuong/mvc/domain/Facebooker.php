<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class Facebooker extends Object{

    private $Id;
	private $Code;	
	private $Email;
	private $FirstName;
	private $LastName;
	private $Gender;
	private $Locale;
	private $TimeZone;
	private $CreatedDate;
	private $UpdatedDate;
					
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( 
		$Id				= null, 
		$Code			= null, 
		$Email			= null, 
		$FirstName		= null,
		$LastName		= null,				
		$Gender			= null, 
		$Locale			= null,
		$TimeZone		= null,
		$CreatedDate 	= null,	
		$UpdatedDate 	= null		
	) {
        $this->Id 			= $Id;
		$this->Code 		= $Code;
		$this->Email 		= $Email;
		$this->FirstName	= $FirstName;
		$this->LastName 	= $LastName;				
		$this->Gender 		= $Gender;		
		$this->Locale 		= $Locale;
		$this->TimeZone 	= $TimeZone;
		$this->CreatedDate 	= $CreatedDate;
		$this->UpdatedDate 	= $UpdatedDate;
				
        parent::__construct( $Id );
    }
    function getId( ) {return $this->Id;}
	
	function setCode( $Code ) {$this->Code = $Code;$this->markDirty();}
	function getCode(){return $this->Code;}
	
	function setEmail( $Email ) {$this->Email = $Email;$this->markDirty();}
	function getEmail(){return $this->Email;}
	
	function setFirstName( $FirstName ) {$this->FirstName = $FirstName;$this->markDirty();}
	function getFirstName(){return $this->FirstName;}
	
	function setLastName( $LastName ) {$this->LastName = $LastName;$this->markDirty();}
	function getLastName(){return $this->LastName;}
				
    function setGender( $Gender ) {$this->Gender = $Gender;$this->markDirty();}	
    function getGender( ) {return $this->Gender;}
	function getGenderPrint( ){
        return $this->Gender;
    }
	
	function setLocale( $Locale){$this->Locale = $Locale;$this->markDirty();}	
	function getLocale(){return $this->Locale;}
	
	function setTimeZone( $TimeZone){$this->TimeZone = $TimeZone;$this->markDirty();}	
	function getTimeZone(){return $this->TimeZone;}
						
	function setCreatedDate( $CreatedDate){$this->CreatedDate = $CreatedDate;$this->markDirty();}	
	function getCreatedDate(){return $this->CreatedDate;}
	
	function setUpdatedDate( $UpdatedDate){$this->UpdatedDate = $UpdatedDate;$this->markDirty();}	
	function getUpdatedDate(){return $this->UpdatedDate;}
					
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'Code'			=> $this->getName(),
			'Email'			=> $this->getEmail(),
			'FirstName'		=> $this->getFirstName(),
			'LastName'		=> $this->getLastName(),						
			'Gender'		=> $this->getGender(),
			'Locale'		=> $this->getLocale(),
			'TimeZone'		=> $this->getTimeZone(),
			'CreatedDate'	=> $this->getCreatedDate(),
			'UpdatedDate'	=> $this->getUpdatedDate()			
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 			= $Data[0];
		$this->Code 		= $Data[1];
		$this->Email 		= $Data[2];
		$this->FirstName 	= $Data[3];
		$this->LastName 	= $Data[4];
		$this->Gender 		= $Data[5];
		$this->Locale 		= $Data[6];
		$this->TimeZone 	= $Data[7];
		$this->CreatedDate 	= $Data[8];
		$this->UpdatedDate 	= $Data[9];
    }
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>