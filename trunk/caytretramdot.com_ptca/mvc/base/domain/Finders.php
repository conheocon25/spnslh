<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface UserFinder  				extends Finder {}
interface UserBranchFinder  		extends Finder {}
interface UserWarehouseFinder  		extends Finder {}

interface RoleFinder  				extends Finder {}
interface UnitFinder  				extends Finder {}

interface BranchFinder  			extends Finder {}
interface BranchGroupFinder  		extends Finder {}
interface BranchQuotaFinder  		extends Finder {}
interface BranchWarehouseFinder  	extends Finder {}

interface SaleCommandFinder  		extends Finder {}
interface SaleCommandDetailFinder  	extends Finder {}

interface InvoiceSellFinder  		extends Finder {}
interface InvoiceSellDetailFinder  	extends Finder {}

interface InvoiceImportFinder  		extends Finder {}
interface InvoiceImportDetailFinder extends Finder {}

interface GoodGroupFinder  		extends Finder {}
interface GoodFinder  			extends Finder {}

interface CustomerGroupFinder  	extends Finder {}
interface CustomerFinder  		extends Finder {}
interface CustomerInitFinder  	extends Finder {}
interface CustomerCollectFinder extends Finder {}

interface EmployeeFinder  		extends Finder {}
interface DepartmentFinder  	extends Finder {}

interface SupplierTypeFinder  	extends Finder {}
interface SupplierFinder  		extends Finder {}
interface SupplierInitFinder  	extends Finder {}

interface WarehouseFinder  		extends Finder {}
interface WarehouseInitFinder  	extends Finder {}
interface WarehouseGroupFinder  extends Finder {}

interface TrackFinder  			extends Finder {}
interface TrackDailyFinder  	extends Finder {}
interface TrackDailyBranchFinder  			extends Finder {}
interface TrackDailyBranchCustomerFinder  	extends Finder {}
interface TrackDailyWarehouseFinder  		extends Finder {}
interface TrackDailyWarehouseGoodFinder  	extends Finder {}

interface TransportFinder  		extends Finder {}
interface TransportGroupFinder  extends Finder {}

interface PaymentMethodFinder  	extends Finder {}

interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

?>