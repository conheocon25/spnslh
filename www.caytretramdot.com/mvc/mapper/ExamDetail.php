<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class ExamDetail extends Mapper implements \MVC\Domain\ExamDetailFinder {

    function __construct() {
        parent::__construct();
		
		$tblExamDetail = "shopc_exam_detail";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblExamDetail);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblExamDetail);
		$updateStmt 	= sprintf("
			update %s set 
				id_exam=?,
				id_question=?,				
				`order`=?
			where id=?", $tblExamDetail);
		$insertStmt 	= sprintf("
			insert into %s(
				id_exam,				
				id_question,				
				`order`
			) values(?, ?, ?)", $tblExamDetail);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblExamDetail);
		$findByStmt 	= sprintf("select * from %s where id_exam=?", $tblExamDetail);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		
    } 
    function getCollection( array $raw ) {return new ExamDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\ExamDetail( 
			$array['id'],
			$array['id_exam'],
			$array['id_question'],
			$array['order']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "ExamDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdExam(),
			$object->getIdQuestion(),			
			$object->getOrder()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdExam(),
			$object->getIdQuestion(),			
			$object->getOrder(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new QuestionDetailCollection( $this->findByStmt->fetchAll(), $this );
    }	
	
}
?>