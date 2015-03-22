<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CustomerGroup extends Mapper implements \MVC\Domain\CustomerGroupFinder {

    function __construct() {
        parent::__construct();
		$tblCustomerGroup 		= "customer_group";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from customer_group ORDER BY name");
        $this->selectStmt 		= self::$PDO->prepare("select * from customer_group where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update customer_group set name=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into customer_group (name) values(?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from customer_group where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblCustomerGroup);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new CustomerGroupCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CustomerGroup( 
			$array['id'],  
			$array['name']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "CustomerGroup";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),			
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
					
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CustomerGroupCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>