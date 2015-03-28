<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Unit extends Mapper implements \MVC\Domain\UnitFinder {

    function __construct() {
        parent::__construct();
		$tblUnit 				= "unit";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from unit ORDER BY name");
        $this->selectStmt 		= self::$PDO->prepare("select * from unit where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update unit set name=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into unit (name) values(?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from unit where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", $tblUnit);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new UnitCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Unit( 
			$array['id'],  
			$array['name']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "Unit";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),			
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
        return new UnitCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>