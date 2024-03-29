<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AdsCollection 			extends Collection implements \MVC\Domain\AdsCollection 			{function targetClass( ) {return "\MVC\Domain\Ads";			}}

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class FeedCollection 			extends Collection implements \MVC\Domain\FeedCollection 			{function targetClass( ) {return "\MVC\Domain\Feed";		}}

class CategoryCollection 		extends Collection implements \MVC\Domain\CategoryCollection 		{function targetClass( ) {return "\MVC\Domain\Category";	}}
class Category1Collection 		extends Collection implements \MVC\Domain\Category1Collection 		{function targetClass( ) {return "\MVC\Domain\Category1";	}}

class SupplierCollection 		extends Collection implements \MVC\Domain\SupplierCollection 		{function targetClass( ) {return "\MVC\Domain\Supplier";	}}

class ProductCollection 		extends Collection implements \MVC\Domain\ProductCollection 		{function targetClass( ) {return "\MVC\Domain\Product";		}}
class ProductImageCollection 	extends Collection implements \MVC\Domain\ProductImageCollection 	{function targetClass( ) {return "\MVC\Domain\ProductImage";}}
class ProductInfoCollection 	extends Collection implements \MVC\Domain\ProductInfoCollection 	{function targetClass( ) {return "\MVC\Domain\ProductInfo";	}}
class ProductMapCollection 		extends Collection implements \MVC\Domain\ProductMapCollection 		{function targetClass( ) {return "\MVC\Domain\ProductMap";	}}

class TypeEstateCollection 		extends Collection implements \MVC\Domain\TypeEstateCollection 		{function targetClass( ) {return "\MVC\Domain\TypeEstate";	}}

class StoryLineCollection 		extends Collection implements \MVC\Domain\StoryLineCollection 		{function targetClass( ) {return "\MVC\Domain\StoryLine";	}}

class TagCollection 			extends Collection implements \MVC\Domain\TagCollection 			{function targetClass( ) {return "\MVC\Domain\Tag";			}}
class PostTagCollection 		extends Collection implements \MVC\Domain\PostTagCollection 		{function targetClass( ) {return "\MVC\Domain\PostTag";		}}

class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}
class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}

class ProvinceCollection 		extends Collection implements \MVC\Domain\ProvinceCollection		{function targetClass(){return "\MVC\Domain\Province";		}}
class DistrictCollection 		extends Collection implements \MVC\Domain\DistrictCollection		{function targetClass(){return "\MVC\Domain\District";		}}


?>