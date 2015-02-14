<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TypeAccount extends Mapper implements \MVC\Domain\TypeAccountFinder{
    function __construct() {
        parent::__construct();
		
		$tblTypeAccount 	= "tbl_type_account";
						
		$selectAllStmt 		= sprintf("select * from %s order by `code`", $tblTypeAccount);
		$selectStmt 		= sprintf("select * from %s where id=?", $tblTypeAccount);
		$updateStmt 		= sprintf("update %s set id_parent=?, `code`=?, name=?, `key`=? where id=?", $tblTypeAccount);
		$insertStmt 		= sprintf("insert into %s ( id_parent, `code`, name, `key`) values(?, ?, ?, ?)", $tblTypeAccount);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblTypeAccount);
		$findByPageStmt 	= sprintf("SELECT * FROM  %s ORDER BY `order`, name	LIMIT :start,:max", $tblTypeAccount);
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblTypeAccount);		
		$findByParentStmt 	= sprintf("select *  from %s where id_parent=? order by code", $tblTypeAccount);
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 		= self::$PDO->prepare($findByKeyStmt);										
		$this->findByParentStmt 	= self::$PDO->prepare($findByParentStmt);		
    }
	
    function getCollection( array $raw ) {return new TypeAccountCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\TypeAccount( 
			$array['id'],
			$array['id_parent'],
			$array['code'],
			$array['name'],			
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "TypeAccount";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdParent(),
			$object->getCode(),			
			$object->getName(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdParent(),
			$object->getCode(),
			$object->getName(),			
			$object->getKey(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByParent( array $values ) {
		$this->findByParentStmt->execute($values);
        return new TypeAccountCollection( $this->findByParentStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new TypeAccountCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
			
}
?>