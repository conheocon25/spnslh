<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface AlbumFinder  			extends Finder {}
interface ImageFinder  			extends Finder {}
interface VideoFinder  			extends Finder {}

interface BranchFinder  		extends Finder {}
interface LinkedFinder  		extends Finder {}

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

interface CustomerFinder 		extends Finder {}
interface StoryLineFinder 		extends Finder {}

interface TagFinder 			extends Finder {}
interface PostTagFinder 		extends Finder {}

interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}
interface PostFinder 			extends Finder {}
interface PresentationFinder 	extends Finder {}
interface SlideFinder 			extends Finder {}
?>
