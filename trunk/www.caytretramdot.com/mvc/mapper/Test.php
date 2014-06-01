<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Test extends Mapper implements \MVC\Domain\TestFinder {

    function __construct() {
        parent::__construct();
		
		$tblTest = "shopc_test";						
		$selectAllStmt 	= sprintf("select * from %s", $tblTest);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblTest);
		$updateStmt 	= sprintf("
			update %s set 
				id_exam=?,
				date_created=?,
				date_updated=?,
				owner=?,
				score=?
			where id=?", $tblTest);
		$insertStmt 	= sprintf("
			insert into %s(
				id_exam,				
				date_created,
				date_updated,
				owner,
				score
			) values(?, ?, ?, ?, ?)", $tblTest);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblTest);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblTest);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblTest);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);							
    } 
    function getCollection( array $raw ) {return new TestCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Test( 
			$array['id'],
			$array['id_exam'],
			$array['date_created'],
			$array['date_updated'],
			$array['owner'],
			$array['score']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Test";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdExam(),			
			$object->getDateCreated(),
			$object->getDateUpdated(),
			$object->getOwner(),			
			$object->getScore()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdExam(),			
			$object->getDateCreated(),
			$object->getDateUpdated(),
			$object->getOwner(),			
			$object->getScore(),
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
        return new TestCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
}
?>