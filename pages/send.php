<?php
    ini_set('max_execution_time', '-1');
	require_once($_SERVER['DOCUMENT_ROOT'].'/backend/databaselogin.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/backend/dbmanager.php');
    $dbmanager = new DBManager($host, $database, $login, $pass);
    $base = "/mnt/pi4tb/fiaede/sharedfiles/";
    if(isset($_FILES['file']) && !empty($_FILES['file'])) {
        if($_POST['categories'] == 'Ressourcen') {
            if($_POST['resources'] == 'Buecher') {
                $base .= "Buecher/";
                $filename = basename($_FILES['file']['name']);
                $dbmanager->insertNewFile($filename, $base, "Buecher", $_FILES['file']['size'], $_SESSION['user']);
            } elseif($_POST['resources'] == 'Betriebssysteme') {
                $base .= "Operating Systems/".$_POST['operatingsystems']."/";
                $filename = basename($_FILES['file']['name']);
                
                $dbmanager->insertNewFile($filename, $base, $_POST['operatingsystems'], $_FILES['file']['size'], $_SESSION['user']);
            } else {
                echo 'Something went wrong horrifically';
                return;
            }
        } elseif($_POST['categories'] == 'Unterrichtsmaterialien') {
            $base .= $_POST['materials']."/";
            $filename = basename($_FILES['file']['name']);
            
            $dbmanager->insertNewFile($filename, $base, $_POST['materials'], $_FILES['file']['size'], $_SESSION['user']);
        } elseif($_POST['categories'] == 'Lernerfolgskontrollen') {
            $base .= "Lernerfolgskontrollen/";
            $filename = basename($_FILES['file']['name']);
            
            $dbmanager->insertNewFile($filename, $base, "Lernerfolgskontrollen", $_FILES['file']['size'], $_SESSION['user']);
        } else {
            echo 'Something went wrong horrifically';
            return;
        }
        if(move_uploaded_file($_FILES['file']['tmp_name'], $base.$filename)) {
            echo 'File successfully transmitted. Feel free to close this tab / leave this page anytime.';
        } else {
            echo 'Something went wrong. I doupt you exceeded the max filesize limit of 16GB, so Nasu has to inspect this a little further, sorry.';
        }
    }
?>
