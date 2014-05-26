<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class QuestionDetail extends Mapper implements \MVC\Domain\QuestionDetailFinder {

    function __construct() {
        parent::__construct();
		
		$tblQuestionDetail 	= "shopc_question_detail";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblQuestionDetail);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblQuestionDetail);
		$updateStmt 	= sprintf("
			update %s set 
				id_question=?,
				content=?,				
				`order`=?
			where id=?", $tblQuestionDetail);
		$insertStmt 	= sprintf("
			insert into %s ( 
				id_question,
				content,
				`order`				
			) values(?, ?, ?)", $tblQuestionDetail);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblQuestionDetail);		
		$findByStmt 	= sprintf("select * from %s where id_question=?", $tblQuestionDetail);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);		
    }
	
    function getCollection( array $raw ) {return new QuestionDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\QuestionDetail( 
			$array['id'],
			$array['id_question'],
			$array['content'],			
			$array['order']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "QuestionDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdQuestion(),
			$object->getContent(),
			$object->getOrder()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdQuestion(),
			$object->getContent(),
			$object->getOrder(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy(array $values){
        $this->findByStmt->execute( $values );
        return new QuestionDetailCollection( $this->findByStmt->fetchAll(), $this );
    }

}
?>