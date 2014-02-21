<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class CStep extends Mapper implements \MVC\Domain\CStepFinder {
    function __construct() {
        parent::__construct();
		
		$tblCStep 		= "tbl_cstep";		
		$selectAllStmt 	= sprintf("select * from %s", $tblCStep);
		$selectStmt 	= sprintf("select *  from %s where id=?", $tblCStep);
		$updateStmt 	= sprintf("update %s set id_cbook=?, name=?, content=?, count=?, `key`=? where id=?", $tblCStep);
		$insertStmt 	= sprintf("insert into %s ( id_cbook, name, content,  count, `key`) values(?, ?, ?, ?, ?)", $tblCStep);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCStep);
				
		$findBySetStmt = sprintf("select *  from %s where id_cbook=?", $tblCStep);				
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findBySetStmt 	= self::$PDO->prepare($findBySetStmt);		
    } 
    function getCollection( array $raw ) {return new CStepCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\CStep(
			$array['id'],
			$array['id_cset'],
			$array['name'],
			$array['content']			
		);		
        return $obj;
    }

    protected function targetClass() {return "CStep";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCSet(),
			$object->getName(),
			$object->getContent(),			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdCSet(),			
			$object->getName(),
			$object->getContent(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByBook( $values ){
        $this->findBySetStmt->execute( $values );
        return new CStepCollection( $this->findBySetStmt->fetchAll(), $this);
    }				
}
?>