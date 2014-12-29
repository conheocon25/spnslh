<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AlbumCollection 			extends Collection implements \MVC\Domain\AlbumCollection 			{function targetClass( ) {return "\MVC\Domain\Album";		}}
class ImageCollection 			extends Collection implements \MVC\Domain\ImageCollection 			{function targetClass( ) {return "\MVC\Domain\Image";		}}
class VideoCollection 			extends Collection implements \MVC\Domain\VideoCollection 			{function targetClass( ) {return "\MVC\Domain\Video";		}}

class BranchCollection 			extends Collection implements \MVC\Domain\BranchCollection 			{function targetClass( ) {return "\MVC\Domain\Branch";		}}
class LinkedCollection 			extends Collection implements \MVC\Domain\LinkedCollection 			{function targetClass( ) {return "\MVC\Domain\Linked";		}}

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class FeedCollection 			extends Collection implements \MVC\Domain\FeedCollection 			{function targetClass( ) {return "\MVC\Domain\Feed";		}}

class CategoryCollection 		extends Collection implements \MVC\Domain\CategoryCollection 		{function targetClass( ) {return "\MVC\Domain\Category";	}}
class Category1Collection 		extends Collection implements \MVC\Domain\Category1Collection 		{function targetClass( ) {return "\MVC\Domain\Category1";	}}
class ProductImageCollection 	extends Collection implements \MVC\Domain\ProductImageCollection 	{function targetClass( ) {return "\MVC\Domain\ProductImage";}}
class ProductAttributeCollection 		extends Collection implements \MVC\Domain\ProductAttributeCollection 		{function targetClass( ) {return "\MVC\Domain\ProductAttribute";	}}

class AttributeCollection 		extends Collection implements \MVC\Domain\AttributeCollection 		{function targetClass( ) {return "\MVC\Domain\Attribute";	}}
class GAttributeCollection 		extends Collection implements \MVC\Domain\GAttributeCollection 		{function targetClass( ) {return "\MVC\Domain\GAttribute";	}}
class ManufacturerCollection 	extends Collection implements \MVC\Domain\ManufacturerCollection 	{function targetClass( ) {return "\MVC\Domain\Manufacturer";}}
class SupplierCollection 		extends Collection implements \MVC\Domain\SupplierCollection 		{function targetClass( ) {return "\MVC\Domain\Supplier";	}}
class ProductCollection 		extends Collection implements \MVC\Domain\ProductCollection 		{function targetClass( ) {return "\MVC\Domain\Product";		}}
class ProductInfoCollection 	extends Collection implements \MVC\Domain\ProductInfoCollection 	{function targetClass( ) {return "\MVC\Domain\ProductInfo";	}}

class CustomerCollection 		extends Collection implements \MVC\Domain\CustomerCollection 		{function targetClass( ) {return "\MVC\Domain\Customer";	}}
class StoryLineCollection 		extends Collection implements \MVC\Domain\StoryLineCollection 		{function targetClass( ) {return "\MVC\Domain\StoryLine";	}}

class TagCollection 			extends Collection implements \MVC\Domain\TagCollection 			{function targetClass( ) {return "\MVC\Domain\Tag";			}}
class PostTagCollection 		extends Collection implements \MVC\Domain\PostTagCollection 		{function targetClass( ) {return "\MVC\Domain\PostTag";		}}

class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}
class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}
class PresentationCollection 	extends Collection implements \MVC\Domain\PresentationCollection	{function targetClass(){return "\MVC\Domain\Presentation";	}}
class SlideCollection 			extends Collection implements \MVC\Domain\SlideCollection			{function targetClass(){return "\MVC\Domain\Slide";			}}
class PostRssCollection 		extends Collection implements \MVC\Domain\PostRssCollection			{function targetClass(){return "\MVC\Domain\PostRss";		}}
class RssLinkCollection 		extends Collection implements \MVC\Domain\RssLinkCollection			{function targetClass(){return "\MVC\Domain\RssLink";		}}


?>