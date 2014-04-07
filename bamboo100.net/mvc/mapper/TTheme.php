<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class TTheme extends Mapper implements \MVC\Domain\TThemeFinder {
    function __construct() {
        parent::__construct();			
		$tblTTheme = "tbl_ttheme";
		
		$selectAllStmt 			= sprintf("select * from %s ORDER BY name", 						$tblTTheme);
		$selectStmt 			= sprintf("select *  from %s where id=?", 							$tblTTheme);
		$updateStmt 			= sprintf("update %s set id_category=?, name=?, note=?, `order`=?, `key`=? where id=?", 		$tblTTheme);
		$insertStmt 			= sprintf("insert into %s ( id_category, name, note, `order`, `key`) values(?, ?, ?, ?, ?)",	$tblTTheme);
		$deleteStmt 			= sprintf("delete from %s where id=?", 								$tblTTheme);		
		$findByStmt 			= sprintf("select *  from %s where id_category=? order by `order`", $tblTTheme);
		$findByPageStmt 		= sprintf("SELECT * FROM  %s ORDER BY name LIMIT :start,:max", 		$tblTTheme);
		
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		
    } 
    function getCollection( array $raw ) {return new TThemeCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\TTheme( 
			$array['id'], 
			$array['id_category'], 
			$array['name'],
			$array['note'],
			$array['order'],			
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() {return "TTheme";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),	
			$object->getName(),	
			$object->getNote(),			
			$object->getOrder(),
			$object->getKey(),
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),	
			$object->getName(),						
			$object->getNote(),
			$object->getOrder(),
			$object->getKey(),
			$object->getId()
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}	
    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}
	
	function findBy( $values ){
        $this->findByStmt->execute( $values );
        return new TThemeCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':start', ((int)($values[0])-1)*(int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[1]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new TThemeCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
}
?>