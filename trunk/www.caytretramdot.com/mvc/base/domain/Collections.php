<?php
namespace MVC\Domain;

interface LinkedCollection 				extends \Iterator {function add( Object $Linked );		}
interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface TagCollection 				extends \Iterator {function add( Object $Tag );			}
interface PostTagCollection 			extends \Iterator {function add( Object $PostTag );		}
interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}

interface ProvinceCollection 			extends \Iterator {function add( Object $Province);		}
interface DistrictCollection 			extends \Iterator {function add( Object $District);		}

?>
