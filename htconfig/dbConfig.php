<?php

session_start();
if (strtoupper(substr(gethostname(), 0, 6)) === 'GARTH') {
    //echo 'This is a server using Windows!';
    $db = array(
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'tony',
        'database' => 'tardy_cart_test');
} else {
    //echo 'This is a server not using Windows!';
    $db = array(
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'vikingso1',
        'database' => 'tardy_cart_test');
}
?>