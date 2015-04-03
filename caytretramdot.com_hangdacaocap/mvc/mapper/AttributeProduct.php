<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class AttributeProduct extends Mapper implements \MVC\Domain\AttributeProductFinder {

    function __construct() {
        parent::__construct();
		
		$tblAttribute = "tbl_attribute_product";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblAttribute);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblAttribute);
		$updateStmt 	= sprintf("update %s set name=?, `material`=?, `size`=?, `color`=?, `guarantee`=?, `note`=? where id=?", $tblAttribute);
		$insertStmt 	= sprintf("insert into %s ( name, `material`, `size`, `color`, `guarantee`, `note`) values(?, ?, ?, ?, ?, ?)", $tblAttribute);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblAttribute);		
		
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
	
		
    } 
    function getCollection( array $raw ) {return new AttributeProductCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\AttributeProduct( 
			$array['id'],
			$array['name'],
			$array['material'],
			$array['size'],
			$array['color'],
			$array['guarantee'],
			$array['note']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "AttributeProduct";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getName(),
			$object->getMaterial(),
			$object->getSize(),
			$object->getColor(),
			$object->getGuarantee(),			
			$object->getNote()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getMaterial(),
			$object->getSize(),
			$object->getColor(),
			$object->getGuarantee(),			
			$object->getNote(),			
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}	
}
?>