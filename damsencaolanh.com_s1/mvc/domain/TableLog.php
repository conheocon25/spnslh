<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class TableLog extends Object{

    private $Id;
	private $IdUser;
	private $IdTable;
	private $DateTime;
	private $Note;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------		
    function __construct( $Id=null, $IdUser=null, $IdTable=null, $DateTime=null, $Note=null){
        $this->Id = $Id;
		$this->IdUser = $IdUser;
		$this->IdTable = $IdTable;
		$this->DateTime = $DateTime;
		$this->Note = $Note;
        parent::__construct( $Id );
    }
	
    function getId( ) {return $this->Id;}
	
	function getIdUser( ) {return $this->IdUser;}	
	function setIdUser( $IdUser ) {$this->IdUser = $IdUser;$this->markDirty();}
	function getUser(){
		$mUser = new \MVC\Mapper\User();
		$User = $mUser->find($this->IdUser);
		return $User;
	}
	
	function getIdTable( ) {return $this->IdTable;}	
	function setIdTable( $IdTable ) {$this->IdTable = $IdTable;$this->markDirty();}

	function getDateTime( ) {return $this->DateTime;}
	function setDateTime( $DateTime ) {$this->DateTime = $DateTime;$this->markDirty();}
	function getDateTimePrint( ){return date('d/m/y H:i',strtotime($this->DateTime));}

	function getNote( ) {return $this->Note;}	
    function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
					
	function getTable(){
		$mTable = new \MVC\Mapper\Table();
		$Table = $mTable->find($this->IdTable);
		return $Table;
	}
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------	
		
	//-------------------------------------------------------------------------------
	//DEFINE SETTING URL
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	//DEFINE SELLING URL
	//-------------------------------------------------------------------------------	
	
	//---------------------------------------------------------	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>