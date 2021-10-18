<!-- Users can update their files -->
<?php
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8'); 
    // research hoe meeer secure kan rijgen
}