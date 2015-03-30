<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Role extends Mapper implements \MVC\Domain\RoleFinder {

    function __construct() {
        parent::__construct();
		$tblRole 				= "role";
		
        $this->selectAllStmt 	= self::$PDO->prepare("select * from role ORDER BY name");
        $this->selectStmt 		= self::$PDO->prepare("select * from role where id=?");
        $this->updateStmt 		= self::$PDO->prepare("update role set name=?  where id=?");
        $this->insertStmt 		= self::$PDO->prepare("insert into role (name) values(?)");
		$this->deleteStmt 		= self::$PDO->prepare("delete from role where id=?");
		 
    } 
    function getCollection( array $raw ) {return new RoleCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Role( 
			$array['id'],  
			$array['name']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Role";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getName(),			
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
}
?>