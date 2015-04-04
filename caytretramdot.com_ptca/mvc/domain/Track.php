<?php
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Track extends Object{
    private $Id;
	private $DateStart;
	private $DateEnd;
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
    function __construct( 
			$Id=null,
			$DateStart=null, 
			$DateEnd=null			
	){
			$this->Id 					= $Id; 
			$this->DateStart 			= $DateStart; 
			$this->DateEnd 				= $DateEnd;						
									
			parent::__construct( $Id );
	}
    function setId($Id) {return $this->Id = $Id;}
	function getId() {return $this->Id;}
	function getName(){$Name = 'THÁNG '.\date("m/Y", strtotime($this->getDateStart()));return $Name;}
	
    function setDateStart( $DateStart ) {$this->DateStart = $DateStart;$this->markDirty();}   
	function getDateStart( ) {return $this->DateStart;}	
	function getDateStartPrint( ) {$D = new \MVC\Library\Date($this->DateStart);return $D->getDateFormat();}
	
	function setDateEnd( $DateEnd ) {$this->DateEnd= $DateEnd;$this->markDirty();}   
	function getDateEnd( ) {return $this->DateEnd;}	
	function getDateEndPrint( ) {$D = new \MVC\Library\Date($this->DateEnd);return $D->getDateFormat();}
					
	function toJSON(){
		$json = array(
			'Id' 					=> $this->getId(),			
			'DateStart'				=> $this->getDateStart(),
			'DateEnd'				=> $this->getDateEnd()	
		);
		return json_encode($json);
	}
	
	function setArray( $Data ){        
		$this->Id 					= $Data[0];
		$this->DateStart 			= $Data[1];
		$this->DateEnd 				= $Data[2];		
    }
	
	//-------------------------------------------------------------------------------
	//GET LISTs
	//-------------------------------------------------------------------------------	
	function getDetailAll(){
		$mTD 	= new \MVC\Mapper\TrackDaily();
		$TDAll 	= $mTD->findBy(array($this->getId()));
		return $TDAll;
	}
	
	function generateDailyBranch($Branch){
		$TDAll = $this->getDetailAll();
		$mTDB = new \MVC\Mapper\TrackDailyBranch();
		
		while ($TDAll->valid()){
			$TD = $TDAll->current();			
			
			$TDB = new \MVC\Domain\TrackDailyBranch(
				null,
				$TD->getIdTrack(),
				$Branch->getId(),
				$TD->getDate(),
				0,0,0
			);
			$mTDB->insert($TDB);
			
			$TDAll->next();
		}		
	}
	
	function generateDailyWarehouse($Warehouse){
		$TDAll = $this->getDetailAll();
		$mTDW = new \MVC\Mapper\TrackDailyWarehouse();
		
		while ($TDAll->valid()){
			$TD = $TDAll->current();			
			
			$TDW = new \MVC\Domain\TrackDailyWarehouse(
				null,
				$TD->getIdTrack(),
				$Warehouse->getId(),
				$TD->getDate(),
				0,0,0
			);
			$mTDW->insert($TDW);			
			
			//PS Good
			$TDW->generate();
			
			$TDAll->next();
		}		
	}
		
	function generateDaily(){
		$Date = $this->getDateStart();
		$EndDate = $this->getDateEnd();
		$mTD = new \MVC\Mapper\TrackDaily();
		
		while (strtotime($Date) <= strtotime($EndDate)){
			$TD = new \MVC\Domain\TrackDaily(
				null,
				$this->getId(), 
				$Date
			);
			$mTD->insert($TD);
			$Date = \date("Y-m-d", strtotime("+1 day", strtotime($Date)));
		}
	}
					
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
	function getURLSetting()					{return "/ql-thiet-lap/theo-doi/".$this->getId();}
										
	function getURLCustomer()					{return "/report/customer/".$this->getId();}
	function getURLCustomerDetail($IdCustomer)	{return "/report/customer/".$this->getId()."/".$IdCustomer;}

	function getURLSupplier()					{return "/report/supplier/".$this->getId();}
	function getURLSupplierDetail($IdSupplier)	{return "/report/supplier/".$this->getId()."/".$IdSupplier;}
				
	//--------------------------------------------------------------------------
    static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
    static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
}
?>