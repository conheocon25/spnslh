<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class CategoryCollection 		extends Collection implements \MVC\Domain\CategoryCollection 		{function targetClass(){return "\MVC\Domain\Category";		}}
class Category1Collection 		extends Collection implements \MVC\Domain\Category1Collection 		{function targetClass(){return "\MVC\Domain\Category1";		}}
class ConfigCollection 			extends Collection implements \MVC\Domain\ConfigCollection			{function targetClass(){return "\MVC\Domain\Config";		}}
class CustomerCollection 		extends Collection implements \MVC\Domain\CustomerCollection 		{function targetClass(){return "\MVC\Domain\Customer";		}}
class GuestCollection 			extends Collection implements \MVC\Domain\GuestCollection			{function targetClass(){return "\MVC\Domain\Guest";			}}
class PostCollection 			extends Collection implements \MVC\Domain\PostCollection			{function targetClass(){return "\MVC\Domain\Post";			}}
class PostTagCollection 		extends Collection implements \MVC\Domain\PostTagCollection 		{function targetClass(){return "\MVC\Domain\PostTag";		}}
class PresentationCollection 	extends Collection implements \MVC\Domain\PresentationCollection	{function targetClass(){return "\MVC\Domain\Presentation";	}}

class QuestionCollection 		extends Collection implements \MVC\Domain\QuestionCollection		{function targetClass(){return "\MVC\Domain\Question";		}}
class QuestionDetailCollection 	extends Collection implements \MVC\Domain\QuestionDetailCollection	{function targetClass(){return "\MVC\Domain\QuestionDetail";}}

class SlideCollection 			extends Collection implements \MVC\Domain\SlideCollection			{function targetClass(){return "\MVC\Domain\Slide";			}}
class TagCollection 			extends Collection implements \MVC\Domain\TagCollection 			{function targetClass(){return "\MVC\Domain\Tag";			}}
class TrackingCollection 		extends Collection implements \MVC\Domain\TrackingCollection		{function targetClass(){return "\MVC\Domain\Tracking";		}}
class TrackingDailyCollection 	extends Collection implements \MVC\Domain\TrackingDailyCollection	{function targetClass(){return "\MVC\Domain\TrackingDaily";	}}
class PageCollection 			extends Collection implements \MVC\Domain\PageCollection			{function targetClass(){return "\MVC\Domain\Page";			}}
class UserCollection 			extends Collection implements \MVC\Domain\UserCollection 			{function targetClass(){return "\MVC\Domain\User";			}}

?>