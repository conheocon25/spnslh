<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Branch extends Mapper implements \MVC\Domain\BranchFinder {

    function __construct() {
        parent::__construct();
		$tblBranch 				= "branch";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from branch");
        $this->updateStmt 		= self::$PDO->prepare("update branch set name=?, tel=?, fax=?, address=?, visible=?  where id=?");
        $this->selectStmt 		= self::$PDO->prepare("select * from branch where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into branch (name, tel, fax, address, visible) values(?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from branch where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblBranch);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new BranchCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Branch( 
			$array['id'],  
			$array['name'],
			$array['tel'],
			$array['fax'],
			$array['address'],
			$array['visible']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Branch";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getTel(),
			$object->getFax(),
			$object->getAddress(),
			$object->getVisible()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),
			$object->getTel(),
			$object->getFax(),
			$object->getAddress(),
			$object->getVisible(),
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
        return new BranchCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>