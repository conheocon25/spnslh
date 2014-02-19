<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Project extends Mapper implements \MVC\Domain\ProjectFinder{

    function __construct() {
        parent::__construct();
				
		$tblProject = "tbl_project";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC", $tblProject);
		$selectStmt = sprintf("select *  from %s where id=?", $tblProject);
		$updateStmt = sprintf("update %s set name=?, description=?, address=?, type1=?, investors=?, stretch=?, payment=?, date_start=?, date_end=?, type=?, `key`=? where id=?", $tblProject);
		$insertStmt = sprintf("insert into %s ( name, description, address, type1, investors, stretch, payment, date_start, date_end, type, `key`) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblProject);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProject);
		$findByKeyStmt = sprintf("select *  from %s where `key`=?", $tblProject);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			LIMIT :start,:max"
		, $tblProject);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByKeyStmt = self::$PDO->prepare($findByKeyStmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);

    } 
    function getCollection( array $raw ) {return new ProjectCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Project( 
			$array['id'],
			$array['name'],
			$array['description'],
			$array['address'],
			$array['type1'],
			$array['investors'],
			$array['stretch'],
			$array['payment'],
			$array['date_start'],
			$array['date_end'],
			$array['type'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {return "Project";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getDescription(),
			$object->getAddress(),
			$object->getType1(),
			$object->getInvestors(),
			$object->getStretch(),
			$object->getPayment(),
			$object->getDateStart(),
			$object->getDateEnd(),
			$object->getType(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getName(),
			$object->getDescription(),
			$object->getAddress(),
			$object->getType1(),
			$object->getInvestors(),
			$object->getStretch(),
			$object->getPayment(),
			$object->getDateStart(),
			$object->getDateEnd(),
			$object->getType(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByKey( $values ) {	
		$this->findByKeyStmt->execute( array($values) );
        $array = $this->findByKeyStmt->fetch();
        $this->findByKeyStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new ProjectCollection( $this->findByPageStmt->fetchAll(), $this );
    }
}
?>
