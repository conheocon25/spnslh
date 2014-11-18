<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface UserFinder  			extends Finder {}
interface FeedFinder  			extends Finder {}

interface CategoryFinder  		extends Finder {}
interface Category1Finder  		extends Finder {}
interface ProductImageFinder 	extends Finder {}
interface ProductAttributeFinder 	extends Finder {}

interface SupplierFinder 		extends Finder {}
interface ProductFinder 		extends Finder {}
interface ProductInfoFinder 	extends Finder {}

interface StoryLineFinder 		extends Finder {}

interface TagFinder 			extends Finder {}
interface PostTagFinder 		extends Finder {}

interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}
interface PostFinder 			extends Finder {}

interface ProvinceFinder 		extends Finder {}
interface DistrictFinder 		extends Finder {}
?>
