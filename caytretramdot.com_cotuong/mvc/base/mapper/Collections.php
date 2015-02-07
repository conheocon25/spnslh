<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class FacebookerCollection 		extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\Facebooker";	}}

class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}
class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}

class BoardCollection 			extends Collection implements \MVC\Domain\BoardCollection			{function targetClass(){return "\MVC\Domain\Board";			}}
class BoardDetailCollection 	extends Collection implements \MVC\Domain\BoardDetailCollection		{function targetClass(){return "\MVC\Domain\BoardDetail";	}}

class CategoryBookCollection 	extends Collection implements \MVC\Domain\CategoryBookCollection	{function targetClass(){return "\MVC\Domain\CategoryBook";	}}
class BookCollection 			extends Collection implements \MVC\Domain\BookCollection			{function targetClass(){return "\MVC\Domain\Book";			}}
class ChapterCollection 		extends Collection implements \MVC\Domain\ChapterCollection			{function targetClass(){return "\MVC\Domain\Chapter";		}}

class CategoryVideoCollection 	extends Collection implements \MVC\Domain\CategoryVideoCollection	{function targetClass(){return "\MVC\Domain\CategoryVideo";	}}
class VideoCollection 			extends Collection implements \MVC\Domain\VideoCollection			{function targetClass(){return "\MVC\Domain\Video";			}}

class CategoryPostCollection 	extends Collection implements \MVC\Domain\CategoryPostCollection	{function targetClass(){return "\MVC\Domain\CategoryPost";	}}
?>