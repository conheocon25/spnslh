<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Department extends Mapper implements \MVC\Domain\DepartmentFinder {

    function __construct() {
        parent::__construct();
		$tblDepartment 			= "department";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from department");
        $this->updateStmt 		= self::$PDO->prepare("update department set name=?, tel=?, fax=?, address=?, visible=?  where id=?");
        $this->selectStmt 		= self::$PDO->prepare("select * from department where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into department (name, tel, fax, address, visible) values(?, ?, ?, ?, ?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from department where id=?");
						
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblDepartment);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		 
    } 
    function getCollection( array $raw ) {return new DepartmentCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Department( 
			$array['id'],  
			$array['name'],
			$array['tel'],
			$array['fax'],
			$array['address'],
			$array['visible']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Department";}

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
        return new DepartmentCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>