<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}
class UserTagCollection 		extends Collection implements \MVC\Domain\UserTagCollection 		{function targetClass( ) {return "\MVC\Domain\UserTag";		}}

class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}

class CategoryBuddhaCollection 	extends Collection implements \MVC\Domain\CategoryBuddhaCollection	{function targetClass(){return "\MVC\Domain\CategoryBuddha";}}
class CategoryVideoCollection 	extends Collection implements \MVC\Domain\CategoryVideoCollection	{function targetClass(){return "\MVC\Domain\CategoryVideo";	}}
class VideoCollection 			extends Collection implements \MVC\Domain\VideoCollection			{function targetClass(){return "\MVC\Domain\Video";			}}

class CategoryPostCollection 	extends Collection implements \MVC\Domain\CategoryPostCollection	{function targetClass(){return "\MVC\Domain\CategoryPost";	}}
class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}
class RssLinkCollection 	extends Collection implements \MVC\Domain\RssLinkCollection	{function targetClass(){return "\MVC\Domain\RssLink";	}}
class PostRssCollection 	extends Collection implements \MVC\Domain\PostRssCollection	{function targetClass(){return "\MVC\Domain\PostRss";	}}
?>