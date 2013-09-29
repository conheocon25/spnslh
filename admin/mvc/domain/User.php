<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class User extends Object{

    private $Id;
	private $Name;
	private $Email;
    private $Pass;    
	private $Gender;
	private $Note;
	private $DateCreate;
	private $DateUpdate;	
	private $DateActivity;
	private $Type;
	private $Code;
		
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( 
		$Id=null, 
		$Name=null,
		$Email=null, 
		$Pass=null, 		
		$Gender=null, 
		$Note=null, 		
		$DateCreate = null,	
		$DateUpdate = null,	
		$DateActivity = null,	
		$Type = null,
		$Code = null
	) {
        $this->Id = $Id;
		$this->Name = $Name;
		$this->Email = $Email;
		$this->Pass = $Pass;		
		$this->Gender = $Gender;
		$this->Note = $Note;		
		$this->DateCreate = $DateCreate;
		$this->DateUpdate = $DateUpdate;
		$this->DateActivity = $DateActivity;
		$this->Type = $Type;
		$this->Code = $Code;
		
        parent::__construct( $Id );
    }
    function getId( ) {
        return $this->Id;
    }
	
	function setName( $Name ) {
        $this->Name= $Name;
        $this->markDirty();
    }
	function getName(){
		return $this->Name;
	}
	function getNameReduce(){
		$arr = \explode(" ", $this->Name);
		$temp = "";
		foreach ($arr as $a){
			$temp = $temp.\substr($a,0,1);
		}
		return $temp;
	}
	
	function setEmail( $Email ) {
        $this->Email = $Email;
        $this->markDirty();
    }
	function getEmail(){
		return $this->Email;
	}
	
    function setPass( $Pass ) {
        $this->Pass = $Pass;
        $this->markDirty();
    }
    function getPass( ) {
        return $this->Pass;
    }
			
    function setGender( $Gender ) {
        $this->Gender = $Gender;
        $this->markDirty();
    }	
    function getGender( ) {
        return $this->Gender;
    }
	function getGenderPrint( ){
        if($this->Gender == 0) {
			return "Nữ";
		} else {
		return "Nam";
		}
    }
	
	function setNote( $Note ) {
        $this->Note = $Note;
        $this->markDirty();
    }
	
	function getNote( ) {
        return $this->Note;
    }
				
	function setDateCreate( $DateCreate){
        $this->DateCreate = $DateCreate;
        $this->markDirty();
    }
	
	function getDateCreate(){
        return $this->DateCreate;
    }
	
	function setDateUpdate( $DateUpdate){
        $this->DateUpdate = $DateUpdate;
        $this->markDirty();
    }
	
	function getDateUpdate(){
        return $this->DateUpdate;
    }
	
	function setDateActivity( $DateActivity){
        $this->DateActivity = $DateActivity;
        $this->markDirty();
    }
	
	function getDateActivity(){
        return $this->DateActivity;
    }
	
	function setType( $Type){
        $this->Type = $Type;
        $this->markDirty();
    }
	function getType(){
        return $this->Type;
    }
	
	function getTypePrint(){
		$Arr = array("", "Bán hàng", "Quản lý", "Quan sát", "Quản trị");
        return $Arr[$this->Type];
    }
	
	function isAdmin(){
		if ($this->getType()==4)
			return true;
		return false;
	}
	
	function isViewer(){
		if ($this->getType()==3)
			return true;
		return false;
	}
	
	function isManager(){
		if ($this->getType()==2)
			return true;
		return false;
	}
	
	function isSeller(){
		if ($this->getType()==1)
			return true;
		return false;
	}
	
	function setCode( $Code){
        $this->Code= $Code;
        $this->markDirty();
    }
	function getCode(){
        return $this->Code;
    }
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){		
		return "/setting/user/".$this->getId()."/upd/load";
	}
	function getURLUpdExe(){
		return "/setting/user/".$this->getId()."/upd/exe";
	}
	
	function getURLDelLoad(){		
		return "/setting/user/".$this->getId()."/del/load";
	}
	function getURLDelExe(){
		return "/setting/user/".$this->getId()."/del/exe";
	}	
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>