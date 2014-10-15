<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface AppFinder  			extends Finder {}
interface UserFinder  			extends Finder {}
interface NotifyFinder  		extends Finder {}
interface DomainFinder  		extends Finder {}
interface TableFinder  			extends Finder {}
interface TableLogFinder  		extends Finder {}
interface SessionFinder  		extends Finder {}
interface SessionDetailFinder  	extends Finder {}
interface CategoryFinder  		extends Finder {}
interface CourseFinder  		extends Finder {}
interface CourseLogFinder  		extends Finder {}
interface SupplierFinder 		extends Finder {}

interface PaidSupplierFinder 	extends Finder {}
interface PaidPayRollFinder 	extends Finder {}
interface PaidGeneralFinder 	extends Finder {}
interface PaidEmployeeFinder 	extends Finder {}
interface PayRollFinder 		extends Finder {}

interface TermPaidFinder 		extends Finder {}
interface TermCollectFinder 	extends Finder {}

interface CollectGeneralFinder 	extends Finder {}
interface CollectCustomerFinder extends Finder {}

interface ResourceFinder 		extends Finder {}
interface OrderImportFinder 	extends Finder {}
interface OrderImportDetailFinder extends Finder {}
interface CustomerFinder 		extends Finder {}
interface EmployeeFinder 		extends Finder {}
interface UnitFinder 			extends Finder {}
interface ConfigFinder 			extends Finder {}

interface TrackingFinder 		extends Finder {}
interface TrackingCustomerFinder 	extends Finder {}
interface TrackingStoreFinder 	extends Finder {}
interface TrackingCourseFinder 	extends Finder {}
interface TrackingDailyFinder 	extends Finder {}

interface R2CFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}
?>
