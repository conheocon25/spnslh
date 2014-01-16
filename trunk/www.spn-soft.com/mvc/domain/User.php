<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class User extends Object{

    private $Id;
	private $Email;
    private $Pass;
    private $Pass2;
	private $Gender;
	private $Note;
	private $DateCreate;
	private $DateUpdate;	
	private $DateActivity;
	private $Type;
	
	private $App;
	private $Apps;
	/*Hàm khởi tạo và thiết lập các thuộc tính*/
    function __construct( 
		$Id=null, 
		$Email=null, 
		$Pass=null, 
		$Pass2=null, 
		$Gender=null, 
		$Note=null, 		
		$DateCreate = null,	
		$DateUpdate = null,	
		$DateActivity = null,	
		$Type = null
	) {
        $this->Id = $Id;
		$this->Email = $Email;
		$this->Pass = $Pass;
		$this->Pass2 = $Pass2;
		$this->Gender = $Gender;
		$this->Note = $Note;		
		$this->DateCreate = $DateCreate;
		$this->DateUpdate = $DateUpdate;
		$this->DateActivity = $DateActivity;
		$this->Type = $Type;
        parent::__construct( $Id );
    }
    function getId( ) {
        return $this->Id;
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
	
	function setPass2( $Pass2 ) {
        $this->Pass2 = $Pass2;
        $this->markDirty();
    }
    function getPass2( ) {
        return $this->Pass2;
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
	
	function setApp( $App ){
        $this->App = $App;
        $this->markDirty();
    }
	
	function getApp($IdApp=null){		
		return $this->App;
	}
	
	function getApps(){
		if (!isset($this->Apps)){
			$mUserApp = new \MVC\Mapper\UserApp();
			$this->Apps = $mUserApp->findBy(array($this->Id));
		}
		return $this->Apps;
	}
		
	function getNotSigned(){		
		$mApp = new \MVC\Mapper\App();
		$Apps = $mApp->notSigned(array($this->Id));
		
		return $Apps;
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
		$Arr = array("", "Doanh nghiệp", "Đại lý", "", "Quản trị");
        return $Arr[$this->Type];
    }
	
	//Chứng thực quyền người dùng
	function authorize($Command){
		$mUser = new \MVC\Mapper\User();		
		$result = $mUser->authorize(array($Command, $Command, $this->Type));
		return $result;
	}
	
	//Lấy địa chỉ
		
	function getURLViewSystem(){		
		return "/quan_tri/".$this->Id;
	}
	
	function getURLViewVendor(){
		return "/dai_ly";
	}
	
	function getURLViewIndex(){
		$Prefix = $this->getApp()->getAlias();
		return $Prefix;
	}
	
	function getURLDefault(){
		$Prefix = $this->getApp()->getAlias();
		
		$Arr = array(
			"", 
			$Prefix."/ban_hang", 
			$this->getURLViewVendor(),
			"",
			$this->getURLViewSystem()
		);
        return $Arr[$this->Type];
	}
	
    static function findAll() {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->findAll();
    }
    static function find( $Id ) {
        $finder = self::getFinder( __CLASS__ ); 
        return $finder->find( $Id );
    }
}
?>