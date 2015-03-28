<?php
namespace MVC\Domain;
if ( ! isset( $EG_DISABLE_INCLUDES ) ) {			
	require_once( "mvc/mapper/User.php" 			);
	require_once( "mvc/mapper/TypeAccount.php" 		);
	require_once( "mvc/mapper/Unit.php" 			);
	
	require_once( "mvc/mapper/Branch.php" 			);
	
	require_once( "mvc/mapper/SaleCommand.php" 		);
	require_once( "mvc/mapper/SaleCommandDetail.php");
	
	require_once( "mvc/mapper/InvoiceSell.php" 		);
	require_once( "mvc/mapper/InvoiceSellDetail.php");
	
	require_once( "mvc/mapper/InvoiceImport.php" 	);
	require_once( "mvc/mapper/InvoiceImportDetail.php");
	
	require_once( "mvc/mapper/GoodGroup.php" 		);
	require_once( "mvc/mapper/Good.php" 			);
	
	require_once( "mvc/mapper/CustomerGroup.php" 	);
	require_once( "mvc/mapper/Customer.php" 		);
	
	require_once( "mvc/mapper/Supplier.php" 		);
	require_once( "mvc/mapper/SupplierType.php" 	);
	
	require_once( "mvc/mapper/Department.php" 		);
	require_once( "mvc/mapper/Employee.php" 		);		
	
	require_once( "mvc/mapper/Warehouse.php" 		);
	require_once( "mvc/mapper/WarehouseGroup.php" 	);
	
	require_once( "mvc/mapper/Track.php" 			);
	require_once( "mvc/mapper/TrackDaily.php" 		);
	
	require_once( "mvc/mapper/Transport.php" 		);
	require_once( "mvc/mapper/TransportGroup.php" 	);
	
	require_once( "mvc/mapper/PaymentMethod.php" 	);
	
	require_once( "mvc/mapper/Config.php"			);
	require_once( "mvc/mapper/Guest.php"			);
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