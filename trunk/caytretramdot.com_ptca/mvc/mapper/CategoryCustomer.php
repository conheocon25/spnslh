<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CategoryCustomer extends Mapper implements \MVC\Domain\CategoryCustomerFinder {

    function __construct() {
        parent::__construct();
		$tblCategoryCustomer 		= "tbl_category_customer";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from tbl_category_customer");
        $this->selectStmt 		= self::$PDO->prepare("select * from tbl_category_customer where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update tbl_category_customer set name=?, note=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into tbl_category_customer (name, note) values(?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from tbl_category_customer where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblCategoryCustomer);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new CategoryCustomerCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CategoryCustomer( 
			$array['id'],  
			$array['name'],			
			$array['note']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "CategoryCustomer";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  
			$object->getName(),			
			$object->getNote()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),			
			$object->getNote(),			
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
        return new CategoryCustomerCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>