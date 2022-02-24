<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    header('refresh:1200; url=/User/Logout');
    require_once('backend/scssAutoCompiler.php');
    require_once('backend/DatabaseManager.php');
    require_once('backend/dblogin.php');
    foreach(scandir('classes/') as $file) if($file != "." && $file != "..") require_once('classes/'.$file);
    session_start();

    $dbman = new DatabaseManager($host, $dbname, $login, $password);
    
    $navigation = new Navigation($dbman->getMenuEntries(), Helpers::isLoggedIn());

    $categoriesresult = $dbman->getCategories();
    $categories = array();
    
    foreach($categoriesresult as $categoryresult) {
        array_push($categories, new Category($categoryresult['id'], $categoryresult['parent'], $categoryresult['value'], $categoryresult['target'], $categoryresult['inMainNavigation'], $categoryresult['inFooter'], $categoryresult['isUploadCategory'], $categoryresult['requiresLogin']));
    }
    
    
?>
<!DOCTYPE="html">
<html>
    <head>
        <title>
            <?php
                $url = Helpers::getUrl();
                if(sizeof($url) > 0) {
                    echo 'FIAE-DE - '.$url[sizeof($url)-1]; 
                } else {
                    echo 'Welcome to FIAE-DE'; 
                    $url[0] = 'Home';
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
