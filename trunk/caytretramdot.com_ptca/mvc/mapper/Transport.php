<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Transport extends Mapper implements \MVC\Domain\TransportFinder {

    function __construct() {
        parent::__construct();
		$tblTransport 			= "transport";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from transport ORDER BY name");
        $this->selectStmt 		= self::$PDO->prepare("select * from transport where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update transport set id_group=?, name=?, code=?, driver=?, quantity=?, note=?, enable=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into transport (id_group, name, code, driver, quantity, note, enable) values(?, ?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from transport where id=?");
		
		$findByGroupStmt		= sprintf("select * from %s where id_group=?", $tblTransport);
		$this->findByGroupStmt 	= self::$PDO->prepare($findByGroupStmt);
		
		$findByGroupPageStmt 		= sprintf("SELECT * FROM  %s WHERE id_group=:id_group LIMIT :start,:max", $tblTransport);		
		$this->findByGroupPageStmt 	= self::$PDO->prepare($findByGroupPageStmt);
		
		
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblTransport);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);					 
    } 
    function getCollection( array $raw ) {return new TransportCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Transport( 
			$array['id'],
			$array['id_group'],
			$array['name'],
			$array['code'],
			$array['driver'],
			$array['quantity'],
			$array['note'],
			$array['enable']
		);			
        return $obj;
    }
	
    protected function targetClass() {return "Transport";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdGroup(),
			$object->getName(),
			$object->getCode(),
			$object->getDriver(),
			$object->getQuantity(),
			$object->getNote(),
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
			$object->getCode(),
			$object->getDriver(),
			$object->getQuantity(),
			$object->getNote(),
			$object->getEnable(),
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
        return new TransportCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByGroup( array $values ) {
		$this->findByGroupStmt->execute($values);
        return new TransportCollection( $this->findByGroupStmt->fetchAll(), $this );
    }
	
	function findByGroupPage( $values ) {
		$this->findByGroupPageStmt->bindValue(':id_group', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByGroupPageStmt->execute();
        return new TransportCollection( $this->findByGroupPageStmt->fetchAll(), $this );
    }
}
?>