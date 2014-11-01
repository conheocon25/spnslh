<?php
namespace MVC\Domain;

interface AlbumCollection 				extends \Iterator {function add( Object $Album );		}
interface ImageCollection 				extends \Iterator {function add( Object $Image );		}
interface VideoCollection 				extends \Iterator {function add( Object $Video);		}
interface LinkedCollection 				extends \Iterator {function add( Object $Linked );		}
interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface CategoryCollection 			extends \Iterator {function add( Object $Category );	}
interface Category1Collection 			extends \Iterator {function add( Object $Category1 );	}
interface TagCollection 				extends \Iterator {function add( Object $Tag );			}
interface PostTagCollection 			extends \Iterator {function add( Object $PostTag );		}
interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}

?>
