<?php
    session_start();
    session_destroy();
    header('location: /app-web-frontend/login.php');
    exit();
?>