<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AlbumCollection 			extends Collection implements \MVC\Domain\AlbumCollection 			{function targetClass( ) {return "\MVC\Domain\Album";		}}
class ImageCollection 			extends Collection implements \MVC\Domain\ImageCollection 			{function targetClass( ) {return "\MVC\Domain\Image";		}}
class VideoCollection 			extends Collection implements \MVC\Domain\VideoCollection 			{function targetClass( ) {return "\MVC\Domain\Video";		}}
class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class CategoryCollection 		extends Collection implements \MVC\Domain\CategoryCollection 		{function targetClass( ) {return "\MVC\Domain\Category";	}}
class Category1Collection 		extends Collection implements \MVC\Domain\Category1Collection 		{function targetClass( ) {return "\MVC\Domain\Category1";	}}
class TagCollection 			extends Collection implements \MVC\Domain\TagCollection 			{function targetClass( ) {return "\MVC\Domain\Tag";			}}
class PostTagCollection 		extends Collection implements \MVC\Domain\PostTagCollection 		{function targetClass( ) {return "\MVC\Domain\PostTag";		}}
class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}
class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}

class ProvinceCollection 		extends Collection implements \MVC\Domain\ProvinceCollection		{function targetClass(){return "\MVC\Domain\Province";		}}
class DistrictCollection 		extends Collection implements \MVC\Domain\DistrictCollection		{function targetClass(){return "\MVC\Domain\District";		}}

?>