<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class GoodGroup extends Mapper implements \MVC\Domain\GoodGroupFinder {

    function __construct() {
        parent::__construct();
		$tblGoodGroup 			= "good_group";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from good_group");
        $this->selectStmt 		= self::$PDO->prepare("select * from good_group where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update good_group set name=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into good_group (name) values(?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from good_group where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblGoodGroup);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new GoodGroupCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\GoodGroup( 
			$array['id'],  
			$array['name']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "GoodGroup";}

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
        return new GoodGroupCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>