<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CategoryMarket extends Mapper implements \MVC\Domain\CategoryMarketFinder {

    function __construct() {
        parent::__construct();
				
		$tblCategoryMarket = "saigonlandhouse_category_market";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblCategoryMarket);
		$selectStmt = sprintf("select *  from %s where id=?", $tblCategoryMarket);
		$updateStmt = sprintf("update %s set name=? where id=?", $tblCategoryMarket);
		$insertStmt = sprintf("insert into %s ( name) values(?)", $tblCategoryMarket);
		$deleteStmt = sprintf("delete from %s where id=?", $tblCategoryMarket);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new CategoryMarketCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CategoryMarket( 
			$array['id'],			
			$array['name']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "CategoryMarket";
    }

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

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>