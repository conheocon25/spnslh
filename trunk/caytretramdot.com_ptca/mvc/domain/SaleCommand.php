<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class SaleCommand extends Object{

    private $Id;
	private $IdEmployee;
	private $IdCustomer;
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
		$IdCustomer=null,				
		$IdBranch=null,
		$DateTime=null,		
		$Note=null,
		$State=null
	){
        $this->Id 				= $Id;
		$this->IdEmployee 		= $IdEmployee;
		$this->IdCustomer 		= $IdCustomer;		
		$this->IdBranch 		= $IdBranch;
		$this->DateTime 		= $DateTime;		
		$this->Note 			= $Note;
		$this->State 			= $State;
								
        parent::__construct( $Id );
    }
			
    function getId( ) 		{return $this->Id;}
	function getIdPrint( ) 	{return "XK / ".$this->Id;}

	function setIdEmployee( $IdEmployee ) {$this->IdEmployee = $IdEmployee; $this->markDirty();}
	function getIdEmployee(){return $this->IdEmployee;}
	function getEmployee(){
		$mEmployee 	= new \MVC\Mapper\Employee();
		$Employee 	= $mEmployee->find($this->IdEmployee);
		return $Employee;
	}
	
	function setIdCustomer( $IdCustomer ) {$this->IdCustomer = $IdCustomer; $this->markDirty();}
	function getIdCustomer(){return $this->IdCustomer;}
	function getCustomer(){
		$mCustomer 	= new \MVC\Mapper\Customer();
		$Customer 	= $mCustomer->find($this->IdCustomer);
		return $Customer;
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
			'IdCustomer'		=> $this->getIdCustomer(),			
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
		$this->IdCustomer 		= $Data[2];		
		$this->IdBranch 		= $Data[3];
		$this->DateTime 		= $Data[4];		
		$this->Note 			= $Data[5];
		$this->State 			= $Data[6];
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------
					
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $id );}
	
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------				
	function getURLLoad(){return "/ql-ban-hang/lenh-ban/khach-hang/".$this->getIdCustomer()."/".$this->getId();}
	function getURLPrint(){return "/ql-ban-hang/lenh-ban/khach-hang/".$this->getIdCustomer()."/".$this->getId()."/print";}
		
}
?>