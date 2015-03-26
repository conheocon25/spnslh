<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class SupplierType extends Mapper implements \MVC\Domain\SupplierTypeFinder {

    function __construct() {
        parent::__construct();
		$tblSupplierType 		= "supplier_type";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * FROM supplier_type");
        $this->selectStmt 		= self::$PDO->prepare("select * FROM supplier_type where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update supplier_type set name=?, code=?, note=?, enable=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into supplier_type (name, code, note, enable) values( ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete FROM supplier_type where id=?");
		
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblSupplierType);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
						 
    } 
    function getCollection( array $raw ) {return new SupplierTypeCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\SupplierType(
			$array['id'],
			$array['name'],
			$array['code'],
			$array['note'],
			$array['enable']
		);
        return $obj;
    }
	
    protected function targetClass() {return "SupplierType";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(  	
			$object->getName(),			
			$object->getCode(),
			$object->getNote(),
			$object->getEnable()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(			
			$object->getName(),			
			$object->getCode(),
			$object->getNote(),
			$object->getEnable(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
				
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new SupplierTypeCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>