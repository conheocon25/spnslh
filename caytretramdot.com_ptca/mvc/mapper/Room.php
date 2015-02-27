<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Room extends Mapper implements \MVC\Domain\RoomFinder {

    function __construct() {
        parent::__construct();
		$tblRoom 				= "tbl_room";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from tbl_room");
        $this->selectStmt 		= self::$PDO->prepare("select * from tbl_room where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update tbl_room set name=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into tbl_room (name) values(?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from tbl_room where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblRoom);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new RoomCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Room( 
			$array['id'],  
			$array['name']			
		);
        return $obj;
    }
	
    protected function targetClass() {return "Room";}

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
        return new RoomCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>