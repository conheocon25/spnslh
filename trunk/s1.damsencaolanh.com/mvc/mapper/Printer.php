<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Printer extends Mapper implements \MVC\Domain\PrinterFinder {

    function __construct() {
        parent::__construct();			
		$tblPrinter = "tbl_printer";
		
		$selectAllStmt 			= sprintf("select * from %s", 										$tblPrinter);
		$selectStmt 			= sprintf("select *  from %s where id=?", 							$tblPrinter);
		$updateStmt 			= sprintf("update %s set name=?, url=? where id=?", 				$tblPrinter);
		$insertStmt 			= sprintf("insert into %s ( name, url) values(?, ?)",				$tblPrinter);
		$deleteStmt 			= sprintf("delete from %s where id=?", 								$tblPrinter);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", 					$tblPrinter);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
				
    } 
    function getCollection( array $raw ) {return new PrinterCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Printer( 
			$array['id'], 
			$array['name'],			
			$array['url']
		);
        return $obj;
    }

    protected function targetClass() {return "Printer";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),			
			$object->getURL()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),			
			$object->getURL(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
			
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new PrinterCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>