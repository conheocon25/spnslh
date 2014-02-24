<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );

class CStep extends Mapper implements \MVC\Domain\CStepFinder {
    function __construct() {
        parent::__construct();
		
		$tblCStep 		= "tbl_cstep";		
		$selectAllStmt 	= sprintf("select * from %s", $tblCStep);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblCStep);
		$updateStmt 	= sprintf("update %s set id_cset=?, name1=?, content1=?, name2=?, content2=? where id=?", $tblCStep);
		$insertStmt 	= sprintf("insert into %s ( id_cset, name1, content1, name2, content2) values(?, ?, ?, ?, ?)", $tblCStep);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCStep);
		$deleteBySetStmt= sprintf("delete from %s where id_cset=?", $tblCStep);
				
		$findBySetStmt = sprintf("select *  from %s where id_cset=?", $tblCStep);				
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->deleteBySetStmt 	= self::$PDO->prepare($deleteBySetStmt);
		$this->findBySetStmt 	= self::$PDO->prepare($findBySetStmt);		
    } 
    function getCollection( array $raw ) {return new CStepCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CStep(
			$array['id'],
			$array['id_cset'],
			$array['name1'],
			$array['content1'],
			$array['name2'],
			$array['content2']
		);		
        return $obj;
    }

    protected function targetClass() {return "CStep";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCSet(),
			$object->getName1(),
			$object->getContent1(),			
			$object->getName2(),
			$object->getContent2()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCSet(),			
			$object->getName1(),
			$object->getContent1(),
			$object->getName2(),
			$object->getContent2(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function deleteBySet( $values ){
        $this->deleteBySetStmt->execute( $values );
        return true;
    }				
	
	function findBySet( $values ){
        $this->findBySetStmt->execute( $values );
        return new CStepCollection( $this->findBySetStmt->fetchAll(), $this);
    }				
}
?>