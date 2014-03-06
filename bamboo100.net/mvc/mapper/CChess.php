<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CChess extends Mapper implements \MVC\Domain\CChessFinder {

    function __construct() {
        parent::__construct();
		
		$tblCChess 		= "tbl_cchess";		
		$selectAllStmt 	= sprintf("select * from %s", $tblCChess);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblCChess);
		$updateStmt 	= sprintf("update %s set introduction=?, count=? where id=?"	, $tblCChess);
		$insertStmt 	= sprintf("insert into %s ( introduction, count) values(?, ?)"	, $tblCChess);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCChess);
										
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);								
		
    } 
    function getCollection( array $raw ) {return new CChessCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CChess( 
			$array['id'],			
			$array['introduction'],
			$array['count']
		);				
        return $obj;
    }

    protected function targetClass() {return "CChess";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIntroduction(),
			$object->getCount()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIntroduction(),
			$object->getCount(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}			
}
?>