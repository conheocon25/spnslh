<?php
namespace MVC\Domain;
if ( ! isset( $EG_DISABLE_INCLUDES ) ) {			
	
	require_once( "mvc/mapper/Category.php" 		);
	require_once( "mvc/mapper/Category1.php" 		);		
	require_once( "mvc/mapper/Config.php"			);	
	require_once( "mvc/mapper/Customer.php" 		);		
	require_once( "mvc/mapper/Exam.php" 			);
	require_once( "mvc/mapper/ExamDetail.php" 		);
	require_once( "mvc/mapper/Guest.php"			);
	require_once( "mvc/mapper/Post.php"				);
	require_once( "mvc/mapper/PostTag.php" 			);		
	require_once( "mvc/mapper/Presentation.php"		);
	require_once( "mvc/mapper/Question.php"			);
	require_once( "mvc/mapper/QuestionDetail.php"	);
	require_once( "mvc/mapper/Slide.php"			);
	require_once( "mvc/mapper/Tag.php" 				);
	require_once( "mvc/mapper/Test.php" 			);
	require_once( "mvc/mapper/TestDetail.php" 		);
	require_once( "mvc/mapper/Tracking.php"			);
	require_once( "mvc/mapper/TrackingDaily.php"	);	
	require_once( "mvc/mapper/User.php" 			);
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
