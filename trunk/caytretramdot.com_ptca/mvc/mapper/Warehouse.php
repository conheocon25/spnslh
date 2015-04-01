<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Warehouse extends Mapper implements \MVC\Domain\WarehouseFinder {
    function __construct() {
        parent::__construct();				
        $this->selectAllStmt 		= self::$PDO->prepare("SELECT * FROM warehouse");
        $this->updateStmt 			= self::$PDO->prepare("UPDATE warehouse set id_group=?, name=?, tel=?, fax=?, address=?, `key`=?, enable=?  where id=?");
        $this->selectStmt 			= self::$PDO->prepare("SELECT * FROM warehouse where id=?");
        $this->insertStmt 			= self::$PDO->prepare("INSERT into warehouse (id_group, name, tel, fax, address, `key`, enable) values(?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 			= self::$PDO->prepare("delete FROM warehouse where id=?");
		$this->findByGroupStmt 		= self::$PDO->prepare("SELECT * FROM warehouse WHERE id_group=? ORDER BY name");
		$this->findByKeyStmt 		= self::$PDO->prepare("SELECT *  FROM warehouse where `key`=?");		
		$this->findByGroupPageStmt 	= self::$PDO->prepare("SELECT * FROM  warehouse WHERE id_group=:id_group LIMIT :start,:max");
		$this->findByPageStmt 		= self::$PDO->prepare("SELECT * FROM  warehouse LIMIT :start,:max");		 
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
			$array['key'],
			$array['enable']
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
			$object->getKey(),
			$object->getEnable()
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
			$object->getKey(),
			$object->getEnable(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() 	{return $this->selectStmt;}	
    function selectAllStmt(){return $this->selectAllStmt;}
					
	function findByKey( $values ){
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
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