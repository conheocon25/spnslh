<?php
namespace MVC\Domain;

interface UserCollection 				extends \Iterator {function add( Object $User );		}
interface UserTagCollection 			extends \Iterator {function add( Object $UserTag );		}
interface TagCollection 				extends \Iterator {function add( Object $Tag );			}
interface PostCollection 				extends \Iterator {function add( Object $Post);			}
interface LinkedCollection 				extends \Iterator {function add( Object $Linked );		}
interface PostTagCollection 			extends \Iterator {function add( Object $PostTag );		}
interface PostLinkedCollection 			extends \Iterator {function add( Object $PostLinked);	}
interface PostMapCollection 			extends \Iterator {function add( Object $PostMap);		}
interface ConfigCollection 				extends \Iterator {function add( Object $Config );		}
interface PageCollection 				extends \Iterator {function add( Object $Page);			}
interface GuestCollection 				extends \Iterator {function add( Object $Guest);		}
interface ProvinceCollection 			extends \Iterator {function add( Object $Province);		}
interface DistrictCollection 			extends \Iterator {function add( Object $District);		}
interface CBMCollection 				extends \Iterator {function add( Object $CBM);			}
interface CBMDetailCollection 			extends \Iterator {function add( Object $CBMDetail);	}
interface CategoryBookCollection 		extends \Iterator {function add( Object $CategoryBook);	}
interface BookCollection 				extends \Iterator {function add( Object $Book);			}
interface CategoryBoardCollection 		extends \Iterator {function add( Object $CategoryBoard);}
?>