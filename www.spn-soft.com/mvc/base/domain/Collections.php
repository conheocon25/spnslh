<?php
namespace MVC\Domain;

interface AppCollection extends \Iterator {function add( Object $App );}
interface UserCollection extends \Iterator {function add( Object $User );}
interface GuestCollection extends \Iterator {function add( Object $Guest);}
interface TechnicalCollection extends \Iterator {function add( Object $Technical );}
interface SolutionCollection extends \Iterator {function add( Object $Solution );}
interface ServiceCollection extends \Iterator {function add( Object $Service );}
interface ProjectCollection extends \Iterator {function add( Object $Project );}
interface CustomerStoryCollection extends \Iterator {function add( Object $CustomerStory );}

?>
