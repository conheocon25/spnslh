<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Transport extends Mapper implements \MVC\Domain\TransportFinder {

    function __construct() {
        parent::__construct();
		$tblTransport 			= "transport";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from transport ORDER BY name");
        $this->selectStmt 		= self::$PDO->prepare("select * from transport where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update transport set name=?, driver=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into transport (name, driver) values(?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from transport where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblTransport);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new TransportCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Transport( 
			$array['id'],  
			$array['name'],
			$array['driver']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Transport";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getDriver()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getDriver(),
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
}
?>