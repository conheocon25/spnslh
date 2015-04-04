<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CustomerPriceDetail extends Mapper implements \MVC\Domain\CustomerPriceDetailFinder {

    function __construct() {
        parent::__construct();
		$tblCustomerPriceDetail 	= "customer_price_detail";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from customer_price_detail");
        $this->selectStmt 		= self::$PDO->prepare("select * from customer_price_detail where id=?");
        $this->updateStmt 		= self::$PDO->prepare("
			update customer_price_detail set 				
				id_cp=?,				
				id_good=?,
				price=?,
				commission=?				
			where id=?"
		);
        $this->insertStmt 		= self::$PDO->prepare("insert into customer_price_detail(
				id_cp,
				id_good, 
				price, 
				commission
			) 
			values( ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from customer_price_detail where id=?");
		$this->findBy 			= self::$PDO->prepare("SELECT * FROM customer_price_detail WHERE id_cp=?");
		$this->findByDateStmt 	= self::$PDO->prepare("SELECT * FROM customer_price_detail WHERE id_cp=? AND date(`datetime`)=?");
    }
    function getCollection( array $raw ) {return new CustomerPriceDetailCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CustomerPriceDetail( 
			$array['id'],			
			$array['id_cp'], 			
			$array['id_good'],
			$array['price'],
			$array['commission']
		);
        return $obj;
    }	
    protected function targetClass() {return "CustomerPriceDetail";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdCP(),
			$object->getIdGood(),
			$object->getPrice(),
			$object->getCommission()
		); 		
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {												
        $values = array(
			$object->getIdCP(),
			$object->getIdGood(),
			$object->getPrice(),
			$object->getCommission(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy($values){
        $this->findBy->execute( $values );
        return new CustomerPriceDetailCollection( $this->findBy->fetchAll(), $this );
    }
	
	function findByDate($values){
        $this->findByDateStmt->execute( $values );
        return new CustomerPriceDetailCollection( $this->findByDateStmt->fetchAll(), $this );
    }
	
}
?>