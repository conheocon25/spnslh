<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CategoryEstate extends Mapper implements \MVC\Domain\CategoryEstateFinder {

    function __construct() {
        parent::__construct();
				
		$tblCategoryEstate = "saigonlandhouse_category_estate";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblCategoryEstate);
		$selectStmt = sprintf("select *  from %s where id=?", $tblCategoryEstate);
		$updateStmt = sprintf("update %s set name=? where id=?", $tblCategoryEstate);
		$insertStmt = sprintf("insert into %s ( name) values(?)", $tblCategoryEstate);
		$deleteStmt = sprintf("delete from %s where id=?", $tblCategoryEstate);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new CategoryEstateCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CategoryEstate( 
			$array['id'],			
			$array['name']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "CategoryEstate";
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