<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class ZenMusic extends Mapper implements \MVC\Domain\ZenMusicFinder {

    function __construct() {
        parent::__construct();
		
		$tblZenMusic 	= "tbl_zenmusic";
		$selectAllStmt 	= sprintf("select * from %s", $tblZenMusic);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblZenMusic);
		$updateStmt 	= sprintf("update %s set introduction=?, count=? where id=?"	, $tblZenMusic);
		$insertStmt 	= sprintf("insert into %s ( introduction, count) values(?, ?)"	, $tblZenMusic);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblZenMusic);
										
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);								
		
    } 
    function getCollection( array $raw ) {return new ZenMusicCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\ZenMusic( 
			$array['id'],			
			$array['introduction'],
			$array['count']
		);				
        return $obj;
    }

    protected function targetClass() {return "ZenMusic";}

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