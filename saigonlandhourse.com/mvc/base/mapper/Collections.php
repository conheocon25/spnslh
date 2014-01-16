<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class ProjectCollection extends Collection implements \MVC\Domain\ProjectCollection {function targetClass( ) {return "\MVC\Domain\Project";}}
class PDocumentCollection extends Collection implements \MVC\Domain\PDocumentCollection {function targetClass( ) {return "\MVC\Domain\PDocument";}}
class PVideoCollection extends Collection implements \MVC\Domain\PVideoCollection {function targetClass( ) {return "\MVC\Domain\PVideo";}}
class PAlbumCollection extends Collection implements \MVC\Domain\PAlbumCollection {function targetClass( ) {return "\MVC\Domain\PAlbum";}}
class PNewsCollection extends Collection implements \MVC\Domain\PNewsCollection {function targetClass( ) {return "\MVC\Domain\PNews";}}
class PProductCollection extends Collection implements \MVC\Domain\PProductCollection {function targetClass( ) {return "\MVC\Domain\PProduct";}}

class CategoryNewsCollection extends Collection implements \MVC\Domain\CategoryNewsCollection{function targetClass(){return "\MVC\Domain\CategoryNews";}}
class NewsCollection extends Collection implements \MVC\Domain\NewsCollection{function targetClass(){return "\MVC\Domain\News";}}

class ConfigCollection extends Collection implements \MVC\Domain\ConfigCollection{function targetClass(){return "\MVC\Domain\Config";}}
class GuestCollection extends Collection implements \MVC\Domain\GuestCollection{function targetClass(){return "\MVC\Domain\Guest";}}
class PageCollection extends Collection implements \MVC\Domain\PageCollection{function targetClass(){return "\MVC\Domain\Page";}}
class UnitCollection extends Collection implements \MVC\Domain\UnitCollection{function targetClass(){return "\MVC\Domain\Unit";}}
class UserCollection extends Collection implements \MVC\Domain\UserCollection {function targetClass( ) {return "\MVC\Domain\User";}}

?>