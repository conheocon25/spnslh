<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class AgencyMarket extends Mapper implements \MVC\Domain\AgencyMarketFinder {

    function __construct() {
        parent::__construct();
				
		$tblAgency = "saigonlandhouse_agency_market";
		$tblNews = "saigonlandhouse_news_market";
		
		$selectAllStmt = sprintf("select * from %s", $tblAgency);
		$selectStmt = sprintf("select *  from %s where id=?", $tblAgency);
		$updateStmt = sprintf("update %s set id_agency=?, id_market=?, permission=? where id=?", $tblAgency);
		$insertStmt = sprintf("insert into %s ( id_agency, id_market, permission) values(?, ?, ?)", $tblAgency);
		$deleteStmt = sprintf("delete from %s where id=?", $tblAgency);
		$findByStmt = sprintf("select *  from %s where id_agency=?", $tblAgency);
		$findByAgencyPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s A
			WHERE id_agency=:id_agency
			ORDER BY (select date from %s N where N.id=A.id_market ) DESC
			LIMIT :start,:max			
			"
		, $tblAgency, $tblNews);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByStmt = self::$PDO->prepare($findByStmt);
		$this->findByAgencyPageStmt = self::$PDO->prepare($findByAgencyPageStmt);
    } 
    function getCollection( array $raw ) {
        return new AgencyMarketCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\AgencyMarket( 
			$array['id'],
			$array['id_agency'],
			$array['id_market'],
			$array['permission']
		);
        return $obj;
    }

    protected function targetClass() {        
		return "AgencyMarket";
    }

    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdAgency(),
			$object->getIdMarket(),
			$object->getPermission()			
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdAgency(),
			$object->getIdMarket(),			
			$object->getPermission(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {
        return $this->deleteStmt->execute( $values );
    }
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new AgencyMarketCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByAgencyPage( $values ) {
		$this->findByAgencyPageStmt->bindValue(':id_agency', $values[0], \PDO::PARAM_INT);
		$this->findByAgencyPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByAgencyPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByAgencyPageStmt->execute();
        return new AgencyMarketCollection( $this->findByAgencyPageStmt->fetchAll(), $this );
    }
	
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
}
?>