<!-- accessing the databases (core folder) -->
<!-- We hoeven geen require_once te gebruiken want het word automtisch bij elkaar getrokken -->

<?php
class Config {
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            // print_r($path);

            foreach ($path as $bit) {
                if (isset ($config[$bit]) ) {
                    $config = $config[$bit];
                    // echo ' set ';
                }
                // echo $key, ' ';
            }

        // return $config;
        var_dump($config);
        }
    }
}