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
		
	public function SumPackCart() {
		$nSum = 0;
		$N1 = 0;
		if ($this->isEmpty() == false) {
			foreach ($this->Items as $Item) {				
				$nSum = $nSum + ($Item['Price']*$Item['Count']);																											
			}			
			return $nSum;
		} 
		else { return $nSum;}
	}
	
	public function SumPackCartPrint() {
		$N = new \MVC\Library\Number($this->SumPackCart());
		return $N->formatCurrency() . " đồng";
	}
	
	public function addItem($NameProduct, $IdProduct, $Price, $UrlImage, $Count){
		$flag = false;
		if ($this->isEmpty() == false) {
			foreach ($this->Items as $Item) {					
				if ($Item['IdProduct'] == $IdProduct) {					
					$this->plus($Item['Id']);
					$flag = true;
				}					
			}			
			if ($flag == false) {
				$Id = $this->countItem();
				$this->addNew($Id, $NameProduct, $IdProduct, $Price, $UrlImage, $Count);
			}
		} 
		else { 			
			$this->addNew(0, $NameProduct, $IdProduct, $Price, $UrlImage, $Count);
		}		
	}
	
	public function plus($Id){
		$this->Items[$Id]['Count'] = $this->Items[$Id]['Count']  + 1;
	}
	
	public function minus($Id){
		if($this->Items[$Id]['Count'] <= 1)
		{
			$this->deleteItem($Id);
		}else {
			$this->Items[$Id]['Count'] = $this->Items[$Id]['Count'] - 1;
		}		
	}
	public function addNew($Id, $NameProduct, $IdProduct, $Price, $UrlImage, $Count){
						
			$this->Items[$Id]['Id']			= $Id;
			$this->Items[$Id]['NameProduct']	= $NameProduct;
			$this->Items[$Id]['IdProduct']	= $IdProduct;
			$this->Items[$Id]['Price']		= $Price;
			$this->Items[$Id]['UrlImage']	= $UrlImage;
			$this->Items[$Id]['Count'] 		= $Count;
			
			$N1 = new \MVC\Library\Number($this->Items[$Id]['Count']*$this->Items[$Id]['Price']);
			$this->Items[$Id]['ValueP'] 	= $N1->formatCurrency();
			$N2 = new \MVC\Library\Number($this->Items[$Id]['Price']);
			$this->Items[$Id]['PriceP'] 	= $N2->formatCurrency();
			
						
			$this->Items[$Id]['URLDel'] 	= "/gio-hang/" . $this->Items[$Id]['Id'] . "/del";
			$this->Items[$Id]['URLPlusUpd']	= "/gio-hang/" . $this->Items[$Id]['Id'] . "/plus";			
			$this->Items[$Id]['URLMinusUpd']= "/gio-hang/" . $this->Items[$Id]['Id'] . "/minus";
	}
	
	
	public function deleteItem($Id){
		if (isset($this->Items[$Id])){
			unset($this->Items[$Id]);
		}
	}
	
	public function countItem(){		
		$C = 0;
		foreach ($this->Items as $Item)
			$C = $C + 1;
		return $C;
	}
}
?>
