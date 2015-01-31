<?php
namespace MVC\Mapper;

require_once( "mvc/base/Mapper.php" );
class RssLink extends Mapper implements \MVC\Domain\RssLinkFinder{

    function __construct() {
        parent::__construct();
				
		$tblRssLink = "tbl_rss_link";
		
		$selectAllStmt 		= sprintf("select * from %s where `enable`=1", $tblRssLink);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblRssLink);
		$updateStmt 		= sprintf("update %s set id_category_post=?, name=?, `weburl`=?, rssurl=?, type=?, `enable`=?, classcontentname=?, classauthor=?, imgpath=? where id=?", $tblRssLink);
		$insertStmt 		= sprintf("insert into %s ( id_category_post, name, `weburl`, rssurl, type, `enable`, classcontentname, classauthor, imgpath) values(?, ?, ?, ?, ?, ?, ?, ?, ?)", $tblRssLink);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblRssLink);
		$findByStmt 		= sprintf("select *  from %s where id_category_post=?", $tblRssLink);
		$findByTypeStmt 	= sprintf("SELECT * FROM  %s WHERE id_category_post=:id_category_post LIMIT :start,:max", $tblRssLink);
		$findByEnableStmt 		= sprintf("select *  from %s where `enable`=?", $tblRssLink);	
						
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByEnableStmt = self::$PDO->prepare($findByEnableStmt);
		$this->findByTypeStmt 	= self::$PDO->prepare($findByTypeStmt);
    }
	
    function getCollection( array $raw ) {return new RssLinkCollection( $raw, $this );}
    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\RssLink( 
			$array['id'],			
			$array['id_category_post'],
			$array['name'],
			$array['weburl'],
			$array['rssurl'],
			$array['type'],
			$array['enable'],
			$array['classcontentname'],
			$array['classauthor'],
			$array['imgpath']
		);
        return $obj;
    }

    protected function targetClass() {return "RssLink";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategoryPost(),
			$object->getName(),			
			$object->getWeburl(),
			$object->getRssurl(),
			$object->getType(),
			$object->getEnable(),
			$object->getClassContentName(),
			$object->getClassauthor(),
			$object->getImgPath()
		);
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array(
			$object->getIdCategoryPost(),
			$object->getName(),
			$object->getWeburl(),
			$object->getRssurl(),
			$object->getType(),
			$object->getEnable(),
			$object->getClassContentName(),
			$object->getClassauthor(),
			$object->getImgPath(),
			$object->getId()			
		);
        $this->updateStmt->execute( $values );
    }
	protected function doDelete(array $values) {return $this->deleteStmt->execute( $values );}

    function selectStmt() {return $this->selectStmt;}
    function selectAllStmt() {return $this->selectAllStmt;}	
	
	function findBy( $values ){
		$this->findByStmt->execute($values);
        return new RssLinkCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByIdCategory( $values ) {				
		$this->findByTypeStmt->bindValue(':id_category_post', $values[0], \PDO::PARAM_INT);
		$this->findByTypeStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByTypeStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByTypeStmt->execute();
        return new RssLinkCollection( $this->findByTypeStmt->fetchAll(), $this );
    }
	
	function findByEnable( $values ) {	
		$this->findByEnableStmt->execute( array($values) );
        $array = $this->findByEnableStmt->fetch();
        $this->findByEnableStmt->closeCursor();
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->doCreateObject( $array );
        return $object;		
    }
}
?>