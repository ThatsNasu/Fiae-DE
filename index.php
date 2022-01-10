<?php
    require_once('backend/DatabaseManager.php');
    require_once('backend/dblogin.php');
    foreach(scandir('classes/') as $file) if($file != "." && $file != "..") require_once('classes/'.$file);

    $dbman = new DatabaseManager($host, $dbname, $login, $password);

    $navigation = new Navigation($dbman->getMenuEntries());
    $contentManager = new ContentManager();
    $footer = new Navigation($dbman->getMenuEntries());
?>
<!DOCTYPE="html">
<html>
    <style>
        * {
            margin: 0px;
        }
        body {
            background-color: gainsboro;
        }
        nav {
            background-color: cadetblue;
        }
        header {
            background-color: darkgray;
        }
        content {
            background-color: darkseagreen;
        }
        section {
            background-color: dimgray;
        }
        article {
            background-color: dimgrey;
        }
        footer {
            background-color: darkgrey;
        }
    </style>
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
    </head>

    <body>
        <nav>
            <?php
                echo $navigation->getTree();
            ?>
        </nav>
        <header>
            Welcome to FIAE-DE
        </header>
        <content>
            <?php
                echo $contentManager->loadContent();
            ?>
            <section>
                <article>

                </article>
            </section>
        </content>
        <footer>
            <?php
                echo $footer->getTree();
            ?>
        </footer>
    </body>
</html>
