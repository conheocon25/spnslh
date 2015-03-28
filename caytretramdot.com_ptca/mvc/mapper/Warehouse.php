<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Warehouse extends Mapper implements \MVC\Domain\WarehouseFinder {

    function __construct() {
        parent::__construct();
		$tblWarehouse 			= "warehouse";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from warehouse");
        $this->updateStmt 		= self::$PDO->prepare("update warehouse set id_group=?, name=?, tel=?, fax=?, address=?, visible=?  where id=?");
        $this->selectStmt 		= self::$PDO->prepare("select * from warehouse where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into warehouse (id_group, name, tel, fax, address, visible) values(?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from warehouse where id=?");
		$this->findByGroupStmt 	= self::$PDO->prepare("SELECT * FROM warehouse WHERE id_group=? ORDER BY name");
		
		$findByGroupPageStmt 		= sprintf("SELECT * FROM  %s WHERE id_group=:id_group LIMIT :start,:max", $tblWarehouse);
		$this->findByGroupPageStmt 	= self::$PDO->prepare($findByGroupPageStmt);
		
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblWarehouse);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new WarehouseCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Warehouse( 
			$array['id'],  
			$array['id_group'],
			$array['name'],
			$array['tel'],
			$array['fax'],
			$array['address'],
			$array['visible']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Warehouse";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdGroup(),
			$object->getName(),
			$object->getTel(),
			$object->getFax(),
			$object->getAddress(),
			$object->getVisible()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdGroup(),
			$object->getName(),
			$object->getTel(),
			$object->getFax(),
			$object->getAddress(),
			$object->getVisible(),
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
        return new WarehouseCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByGroup($values) {		
        $this->findByGroupStmt->execute( $values );
        return new WarehouseCollection( $this->findByGroupStmt->fetchAll(), $this );
    }
	
	function findByGroupPage( $values ) {
		$this->findByGroupPageStmt->bindValue(':id_group', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->execute();
        return new WarehouseCollection( $this->findByGroupPageStmt->fetchAll(), $this );
    }
	
}
?>