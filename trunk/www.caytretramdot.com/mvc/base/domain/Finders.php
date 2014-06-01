<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface CategoryFinder  		extends Finder {}
interface Category1Finder  		extends Finder {}
interface ConfigFinder 			extends Finder {}
interface CustomerFinder 		extends Finder {}
interface ExamFinder 			extends Finder {}
interface ExamDetailFinder 		extends Finder {}
interface GuestFinder 			extends Finder {}
interface PostFinder 			extends Finder {}
interface PostTagFinder 		extends Finder {}
interface PresentationFinder 	extends Finder {}
interface QuestionFinder 		extends Finder {}
interface QuestionDetailFinder 	extends Finder {}
interface SlideFinder 			extends Finder {}
interface TagFinder 			extends Finder {}
interface TestFinder 			extends Finder {}
interface TrackingFinder 		extends Finder {}
interface TrackingDailyFinder 	extends Finder {}
interface PageFinder  			extends Finder {}
interface UserFinder  			extends Finder {}

?>