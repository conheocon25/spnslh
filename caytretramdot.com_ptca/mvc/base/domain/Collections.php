<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}

interface AlbumCollection 				extends \Iterator {function add( Object $Album);		}
interface ImageCollection 				extends \Iterator {function add( Object $Image);		}

interface LinkedCollection 				extends \Iterator {function add( Object $Linked);		}

interface FacebookerCollection 			extends \Iterator {function add( Object $Facebooker );	}

interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}

interface BoardCollection 				extends \Iterator {function add( Object $Board);		}
interface BoardSubCollection 			extends \Iterator {function add( Object $BoardSub);		}
interface BoardDetailCollection 		extends \Iterator {function add( Object $BoardDetail);	}

interface CategoryBookCollection 		extends \Iterator {function add( Object $CategoryBook);	}
interface BookCollection 				extends \Iterator {function add( Object $Book);			}
interface ChapterCollection 			extends \Iterator {function add( Object $Chapter);		}

interface CategoryVideoCollection 		extends \Iterator {function add( Object $CategoryVideo);}
interface VideoCollection 				extends \Iterator {function add( Object $Video);		}

interface CategoryPostCollection 		extends \Iterator {function add( Object $CategoryPost);	}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}

interface PresentationCollection 		extends \Iterator {function add( Object $Presentation);	}
interface SlideCollection 				extends \Iterator {function add( Object $Slide);		}

?>