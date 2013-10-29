<?php
namespace MVC\Domain;

interface ProjectCollection extends \Iterator {function add( Object $Project );}
interface PDocumentCollection extends \Iterator {function add( 	Object $PDocument );}
interface PVideoCollection extends \Iterator {function add( 	Object $PVideo );}
interface PAlbumCollection extends \Iterator {function add( 	Object $PAlbum );}
interface PNewsCollection extends \Iterator {function add( 		Object $PNews );}
interface PProductCollection extends \Iterator {function add( 	Object $PProduct );}

interface CategoryNewsCollection extends \Iterator {function add( Object $CategoryNews );}
interface NewsCollection extends \Iterator {function add( Object $News );}

interface UserCollection extends \Iterator {function add( Object $user );}
interface UnitCollection extends \Iterator {function add( Object $Unit );}
interface ConfigCollection extends \Iterator {function add( Object $Config );}
interface PageCollection extends \Iterator {function add( Object $Page);}
interface GuestCollection extends \Iterator {function add( Object $Guest);}
?>
