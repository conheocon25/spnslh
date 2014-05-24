<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Question extends Mapper implements \MVC\Domain\QuestionFinder {

    function __construct() {
        parent::__construct();
		
		$tblQuestion = "shopc_question";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblQuestion);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblQuestion);
		$updateStmt 	= sprintf("update %s set content=?  where id=?", $tblQuestion);
		$insertStmt 	= sprintf("insert into %s ( content) values(?)", $tblQuestion);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblQuestion);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblQuestion);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblQuestion);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);							
    } 
    function getCollection( array $raw ) {return new QuestionCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Question( 
			$array['id'],
			$array['content']			
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Question";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getContent()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getContent(),			
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
        return new QuestionCollection( $this->findByPageStmt->fetchAll(), $this );
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