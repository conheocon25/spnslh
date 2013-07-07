<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class ProjectProduct extends Mapper implements \MVC\Domain\ProjectProductFinder{

    function __construct() {
        parent::__construct();
				
		$tblProjectProduct = "saigonlandhouse_project_product";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblProjectProduct);
		$selectStmt = sprintf("select *  from %s where id=?", $tblProjectProduct);
		$updateStmt = sprintf("update %s set id_project=?, date=?, content=?, title=?, type=? where id=?", $tblProjectProduct);
		$insertStmt = sprintf("insert into %s ( id_project, date, content, title, type) values(?, ?, ?, ?, ?)", $tblProjectProduct);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProjectProduct);
		$findByStmt = sprintf("select *  from %s where id_project=? ORDER BY type DESC, date DESC", $tblProjectProduct);
		/*
		$findByLimitStmt = sprintf("select *  from %s where id_project=? ORDER BY type DESC, date DESC limit 10", $tblProjectProduct);
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE id_project=:id_project
			ORDER BY date desc
			LIMIT :start,:max"
		, $tblProjectProduct);
		*/
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		//$this->findByLimitStmt = self::$PDO->prepare($findByLimitStmt);
		//$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);

    } 
    function getCollection( array $raw ) {
        return new ProjectProductCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\ProjectProduct( 
			$array['id'],
			$array['id_project'],
			$array['name'],
			$array['date'],
			$array['description'],			
			$array['type'],
			$array['price_from'],
			$array['price_to']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "ProjectProduct";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdProject(),
			$object->getName(),
			$object->getDate(),
			$object->getDescription(),
			$object->getType(),
			$object->getPriceFrom(),
			$object->getPriceTo()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 			
			$object->getIdProject(),
			$object->getName(),
			$object->getDate(),
			$object->getDescription(),
			$object->getType(),
			$object->getPriceFrom(),
			$object->getPriceTo(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new ProjectProductCollection( $this->findByStmt->fetchAll(), $this);
    }
	/*	
	function findByLimit( $values ){
        $this->findByLimitStmt->execute( $values );
        return new ProjectProductCollection( $this->findByLimitStmt->fetchAll(), $this);
    }
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_category', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new ProjectProductCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	*/
}
?>
