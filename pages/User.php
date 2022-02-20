<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    if(!Helpers::isLoggedIn()) {
        require_once('pages/Login.php');
        return;
    }
    echo 'someday show userprofile here';
?>