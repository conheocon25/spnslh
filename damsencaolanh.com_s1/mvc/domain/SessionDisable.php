<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class SessionDisable extends Object{

    private $Id;	
	private $IdSession;	
	private $Note;
		
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( $Id=null, $IdSession=null, $Note=null ) {
        $this->Id 			= $Id;
		$this->IdSession 	= $IdSession;		
		$this->Note 		= $Note;
		
        parent::__construct( $Id );
    }
	
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdSession'			=> $this->getIdSession(),
			'Note'				=> $this->getNote()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdSession 		= $Data[1];		
		$this->Note 			= $Data[2];
    }
		
	function setId( $Id) {return $this->Id = $Id;}
    function getId( ){return $this->Id;}
				
	function getIdSession( ) {return $this->IdSession;}	
	function setIdSession( $IdSession ) {$this->IdSession = $IdSession; $this->markDirty();}
	function getSession(){		
		$mSession = new \MVC\Mapper\Session();
		$Session = $mSession->find($this->IdSession);
		return $Session;
	}
			
	//Ghi chú
	function getNote( ) {return $this->Note;}	
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
			
	//---------------------------------------------------------	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}	
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>
