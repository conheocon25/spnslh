<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Product extends Mapper implements \MVC\Domain\ProductFinder {

    function __construct() {
        parent::__construct();
		$tblProduct 				= "tbl_product";
						
		$selectAllStmt 				= sprintf("select * from %s", $tblProduct);
		$selectStmt 				= sprintf("select * from %s WHERE id=?", $tblProduct);
		$updateStmt 				= sprintf("update %s set idsupplier=?, idcategory=?, idestate=?, iddistrict=?, name=?, `datetime`=?, price=?, address=?, `key`=? where id=?", $tblProduct);
		$insertStmt 				= sprintf("insert into %s ( idsupplier, idcategory, idestate, iddistrict, name, `datetime`, price, address, `key`) values( ?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblProduct);
		$deleteStmt 				= sprintf("delete from %s WHERE id=?", $tblProduct);
						
		$findBySupplierStmt 		= sprintf("select * from %s WHERE idsupplier=?  order by `datetime` DESC", $tblProduct);
		$findBySupplierPageStmt 	= sprintf("SELECT * FROM %s WHERE idsupplier=:idsupplier ORDER BY `datetime` DESC LIMIT :start,:max", $tblProduct);
		
		$findBySupplierCategoryStmt = sprintf("select * from %s WHERE idsupplier=? AND idcategory=? order by id DESC", $tblProduct);
		$findByCategoryTopStmt		= sprintf("
					SELECT * 
					FROM %s 
					WHERE 
						idcategory IN (select id from tbl_category1 where id_category=?)
					ORDER BY `datetime` 
					DESC 
					LIMIT 6
		", $tblProduct);
		
		$findByCategoryStmt 		= sprintf("select * from %s WHERE idcategory=? order by idcategory, name", $tblProduct);
		$findByCategoryPageStmt 	= sprintf("SELECT * FROM %s WHERE idcategory=:idcategory ORDER BY name LIMIT :start,:max", $tblProduct);
				
		$findByPageStmt 			= sprintf("SELECT * FROM %s WHERE idsupplier=:idsupplier ORDER BY id DESC LIMIT :start,:max", $tblProduct);		
		$findByPage1Stmt 			= sprintf("SELECT * FROM %s WHERE 	idsupplier=:idsupplier AND idcategory=:idcategory ORDER BY id DESC LIMIT :start,:max", $tblProduct);				
		$findByKeyStmt 				= sprintf("select *  from %s WHERE `key`=?", $tblProduct);
				
		$findByNameStmt 			= sprintf("select * from %s WHERE name like :name ORDER BY name", $tblProduct);
		$findByNamePageStmt 		= sprintf("select * from %s WHERE name like :name ORDER BY name LIMIT :start,:max", $tblProduct);
		
		//----------------------------------------------------------------------------------------		
        $this->selectAllStmt 						= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 							= self::$PDO->prepare($selectStmt);
        $this->updateStmt 							= self::$PDO->prepare($updateStmt);
        $this->insertStmt 							= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 							= self::$PDO->prepare($deleteStmt);
						
		$this->findByCategoryTopStmt 				= self::$PDO->prepare($findByCategoryTopStmt);
						
		$this->findBySupplierStmt 					= self::$PDO->prepare($findBySupplierStmt);
		$this->findBySupplierPageStmt 				= self::$PDO->prepare($findBySupplierPageStmt);
								
		$this->findByPageStmt 						= self::$PDO->prepare($findByPageStmt);
		$this->findByPage1Stmt 						= self::$PDO->prepare($findByPage1Stmt);
		$this->findByKeyStmt 						= self::$PDO->prepare($findByKeyStmt);
				
		$this->findByCategoryStmt 					= self::$PDO->prepare($findByCategoryStmt);
		$this->findByCategoryPageStmt 				= self::$PDO->prepare($findByCategoryPageStmt);
		
		$this->findBySupplierCategoryStmt 			= self::$PDO->prepare($findBySupplierCategoryStmt);
		
		$this->findByNameStmt 						= self::$PDO->prepare($findByNameStmt);
		$this->findByNamePageStmt 					= self::$PDO->prepare($findByNamePageStmt);
    } 
    function getCollection( array $raw ) {return new ProductCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Product( 
			$array['id'],
			$array['idsupplier'],
			$array['idcategory'],			
			$array['idestate'],
			$array['iddistrict'],
			$array['name'],
			$array['datetime'],
			$array['price'],
			$array['address'],
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass(){return "Product";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSupplier(),
			$object->getIdCategory(),			
			$object->getIdEstate(),			
			$object->getIdDistrict(),
			$object->getName(),
			$object->getDateTime(),			
			$object->getPrice(),
			$object->getAddress(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ){
        $values = array( 
			$object->getIdSupplier(),
			$object->getIdCategory(),
			$object->getIdEstate(),
			$object->getIdDistrict(),
			$object->getName(),
			$object->getDateTime(),			
			$object->getPrice(),
			$object->getAddress(),
			$object->getKey(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) 	{return $this->deleteStmt->execute( $values );}			
    function selectStmt() 						{return $this->selectStmt;}
    function selectAllStmt() 					{return $this->selectAllStmt;}
	
	function search($IdCategory, $IdEstate, $IdDistrict, $IdDirection, $IdPrice, $IdArea) {				
		$rangePrice = array(
			array(0, 1000000 ),
			array(1000000, 3000000),
			array(3000000, 5000000),
			array(5000000, 10000000),
			array(10000000, 15000000),
			array(20000000, 30000000),
			array(30000000, 40000000),
			array(40000000, 60000000),
			array(60000000, 80000000),
			array(80000000, 100000000),
			array(100000000, 300000000),
			array(300000000, 500000000),
			array(500000000, 800000000),
			array(800000000, 1000000000),
			array(1000000000, 2000000000),
			array(2000000000, 3000000000),
			array(3000000000, 4000000000),
			array(4000000000, 5000000000)
		);
		
		$searchSQL 			= "SELECT * FROM tbl_product WHERE ";
		$whereCategorySQL 	= " idcategory=".$IdCategory;
		$whereEstateSQL 	= " idestate=".$IdEstate;
		$whereDistrictSQL 	= " iddistrict=".$IdDistrict;
		$whereDirectionSQL 	= " iddirection=".$IdDirection;
		$wherePriceSQL 		= " price>=".$rangePrice[isset($IdPrice)?$IdPrice:0][0]." AND price<".$rangePrice[isset($IdPrice)?$IdPrice:0][1];
		$orderSQL 			= " ORDER BY datetime DESC";
		
		$searchSQL 			= $searchSQL.$whereCategorySQL;		
		if ($IdEstate>0)	{$searchSQL 		= $searchSQL." AND ".$whereEstateSQL;}
		if ($IdDistrict>0)	{$searchSQL 		= $searchSQL." AND ".$whereDistrictSQL;}
		//if ($IdDirection>0)	{$searchSQL 		= $searchSQL." AND ".$whereDirectionSQL;}
		if ($IdPrice>0)		{$searchSQL 		= $searchSQL." AND ".$wherePriceSQL;}
		
		$searchSQL 			= $searchSQL.$orderSQL;
		
		$searchStmt 		= self::$PDO->prepare($searchSQL);
		$searchStmt->execute();
        return new ProductCollection( $searchStmt->fetchAll(), $this );
    }
	function searchPage( $IdCategory, $IdEstate, $IdDistrict, $IdDirection, $IdPrice, $IdArea, $Page, $NRow){
		/*
		$this->searchPageStmt->bindValue(':idcategory', $values[0], \PDO::PARAM_INT);
		$this->searchPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->searchPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->searchPageStmt->execute();
        return new ProductCollection( $this->searchPageStmt->fetchAll(), $this );
		*/
		$rangePrice = array(
			array(0			, 0 ),
			array(0			, 1000000 ),
			array(1000000	, 3000000),
			array(3000000	, 5000000),
			array(5000000	, 10000000),
			array(10000000	, 15000000),
			array(20000000	, 30000000),
			array(30000000	, 40000000),
			array(40000000	, 60000000),
			array(60000000	, 80000000),
			array(80000000	, 100000000),
			array(100000000	, 300000000),
			array(300000000	, 500000000),
			array(500000000	, 800000000),
			array(800000000	, 1000000000),
			array(1000000000, 2000000000),
			array(2000000000, 3000000000),
			array(3000000000, 4000000000),
			array(4000000000, 5000000000)
		);
		
		$searchSQL 			= "SELECT * FROM tbl_product WHERE ";
		$whereCategorySQL 	= " idcategory=".$IdCategory;
		$whereEstateSQL 	= " idestate=".$IdEstate;
		$whereDistrictSQL 	= " iddistrict=".$IdDistrict;
		$whereDirectionSQL 	= " iddirection=".$IdDirection;
		$wherePriceSQL 		= " price>=".$rangePrice[$IdPrice][0]." AND price<".$rangePrice[$IdPrice][1];
		$orderSQL 			= " ORDER BY datetime DESC";
		
		$searchSQL 			= $searchSQL.$whereCategorySQL;		
		if ($IdEstate>0)	{$searchSQL 		= $searchSQL." AND ".$whereEstateSQL;}
		if ($IdDistrict>0)	{$searchSQL 		= $searchSQL." AND ".$whereDistrictSQL;}
		//if ($IdDirection>0)	{$searchSQL 		= $searchSQL." AND ".$whereDirectionSQL;}
		if ($IdPrice>0)		{$searchSQL 		= $searchSQL." AND ".$wherePriceSQL;}
		
		$searchSQL 			= $searchSQL.$orderSQL;
		
		$searchStmt 		= self::$PDO->prepare($searchSQL);
		$searchStmt->execute();
        return new ProductCollection( $searchStmt->fetchAll(), $this );
    }
	
	function findBySupplier(array $values) {
        $this->findBySupplierStmt->execute( $values );
        return new ProductCollection( $this->findBySupplierStmt->fetchAll(), $this );
    }
	function findBySupplierPage( $values ){
		$this->findBySupplierPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findBySupplierPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findBySupplierPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findBySupplierPageStmt->execute();
        return new ProductCollection( $this->findBySupplierPageStmt->fetchAll(), $this );
    }
	
	function findBySupplierCategory(array $values) {
        $this->findBySupplierCategoryStmt->execute( $values );
        return new ProductCollection( $this->findBySupplierCategoryStmt->fetchAll(), $this );
    }
	
	function findByCategoryTop(array $values) {
        $this->findByCategoryTopStmt->execute( $values );
        return new ProductCollection( $this->findByCategoryTopStmt->fetchAll(), $this );
    }
	
	function findByPage( $values ){
		$this->findByPageStmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);		
		$this->findByPageStmt->execute();
        return new ProductCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByPage1( $values ){		
		$this->findByPage1Stmt->bindValue(':idsupplier', $values[0], \PDO::PARAM_INT);
		$this->findByPage1Stmt->bindValue(':idcategory', $values[1], \PDO::PARAM_INT);
		$this->findByPage1Stmt->bindValue(':start', ((int)($values[2])-1)*(int)($values[3]), \PDO::PARAM_INT);
		$this->findByPage1Stmt->bindValue(':max', (int)($values[3]), \PDO::PARAM_INT);		
		$this->findByPage1Stmt->execute();
        return new ProductCollection( $this->findByPage1Stmt->fetchAll(), $this );
    }
	
	function findByCategory(array $values) {
        $this->findByCategoryStmt->execute( $values );
        return new ProductCollection( $this->findByCategoryStmt->fetchAll(), $this );
    }
	
	function findByCategoryPage( $values ){		
		$this->findByCategoryPageStmt->bindValue(':idcategory', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByCategoryPageStmt->execute();
        return new ProductCollection( $this->findByCategoryPageStmt->fetchAll(), $this );
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
				
	//TÌM CÁC SẢN PHẨM KHUYẾN MÃI					
	function findByName( $values ){
		$this->findByNameStmt->bindValue(':name', $values[0]."%", \PDO::PARAM_STR);
		$this->findByNameStmt->execute();
        return new ProductCollection( $this->findByNameStmt->fetchAll(), $this );
    }
	
	function findByNamePage( $values ){		
		$this->findByNamePageStmt->bindValue(':name', $values[0]."%", \PDO::PARAM_STR);		
		$this->findByNamePageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByNamePageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByNamePageStmt->execute();
        return new ProductCollection( $this->findByNamePageStmt->fetchAll(), $this );
    }	
}
?>