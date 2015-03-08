<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class BoardSub extends Mapper implements \MVC\Domain\BoardSubFinder{
    function __construct(){
        parent::__construct();				
		$tblBoardSub 			= "tbl_board_sub";
		
		$selectAllStmt 			= sprintf("select * from %s ORDER BY id", $tblBoardSub);
		$selectStmt 			= sprintf("select *  from %s where id=?", $tblBoardSub);
		$updateStmt 			= sprintf("update %s set id_board_parent=?, id_board_me=?, id_board_detail=?  where id=?", $tblBoardSub);
		$insertStmt 			= sprintf("insert into %s (id_board_parent, id_board_me, id_board_detail) values(?, ?, ?)", $tblBoardSub);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblBoardSub);
		$findByStmt 			= sprintf("select *  from %s where `id_board_detail`=?", $tblBoardSub);
		$findByMeStmt 			= sprintf("select *  from %s where `id_board_me`=?", $tblBoardSub);
		$findByKeyStmt 			= sprintf("select *  from %s where `key`=?", $tblBoardSub);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblBoardSub);
										
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByMeStmt 	= self::$PDO->prepare($findByMeStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);		
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
	}
	
    function getCollection( array $raw ) {return new BoardSubCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\BoardSub( 
			$array['id'],
			$array['id_board_parent'],
			$array['id_board_me'],
			$array['id_board_detail']				
		);
        return $obj;
    }

    protected function targetClass() {return "BoardSub";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdBoardParent(),
			$object->getIdBoardMe(),
			$object->getIdBoardDetail()
		);
					
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdBoardParent(),
			$object->getIdBoardMe(),
			$object->getIdBoardDetail(),			
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
	function findBy( $values ){
		$this->findByStmt->execute($values);
        return new BoardSubCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByMe( $values ){
		$this->findByMeStmt->execute($values);
        return new BoardSubCollection( $this->findByMeStmt->fetchAll(), $this);
    }
				
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new BoardSubCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>