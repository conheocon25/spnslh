<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class CategoryVideo extends Mapper implements \MVC\Domain\CategoryVideoFinder{

    function __construct() {
        parent::__construct();
		
		$tblCategoryVideo = "tbl_category_video";
						
		$selectAllStmt 	= sprintf("select * from %s order by id_buddha, `order`", $tblCategoryVideo);
		$selectStmt 	= sprintf("select * from %s where id=?", $tblCategoryVideo);
		$updateStmt 	= sprintf("update %s set id_buddha=?, name=?, image=?, `order`=?, `key`=? where id=?", $tblCategoryVideo);
		$insertStmt 	= sprintf("insert into %s ( id_buddha, name, image, `order`, `key`) values(?, ?, ?, ?, ?)", $tblCategoryVideo);
		$deleteStmt 	= sprintf("delete from %s where id=?", $tblCategoryVideo);
		$findByStmt 	= sprintf("SELECT * FROM  %s WHERE id_buddha=? ORDER BY `order`, name", $tblCategoryVideo);
		$findByPageStmt = sprintf("SELECT * FROM  %s WHERE id_buddha=:id_buddha ORDER BY `order`, name	LIMIT :start,:max", $tblCategoryVideo);
		$findByKeyStmt 	= sprintf("select *  from %s where `key`=?", $tblCategoryVideo);		
		
		$findByOrderNamePageStmt	= sprintf("SELECT * FROM  %s WHERE id_buddha=:id_buddha ORDER BY name		LIMIT :start,:max", $tblCategoryVideo);
		$findByOrderVideoPageStmt 	= sprintf("						
			SELECT 
				id,
				id_buddha,
				name,							
				image,
				`order`,			
				`key`,
				(
					select 
						count(id)
					from 
						tbl_video V
					where
						V.id_category= CV.id
				) as `count`
			FROM  
				tbl_category_video CV
			WHERE 
				id_buddha=:id_buddha
			ORDER BY 
				`count` DESC
			LIMIT :start,:max			
		", $tblCategoryVideo);
				
        $this->selectAllStmt 		= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 			= self::$PDO->prepare($selectStmt);
        $this->updateStmt 			= self::$PDO->prepare($updateStmt);
        $this->insertStmt 			= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 			= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 			= self::$PDO->prepare($findByStmt);
		$this->findByPageStmt 		= self::$PDO->prepare($findByPageStmt);
		$this->findByKeyStmt 		= self::$PDO->prepare($findByKeyStmt);							
		
		$this->findByOrderNamePageStmt 	= self::$PDO->prepare($findByOrderNamePageStmt);
		$this->findByOrderVideoPageStmt = self::$PDO->prepare($findByOrderVideoPageStmt);
		
		
    } 
    function getCollection( array $raw ) {return new CategoryVideoCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {		
        $obj = new \MVC\Domain\CategoryVideo( 
			$array['id'],
			$array['id_buddha'],
			$array['name'],
			$array['image'],
			$array['order'],			
			$array['key']
		);
        return $obj;
    }
	
    protected function targetClass() {  return "CategoryVideo";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getImage(),
			$object->getOrder(),			
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getName(),
			$object->getImage(),
			$object->getOrder(),			
			$object->getKey(),
			$object->getId()
		);				
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}	
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy( $values ) {				
		$this->findByStmt->execute($values);
        return new CategoryVideoCollection( $this->findByStmt->fetchAll(), $this );
    }
	
	function findByOrderName( $values ) {				
		$this->findByOrderNameStmt->execute($values);
        return new CategoryVideoCollection( $this->findByOrderNameStmt->fetchAll(), $this );
    }
			
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_buddha', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new CategoryVideoCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByOrderNamePage( $values ) {
		$this->findByOrderNamePageStmt->bindValue(':id_buddha', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByOrderNamePageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderNamePageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderNamePageStmt->execute();
        return new CategoryVideoCollection( $this->findByOrderNamePageStmt->fetchAll(), $this );
    }
	
	function findByOrderVideoPage( $values ) {
		$this->findByOrderVideoPageStmt->bindValue(':id_buddha', (int)($values[0]), \PDO::PARAM_INT);
		$this->findByOrderVideoPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderVideoPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderVideoPageStmt->execute();
        return new CategoryVideoCollection( $this->findByOrderVideoPageStmt->fetchAll(), $this );
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
			
}
?>