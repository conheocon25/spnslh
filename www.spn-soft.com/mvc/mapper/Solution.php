<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Solution extends Mapper implements \MVC\Domain\SolutionFinder {

    function __construct() {
        parent::__construct();
				
		$tblSolution = "123appnet_solution";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY name", $tblSolution);
		$selectStmt = sprintf("select *  from %s where id=?", $tblSolution);
		$updateStmt = sprintf("update %s set name=?, picture=? where id=?", $tblSolution);
		$insertStmt = sprintf("insert into %s ( name, picture) values(?, ?)", $tblSolution);
		$deleteStmt = sprintf("delete from %s where id=?", $tblSolution);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		
    } 
    function getCollection( array $raw ) {
        return new SolutionCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Solution( 
			$array['id'], 
			$array['name'],
			$array['url_doc'] 
			);
        return $obj;
    }

    protected function targetClass() {        
		return "Solution";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getURLDoc()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getURLDoc(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>