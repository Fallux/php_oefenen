<?php
require_once 'core/init.php';

$user = DB::getInstance()->query("SELECT username FROM users WHERE username = ?", array('alex'));

// if ($user->error()) {
//     echo "<br><b>something went wrong</b>";
// }else {
//     echo "<br><i>it went well</i>";
// }

