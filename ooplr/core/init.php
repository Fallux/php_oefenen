<!-- autoloading classes -->
<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        // als je localhost wilt doen moet je een DNS table maken en de bestanden laden trager...
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'leren_php'
    ),
    'remember' => array (
        'cookie_name' => 'hash',
        'cookie_expiry' => 3600

    ),
    'session' => array (
        'session_name' => 'user'
    )
);

spl_autoload_register(function($class){
    require_once 'classes/' . $class . '.php';
});
// include once kan maar je werkt met zo veel bestanden dat het heel vervelend word als je een name wilt veranderen bijvoorbeeld
// spl_autoload_register(); hoeven we alleen de class namen aan te geven die toegang erop hebben
// SPL = Standard PHP Lybrary
// x$db = new DB();x
// jammer genoeg is sanitize.php een functie dus dat is geen class
require_once 'functions/sanitize.php';