<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Attribute extends Mapper implements \MVC\Domain\AttributeFinder {

    function __construct() {
        parent::__construct();
		
		$tblAttribute = "res_attribute";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblAttribute);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblAttribute);
		$updateStmt 	= sprintf("update %s set id_gattribute=?, name=?, `order`=? where id=?", $tblAttribute);
		$insertStmt 	= sprintf("insert into %s ( id_gattribute, name, `order`) values(?, ?, ?)", $tblAttribute);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblAttribute);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblAttribute);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblAttribute);
		$findByStmt 	= sprintf("select *  from %s where `id_gattribute`=?", $tblAttribute);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);							
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
    } 
    function getCollection( array $raw ) {return new AttributeCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Attribute( 
			$array['id'],
			$array['id_gattribute'],
			$array['name'],
			$array['order']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Attribute";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdGAttribute(),
			$object->getName(),
			$object->getOrder()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdGAttribute(),
			$object->getName(),
			$object->getOrder(),			
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
        return new AttributeCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new AttributeCollection( $this->findByStmt->fetchAll(), $this );
    }
	
}
?>