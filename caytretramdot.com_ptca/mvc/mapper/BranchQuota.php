<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class BranchQuota extends Mapper implements \MVC\Domain\BranchQuotaFinder {

    function __construct() {
        parent::__construct();
		$tblBranchQuota 			= "branch_quota";
		
        $this->selectAllStmt 		= self::$PDO->prepare("select * from branch_quota");
        $this->updateStmt 			= self::$PDO->prepare("update branch_quota set id_branch=?, date=?, id_good=?, count1=?, count2=?, count3=?  where id=?");
        $this->selectStmt 			= self::$PDO->prepare("select * from branch_quota where id=?");
        $this->insertStmt 			= self::$PDO->prepare("insert into branch_quota (id_branch, date, id_good, count1, count2, count3) values(?, ?, ?, ?, ?, ?)");
		$this->deleteStmt 			= self::$PDO->prepare("delete from branch_quota where id=?");
		$this->checkStmt 			= self::$PDO->prepare("select * from branch_quota where id_branch=? AND date=? AND id_good=?");
		$this->findByBranchDateStmt = self::$PDO->prepare("SELECT * FROM branch_quota WHERE id_branch=? AND date=?");
		
	}
    function getCollection( array $raw ) {return new BranchQuotaCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\BranchQuota( 
			$array['id'],
			$array['id_branch'],
			$array['date'],
			$array['id_good'],
			$array['count1'],
			$array['count2'],
			$array['count3']
		);
        return $obj;
    }
	
    protected function targetClass() {return "BranchQuota";}

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdBranch(),
			$object->getDate(),
			$object->getIdGood(),
			$object->getCount1(),
			$object->getCount2(),
			$object->getCount3()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdBranch(),
			$object->getDate(),
			$object->getIdGood(),
			$object->getCount1(),
			$object->getCount2(),
			$object->getCount3(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	
	function check( $values ){
		$this->checkStmt->execute( $values );
        $array = $this->checkStmt->fetch();
        $this->checkStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findByBranchDate($values){
        $this->findByBranchDateStmt->execute( $values );
        return new BranchQuotaCollection( $this->findByBranchDateStmt->fetchAll(), $this );
    }
			
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
					
}
?>