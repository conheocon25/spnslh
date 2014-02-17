<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class PostCollection extends Collection implements \MVC\Domain\PostCollection{function targetClass(){return "\MVC\Domain\Post";}}
class ConfigCollection extends Collection implements \MVC\Domain\ConfigCollection{function targetClass(){return "\MVC\Domain\Config";}}
class GuestCollection extends Collection implements \MVC\Domain\GuestCollection{function targetClass(){return "\MVC\Domain\Guest";}}
class PageCollection extends Collection implements \MVC\Domain\PageCollection{function targetClass(){return "\MVC\Domain\Page";}}
class UserCollection extends Collection implements \MVC\Domain\UserCollection {function targetClass( ) {return "\MVC\Domain\User";}}

?>