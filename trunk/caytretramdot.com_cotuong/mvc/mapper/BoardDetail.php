<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class BoardDetail extends Mapper implements \MVC\Domain\BoardDetailFinder{

    function __construct() {
        parent::__construct();
				
		$tblBoardDetail 	= "tbl_board_detail";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY id", $tblBoardDetail);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblBoardDetail);
		$updateStmt 		= sprintf("update %s set id_board=?, move=?, name1=?, state1=?, name2=?, state2=?, note1=?, note2=?  where id=?", $tblBoardDetail);
		$insertStmt 		= sprintf("insert into %s ( id_board, move, name1, state1, name2, state2, note1, note2) values(?, ?, ?, ?, ?, ?, ?, ?)", $tblBoardDetail);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblBoardDetail);
		$deleteByStmt 		= sprintf("delete from %s where id_board=?", $tblBoardDetail);
		$findByStmt 		= sprintf("SELECT * FROM  %s WHERE id_board=?", $tblBoardDetail);
												
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);		
		$this->deleteByStmt 	= self::$PDO->prepare($deleteByStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);		
	}
	
    function getCollection( array $raw ) {return new BoardDetailCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\BoardDetail( 
			$array['id'],
			$array['id_board'],
			$array['move'],
			$array['name1'],
			$array['state1'],
			$array['name2'],
			$array['state2'],
			$array['note1'],
			$array['note2']
		);
        return $obj;
    }

    protected function targetClass() {return "BoardDetail";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdBoard(),
			$object->getMove(),
			$object->getName1(),
			$object->getState1(),
			$object->getName2(),
			$object->getState2(),
			$object->getNote1(),
			$object->getNote2()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdBoard(),
			$object->getMove(),
			$object->getName1(),
			$object->getState1(),
			$object->getName2(),
			$object->getState2(),
			$object->getNote1(),
			$object->getNote2(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	function deleteBy(array $values) {return $this->deleteByStmt->execute( $values );}
			
	function findBy( $values ){
		$this->findByStmt->execute($values);
        return new BoardDetailCollection( $this->findByStmt->fetchAll(), $this);
    }			
}
?>