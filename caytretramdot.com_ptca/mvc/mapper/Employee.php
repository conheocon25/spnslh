<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Employee extends Mapper implements \MVC\Domain\EmployeeFinder{
    function __construct() {
        parent::__construct();				
		$tblEmployee = "employee";
		
		$selectAllStmt 	= sprintf("select * from %s", $tblEmployee);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblEmployee);
		$updateStmt 	= sprintf("update %s set id_department=?, name=?, gender=?, tel=?, email=?, address=?, avatar=?, serial=? where id=?", $tblEmployee);
		$insertStmt 	= sprintf("insert into %s (id_department, name, gender, tel, email, address, avatar, serial) values(?, ?, ?, ?, ?, ?, ?, ?)", $tblEmployee);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblEmployee);
		$findByDepartmentStmt		= sprintf("select * from %s where id_department=?", $tblEmployee);
		$findByDepartmentPageStmt 	= sprintf("SELECT * FROM  %s WHERE id_department=:id_department LIMIT :start,:max", $tblEmployee);
		
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblEmployee);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByDepartmentPageStmt 	= self::$PDO->prepare($findByDepartmentPageStmt);
		$this->findByDepartmentStmt 		= self::$PDO->prepare($findByDepartmentStmt);
			
    } 
    function getCollection( array $raw ) {return new EmployeeCollection( $raw, $this );}

    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\Employee(
			$array['id'],
			$array['id_department'],
			$array['name'],
			$array['gender'],
			$array['tel'],
			$array['email'],
			$array['address'],
			$array['avatar'],
			$array['serial']
		);					
        return $obj;
    }	
    protected function targetClass() { return "Employee";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 		
			$object->getIdDepartment(),
			$object->getName(),
			$object->getGender(),
			$object->getTel(),
			$object->getEmail(),			
			$object->getAddress(),
			$object->getAvatar(),
			$object->getSerial()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdDepartment(),
			$object->getName(),
			$object->getGender(),
			$object->getTel(),
			$object->getEmail(),			
			$object->getAddress(),
			$object->getAvatar(),
			$object->getSerial(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByDepartment( array $values ) {
		$this->findByDepartmentStmt->execute($values);
        return new EmployeeCollection( $this->findByDepartmentStmt->fetchAll(), $this );
    }
	
	function findByDepartmentPage( $values ) {
		$this->findByDepartmentPageStmt->bindValue(':id_department', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByDepartmentPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByDepartmentPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByDepartmentPageStmt->execute();
        return new EmployeeCollection( $this->findByDepartmentPageStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new EmployeeCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>