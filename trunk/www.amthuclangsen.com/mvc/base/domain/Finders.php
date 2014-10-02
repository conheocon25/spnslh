<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface BranchFinder  		extends Finder {}

interface UserFinder  			extends Finder {}
interface FeedFinder  			extends Finder {}

interface CategoryFinder  		extends Finder {}
interface Category1Finder  		extends Finder {}
interface ProductImageFinder 	extends Finder {}
interface ProductAttributeFinder 	extends Finder {}

interface AttributeFinder 		extends Finder {}
interface GAttributeFinder 		extends Finder {}
interface ManufacturerFinder 	extends Finder {}
interface SupplierFinder 		extends Finder {}
interface ProductFinder 		extends Finder {}
interface ProductInfoFinder 	extends Finder {}

interface OrderImportFinder 	extends Finder {}
interface OrderImportDetailFinder extends Finder {}
interface OrderExportFinder 	extends Finder {}
interface OrderExportDetailFinder extends Finder {}

interface CustomerFinder 		extends Finder {}
interface StoryLineFinder 		extends Finder {}

interface TagFinder 			extends Finder {}
interface PostTagFinder 		extends Finder {}

interface EmployeeFinder 		extends Finder {}
interface ConfigFinder 			extends Finder {}
interface TrackingFinder 		extends Finder {}
interface TrackingDailyFinder 	extends Finder {}
interface GuestFinder 			extends Finder {}
interface PostFinder 			extends Finder {}
interface PresentationFinder 	extends Finder {}
interface SlideFinder 			extends Finder {}

interface SaveFinder 			extends Finder {}
interface SaveProductFinder 	extends Finder {}
?>
