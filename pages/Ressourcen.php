<?php
    require_once('./frames/file.php');
    $splits = explode('/', $_GET['url']);
    $pagehead = $splits[sizeof($splits)-1];
    if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        ?>
            <article>
                <div class="headline">Sorry, aber...</div>
                ... dies ist ein Bereich, der ohne g&uuml;ltigen Login nicht betreten werden darf. In 5 Sekunden leite ich dich wieder zur&uuml;ck auf die Homepage.
            </article>
        <?php
        header("refresh:5; url=../");
        return;
    } else {
        ?>
        <div class="headline">
            <?php
                echo $pagehead;
            ?>
        </div>
        <?php
            function checkChild($haystack, $needle) {
                foreach($haystack as $menuItem) {
                    if($menuItem->getValue() == $needle) {
                        if(sizeof($menuItem->getChildren()) != 0) {
                            echo '<div class="subcategories">';
                            foreach($menuItem->getChildren() as $child) {
                                echo '<div class="subcategory"><a href="'.$child->getTarget().'">'.$child->getValue().'</a></div>';
                            }
                            echo '</div>';
                        }
                    } else {
                        checkChild($menuItem->getChildren(), $needle);
                    }
                }
            }

            checkChild($navigation->getMainMenuItems(), $pagehead);
            $splits = explode('/', $_GET['url']);
            if(sizeof($splits) != 1) {
        ?>
            <article>
                <div class="file">
                    <div class="filename columns">Dateiname</div>
                    <div class="creator columns">Ersteller</div>
                    <div class="date columns">Datum</div>
                    <div class="filesize columns">Dateigr&ouml;&szlig;e</div>
                </div>
                <?php
                    $dbdata = $dbmanager->getFileList($dbmanager->getCategoryByName($pagehead)['id']);
                    $filelist = array();
                    foreach($dbdata as $filemeta) {
                        $user = $dbmanager->getUserByID($filemeta['creator']);
                        if($user['nickname'] != "") $creator = $user['nickname'];
                        elseif($user['fullname'] != "") $creator = $user['fullname'];
                        else $creator = $user['login'];
                        $file = new File($filemeta['id'], $filemeta['category'], $filemeta['filename'], $creator, $filemeta['creationtime'], $filemeta['size']);
                        array_push($filelist, $file);
                    }

                    foreach($filelist as $file) {
                        $build = '<div class="file">';
                        $build .= '<div class="filename">';
                        $build .= '<a download href="/pages/get.php?f='.$file->getID().'">';
                        $build .= $file->getFilename();
                        $build .= '</a>';
                        $build .= '</div>';
                        $build .= '<div class="creator">';
                        $build .= $file->getCreator();
                        $build .= '</div>';
                        $build .= '<div class="date">';
                        $build .= date($file->getTimestamp());
                        $build .= '</div>';
                        $build .= '<div class="size">';
                        $build .= number_format($file->getFilesize(), 0, ',', '.').' B';
                        $build .= '</div>';
                        $build .= '</div>';
                        echo $build;
                    }
                ?>
            </article>
            <?php
        }
    }
?>