<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CustomerInit extends Mapper implements \MVC\Domain\CustomerInitFinder {

    function __construct() {
        parent::__construct();
				
        $this->selectAllStmt 	= self::$PDO->prepare("select * from customer_init");
        $this->selectStmt 		= self::$PDO->prepare("select * from customer_init where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update customer_init set id_customer=?, debt=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into customer_init (id_customer, debt) values(?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from customer_init where id=?");				 
		$this->checkStmt 		= self::$PDO->prepare("select * from customer_init where id_customer=?");			
    }
    function getCollection( array $raw ) {return new CustomerInitCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CustomerInit( 
			$array['id'],  
			$array['id_customer'],
			$array['debt']
		);
        return $obj;
    }
	
    protected function targetClass() {return "CustomerInit";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCustomer(),
			$object->getDebt()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCustomer(),
			$object->getDebt(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function check( $Param ){
        $this->checkStmt->execute( array( $Param ) );
        $array = $this->checkStmt->fetch( ); 
        $this->checkStmt->closeCursor( );
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        $object->markClean();
        return $object; 
    }
}
?>