<?php
namespace MVC\Domain;
require_once( "mvc/base/domain/DomainObject.php" );
class PackCart extends Object{
    
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
	
	public function getItems(){return $this->Items;}
	
	public function isEmpty() {
		if (empty($this->Items)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function addItem($Id, $IdProduct, $Price, $UrlImage){
		if (isset($this->Items[$Id])) {
			//$Count = $this->Items[$Id]['Quantity'] + 1;
			$Count = 1;
			$this->updateItem($Id, $IdProduct, $Price, $UrlImage, $Count);
		} else {
			// Add the array of info:
			$this->$Id	= $Id;
			$this->Items[$Id]['IdProduct']	= $IdProduct;
			$this->Items[$Id]['Price']	= $Price;
			$this->Items[$Id]['UrlImage']	= $UrlImage;
			$this->Items[$Id]['Quantity'] 	= 1;
			$this->Items[$Id]['Value'] 		= $this->Items[$Id]['Quantity']*$this->Items[$Id]['Price'];
			
			$N1 = new \MVC\Library\Number($this->Items[$Id]['Quantity']*$this->Items[$Id]['Price']);
			$this->Items[$Id]['ValueP'] 	= $N1->formatCurrency();
			$N2 = new \MVC\Library\Number($this->Items[$Id]['Price']);
			$this->Items[$Id]['PriceP'] 	= $N2->formatCurrency();
						
			$this->Items[$Id]['URLDel'] 	= "/gio-hang/" . $this->$Id . "/del";
			$this->Items[$Id]['URLPlusUpd']	= "/gio-hang/" . $this->$Id . "/add";
			$this->Items[$Id]['URLMinusUpd']= "/gio-hang/" . $this->$Id . "/sub";
		}
	}
	
	public function updateItem($Id, $IdProduct, $Price, $Quantity){
		if ($Quantity == 0){
			$this->deleteItem($Id);
		}else{
			$this->Items[$Id]['IdProduct']	= $IdProduct;
			$this->Items[$Id]['UrlImage']	= $UrlImage;
			$this->Items[$Id]['Price']	= $Price;
			$this->Items[$Id]['Quantity'] 	= $this->Items[$Id]['Quantity'] + $Quantity;
			$this->Items[$Id]['Value'] 		= $this->Items[$Id]['Quantity']*$this->Items[$Id]['Price'];
			
			$N1 = new \MVC\Library\Number($this->Items[$Id]['Quantity']*$this->Items[$Id]['Price']);
			$this->Items[$Id]['ValueP'] 	= $N1->formatCurrency();
			$N2 = new \MVC\Library\Number($this->Items[$Id]['Price']);
			$this->Items[$Id]['PriceP'] 	= $N2->formatCurrency();
			
			$this->Items[$Id]['URLPlusUpd']	= "/gio-hang/" . $this->$Id . "/add";
			$this->Items[$Id]['URLMinusUpd']= "/gio-hang/" . $this->$Id . "/sub";
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
}
?>
