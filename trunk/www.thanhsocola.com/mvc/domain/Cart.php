<?php 
Namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );

class Cart extends Object{
	//-------------------------------------------------------------------------------
	//DEFINE PROPERTY
	//-------------------------------------------------------------------------------
	private $Id;
	public 	$Items = array();
	
	//-------------------------------------------------------------------------------
	//ACCESSING MEMBER PROPERTY
	//-------------------------------------------------------------------------------
	function __construct($Id=null, $Items=array()) {
		$this->Id 		= $Id;
		$this->Items 	= $Items;
		parent::__construct( $Id );
	}		
	function getId() {return $this->Id;}
	
	public function getItems(){return 	$this->Items;}
	public function isEmpty() {
		if (empty($this->Items)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function addItem($Id, $Info){
		if (isset($this->Items[$Id])) {
			//$Count = $this->Items[$Id]['Quantity'] + 1;
			$Count = 1;
			$this->updateItem($Id, $Count);
		} else {
			// Add the array of info:
			$this->Items[$Id] 				= $Info;
			$this->Items[$Id]['Quantity'] 	= 1;
			$this->Items[$Id]['Value'] 		= $this->Items[$Id]['Quantity']*$this->Items[$Id]['Price'];
			
			$N1 = new \MVC\Library\Number($this->Items[$Id]['Quantity']*$this->Items[$Id]['Price']);
			$this->Items[$Id]['ValueP'] 	= $N1->formatCurrency();
			$N2 = new \MVC\Library\Number($this->Items[$Id]['Price']);
			$this->Items[$Id]['PriceP'] 	= $N2->formatCurrency();
						
			$this->Items[$Id]['URLDel'] 	= "/gio-hang/" . $this->Items[$Id]['Id'] . "/xoa";
			$this->Items[$Id]['URLPlusUpd']	= "/gio-hang/" . $this->Items[$Id]['Id'] . "/cap-nhat/cong";
			$this->Items[$Id]['URLMinusUpd']= "/gio-hang/" . $this->Items[$Id]['Id'] . "/cap-nhat/tru";
		}
	}
	
	public function updateItem($Id, $Quantity){
		if ($Quantity == 0){
			$this->deleteItem($Id);
		}else{
			$this->Items[$Id]['Quantity'] 	= $this->Items[$Id]['Quantity'] + $Quantity;
			$this->Items[$Id]['Value'] 		= $this->Items[$Id]['Quantity']*$this->Items[$Id]['Price'];
			
			$N1 = new \MVC\Library\Number($this->Items[$Id]['Quantity']*$this->Items[$Id]['Price']);
			$this->Items[$Id]['ValueP'] 	= $N1->formatCurrency();
			$N2 = new \MVC\Library\Number($this->Items[$Id]['Price']);
			$this->Items[$Id]['PriceP'] 	= $N2->formatCurrency();
			
			$this->Items[$Id]['URLPlusUpd']	= "/gio-hang/" . $this->Items[$Id]['Id'] . "/cap-nhat/cong";
			$this->Items[$Id]['URLMinusUpd']= "/gio-hang/" . $this->Items[$Id]['Id'] . "/cap-nhat/tru";
		}
	}
	
	public function deleteItem($Id){
		if (isset($this->Items[$Id])){
			unset($this->Items[$Id]);
		}
	}
	
	public function countItem(){		
		$C = 0;
		foreach ($this->Items as $Item)
			$C = $C + $Item['Quantity'];
		return $C;
	}
	
	public function getValue(){
		$Value = 0;
		foreach ($this->Items as $Item)
			$Value += $Item['Quantity']*$Item['Price'];
		return $Value;
	}
	
	public function getValuePrint(){
		$N = new \MVC\Library\Number( $this->getValue() );
		return $N->formatCurrency();
	}
		
	//-------------------------------------------------------------------------------
	//GET LIST
	//-------------------------------------------------------------------------------		
		
	//-------------------------------------------------------------------------------
	//DEFINE URL
	//-------------------------------------------------------------------------------
		
	//-------------------------------------------------------------------------------
	static function findAll() {$finder = self::getFinder( __CLASS__ ); return $finder->findAll();}
	static function find( $Id ) {$finder = self::getFinder( __CLASS__ ); return $finder->find( $Id );}
	//-------------------------------------------------------------------------------
	
}
?>