<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CustomerCollect extends Mapper implements \MVC\Domain\CustomerCollectFinder {

    function __construct() {
        parent::__construct();
		$tblCustomerCollect 	= "customer_collect";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from customer_collect");
        $this->selectStmt 		= self::$PDO->prepare("select * from customer_collect where id=?");
        $this->updateStmt 		= self::$PDO->prepare("
			update customer_collect set 				
				id_customer=?,
				datetime=?, 
				value=?,
				note=?				
			where id=?"
		);
        $this->insertStmt 		= self::$PDO->prepare("insert into customer_collect(
				id_customer, 
				datetime, 
				value, 
				note				
			) 
			values( ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from customer_collect where id=?");
		$this->findByBranchStmt = self::$PDO->prepare("SELECT * FROM customer_collect WHERE id_branch=?");
		 
    } 
    function getCollection( array $raw ) {return new CustomerCollectCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CustomerCollect( 
			$array['id'],			
			$array['id_customer'], 
			$array['datetime'],
			$array['value'],
			$array['note']
		);
        return $obj;
    }	
    protected function targetClass() {return "CustomerCollect";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getIdCustomer(),			
			$object->getDateTime(),
			$object->getValue(),
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
			$object->getValue(),
			$object->getNote(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByBranch($values) {		
        $this->findByBranchStmt->execute( $values );
        return new CustomerCollectCollection( $this->findByBranchStmt->fetchAll(), $this );
    }
}
?>