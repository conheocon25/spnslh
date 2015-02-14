<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface TypeAccountCollection 		extends \Iterator {function add( Object $TypeAccount);	}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

?>