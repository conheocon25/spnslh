<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Student extends Mapper implements \MVC\Domain\StudentFinder {
    function __construct(){
        parent::__construct();		
		$tblStudent 			= "tbl_student";
						
		$selectAllStmt 			= sprintf("select * from %s", $tblStudent);
		$selectStmt 			= sprintf("select * from %s where id=?", $tblStudent);
		$updateStmt 			= sprintf("update %s set code=?, sur_name=?, last_name=?, code_ext1=?, birthday=?, gender=?, id_class=?  where id=?", $tblStudent);
		$insertStmt 			= sprintf("insert into %s ( code, sur_name, last_name, code_ext1, birthday, gender, id_class) values(?, ?, ?, ?, ?, ?, ?)", $tblStudent);
		$deleteStmt 			= sprintf("delete from %s where id=?", $tblStudent);
		$deleteAllStmt 			= sprintf("delete from %s", $tblStudent);
		$findByTableStmt 		= sprintf("select * from %s where id_class=?", $tblStudent);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblStudent);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->deleteAllStmt 	= self::$PDO->prepare($deleteAllStmt);
		$this->findByTableStmt 	= self::$PDO->prepare($findByTableStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
									
    } 
    function getCollection( array $raw ) {return new StudentCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Student( 
			$array['id'],
			$array['code'],
			$array['sur_name'],
			$array['last_name'],
			$array['code_ext1'],
			$array['birthday'],
			$array['gender'],
			$array['id_class']
		);
        return $obj;
    }
	
    protected function targetClass() {return "Student";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getCode(),
			$object->getSurName(),
			$object->getLastName(),
			$object->getCodeExt1(),
			$object->getBirthday(),
			$object->getGender(),
			$object->getIdClass()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getCode(),
			$object->getSurName(),
			$object->getLastName(),
			$object->getCodeExt1(),
			$object->getBirthday(),
			$object->getGender(),
			$object->getIdClass(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	function deleteAll($values) {return $this->deleteAllStmt->execute( $values );}
	
	function findByTable($values ) {	
        $this->findByTableStmt->execute( $values );
        return new StudentCollection( $this->findByTableStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new StudentCollection( $this->findByPageStmt->fetchAll(), $this );
    }	
}
?>