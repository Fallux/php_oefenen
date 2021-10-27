<?php
require_once 'core/init.php';

$user = DB::getInstance()->query("SELECT * FROM users");

if (!$user->count()) {
    echo "<br><b>username niet gevonden</b>";
}else {
    foreach($user->results() as $user) {
        echo "<br>" . $user->username;
    }
}

