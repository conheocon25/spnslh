<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class R2C extends Mapper implements \MVC\Domain\R2CFinder{

    function __construct() {
        parent::__construct();
		$tblR2C = "tbl_r2c";
		$tblSessionDetail = "tbl_session_detail";
		
		$selectAllStmt = sprintf("select * from %s", $tblR2C);
		$selectStmt = sprintf("select * from %s where id=?", $tblR2C);
		$updateStmt = sprintf("update %s set id_course=?, id_resource=?, value1=?, value2=? where id=?", $tblR2C);
		$insertStmt = sprintf("insert into %s (id_course, id_resource, value1, value2) values( ?, ?, ?, ?)", $tblR2C);
		$deleteStmt = sprintf("delete from %s where id=?", $tblR2C);
		$findByStmt = sprintf("select * from %s where id_course=?", $tblR2C);
		$findByResourceStmt = sprintf("select * from %s where id_resource=?", $tblR2C);
								
		$this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);		
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByResourceStmt = self::$PDO->prepare($findByResourceStmt);
		
    } 
    function getCollection( array $raw ) {return new R2CCollection( $raw, $this );}
    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\R2C(
			$array['id'],
			$array['id_course'],
			$array['id_resource'],
			$array['value1'],
			$array['value2']
		);
        return $obj;
    }

    protected function targetClass() {return "R2C";}

    protected function doInsert( \MVC\Domain\Object $object ){
        $values = array(
			$object->getIdCourse(),
			$object->getIdResource(),
			$object->getValue1(),
			$object->getValue2()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
	    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCourse(),			
			$object->getIdResource(),
			$object->getValue1(),
			$object->getValue2(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
	function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy( $values ) {
        $this->findByStmt->execute( $values );
		return new R2CCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByResource( $values ) {
        $this->findByResourceStmt->execute( $values );
		return new R2CCollection( $this->findByResourceStmt->fetchAll(), $this );
    }
}
?>