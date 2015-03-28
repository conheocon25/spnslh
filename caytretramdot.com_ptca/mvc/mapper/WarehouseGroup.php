<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class WarehouseGroup extends Mapper implements \MVC\Domain\WarehouseGroupFinder {

    function __construct() {
        parent::__construct();
		$tblWarehouseGroup 		= "warehouse_group";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from warehouse_group ORDER BY name");
        $this->selectStmt 		= self::$PDO->prepare("select * from warehouse_group where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update warehouse_group set name=?, code=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into warehouse_group (name, code) values(?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from warehouse_group where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblWarehouseGroup);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new WarehouseGroupCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\WarehouseGroup( 
			$array['id'],  
			$array['name'],
			$array['code']
		);
        return $obj;
    }
	
    protected function targetClass() {return "WarehouseGroup";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getCode()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getCode(),
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
        return new WarehouseGroupCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>