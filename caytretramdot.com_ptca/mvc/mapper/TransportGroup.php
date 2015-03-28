<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TransportGroup extends Mapper implements \MVC\Domain\TransportGroupFinder {

    function __construct() {
        parent::__construct();
		$tblTransportGroup 		= "transport_group";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from transport_group ORDER BY name");
        $this->selectStmt 		= self::$PDO->prepare("select * from transport_group where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update transport_group set name=?, code=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into transport_group (name, code) values(?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from transport_group where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblTransportGroup);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new TransportGroupCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\TransportGroup( 
			$array['id'],  
			$array['name'],
			$array['code']
		);
        return $obj;
    }
	
    protected function targetClass() {return "TransportGroup";}

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
        return new TransportGroupCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>