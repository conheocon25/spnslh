<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CategoryGeneral extends Mapper implements \MVC\Domain\CategoryGeneralFinder {

    function __construct() {
        parent::__construct();
				
		$tblCategoryGeneral = "saigonlandhouse_category_general";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblCategoryGeneral);
		$selectStmt = sprintf("select *  from %s where id=?", $tblCategoryGeneral);
		$updateStmt = sprintf("update %s set name=? where id=?", $tblCategoryGeneral);
		$insertStmt = sprintf("insert into %s ( name) values(?)", $tblCategoryGeneral);
		$deleteStmt = sprintf("delete from %s where id=?", $tblCategoryGeneral);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new CategoryGeneralCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CategoryGeneral( 
			$array['id'],			
			$array['name']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "CategoryGeneral";
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