<?php
namespace MVC\Mapper;
require_once( "mvc/base/Mapper.php" );
class Video extends Mapper implements \MVC\Domain\VideoFinder{

    function __construct() {
        parent::__construct();				
		$tblVideo 		= "tbl_video";
		
		$selectAllStmt 		= sprintf("select * from %s ORDER BY `order`", $tblVideo);
		$selectStmt 		= sprintf("select *  from %s where id=?", $tblVideo);
		$updateStmt 		= sprintf("update %s set 
										id_category=?, 
										`title`=?, 												
										`info`=?, 												
										`time`=?, 												
										`id_youtube`=?,
										`viewed`=?,
										`liked`=?, 												
										`key`=? 
									where 
										id=?", $tblVideo);
		$insertStmt 		= sprintf("insert into %s ( 
										id_category, 
										`title`, 
										`info`, 
										`time`, 
										`id_youtube`, 
										`viewed`, 
										`liked`, 
										`key`) values(?, ?, ?, ?, ?, ?, ?, ?)", $tblVideo);
		$deleteStmt 		= sprintf("delete from %s where id=?", $tblVideo);				
		$findByStmt 		= sprintf("select *  from %s where id_category=? ORDER BY `viewed` DESC, 'liked' DESC", $tblVideo);
		$findByKeyStmt 		= sprintf("select *  from %s where `key`=?", $tblVideo);
		
		$findByPageStmt 			= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `viewed` DESC, 'liked' DESC LIMIT :start,:max", $tblVideo);
		$findByOrderNamePageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `title` LIMIT :start,:max", $tblVideo);
		$findByOrderViewedPageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `viewed` DESC  LIMIT :start,:max", $tblVideo);
		$findByOrderLikedPageStmt 	= sprintf("SELECT * FROM  %s where id_category=:id_category ORDER BY `liked` DESC LIMIT :start,:max", $tblVideo);
		
		$findByLastestStmt 	= sprintf("			
			SELECT * 
				FROM `tbl_video` 
				WHERE 
					id_category IN (SELECT id FROM tbl_category_video CV WHERE CV.id_buddha=?)
				ORDER BY
					`time`	DESC
				LIMIT 12	
		", $tblVideo);
		
		$findByPopularStmt 	= sprintf("			
			SELECT * 
				FROM `tbl_video` 
				WHERE 
					id_category IN (SELECT id FROM tbl_category_video CV WHERE CV.id_buddha=?)
				ORDER BY
					`viewed` DESC, `liked` DESC
				LIMIT 12	
		", $tblVideo);
				
        $this->selectAllStmt 	= self::$PDO->prepare($selectAllStmt);
        $this->selectStmt 		= self::$PDO->prepare($selectStmt);
        $this->updateStmt 		= self::$PDO->prepare($updateStmt);
        $this->insertStmt 		= self::$PDO->prepare($insertStmt);
		$this->deleteStmt 		= self::$PDO->prepare($deleteStmt);
		$this->findByStmt 		= self::$PDO->prepare($findByStmt);
		$this->findByKeyStmt 	= self::$PDO->prepare($findByKeyStmt);
		$this->findByPageStmt 	= self::$PDO->prepare($findByPageStmt);
		$this->findByOrderNamePageStmt 		= self::$PDO->prepare($findByOrderNamePageStmt);
		$this->findByOrderViewedPageStmt 	= self::$PDO->prepare($findByOrderViewedPageStmt);
		$this->findByOrderLikedPageStmt 	= self::$PDO->prepare($findByOrderLikedPageStmt);
		$this->findByLastestStmt 	= self::$PDO->prepare($findByLastestStmt);
		$this->findByPopularStmt 	= self::$PDO->prepare($findByPopularStmt);
		
    } 
    function getCollection( array $raw ) {return new VideoCollection( $raw, $this );}

    protected function doCreateObject( array $array ) {
        $obj = new \MVC\Domain\Video( 
			$array['id'],
			$array['id_category'],
			$array['title'],
			$array['info'],
			$array['time'],
			$array['id_youtube'],
			$array['viewed'],
			$array['liked'],
			$array['key']
		);
        return $obj;
    }

    protected function targetClass() { return "Video";}
    protected function doInsert( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getTitle(),
			$object->getInfo(),
			$object->getTime(),
			$object->getIdYouTube(),
			$object->getViewed(),
			$object->getLiked(),
			$object->getKey()
		); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    protected function doUpdate( \MVC\Domain\Object $object ) {
        $values = array( 
			$object->getIdCategory(),
			$object->getTitle(),			
			$object->getInfo(),
			$object->getTime(),
			$object->getIdYouTube(),
			$object->getViewed(),
			$object->getLiked(),
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
        return new VideoCollection( $this->findByStmt->fetchAll(), $this);
    }
	
	function findByLastest( $values ){
        $this->findByLastestStmt->execute( $values );
        return new VideoCollection( $this->findByLastestStmt->fetchAll(), $this);
    }
	
	function findByPopular( $values ){
        $this->findByPopularStmt->execute( $values );
        return new VideoCollection( $this->findByPopularStmt->fetchAll(), $this);
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
	
	function findByPage( $values ) {
		$this->findByPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByPageStmt->execute();
        return new VideoCollection( $this->findByPageStmt->fetchAll(), $this );
    }
	
	function findByOrderNamePage( $values ) {
		$this->findByOrderNamePageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByOrderNamePageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderNamePageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderNamePageStmt->execute();
        return new VideoCollection( $this->findByOrderNamePageStmt->fetchAll(), $this );
    }
	
	function findByOrderViewedPage( $values ) {
		$this->findByOrderViewedPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByOrderViewedPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderViewedPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderViewedPageStmt->execute();
        return new VideoCollection( $this->findByOrderViewedPageStmt->fetchAll(), $this );
    }
	
	function findByOrderLikedPage( $values ) {
		$this->findByOrderLikedPageStmt->bindValue(':id_category', $values[0], \PDO::PARAM_INT);
		$this->findByOrderLikedPageStmt->bindValue(':start', ((int)($values[1])-1)*(int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderLikedPageStmt->bindValue(':max', (int)($values[2]), \PDO::PARAM_INT);
		$this->findByOrderLikedPageStmt->execute();
        return new VideoCollection( $this->findByOrderLikedPageStmt->fetchAll(), $this );
    }
}
?>