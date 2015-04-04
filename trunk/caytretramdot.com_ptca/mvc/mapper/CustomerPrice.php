<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CustomerPrice extends Mapper implements \MVC\Domain\CustomerPriceFinder {

    function __construct() {
        parent::__construct();
		$tblCustomerPrice 		= "customer_price";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from customer_price");
        $this->selectStmt 		= self::$PDO->prepare("select * from customer_price where id=?");
        $this->updateStmt 		= self::$PDO->prepare("
			update customer_price set 				
				id_customer=?,
				datetime=?,
				note=?
			where id=?"
		);
        $this->insertStmt 		= self::$PDO->prepare("insert into customer_price(
				id_customer, 
				datetime,
				note
			) 
			values( ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from customer_price where id=?");
		$this->findByStmt		= self::$PDO->prepare("SELECT * FROM customer_price WHERE id_customer=?");
    }
    function getCollection( array $raw ) {return new CustomerPriceCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CustomerPrice( 
			$array['id'],			
			$array['id_customer'], 
			$array['datetime'],
			$array['note']
		);
        return $obj;
    }	
    protected function targetClass() {return "CustomerPrice";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdCustomer(),			
			$object->getDateTime(),			
			$object->getNote()
		); 		
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {												
        $values = array(
			$object->getIdCustomer(),			
			$object->getDateTime(),
			$object->getNote(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy($values){
        $this->findByStmt->execute( $values );
        return new CustomerPriceCollection( $this->findByStmt->fetchAll(), $this );
    }
}
?>