<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface UserTagCollection 			extends \Iterator {function add( Object $UserTag );		}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

interface CategoryBuddhaCollection 		extends \Iterator {function add( Object $CategoryBuddha);}
interface CategoryVideoCollection 		extends \Iterator {function add( Object $CategoryVideo);}
interface VideoCollection 				extends \Iterator {function add( Object $Video);		}

interface CategoryPostCollection 		extends \Iterator {function add( Object $CategoryPost);	}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}
interface RssLinkCollection 		extends \Iterator {function add( Object $RssLink);	}
interface PostRssCollection 		extends \Iterator {function add( Object $PostRss);	}
?>