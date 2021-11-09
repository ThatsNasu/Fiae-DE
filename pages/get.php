<?php
    ini_set('max_execution_time', '-1');
	require_once($_SERVER['DOCUMENT_ROOT'].'/backend/databaselogin.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/backend/dbmanager.php');
    $dbmanager = new DBManager($host, $database, $login, $pass);
    if(isset($_GET['f']) && !empty($_GET['f'])) {
        $file = $dbmanager->getFileByID($_GET['f']);
        if(file_exists($file['diskpath'].$file['filename'])) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$file['filename'].'"');
            header('Expires: 0');
            header('Cache-Control: no-cache');
            header('Pragma: public');
            header('Content-Length: '.$file['size']);
            fpassthru(fopen($file['diskpath'].$file['filename'], 'rb'));
            exit;
        }
        echo 'file doesnt exist';
    }
?>
