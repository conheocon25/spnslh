<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class Product extends Mapper implements \MVC\Domain\ProductFinder {

    function __construct() {
        parent::__construct();
		$tblProduct = "shopc_product";
						
		$selectAllStmt = sprintf("select * from %s", $tblProduct);
		$selectStmt = sprintf("select * from %s where id=?", $tblProduct);
		$updateStmt = sprintf("update %s set 
				idsupplier=?, 
				idcategory=?, 
				idmanufacturer=?, 
				name=?, 
				code=?, 
				price1=?,
				price2=?,
				`key`=? 
			where id=?", $tblProduct);
			
		$insertStmt = sprintf("insert into %s ( 
					idsupplier, 
					idcategory, 
					idmanufacturer, 
					name, 
					code, 
					price1,
					price2,					
					`key`
				) 
				values( ?, ?, ?, ?, ?, ?, ?, ?)", $tblProduct);
		$deleteStmt = sprintf("delete from %s where id=?", $tblProduct);
		$findBySupplierStmt = sprintf("select * from %s where idsupplier=?  order by id DESC", $tblProduct);
		$findBySupplierManufacturerStmt = sprintf("select * from %s where idsupplier=? AND idmanufacturer=? order by id DESC", $tblProduct);
				
		$findByTopStmt 				= sprintf("select * from %s order by idcategory, name LIMIT 8", $tblProduct);
		$findByManufacturerTopStmt 	= sprintf("select * from %s where idmanufacturer=? order by idcategory, name LIMIT 8", $tblProduct);
		$findManufacturerStmt 		= sprintf("
				select 
					1 as id,
					1 as idsupplier,
					1 as idcategory,
					idmanufacturer,
					'abc' as name,
					'123' as code,
					0	as price1,
					0	as price2,
					'abc' as `key`
				from %s
				where
					idsupplier=?
				group by idmanufacturer
		", $tblProduct);
		
		$findManufacturer1Stmt 		= sprintf("
				select 
					1 as id,
					1 as idsupplier,
					1 as idcategory,
					idmanufacturer,
					'abc' as name,
					'123' as code,
					0	as price1,
					0	as price2,
					'abc' as `key`
				from %s
				where
					idcategory=?
				group by idmanufacturer
		", $tblProduct);
		
		$findManufacturer2Stmt 		= sprintf("
				select 
					1 as id,
					1 as idsupplier,
					1 as idcategory,
					idmanufacturer,
					'abc' as name,
					'123' as code,
					0	as price1,
					0	as price2,
					'abc' as `key`
				from 
					(
						shopc_save S INNER JOIN 
						shopc_save_product SP 
						ON S.id = SP.idsave
					) INNER JOIN
						shopc_product P
					ON 
						P.id = SP.idproduct	
				where					
					S.id=?
				group by idmanufacturer
		", $tblProduct);
		
		$findSaveCategoryStmt 		= sprintf("
				select 
					1 as id,
					1 as idsupplier,
					P.idcategory as idcategory,
					1 as idmanufacturer,
					'abc' as name,
					'123' as code,
					0	as price1,
					0	as price2,
					'abc' as `key`
				from 
					(
						shopc_save S INNER JOIN 
						shopc_save_product SP 
						ON S.id = SP.idsave
					) INNER JOIN
						shopc_product P
					ON 
						P.id = SP.idproduct	
				where					
					S.id=?
				group by P.idcategory
		", $tblProduct);
		
		$findBySaveCategoryStmt = sprintf("
				select 
					P.id as id,
					P.idsupplier as idsupplier,
					P.idcategory as idcategory,
					P.idmanufacturer as idmanufacturer,
					P.name as name,
					P.code as code,
					P.price1 as price1,
					P.price2 as price2,
					P.key as `key`
				from 
					(
						shopc_save S INNER JOIN 
						shopc_save_product SP 
						ON S.id = SP.idsave
					) INNER JOIN
						shopc_product P
					ON 
						P.id = SP.idproduct	
				where					
					S.id=? AND P.idcategory = ?
		", $tblProduct);
			
		$findByCategoryStmt = sprintf("select * from %s where idcategory=? order by idcategory, name", $tblProduct);
		$findByCategoryPageStmt = sprintf("
							SELECT *
							FROM %s
							WHERE idcategory=:idcategory
							ORDER BY name
							LIMIT :start,:max
				", $tblProduct);
		
		$findBySaveManufacturerStmt = sprintf("
			SELECT 
				P.id as id,
				P.idsupplier as idsupplier,
				P.idcategory as idcategory,
				P.idmanufacturer as idmanufacturer,
				P.name as name,
				P.code as code,
				P.price1 as price1,
				P.price2 as price2,
				P.key as `key`				
			FROM
				(
					shopc_save S INNER JOIN 
					shopc_save_product SP 
					ON S.id = SP.idsave
				) INNER JOIN
					shopc_product P
				ON 
					P.id = SP.idproduct	
			WHERE
				S.id = ? AND P.idmanufacturer = ?
		", $tblProduct);
		
		$findBySaveManufacturerPageStmt = sprintf("
			SELECT 
				P.id as id,
				P.idsupplier as idsupplier,
				P.idcategory as idcategory,
				P.idmanufacturer as idmanufacturer,
				P.name as name,
				P.code as code,
				P.price1 as price1,
				P.price2 as price2,
				P.key as `key`				
			FROM
				(
					shopc_save S INNER JOIN 
					shopc_save_product SP 
					ON S.id = SP.idsave
				) INNER JOIN
					shopc_product P
				ON 
					P.id = SP.idproduct	
			WHERE
				S.id = :idsave AND P.idmanufacturer = :idmanufacturer
			LIMIT :start,:max	
		", $tblProduct);
		
		$findBySaveStmt = sprintf("			
			SELECT 
				P.id as id,
				P.idsupplier as idsupplier,
				P.idcategory as idcategory,
				P.idmanufacturer as idmanufacturer,
				P.name as name,
				P.code as code,
				P.price1 as price1,
				P.price2 as price2,
				P.key as `key`				
			FROM
				(
					shopc_save S INNER JOIN 
					shopc_save_product SP 
					ON S.id = SP.idsave
				) INNER JOIN
					shopc_product P
				ON 
					P.id = SP.idproduct	
			WHERE
				S.id = ?
		", $tblProduct);
		
		
		$findByCategoryManufacturerStmt = sprintf("select * from %s where idcategory=? AND idmanufacturer=? order by idcategory, name", $tblProduct);
		$findByCategoryManufacturerPageStmt = sprintf("
							SELECT *
							FROM %s
							WHERE 
								idcategory=:idcategory AND
								idmanufacturer=:idmanufacturer
							ORDER BY name
							LIMIT :start,:max
				", $tblProduct);
				
				
		$findByPageStmt = sprintf("
							SELECT *
							FROM %s
							WHERE idsupplier=:idsupplier
							ORDER BY id DESC
							LIMIT :start,:max
				", $tblProduct);
		
		$findByPage1Stmt = sprintf("
							SELECT *
							FROM %s
							WHERE 	idsupplier=:idsupplier AND
									idmanufacturer=:idmanufacturer
							ORDER BY id DESC
							LIMIT :start,:max
				", $tblProduct);
				
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblProduct);
				
		$findBySamePriceStmt = sprintf("
					select * 
					from %s P
					where 
						id<>?
					order by	
						abs(P.price2-?) 
					limit 12	
				", $tblProduct);
		
		$findByNameStmt 	= sprintf("select * from %s where name like :name ORDER BY name", $tblProduct);
		$findByNamePageStmt = sprintf("select * from %s where name like :name ORDER BY name LIMIT :start,:max", $tblProduct);
		
		//----------------------------------------------------------------------------------------		
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
						
		$this->findByTopStmt 						= self::$PDO->prepare($findByTopStmt);
		$this->findByManufacturerTopStmt 			= self::$PDO->prepare($findByManufacturerTopStmt);
		
		$this->findBySupplierStmt 					= self::$PDO->prepare($findBySupplierStmt);
		$this->findBySupplierManufacturerStmt 		= self::$PDO->prepare($findBySupplierManufacturerStmt);
		
		$this->findManufacturerStmt 				= self::$PDO->prepare($findManufacturerStmt);
		$this->findManufacturer1Stmt 				= self::$PDO->prepare($findManufacturer1Stmt);
		$this->findManufacturer2Stmt 				= self::$PDO->prepare($findManufacturer2Stmt);
		
		$this->findByPageStmt 						= self::$PDO->prepare($findByPageStmt);
		$this->findByPage1Stmt 						= self::$PDO->prepare($findByPage1Stmt);
		$this->findByKeyStmt 						= self::$PDO->prepare($findByKeyStmt);
				
		$this->findByCategoryStmt 					= self::$PDO->prepare($findByCategoryStmt);
		$this->findByCategoryPageStmt 				= self::$PDO->prepare($findByCategoryPageStmt);
						
		$this->findByCategoryManufacturerStmt 		= self::$PDO->prepare($findByCategoryManufacturerStmt);
		$this->findByCategoryManufacturerPageStmt 	= self::$PDO->prepare($findByCategoryManufacturerPageStmt);
		
		$this->findBySaveStmt 						= self::$PDO->prepare($findBySaveStmt);
		$this->findSaveCategoryStmt 				= self::$PDO->prepare($findSaveCategoryStmt);
		$this->findBySaveCategoryStmt 				= self::$PDO->prepare($findBySaveCategoryStmt);
		//$this->findBySaveCategoryPageStmt 			= self::$PDO->prepare($findBySaveCategoryPageStmt);
		
		$this->findBySaveManufacturerStmt 			= self::$PDO->prepare($findBySaveManufacturerStmt);
		$this->findBySaveManufacturerPageStmt 		= self::$PDO->prepare($findBySaveManufacturerPageStmt);
		
		$this->findBySamePriceStmt 					= self::$PDO->prepare($findBySamePriceStmt);
		$this->findByNameStmt 						= self::$PDO->prepare($findByNameStmt);
		$this->findByNamePageStmt 					= self::$PDO->prepare($findByNamePageStmt);
    } 
    function getCollection( array $raw ) {return new ProductCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\Product( 
			$array['id'],
			$array['idsupplier'],
			$array['idcategory'],
			$array['idmanufacturer'],
			$array['name'],				
			$array['code'],	
			$array['price1'],	
			$array['price2'],			
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass(){return "Product";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdSupplier(),
			$object->getIdCategory(),
			$object->getIdManufacturer(),
			$object->getName(),
			$object->getCode(),
			$object->getPrice1(),
			$object->getPrice2(),
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
			$object->getIdManufacturer(),
			$object->getName(),
			$object->getCode(),
			$object->getPrice1(),
			$object->getPrice2(),
			$object->getKey(),
			$object->getId()
		);		
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}			
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBySupplier(array $values) {
        $this->findBySupplierStmt->execute( $values );
        return new ProductCollection( $this->findBySupplierStmt->fetchAll(), $this );
    }
	
	function findBySupplierManufacturer(array $values) {
        $this->findBySupplierManufacturerStmt->execute( $values );
        return new ProductCollection( $this->findBySupplierManufacturerStmt->fetchAll(), $this );
    }
	
	function findByTop(array $values) {
        $this->findByTopStmt->execute( $values );
        return new ProductCollection( $this->findByTopStmt->fetchAll(), $this );
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
		$this->findByPage1Stmt->bindValue(':idmanufacturer', $values[1], \PDO::PARAM_INT);
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
	
	function findByCategoryManufacturer(array $values) {
        $this->findByCategoryManufacturerStmt->execute( $values );
        return new ProductCollection( $this->findByCategoryManufacturerStmt->fetchAll(), $this );
    }
	
	function findByCategoryManufacturerPage( $values ){
		$this->findByCategoryManufacturerPageStmt->bindValue(':idcategory', $values[0], \PDO::PARAM_INT);
		$this->findByCategoryManufacturerPageStmt->bindValue(':idmanufacturer', $values[1], \PDO::PARAM_INT);
		$this->findByCategoryManufacturerPageStmt->bindValue(':start', ((int)($values[2])-1)*(int)($values[3]), \PDO::PARAM_INT);
		$this->findByCategoryManufacturerPageStmt->bindValue(':max', (int)($values[3]), \PDO::PARAM_INT);
		$this->findByCategoryManufacturerPageStmt->execute();
        return new ProductCollection( $this->findByCategoryManufacturerPageStmt->fetchAll(), $this );
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
			
	//DANH SÁCH CÁC NHÀ SẢN XUẤT
	function findByManufacturerTop( $values ) {
		$this->findByManufacturerTopStmt->execute( $values );
        return new ProductCollection( $this->findByManufacturerTopStmt->fetchAll(), $this );
    }
	
	function findManufacturer( $values ) {
		$this->findManufacturerStmt->execute( $values );
        return new ProductCollection( $this->findManufacturerStmt->fetchAll(), $this );
    }
	
	function findManufacturer1( $values ) {
		$this->findManufacturer1Stmt->execute( $values );
        return new ProductCollection( $this->findManufacturer1Stmt->fetchAll(), $this );
    }
	
	function findManufacturer2( $values ) {
		$this->findManufacturer2Stmt->execute( $values );
        return new ProductCollection( $this->findManufacturer2Stmt->fetchAll(), $this );
    }
	
	//TÌM CÁC SẢN PHẨM KHUYẾN MÃI
	function findBySave( $values ) {
		$this->findBySaveStmt->execute( $values );
        return new ProductCollection( $this->findBySaveStmt->fetchAll(), $this );
    }	
	function findSaveCategory( $values ) {
		$this->findSaveCategoryStmt->execute( $values );
        return new ProductCollection( $this->findSaveCategoryStmt->fetchAll(), $this );
    }
	function findBySaveCategory(array $values){
        $this->findBySaveCategoryStmt->execute( $values );
        return new ProductCollection( $this->findBySaveCategoryStmt->fetchAll(), $this );
    }
		
	function findBySaveManufacturer(array $values) {
        $this->findBySaveManufacturerStmt->execute( $values );
        return new ProductCollection( $this->findBySaveManufacturerStmt->fetchAll(), $this );
    }
	
	function findBySaveManufacturerPage( $values ){
		$this->findBySaveManufacturerPageStmt->bindValue(':idsave', $values[0], \PDO::PARAM_INT);
		$this->findBySaveManufacturerPageStmt->bindValue(':idmanufacturer', $values[1], \PDO::PARAM_INT);
		$this->findBySaveManufacturerPageStmt->bindValue(':start', ((int)($values[2])-1)*(int)($values[3]), \PDO::PARAM_INT);
		$this->findBySaveManufacturerPageStmt->bindValue(':max', (int)($values[3]), \PDO::PARAM_INT);
		$this->findBySaveManufacturerPageStmt->execute();
        return new ProductCollection( $this->findBySaveManufacturerPageStmt->fetchAll(), $this );
    }	
	
	function findBySamePrice( $values ){
		$this->findBySamePriceStmt->execute( $values );
        return new ProductCollection( $this->findBySamePriceStmt->fetchAll(), $this );
    }
	
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
	
	function findByCondition( $Cond ){
		$findByConditionStmt = "select * from shopc_product where $Cond ORDER BY name";		
		$this->findByConditionStmt 		= self::$PDO->prepare($findByConditionStmt);
		$this->findByConditionStmt->execute(array());
        return new ProductCollection( $this->findByConditionStmt->fetchAll(), $this );
    }
	
	function findByConditionPage( $values ){
		$Cond 	= $values[0];
		$start 	= ((int)($values[1])-1)*(int)($values[2]);
		$max	=  $values[2];		
		$findByConditionPageStmt = "select * from shopc_product where $Cond ORDER BY name limit $start, $max";
		$this->findByConditionPageStmt 		= self::$PDO->prepare($findByConditionPageStmt);
		$this->findByConditionPageStmt->execute(array());
        return new ProductCollection( $this->findByConditionPageStmt->fetchAll(), $this );
    }
	
}
?>