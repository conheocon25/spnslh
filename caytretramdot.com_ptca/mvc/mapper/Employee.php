<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Employee extends Mapper implements \MVC\Domain\EmployeeFinder{
    function __construct() {
        parent::__construct();				
		$tblEmployee = "tbl_employee";
		
		$selectAllStmt 	= sprintf("select * from %s", $tblEmployee);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblEmployee);
		$updateStmt 	= sprintf("update %s set id_room=?, name=?, gender=?, job=?, phone=?, address=?, salary_base=?, card=? where id=?", $tblEmployee);
		$insertStmt 	= sprintf("insert into %s (id_room, name, gender, job, phone, address, salary_base, card) values(?, ?, ?, ?, ?, ?, ?, ?)", $tblEmployee);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblEmployee);
		$findByRoomStmt		= sprintf("select * from %s where id_room=?", $tblEmployee);
		$findByRoomPageStmt = sprintf("SELECT * FROM  %s WHERE id_room=:id_room LIMIT :start,:max", $tblEmployee);
		
		$findByPageStmt = sprintf("SELECT * FROM  %s LIMIT :start,:max", $tblEmployee);
				
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByRoomPageStmt 	= self::$PDO->prepare($findByRoomPageStmt);
		$this->findByRoomStmt 		= self::$PDO->prepare($findByRoomStmt);
			
    } 
    function getCollection( array $raw ) {return new EmployeeCollection( $raw, $this );}

    protected function doCreateObject( array $array ){
        $obj = new \MVC\Domain\Employee(
			$array['id'],
			$array['id_room'],
			$array['name'],
			$array['gender'],
			$array['job'],
			$array['phone'],
			$array['address'],
			$array['salary_base'],
			$array['card']
		);
        return $obj;
    }	
    protected function targetClass() { return "Employee";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 		
			$object->getIdRoom(),
			$object->getName(),
			$object->getGender(),
			$object->getJob(),
			$object->getPhone(),			
			$object->getAddress(),
			$object->getSalaryBase(),
			$object->getCard()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdRoom(),
			$object->getName(),
			$object->getGender(),
			$object->getJob(),
			$object->getPhone(),
			$object->getAddress(),
			$object->getSalaryBase(),
			$object->getCard(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByRoom( array $values ) {
		$this->findByRoomStmt->execute($values);
        return new EmployeeCollection( $this->findByRoomStmt->fetchAll(), $this );
    }
	
	function findByRoomPage( $values ) {
		$this->findByRoomPageStmt->bindValue(':id_room', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByRoomPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByRoomPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByRoomPageStmt->execute();
        return new EmployeeCollection( $this->findByRoomPageStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new EmployeeCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>