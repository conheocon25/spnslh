<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Feed extends Mapper implements \MVC\Domain\FeedFinder{

    function __construct() {
        parent::__construct();
				
		$tblFeed = "res_feed";
		
		$selectAllStmt = sprintf("select * from %s", $tblFeed);
		$selectStmt = sprintf("select *  from %s where id=?", $tblFeed);
		$updateStmt = sprintf("update %s set email=? where id=?", $tblFeed);
		$insertStmt = sprintf("insert into %s (email) values(?)", $tblFeed);
		$deleteStmt = sprintf("delete from %s where id=?", $tblFeed);				
		$findByEmailStmt = sprintf("select * from %s where `email`=?", $tblFeed);
						
        $this->selectAllStmt	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByEmailStmt 	= self::$PDO->prepare($findByEmailStmt);
    } 
    function getCollection( array $raw ) {return new FeedCollection( $raw, $this );}
    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\Feed(
			$array['id'],
			$array['email']
		);
        return $obj;
    }

    protected function targetClass() { return "Feed";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( $object->getEmail());
		
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getEmail(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
		
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
		
	function findByEmail( $values ) {
		$this->findByEmailStmt->execute( array($values) );
        $array = $this->findByEmailStmt->fetch();
        $this->findByEmailStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }	
}
?>