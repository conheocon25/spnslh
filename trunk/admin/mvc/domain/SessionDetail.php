<?php
Namespace MVC\Domain;
use MVC\Library\Number;
require_once( "mvc/base/domain/DomainObject.php" );

class SessionDetail extends Object{

    private $Id;	
	private $IdSession;
	private $IdCourse;
	private $Count;	
	private $Price;
	
	private $Course;
	private $Session;

    function __construct( $Id=null, $IdSession=null, $IdCourse=null, $Count=null, $Price=null) {
        $this->Id = $Id;
		$this->IdSession = $IdSession;
		$this->IdCourse = $IdCourse;
		$this->Count = $Count;		
		$this->Price = $Price;
        parent::__construct( $Id );
    }
	function setId( $Id) {$this->Id = $Id;}
    function getId( ) {return $this->Id;}
	function getIdPrint( ) {
        return "SessionDetail".$this->Id;
    }
				
	function setIdSession( $IdSession ) {$this->IdSession = $IdSession;$this->markDirty();}
	function getIdSession( ) {return $this->IdSession;}	
	function getSession( ) {
		if (!isset($this->Session)){
			$mSession = new \MVC\Mapper\Session();
			$this->Session = $mSession->find($this->IdSession);
		}
        return $this->Session;
    }
	
	function setIdCourse( $IdCourse ) {$this->IdCourse = $IdCourse;$this->markDirty();}
	function getIdCourse( ) {return $this->IdCourse;}		
	function getCourse( ) {	$mCourse = new \MVC\Mapper\Course(); $Course = $mCourse->find($this->IdCourse); return $Course;}
	
    function setCount( $Count ) {$this->Count = $Count;$this->markDirty();}   
	function getCount( ) {return $this->Count;}
	function getCountPrint( ) {$num = new Number($this->Count);return $num->formatCurrency();}
			
	function setPrice( $Price) {$this->Price = $Price;}
	function getPrice( ) {return $this->Price;}
	function getPricePrint( ) {$num = new Number($this->Price);return $num->formatCurrency();}
	
	function getValue( ) {return $this->Price*$this->Count;}
	function getValuePrint( ) {$num = new Number($this->getValue());return $num->formatCurrency()." đ";}
	
	function getValueBase( ){
		return $this->getValue()* ( 1.0 - (float)($this->getCourse()->getRate())/100.0);		
	}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLUpdLoad(){	
		$Session = $this->getSession();
		$Table = $Session->getTable();
		$Domain = $Table->getDomain();		
		return "/selling/".$Domain->getId()."/".$Table->getId()."/detail/".$this->getId()."/upd/load";
    }
	function getURLUpdExe(){		
		$Session = $this->getSession();
		$Table = $Session->getTable();
		$Domain = $Table->getDomain();		
		return "/selling/".$Domain->getId()."/".$Table->getId()."/detail/".$this->getId()."/upd/exe";
    }
	
	function getURLDelLoad(){			
		$Session = $this->getSession();
		$Table = $Session->getTable();
		$Domain = $Table->getDomain();
		return "/selling/".$Domain->getId()."/".$Table->getId()."/detail/".$this->getId()."/del/load";
    }
	function getURLDelExe(){		
		$Session = $this->getSession();
		$Table = $Session->getTable();
		$Domain = $Table->getDomain();
		return "/selling/".$Domain->getId()."/".$Table->getId()."/detail/".$this->getId()."/del/exe";
    }
		
	//---------------------------------------------------------------------------------	
	//CÁC HÀM XỬ LÍ DANH SÁCH
	//---------------------------------------------------------------------------------			
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	
}
?>
