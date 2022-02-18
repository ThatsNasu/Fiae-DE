<?php
    require_once('backend/scssAutoCompiler.php');
    require_once('backend/DatabaseManager.php');
    require_once('backend/dblogin.php');
    foreach(scandir('classes/') as $file) if($file != "." && $file != "..") require_once('classes/'.$file);

    $dbman = new DatabaseManager($host, $dbname, $login, $password);
    
    $navigation = new Navigation($dbman->getMenuEntries(), true);

    $categoriesresult = $dbman->getCategories();
    $categories = array();
    
    foreach($categoriesresult as $categoryresult) {
        array_push($categories, new Category($categoryresult['id'], $categoryresult['parent'], $categoryresult['value'], $categoryresult['target'], $categoryresult['isUploadCategory']));
    }
?>
<!DOCTYPE="html">
<html>
    <head>
        <title>
            <?php
                if(!isset($_GET['url']) && !empty($_GET['url'])) {
                    echo 'FIAE-DE - '.$_GET['url'];
                } else {
                    echo 'Welcome to FIAE-DE';
                }
            ?>
        </title>
		<link rel="preload" as="font" href="https://fonts.gstatic.com/s/materialicons/v85/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2" type="font/woff2" crossorigin>
		<link rel="stylesheet" href="/style/global.css" media="screen">
		<link rel="stylesheet" href="/style/theme.css" media="screen">
        <link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap'" crossorigin>
	</head>

    <body>
        <header>
            <span>
                Welcome to FIAE-DE
            </span>
            <nav>
                <?php
                    echo $navigation->renderTree('inMainNavigation');
                ?>
            </nav>
        </header>
        <content>
            <?php
                $url = array();
                if(empty($_GET['url'])) {
                    $url[0] = "Home";
                } else {
                    $url = explode("/", $_GET['url']);
                }
                if(file_exists('pages/'.$url[0].'.php')) {
                    require_once('pages/'.$url[0].'.php');
                } elseif(file_exists('pages/'.$url[0].'.html')) {
                    require_once('pages/'.$url[0].'.html');
                } else {
                    require_once('pages/404.html');
                }
            ?>
        </content>
        <footer>
            <?php
                echo $navigation->renderTree('inFooter');
            ?>
        </footer>
    </body>
</html>
