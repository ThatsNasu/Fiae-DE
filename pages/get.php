<?php
	require_once('../backend/databaselogin.php');
    require_once('../backend/dbmanager.php');
    $dbmanager = new DBManager($host, $database, $login, $pass);
    if(isset($_GET['f']) && !empty($_GET['f'])) {
        $file = $dbmanager->getFileByID($_GET['f']);
        if (file_exists($file['diskpath'].$file['filename'])) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$file['filename'].'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file['diskpath'].$file['filename']));
            readfile($file['diskpath'].$file['filename']);
            exit;
        }
    }
?>
