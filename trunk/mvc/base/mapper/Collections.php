<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AppCollection extends Collection implements \MVC\Domain\AppCollection {function targetClass( ) {return "\MVC\Domain\App";}}
class CategoryAdsCollection extends Collection implements \MVC\Domain\CategoryAdsCollection {function targetClass( ) {return "\MVC\Domain\CategoryAds";}}
class AdsCollection extends Collection implements \MVC\Domain\AdsCollection {function targetClass( ) {return "\MVC\Domain\Ads";}}
class UserCollection extends Collection implements \MVC\Domain\UserCollection {function targetClass( ) {return "\MVC\Domain\User";}}
class GuestCollection extends Collection implements \MVC\Domain\GuestCollection {function targetClass( ) {return "\MVC\Domain\Guest";}}
class ContactCollection extends Collection implements \MVC\Domain\ContactCollection {function targetClass( ) {return "\MVC\Domain\Contact";}}

class PageCollection extends Collection implements \MVC\Domain\PageCollection {function targetClass( ) {return "\MVC\Domain\Page";}}

class ProvinceCollection extends Collection implements \MVC\Domain\ProvinceCollection {function targetClass( ) {return "\MVC\Domain\Province";}}
class DistrictCollection extends Collection implements \MVC\Domain\DistrictCollection {function targetClass( ) {return "\MVC\Domain\District";}}

class AgencyCollection extends Collection implements \MVC\Domain\AgencyCollection {function targetClass( ) {return "\MVC\Domain\Agency";}}
class AgencyMarketCollection extends Collection implements \MVC\Domain\AgencyMarketCollection {function targetClass( ) {return "\MVC\Domain\AgencyMarket";}}

class CategoryEstateCollection extends Collection implements \MVC\Domain\CategoryEstateCollection {function targetClass( ) {return "\MVC\Domain\CategoryEstate";}}

class CategoryKnowledgeCollection extends Collection implements \MVC\Domain\CategoryKnowledgeCollection {function targetClass( ) {return "\MVC\Domain\CategoryKnowledge";}}
class NewsKnowledgeCollection extends Collection implements \MVC\Domain\NewsKnowledgeCollection {function targetClass( ) {return "\MVC\Domain\NewsKnowledge";}}

class CategoryGeneralCollection extends Collection implements \MVC\Domain\CategoryGeneralCollection {function targetClass( ) {return "\MVC\Domain\CategoryGeneral";}}
class NewsGeneralCollection extends Collection implements \MVC\Domain\NewsGeneralCollection {function targetClass( ) {return "\MVC\Domain\NewsGeneral";}}

class CategoryMarketCollection extends Collection implements \MVC\Domain\CategoryMarketCollection {function targetClass( ) {return "\MVC\Domain\CategoryMarket";}}
class NewsMarketCollection extends Collection implements \MVC\Domain\NewsMarketCollection {function targetClass( ) {return "\MVC\Domain\NewsMarket";}}

class CategoryProjectCollection extends Collection implements \MVC\Domain\CategoryProjectCollection {function targetClass( ) {return "\MVC\Domain\CategoryProject";}}
class ProjectCollection extends Collection implements \MVC\Domain\ProjectCollection {function targetClass( ) {return "\MVC\Domain\Project";}}
class ProjectProductCollection extends Collection implements \MVC\Domain\ProjectProductCollection {function targetClass( ) {return "\MVC\Domain\ProjectProduct";}}
class ProjectAlbumCollection extends Collection implements \MVC\Domain\ProjectAlbumCollection {function targetClass( ) {return "\MVC\Domain\ProjectAlbum";}}
class ProjectVideoCollection extends Collection implements \MVC\Domain\ProjectVideoCollection {function targetClass( ) {return "\MVC\Domain\ProjectVideo";}}
class ProjectDocCollection extends Collection implements \MVC\Domain\ProjectDocCollection {function targetClass( ) {return "\MVC\Domain\ProjectDoc";}}
class NewsProjectCollection extends Collection implements \MVC\Domain\NewsProjectCollection {function targetClass( ) {return "\MVC\Domain\NewsProject";}}

?>
