<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Question extends Mapper implements \MVC\Domain\QuestionFinder {

    function __construct() {
        parent::__construct();
		
		$tblQuestion = "tbl_question";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblQuestion);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblQuestion);
		$updateStmt 	= sprintf("update %s set id_domain=?, name=?, note=? where id=?", $tblQuestion);
		$insertStmt 	= sprintf("insert into %s ( id_domain, name, note) values(?,?,?)", $tblQuestion);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblQuestion);		
		$findByStmt 	= sprintf("SELECT * FROM  %s WHERE id_domain=?", $tblQuestion);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblQuestion);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
									
    } 
    function getCollection( array $raw ) {
        return new QuestionCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Question( 
			$array['id'],
			$array['id_domain'],
			$array['name'],
			$array['note']
		);
        return $obj;
    }
	
    protected function targetClass() {        
		return "Question";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdDomain(),
			$object->getName(),
			$object->getNote()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdDomain(),
			$object->getName(),
			$object->getNote(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy($values ){
        $this->findByStmt->execute( $values );
        return new QuestionCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new QuestionCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>