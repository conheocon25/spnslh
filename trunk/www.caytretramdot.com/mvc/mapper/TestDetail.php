<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TestDetail extends Mapper implements \MVC\Domain\TestDetailFinder{

    function __construct() {
        parent::__construct();
		
		$tblTestDetail = "shopc_test_detail";
		$selectAllStmt 	= sprintf("select * from %s", $tblTestDetail);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblTestDetail);
		$updateStmt 	= sprintf("
			update %s set 
				id_test=?,
				id_question=?,
				answer=?				
			where id=?", $tblTestDetail);
		$insertStmt 	= sprintf("
			insert into %s(
				id_test,				
				id_question,
				answer
			) values(?, ?, ?)", $tblTestDetail);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblTestDetail);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblTestDetail);
		$findByStmt 	= sprintf("select *  from %s where id_test=?", $tblTestDetail);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
    }
    function getCollection( array $raw ) {return new TestDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\TestDetail(
			$array['id'],
			$array['id_test'],
			$array['id_question'],
			$array['answer']			
		);
        return $obj;
    }
	
    protected function targetClass() {  return "TestDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdTest(),			
			$object->getIdQuestion(),
			$object->getAnswer()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdTest(),
			$object->getIdQuestion(),
			$object->getAnswer(),
			$object->getId()
		);				
        $this->updaTestDetailmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleTestDetailmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new TestDetailCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findBy(array $values){
        $this->findByStmt->execute( $values );
        return new TestDetailCollection( $this->findByStmt->fetchAll(), $this );
    }
	
}
?>