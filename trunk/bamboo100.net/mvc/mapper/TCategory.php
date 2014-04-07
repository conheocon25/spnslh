<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TCategory extends Mapper implements \MVC\Domain\TCategoryFinder {
    function __construct() {
        parent::__construct();			
		$tblTCategory = "tbl_tcategory";
		
		$selectAllStmt 			= sprintf("select * from %s ORDER BY name", 						$tblTCategory);
		$selectStmt 			= sprintf("select *  from %s where id=?", 							$tblTCategory);
		$updateStmt 			= sprintf("update %s set name=?, `order`=?, `key`=? where id=?", 	$tblTCategory);
		$insertStmt 			= sprintf("insert into %s ( name, `order`, `key`) values(?, ?, ?)",	$tblTCategory);
		$deleteStmt 			= sprintf("delete from %s where id=?", 								$tblTCategory);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", 		$tblTCategory);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new TCategoryCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TCategory( 
			$array['id'], 
			$array['name'],			
			$array['order'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {return "TCategory";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),						
			$object->getOrder(),
			$object->getKey(),
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),						
			$object->getOrder(),
			$object->getKey(),
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
        return new TCategoryCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>