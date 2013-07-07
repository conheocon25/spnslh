<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class NewsMarket extends Mapper implements \MVC\Domain\NewsMarketFinder {

    function __construct() {
        parent::__construct();
				
		$tblNewsMarket = "saigonlandhouse_news_market";
		
		$selectAllStmt = sprintf("select * from %s ORDER BY type DESC, date DESC", $tblNewsMarket);
		$selectStmt = sprintf("select *  from %s where id=?", $tblNewsMarket);
		$updateStmt = sprintf("update %s set id_category=?, id_estate=?, price=?, id_province=?, id_district=?, date=?, content=?, title=?, type=?, X=?, Y=? where id=?", $tblNewsMarket);
		$insertStmt = sprintf("insert into %s ( id_category, id_estate, price, id_province, id_district, date, content, title, type, X, Y) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblNewsMarket);
		$deleteStmt = sprintf("delete from %s where id=?", $tblNewsMarket);
		$findByCategoryStmt = sprintf("select *  from %s where id_category=?", $tblNewsMarket);
		$findByCategoryTop4Stmt = sprintf("select *  from %s where id_category=? ORDER BY date desc LIMIT 4", $tblNewsMarket);
				
		$findByPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 			
			ORDER BY date desc
			LIMIT :start,:max"
		, $tblNewsMarket);
		
		$findByCategoryPageStmt = sprintf(
			"SELECT 
				*
			FROM 
				%s 
			WHERE
				id_category=:id_category
			ORDER BY date desc
			LIMIT :start,:max"
		, $tblNewsMarket);
		
        $this->selectAllStmt = self::$PDO->prepare($selectAllStmt);
        $this->selectStmt = self::$PDO->prepare($selectStmt);
        $this->updateStmt = self::$PDO->prepare($updateStmt);
        $this->insertStmt = self::$PDO->prepare($insertStmt);
		$this->deleteStmt = self::$PDO->prepare($deleteStmt);
		$this->findByCategoryStmt = self::$PDO->prepare($findByCategoryStmt);
		$this->findByCategoryTop4Stmt = self::$PDO->prepare($findByCategoryTop4Stmt);
		$this->findByPageStmt = self::$PDO->prepare($findByPageStmt);
		$this->findByCategoryPageStmt = self::$PDO->prepare($findByCategoryPageStmt);

    } 
    function getCollection( array $raw ) {
        return new NewsMarketCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\NewsMarket( 
			$array['id'],
			$array['id_category'],
			$array['id_estate'],
			$array['price'],			
			$array['id_province'],
			$array['id_district'],
			$array['date'],
			$array['content'],
			$array['title'],
			$array['type'],
			$array['X'],
			$array['Y']
		);
        return $obj;
    }

    protected function targetClass() {return "NewsMarket";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getIdEstate(),
			$object->getPrice(),			
			$object->getIdProvince(),
			$object->getIdDistrict(),			
			$object->getDate(),
			$object->getContent(),
			$object->getTitle(),
			$object->getType(),
			$object->getX(),
			$object->getY()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getIdEstate(),
			$object->getPrice(),
			$object->getIdProvince(),
			$object->getIdDistrict(),
			$object->getDate(),
			$object->getContent(),
			$object->getTitle(),
			$object->getType(),
			$object->getX(),
			$object->getY(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }

	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findByCategory( $values ){
        $this->findByCategoryStmt->execute( $values );
        return new NewsMarketCollection( $this->findByCategoryStmt->fetchAll(), $this);
    }
	
	function findByCategoryTop4( $values ){
        $this->findByCategoryTop4Stmt->execute( $values );
        return new NewsMarketCollection( $this->findByCategoryTop4Stmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {		
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new NewsMarketCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByCategoryPage( $values ) {		
		$this->findByCategoryPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new NewsMarketCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
    }
}
?>