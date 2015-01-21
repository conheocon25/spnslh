<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Board extends Mapper implements \MVC\Domain\BoardFinder{

    function __construct() {
        parent::__construct();
				
		$tblBoard 				= "bamboo100_board";
		
		$selectAllStmt 			= sprintf("select * from %s ORDER BY id", $tblBoard);
		$selectStmt 			= sprintf("select *  from %s where id=?", $tblBoard);
		$updateStmt 			= sprintf("update %s set id_category=?, name=?, `time`=?, info=?, move_start=?, move_end=?, `key`=? where id=?", $tblBoard);
		$insertStmt 			= sprintf("insert into %s ( id_category, name, `time`, info, move_start, move_end, `key`) values(?, ?, ?, ?, ?, ?, ?)", $tblBoard);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblBoard);
		$findByStmt 			= sprintf("select *  from %s where `id_category`=?", $tblBoard);
		$findByKeyStmt 			= sprintf("select *  from %s where `key`=?", $tblBoard);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblBoard);
						
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);		
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
	}
	
    function getCollection( array $raw ) {return new BoardCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Board( 
			$array['id'],
			$array['id_category'],
			$array['name'],
			$array['time'],
			$array['info'],
			$array['move_start'],
			$array['move_end'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {return "Board";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getTime(),
			$object->getInfo(),
			$object->getMoveStart(),
			$object->getMoveEnd(),
			$object->getKey()			
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),			
			$object->getTime(),
			$object->getInfo(),
			$object->getMoveStart(),
			$object->getMoveEnd(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
	function findBy( $values ){
		$this->findByStmt->execute($values);
        return new BoardCollection( $this->findByStmt->fetchAll(), $this);
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
			
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new BoardCollection( $this->findByPageStmt->fetchAll(), $this );
    }
			
}
?>