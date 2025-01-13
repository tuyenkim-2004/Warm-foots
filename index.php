<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    require_once './app/require.php';
    $app = new App();
    
?>