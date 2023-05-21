<?php
//load the config file
require_once 'config/config.php';
// load our libraries
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/Database.php';

//load helpers
require_once 'helpers/url_handler.php';
require_once 'helpers/session_message.php';
// An autoloader to require all the libraries
// Note: for this to work, the name of the class and the file must be thesame
spl_autoload_register(function($className){
 require_once 'libraries/' . $className. '.php';
});