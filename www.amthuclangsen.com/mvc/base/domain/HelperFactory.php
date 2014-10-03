<?php
namespace MVC\Domain;
if ( ! isset( $EG_DISABLE_INCLUDES ) ) {	
	require_once( "mvc/mapper/Album.php" 			);	
	require_once( "mvc/mapper/Branch.php" 			);	
	
	require_once( "mvc/mapper/User.php" 			);	
	require_once( "mvc/mapper/Feed.php" 			);	
	
	require_once( "mvc/mapper/Category.php" 		);
	require_once( "mvc/mapper/Category1.php" 		);
			
	require_once( "mvc/mapper/Attribute.php" 		);
	require_once( "mvc/mapper/GAttribute.php" 		);
	require_once( "mvc/mapper/Manufacturer.php" 	);
	require_once( "mvc/mapper/Supplier.php" 		);
	require_once( "mvc/mapper/Product.php" 			);
	require_once( "mvc/mapper/ProductInfo.php" 		);	
	require_once( "mvc/mapper/ProductImage.php" 	);
	require_once( "mvc/mapper/ProductAttribute.php" );
			
	require_once( "mvc/mapper/Customer.php" 		);
	require_once( "mvc/mapper/StoryLine.php" 		);
	
	require_once( "mvc/mapper/Tag.php" 				);
	require_once( "mvc/mapper/PostTag.php" 			);
	
	require_once( "mvc/mapper/Employee.php" 		);	
	require_once( "mvc/mapper/Config.php"			);	
	require_once( "mvc/mapper/Guest.php"			);
	require_once( "mvc/mapper/Post.php"				);
	require_once( "mvc/mapper/Presentation.php"		);
	require_once( "mvc/mapper/Slide.php"			);
	
	require_once( "mvc/mapper/Save.php"				);	
	require_once( "mvc/mapper/SaveProduct.php"		);
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
