<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Customer extends Object{

    private $Id;
	private $IdCategory;
	private $Name;
	private $Phone;
    private $Type;
    private $Card;
    private $Note;
    private $Address;
	private $Discount;
		
    function __construct( $Id=null, $IdCategory=null, $Name=null, $Type=null, $Card=null, $Phone=null, $Address=null, $Note=null, $Discount=null ) {
        $this->Id 		= $Id;
		$this->IdCategory 		= $IdCategory;
		$this->Name 	= $Name;
		$this->Type 	= $Type;
		$this->Card 	= $Card;
		$this->Phone 	= $Phone;
		$this->Address 	= $Address;
		$this->Note 	= $Note;
		$this->Discount = $Discount;
        parent::__construct( $Id );
    }
	function setId( $Id) {return $this->Id = $Id;}
    function getId( ) {return $this->Id;}
	
	function setIdCategory( $IdCategory) {return $this->IdCategory= $IdCategory;}
    function getIdCategory( ) {return $this->IdCategory;}
	function getCategory(){
		$mCategoryCustomer = new \MVC\Mapper\CategoryCustomer();
		$Category = $mCategoryCustomer->find($this->IdCategory);
		return $Category;
	}
	
	function getType(){return $this->Type;}	
    function setType( $Type ) {$this->Type = $type;$this->markDirty();}
	function getTypePrint(){
		$Arr = array("Hệ thống", "Nhà", "Thường");
		return $Arr[$this->Type];		
	}
	
	function getCard(){return $this->Card;}	
    function setCard( $Card ) {$this->Card = $Card;$this->markDirty();}
	
	function getNote(){return $this->Note;}	
    function setNote( $Note ) {$this->Note = $Note;$this->markDirty();}
	
	function getName(){return $this->Name;}	
    function setName( $Name ) {$this->Name = $Name;$this->markDirty();}

	function getPhone(){return $this->Phone;}
    function setPhone( $Phone ) {$this->Phone = $Phone;$this->markDirty();}
			
    function setAddress( $Address ) {$this->Address = $Address;$this->markDirty();}
	function getAddress(){return $this->Address;}
		
	function setDiscount( $Discount ) {$this->Discount = $Discount;$this->markDirty();}
	function getDiscount(){return $this->Discount;}
	
	function toJSON(){
		$json = array(
			'Id' 			=> $this->getId(),
			'IdCategory' 	=> $this->getIdCategory(),
			'Name'			=> $this->getName(),
			'Type'			=> $this->getType(),
			'Card'			=> $this->getCard(),
			'Phone'			=> $this->getPhone(),
			'Address'		=> $this->getAddress(),
			'Note'			=> $this->getNote(),
			'Discount'		=> $this->getDiscount()
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){
		$this->Id 			= $Data[0];
		$this->IdCategory	= $Data[1];
		$this->Name 		= $Data[2];
		$this->Type			= $Data[3];
		$this->Card			= $Data[4];
		$this->Phone		= $Data[5];
		$this->Address		= $Data[6];
		$this->Note			= $Data[7];
		$this->Discount		= $Data[8];
    }
			
	function getSessionAll(){
		$mSession = new	\MVC\Mapper\Session();
		$Sessions = $mSession->findByCustomer(array($this->Id));
		return $Sessions;
	}
	
	function getCollectAll(){
		$mCC = new \MVC\Mapper\CollectCustomer();
		$CollectAll = $mCC->findBy(array($this->getId()));
		return $CollectAll;
	}
	
	function getPaidAll(){
		$mPC 		= new \MVC\Mapper\PaidCustomer();
		$PaidAll 	= $mPC->findBy(array($this->getId()));
		return $PaidAll;
	}
	
	//Tính công nợ	
	function getValue($IdTrack, $IdTD){
		$mTracking 	= new \MVC\Mapper\Tracking();
		$mTC 		= new \MVC\Mapper\TrackingCustomer();
		$mTD 		= new \MVC\Mapper\TrackingDaily();
		$mCC 		= new \MVC\Mapper\CollectCustomer();
		$mPC 		= new \MVC\Mapper\PaidCustomer();			
		
		$Tracking 	= $mTracking->find($IdTrack);
		$TD 		= $mTD->find($IdTD);
			
		//TÍNH NỢ CŨ CỦA KHÁCH HÀNG
		$TCAll = $mTC->findByPre(array($IdTrack, $this->getId()));
		if ($TCAll->count()==0){
			$TC = new \MVC\Domain\TrackingCustomer(
				null,
				$IdTrack,
				$this->getId(),
				0,
				0
			);
		}else{
			$TC = $TCAll->current();
		}
					
		//CÁC GIAO DỊCH TRONG KÌ HIỆN TẠI
		$CollectAll = $mCC->findByTracking(array($this->getId(), $Tracking->getDateStart(), $TD->getDate()));
		$VC = 0;
		while ($CollectAll->valid()){
			$Collect = $CollectAll->current();
			$VC += $Collect->getValue();
			$CollectAll->next();
		}
				
		//CÁC TRẢ TIỀN TRONG KÌ HIỆN TẠI
		$PaidAll = $mPC->findByTracking(array($this->getId(), $Tracking->getDateStart(), $TD->getDate()));
		$VP = 0;
		while ($PaidAll->valid()){
			$Paid 	= $PaidAll->current();
			$VP 	+= $Paid->getValue();
			$PaidAll->next();
		}
				
		//TÍNH NỢ MỚI			
		$VO		= $TC->getValue();
		$VN		= $VO + $VP - $VC;
				
		//NẾU LÀ NGÀY CUỐI THÁNG THÌ TỔNG KẾT SỔ THÁNG
		if ($TD->getDate() == $Tracking->getDateEnd()){
			$TCAll = $mTC->findBy1(array($IdTrack, $this->getId()));
			if ($TCAll->count()==0){
				$TC = new \MVC\Domain\TrackingCustomer(
					null,
					$IdTrack,
					$IdCustomer,
					$VP,						
					$VC
				);
				$mTC->insert($TC);
			}else{
				$TC = $TCAll->current();
				$TC->setValuePaid($VP);					
				$TC->setValueCollect($VC);
				$mTC->update($TC);
			}
		}
		return $VN;
	}
	
	function getValuePrint($IdTrack, $IdTD){
		$NValue = new \MVC\Library\Number($this->getValue($IdTrack, $IdTD));
		return $NValue->formatCurrency();
	}
		
	//=================================================================================
	function getURLCollect()	{return "/money/collect/customer/".$this->getId();}
	function getURLPaid()		{return "/money/paid/customer/".$this->getId();}
	
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}	
	
}
?>