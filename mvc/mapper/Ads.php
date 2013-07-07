<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Ads extends Mapper implements \MVC\Domain\AdsFinder {

    function __construct() {
        parent::__construct();
				
		$tblAds = "saigonlandhouse_ads";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblAds);
		$selectStmt = sprintf("select *  from %s where id=?", $tblAds);
		$updateStmt = sprintf("update %s set id_category=?, name=?, date=?, content=?, logo=? where id=?", $tblAds);
		$insertStmt = sprintf("insert into %s ( id_category, name, date, content, logo) values(?, ?, ?, ?, ?)", $tblAds);
		$deleteStmt = sprintf("delete from %s where id=?", $tblAds);
		$findByStmt = sprintf("select *  from %s where id_category=?", $tblAds);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);		
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		
    } 
    function getCollection( array $raw ) {
        return new AdsCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Ads( 
			$array['id'],
			$array['id_category'],
			$array['name'],
			$array['date'],
			$array['content'],
			$array['logo']
		);
        return $obj;
    }

    protected function targetClass() {return "Ads";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getDate(),
			$object->getContent(),
			$object->getLogo()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getDate(),
			$object->getContent(),
			$object->getLogo(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new AdsCollection( $this->findByStmt->fetchAll(), $this);
    }
	
}
?>