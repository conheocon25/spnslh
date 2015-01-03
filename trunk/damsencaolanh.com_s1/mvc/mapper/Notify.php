<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Notify extends Mapper implements \MVC\Domain\NotifyFinder {

    function __construct() {
        parent::__construct();
				
		$tblNotify = "tbl_notify";
		
		$selectAllStmt 			= sprintf("select * from %s", $tblNotify);
		$selectStmt 			= sprintf("select *  from %s where id=?", $tblNotify);
		$updateStmt 			= sprintf("update %s set title=?, type=?, message=? where id=?", $tblNotify);
		$insertStmt 			= sprintf("insert into %s ( title, type, message) values(?, ?, ?)", $tblNotify);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblNotify);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblNotify);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {
        return new NotifyCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Notify( 
			$array['id'], 
			$array['title'],
			$array['type'],
			$array['message'] 
			);
        return $obj;
    }

    protected function targetClass() {return "Notify";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getTitle(),
			$object->getType(),
			$object->getMessage()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getTitle(),
			$object->getType(),
			$object->getMessage(),
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
        return new NotifyCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>