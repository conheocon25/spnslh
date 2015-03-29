<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class SaleCommand extends Object{

    private $Id;
	private $IdEmployee;
	private $IdBranch;
	private $DateTime;
	private $Note;
	private $State;
			
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
		$Id=null,
		$IdEmployee=null, 		
		$IdBranch=null,
		$DateTime=null,		
		$Note=null,
		$State=null
	){
        $this->Id 				= $Id;
		$this->IdEmployee 		= $IdEmployee;		
		$this->IdBranch 		= $IdBranch;
		$this->DateTime 		= $DateTime;		
		$this->Note 			= $Note;
		$this->State 			= $State;
								
        parent::__construct( $Id );
    }
			
    function getId( ) 		{return $this->Id;}
	function getIdPrint( ) 	{return "LB / ".$this->Id;}

	function setIdEmployee( $IdEmployee ) {$this->IdEmployee = $IdEmployee; $this->markDirty();}
	function getIdEmployee(){return $this->IdEmployee;}
	function getEmployee(){
		$mEmployee 	= new \MVC\Mapper\Employee();
		$Employee 	= $mEmployee->find($this->IdEmployee);
		return $Employee;
	}
				
	function setIdBranch( $IdBranch ) {$this->IdBranch = $IdBranch; $this->markDirty();}
	function getIdBranch(){return $this->IdBranch;}
	function getBranch(){
		$mBranch 	= new \MVC\Mapper\Branch();
		$Branch 	= $mBranch->find($this->IdBranch);
		return $Branch;
	}
	
	function setDateTime($DateTime ) {$this->DateTime = $DateTime; $this->markDirty();}
	function getDateTime(){return $this->DateTime;}
	function getDateTimePrint(){
		$t = strtotime($this->DateTime);		
		return date('d/m/Y H:i',$t);
	}
			
	function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	function getNote(){return $this->Note;}
	
	function setState( $State ){$this->State = $State; $this->markDirty();}
	function getState(){return $this->State;}
	function getStatePrint(){
		if ($this->State == 0){
			return "Soạn mới";
		}else if ($this->State == 1) {
			return "Chờ duyệt";
		}
		return "Duyệt xong";
	}
	
	function getDetailAll(){
		$mSaleCommandDetail = new \MVC\Mapper\SaleCommandDetail();
		$DetailAll  = $mSaleCommandDetail->findBy(array($this->getId()));
		return $DetailAll;
	}
	function getValue(){
		$DetailAll = $this->getDetailAll();
		$Sum = 0;
		while ($DetailAll->valid()){
			$Detail = $DetailAll->current();
			$Sum 	+= $Detail->getValue();
			$DetailAll->next();
		}
		return $Sum;
	}		
	function getValuePrint( ){
		$num = number_format($this->getValue(), 0, ',', ' ');
		return $num;
	}	
	function getValueStrPrint(){$num = new \MVC\Library\Number($this->getValue());return $num->readDigit()." đồng";}
	
	function getCount(){
		$DetailAll = $this->getDetailAll();
		$Count = 0;
		while ($DetailAll->valid()){
			$Detail = $DetailAll->current();
			$Count 	+= $Detail->getCount();
			$DetailAll->next();
		}
		return $Count;
	}
	function getCountPrint( ){
		$num = number_format($this->getCount(), 0, ',', ' ');
		return $num;
	}
	function getCountStrPrint( ){
		$num = new \MVC\Library\Number($this->getCount());
		return $num->readDigit();
	}
	
	function toJSON(){
		$json = array(
			'Id' 				=> $this->getId(),
			'IdEmployee'		=> $this->getIdEmployee(),			
			'IdBranch'			=> $this->getIdBranch(),
			'DateTime'			=> $this->getDateTime(),			
			'Note'				=> $this->getNote(),
			'State'				=> $this->getState()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
        $this->Id 				= $Data[0];
		$this->IdEmployee 		= $Data[1];		
		$this->IdBranch 		= $Data[2];
		$this->DateTime 		= $Data[3];		
		$this->Note 			= $Data[4];
		$this->State 			= $Data[5];
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------				
	function getURLLoad(){return "/don-vi/".$this->getBranch()->getKey()."/lenh-ban/".$this->getId();}
	function getURLMail(){return "/don-vi/".$this->getBranch()->getKey()."/lenh-ban/".$this->getId()."/trinh";}
	function getURLPrint(){return "/don-vi/".$this->getBranch()->getKey()."/lenh-ban/".$this->getId()."/in";}	
	
}
?>