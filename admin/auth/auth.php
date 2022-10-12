<?php 
    ob_start();
    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] < 1) {
        // header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        header('Location: ./login.php');

        die();
    }
?>