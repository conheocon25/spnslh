<?php
namespace MVC\Domain;
if ( ! isset( $EG_DISABLE_INCLUDES ) ) {
	
	require_once( "mvc/mapper/Ads.php"		);
	require_once( "mvc/mapper/Cafe.php"		);
	require_once( "mvc/mapper/Karaoke.php"	);
	require_once( "mvc/mapper/Pagoda.php"	);
	require_once( "mvc/mapper/ZenMusic.php"	);
	
	require_once( "mvc/mapper/TCategory.php");
	require_once( "mvc/mapper/TTheme.php"	);
	
	require_once( "mvc/mapper/Store.php"	);
	require_once( "mvc/mapper/MStore.php"	);
	
	require_once( "mvc/mapper/Restaurant.php"	);
	require_once( "mvc/mapper/MRestaurant.php"	);
	
	require_once( "mvc/mapper/Hotel.php"	);
	require_once( "mvc/mapper/MHotel.php"	);
	
	require_once( "mvc/mapper/CChess.php"	);
	require_once( "mvc/mapper/CBook.php"	);
	require_once( "mvc/mapper/CSet.php"		);
	require_once( "mvc/mapper/CStep.php"	);
	
	require_once( "mvc/mapper/Post.php"		);	
	require_once( "mvc/mapper/User.php"		);
	require_once( "mvc/mapper/Config.php"	);
	require_once( "mvc/mapper/Guest.php"	);
	
}

class HelperFactory {
    static function getFinder( $type ) {
        $type = preg_replace( "/^.*_/", "", $type );
        $mapper = "\\MVC\\Mapper\\{$type}";
        if ( class_exists( $mapper ) ) {
            return new $mapper();
        }
        throw new \MVC\Base\AppException( "Không biết: $mapper" );
    }

    static function getCollection( $type ) {
        $type = preg_replace( "/^.*_/", "", $type );
        $collection = "\\MVC\\Mapper\\{$type}Collection";
        if ( class_exists( $collection ) ) {
            return new $collection();
        }
        throw new \MVC\Base\AppException( "Không biết: $collection" );
    }
	
	static function getModel( $model ) {
        $model = preg_replace( "/^.*_/", "", $model );
        $model = "\\MVC\\Domain\\{$model}";
        if ( class_exists( $model ) ) {
            return new $model();
        }
        throw new \MVC\Base\AppException( "Không biết: $model" );
    }
}
?>
