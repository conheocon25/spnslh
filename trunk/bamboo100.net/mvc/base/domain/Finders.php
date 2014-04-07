<?php
namespace MVC\Domain;

interface Finder {
    function find( $id );
    function findAll();

    function update( Object $object );
    function insert( Object $obj );
    //function delete();
}

interface AdsFinder  			extends Finder {}
interface CafeFinder  			extends Finder {}
interface KaraokeFinder  		extends Finder {}
interface PagodaFinder  		extends Finder {}
interface ZenMusicFinder  		extends Finder {}

interface TCategoryFinder  		extends Finder {}
interface TThemeFinder  		extends Finder {}

interface StoreFinder  			extends Finder {}
interface MStoreFinder  		extends Finder {}

interface RestaurantFinder  	extends Finder {}
interface MRestaurantFinder  	extends Finder {}

interface HotelFinder  			extends Finder {}
interface MHotelFinder  		extends Finder {}

interface CChessFinder  		extends Finder {}
interface CBookFinder  			extends Finder {}
interface CSetFinder  			extends Finder {}
interface CStepFinder  			extends Finder {}

interface PostFinder  			extends Finder {}
interface UserFinder  			extends Finder {}
interface ConfigFinder 			extends Finder {}
interface GuestFinder 			extends Finder {}

?>