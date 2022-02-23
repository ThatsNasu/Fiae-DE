<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    if(isset($url[1]) && $url[1] == 'Logout') {
        if(Helpers::isLoggedIn()) {
            $_SESSION['user'] = null;
            session_destroy();
            header('refresh:0');
        }
        echo 'You have been logged out.';
    }
    if(!Helpers::isLoggedIn()) {
        require_once('pages/Login.php');
        return;
    }
    if(isset($url[1]) && $url[1] == 'Settings') {
        require_once('pages/user/Settings.php');
        return;
    }
    echo 'someday show userprofile here';
?>