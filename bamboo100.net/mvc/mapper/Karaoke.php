<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Karaoke extends Mapper implements \MVC\Domain\KaraokeFinder {

    function __construct() {
        parent::__construct();
		
		$tblKaraoke 	= "tbl_karaoke";
		$selectAllStmt 	= sprintf("select * from %s", $tblKaraoke);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblKaraoke);
		$updateStmt 	= sprintf("update %s set introduction=?, count=? where id=?"	, $tblKaraoke);
		$insertStmt 	= sprintf("insert into %s ( introduction, count) values(?, ?)"	, $tblKaraoke);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblKaraoke);
										
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);								
		
    } 
    function getCollection( array $raw ) {return new KaraokeCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Karaoke( 
			$array['id'],			
			$array['introduction'],
			$array['count']
		);				
        return $obj;
    }

    protected function targetClass() {return "Karaoke";}

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