<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Exam extends Mapper implements \MVC\Domain\ExamFinder {

    function __construct() {
        parent::__construct();
		
		$tblExam = "shopc_exam";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblExam);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblExam);
		$updateStmt 	= sprintf("
			update %s set 
				name=?,
				date_created=?,
				date_updated=?,
				owner=?,
				time=?
			where id=?", $tblExam);
		$insertStmt 	= sprintf("
			insert into %s(
				name,				
				date_created,
				date_updated,
				owner,
				time
			) values(?, ?, ?, ?, ?)", $tblExam);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblExam);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblExam);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblExam);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);							
    } 
    function getCollection( array $raw ) {return new ExamCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Exam( 
			$array['id'],
			$array['name'],			
			$array['date_created'],
			$array['date_updated'],
			$array['owner'],			
			$array['time']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Exam";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),			
			$object->getDateCreated(),
			$object->getDateUpdated(),
			$object->getOwner(),			
			$object->getTime()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),			
			$object->getDateCreated(),
			$object->getDateUpdated(),
			$object->getOwner(),			
			$object->getTime(),
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
        return new ExamCollection( $this->findByPageStmt->fetchAll(), $this );
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