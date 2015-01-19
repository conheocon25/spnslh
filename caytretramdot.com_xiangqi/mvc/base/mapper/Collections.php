<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class UserTagCollection 		extends Collection implements \MVC\Domain\UserTagCollection 		{function targetClass( ) {return "\MVC\Domain\UserTag";		}}
class TagCollection 			extends Collection implements \MVC\Domain\TagCollection 			{function targetClass( ) {return "\MVC\Domain\Tag";			}}
class LinkedCollection 			extends Collection implements \MVC\Domain\LinkedCollection 			{function targetClass( ) {return "\MVC\Domain\Linked";		}}
class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}
class PostTagCollection 		extends Collection implements \MVC\Domain\PostTagCollection 		{function targetClass( ) {return "\MVC\Domain\PostTag";		}}
class PostLinkedCollection 		extends Collection implements \MVC\Domain\PostLinkedCollection 		{function targetClass( ) {return "\MVC\Domain\PostLinked";	}}
class PostMapCollection 		extends Collection implements \MVC\Domain\PostMapCollection 		{function targetClass( ) {return "\MVC\Domain\PostMap";		}}
class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}
class ProvinceCollection 		extends Collection implements \MVC\Domain\ProvinceCollection		{function targetClass(){return "\MVC\Domain\Province";		}}
class DistrictCollection 		extends Collection implements \MVC\Domain\DistrictCollection		{function targetClass(){return "\MVC\Domain\District";		}}
class CBMCollection 			extends Collection implements \MVC\Domain\CBMCollection				{function targetClass(){return "\MVC\Domain\CBM";			}}
class CBMDetailCollection 		extends Collection implements \MVC\Domain\CBMDetailCollection		{function targetClass(){return "\MVC\Domain\CBMDetail";		}}
class CategoryBookCollection 	extends Collection implements \MVC\Domain\CategoryBookCollection	{function targetClass(){return "\MVC\Domain\CategoryBook";	}}
class BookCollection 			extends Collection implements \MVC\Domain\BookCollection			{function targetClass(){return "\MVC\Domain\Book";			}}
class CategoryBoardCollection 	extends Collection implements \MVC\Domain\CategoryBoardCollection	{function targetClass(){return "\MVC\Domain\CategoryBoard";	}}
?>