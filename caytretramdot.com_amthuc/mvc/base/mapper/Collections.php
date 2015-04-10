<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass( ) {return "\MVC\Domain\User";		}}

class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}

class CourseCollection 			extends Collection implements \MVC\Domain\CourseCollection			{function targetClass(){return "\MVC\Domain\Course";		}}
class CookMethodCollection 		extends Collection implements \MVC\Domain\CookMethodCollection		{function targetClass(){return "\MVC\Domain\CookMethod";	}}

class VideoCollection 			extends Collection implements \MVC\Domain\VideoCollection			{function targetClass(){return "\MVC\Domain\Video";			}}
class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}

?>