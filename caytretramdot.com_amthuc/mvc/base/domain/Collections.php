<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

interface CourseCollection 				extends \Iterator {function add( Object $Course);		}
interface CookMethodCollection 			extends \Iterator {function add( Object $CookMethod);	}

interface VideoCollection 				extends \Iterator {function add( Object $Video);		}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}

?>