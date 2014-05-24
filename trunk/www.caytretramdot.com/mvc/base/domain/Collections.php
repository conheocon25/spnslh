<?php
namespace MVC\Domain;

interface CategoryCollection 			extends \Iterator {function add( Object $Category );	}
interface Category1Collection 			extends \Iterator {function add( Object $Category1 );	}
interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface CustomerCollection 			extends \Iterator {function add( Object $Customer );	}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}
interface PostTagCollection 			extends \Iterator {function add( Object $PostTag );		}
interface PresentationCollection 		extends \Iterator {function add( Object $Presentation);	}
interface QuestionCollection 			extends \Iterator {function add( Object $Question);		}
interface SlideCollection 				extends \Iterator {function add( Object $Slide);		}
interface TagCollection 				extends \Iterator {function add( Object $Tag );			}
interface TrackingCollection 			extends \Iterator {function add( Object $Tracking);		}
interface TrackingDailyCollection 		extends \Iterator {function add( Object $TrackingDaily);}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface UserCollection 				extends \Iterator {function add( Object $User );		}

?>