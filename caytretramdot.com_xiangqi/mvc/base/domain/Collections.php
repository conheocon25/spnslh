<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface UserTagCollection 			extends \Iterator {function add( Object $UserTag );		}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

interface BoardCollection 				extends \Iterator {function add( Object $Board);		}
interface BoardDetailCollection 		extends \Iterator {function add( Object $BoardDetail);	}
interface CategoryBookCollection 		extends \Iterator {function add( Object $CategoryBook);	}
interface BookCollection 				extends \Iterator {function add( Object $Book);			}
interface CategoryBoardCollection 		extends \Iterator {function add( Object $CategoryBoard);}
interface CategoryPostCollection 		extends \Iterator {function add( Object $CategoryPost);	}
?>