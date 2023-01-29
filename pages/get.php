<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/backend/dblogin.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/backend/DatabaseManager.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/classes/Helpers.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/classes/Category.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/classes/User.php');
    session_start();
    if(!Helpers::isLoggedIn()) {
        return;
    }

    $base = '/mnt/external/FIAE-DE';
    $dbman = new DatabaseManager($host, $dbname, $login, $password);

    $categoriesresult = $dbman->getCategories();
    $categories = array();
    
    foreach($categoriesresult as $categoryresult) {
        array_push($categories, new Category($categoryresult['id'], $categoryresult['parent'], $categoryresult['label'], $categoryresult['linksto'], $categoryresult['isUploadCategory']));
    }


    if(isset($_GET['f']) && !empty($_GET['f'])) {
        $file = $dbman->getFileByID($_GET['f']);
        echo $base.Helpers::getFullPathByCategoryID($file['category'], $categories).'/'.$file['filename'];
        if(file_exists($base.Helpers::getFullPathByCategoryID($file['category'], $categories).'/'.$file['filename'])) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$file['filename'].'"');
            header('Expires: 0');
            header('Cache-Control: no-cache');
            header('Pragma: public');
            header('Content-Length: '.$file['filesize']);
            fpassthru(fopen($base.Helpers::getFullPathByCategoryID($file['category'], $categories).'/'.$file['filename'], 'rb'));
            exit;
        }
        echo 'File not found on the server, or no permission to acces this file';
    }
?>
