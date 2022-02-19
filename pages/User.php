<?php
    if(!Helpers::isLoggedIn()) {
        require_once('pages/Login.php');
        return;
    }
    echo 'someday show userprofile here';
?>