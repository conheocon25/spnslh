<?php
namespace MVC\Domain;

interface AdsCollection 		extends \Iterator {function add( Object $Ads	);}
interface CafeCollection 		extends \Iterator {function add( Object $Cafe	);}
interface KaraokeCollection 	extends \Iterator {function add( Object $Karaoke);}
interface PagodaCollection 		extends \Iterator {function add( Object $Pagoda	);}
interface ZenMusicCollection 	extends \Iterator {function add( Object $ZenMusic	);}

interface StoreCollection 		extends \Iterator {function add( Object $Store	);}
interface MStoreCollection 		extends \Iterator {function add( Object $MStore	);}

interface RestaurantCollection 	extends \Iterator {function add( Object $Restaurant	);}
interface MRestaurantCollection extends \Iterator {function add( Object $MRestaurant);}

interface HotelCollection 		extends \Iterator {function add( Object $Hotel	);}
interface MHotelCollection 		extends \Iterator {function add( Object $MHotel	);}

interface CChessCollection 		extends \Iterator {function add( Object $CChess	);}
interface CBookCollection 		extends \Iterator {function add( Object $CBook 	);}
interface CSetCollection 		extends \Iterator {function add( Object $CSet 	);}
interface CStepCollection 		extends \Iterator {function add( Object $CStep 	);}

interface PostCollection 		extends \Iterator {function add( Object $Post 	);}
interface UserCollection 		extends \Iterator {function add( Object $User 	);}
interface ConfigCollection 		extends \Iterator {function add( Object $Config );}
interface PageCollection 		extends \Iterator {function add( Object $Page	);}
interface GuestCollection 		extends \Iterator {function add( Object $Guest	);}

?>
