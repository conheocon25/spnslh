<?php
namespace MVC\Domain;

interface AppCollection extends \Iterator {function add( Object $App );}

interface CategoryAdsCollection extends \Iterator {function add( Object $CategoryAds );}
interface AdsCollection extends \Iterator {function add( Object $Ads );}

interface UserCollection extends \Iterator {function add( Object $User );}
interface GuestCollection extends \Iterator {function add( Object $Guest);}
interface ContactCollection extends \Iterator {function add( Object $Contact);}

interface PageCollection extends \Iterator {function add( Object $Page);}

interface ProvinceCollection extends \Iterator {function add( Object $Province);}
interface DistrictCollection extends \Iterator {function add( Object $District);}

interface AgencyCollection extends \Iterator {function add( Object $Agency );}
interface AgencyMarketCollection extends \Iterator {function add( Object $AgencyMarket );}

interface CategoryEstateCollection extends \Iterator {function add( Object $CategoryEstate );}

interface CategoryKnowledgeCollection extends \Iterator {function add( Object $CategoryKnowledge );}
interface NewsKnowledgeCollection extends \Iterator {function add( Object $NewsKnowledge );}

interface CategoryGeneralCollection extends \Iterator {function add( Object $CategoryGeneral );}
interface NewsGeneralCollection extends \Iterator {function add( Object $NewsGeneral );}

interface CategoryMarketCollection extends \Iterator {function add( Object $CategoryMarket );}
interface NewsMarketCollection extends \Iterator {function add( Object $NewsMarket );}

interface CategoryProjectCollection extends \Iterator {function add( Object $CategoryProject );}
interface ProjectCollection extends \Iterator {function add( Object $Project );}
interface ProjectProductCollection extends \Iterator {function add( Object $ProjectProduct );}
interface ProjectAlbumCollection extends \Iterator {function add( Object $ProjectAlbum );}
interface ProjectVideoCollection extends \Iterator {function add( Object $ProjectVideo );}
interface ProjectDocCollection extends \Iterator {function add( Object $ProjectDoc );}

interface NewsProjectCollection extends \Iterator {function add( Object $NewsProject );}
?>
