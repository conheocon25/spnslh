<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Slide extends Mapper implements \MVC\Domain\SlideFinder {

    function __construct() {
        parent::__construct();
		
		$tblSlide = "tbl_slide";
						
		$selectAllStmt 	= sprintf("select * from %s order by `order`", $tblSlide);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblSlide);
		$updateStmt 	= sprintf("update %s set idpresentation=?, name=?, `order`=?, note=?, `url`=? where id=?", $tblSlide);
		$insertStmt 	= sprintf("insert into %s ( idpresentation, name, `order`, note, `url`) values(?, ?, ?, ?, ?)", $tblSlide);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblSlide);
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblSlide);
		$findByStmt 	= sprintf("select * from %s where idpresentation=?", $tblSlide);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
									
    } 
    function getCollection( array $raw ) {return new SlideCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Slide( 
			$array['id'],
			$array['idpresentation'],
			$array['name'],
			$array['order'],
			$array['note'],
			$array['url']
		);
        return $obj;	
    }
	
    protected function targetClass() {  return "Slide";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPresentation(),
			$object->getName(),
			$object->getOrder(),
			$object->getNote(),
			$object->getURL()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdPresentation(),
			$object->getName(),
			$object->getOrder(),
			$object->getNote(),
			$object->getURL(),
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
        return new SlideCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findBy(array $values) {
        $this->findByStmt->execute( $values );
        return new SlideCollection( $this->findByStmt->fetchAll(), $this );
    }
}
?>