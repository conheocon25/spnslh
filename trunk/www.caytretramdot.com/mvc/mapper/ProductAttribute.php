<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class ProductAttribute extends Mapper implements \MVC\Domain\ProductAttributeFinder{

    function __construct() {
        parent::__construct();
		
		$tblProductAttribute 	= "shopc_product_attribute";
						
		$selectAllStmt 	= sprintf("SELECT * from %s ", $tblProductAttribute);
		$selectStmt 	= sprintf("SELECT * from %s where id=?", $tblProductAttribute);
		$updateStmt 	= sprintf("update %s set id_product=?, id_attribute=?, value=? where id=?", $tblProductAttribute);
		$insertStmt 	= sprintf("insert into %s ( id_product, id_attribute, value) values(?, ?, ?)", $tblProductAttribute);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblProductAttribute);
		$findByStmt 	= sprintf("SELECT * FROM  %s WHERE id_product=?", $tblProductAttribute);
						
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
									
    } 
    function getCollection( array $raw ) {return new ProductAttributeCollection( $raw, $this );}
    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\ProductAttribute( 
			$array['id'],
			$array['id_product'],
			$array['id_attribute'],
			$array['value']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "ProductAttribute";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProduct(),
			$object->getIdAttribute(),
			$object->getValue()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdProduct(),
			$object->getIdAttribute(),
			$object->getValue(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy(array $values) {
		$this->findByStmt->execute( $values );
        return new ProductAttributeCollection( $this->findByStmt->fetchAll(), $this );
    }	
}
?>