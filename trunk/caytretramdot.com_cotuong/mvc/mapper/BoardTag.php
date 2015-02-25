<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class BoardTag extends Mapper implements \MVC\Domain\BoardTagFinder{

    function __construct() {
        parent::__construct();
		
		$tblBoardTag 	= "tbl_board_tag";
						
		$selectAllStmt 	= sprintf("select * from %s", $tblBoardTag);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblBoardTag);
		$updateStmt 	= sprintf("update %s set id_board=?, id_tag=? where id=?", $tblBoardTag);
		$insertStmt 	= sprintf("insert into %s ( id_board, id_tag) values(?, ?)", $tblBoardTag);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblBoardTag);		
		$findByBoardStmt= sprintf("select * from %s where id_board=?", $tblBoardTag);
		$findByTagStmt	= sprintf("select * from %s where id_tag=?", $tblBoardTag);
						
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByBoardStmt 		= self::$PDO->prepare($findByBoardStmt);
		$this->findByTagStmt 		= self::$PDO->prepare($findByTagStmt);
    }
	
    function getCollection( array $raw ) {return new BoardTagCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\BoardTag( 
			$array['id'],			
			$array['id_board'],
			$array['id_tag']			
		);
        return $obj;
    }
	
    protected function targetClass() {  return "BoardTag";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdBoard(),
			$object->getIdTag()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdBoard(),
			$object->getIdTag(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByBoard(array $values) {
        $this->findByBoardStmt->execute( $values );
        return new BoardTagCollection( $this->findByBoardStmt->fetchAll(), $this );
    }	
	
	function findByTag(array $values) {
        $this->findByTagStmt->execute( $values );
        return new BoardTagCollection( $this->findByTagStmt->fetchAll(), $this );
    }
}
?>