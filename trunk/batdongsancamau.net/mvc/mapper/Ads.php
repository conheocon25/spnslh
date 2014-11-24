<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Ads extends Mapper implements \MVC\Domain\AdsFinder {

    function __construct() {
        parent::__construct();		
		$tblAds = "tbl_ads";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblAds);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblAds);
		$updateStmt 	= sprintf("update %s set name=?, position=?, picture=?, url=?, `key`=? where id=?", $tblAds);
		$insertStmt 	= sprintf("insert into %s ( name, position, picture, url, `key`) values(?, ?, ?)", $tblAds);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblAds);
		$findByPageStmt = sprintf("SELECT * FROM  %s ORDER BY `order` LIMIT :start,:max", $tblAds);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblAds);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);							
    } 
    function getCollection( array $raw ) {return new AdsCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Ads( 
			$array['id'],
			$array['name'],
			$array['position'],
			$array['picture'],
			$array['url'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "Ads";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPosition(),
			$object->getPicture(),
			$object->getURL(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getPosition(),
			$object->getPicture(),
			$object->getURL(),
			$object->getKey(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new AdsCollection( $this->findByPageStmt->fetchAll(), $this );
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
}
?>