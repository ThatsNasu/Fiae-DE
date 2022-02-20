<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    if(!Helpers::isLoggedIn()) {
        require_once('pages/Login.php');
        return;
    }
?>
<section>
    <article>
        <?php
            if(sizeof($url) >= 2) {
                echo 'Other Categories in <a href="';
                for($i = 0; $i <= sizeof($url)-2; $i++) {
                    echo '/'.$url[$i];
                }
                echo '">'.$url[sizeof($url)-2].'</a>';
            }
        ?>
        <div class="foldableCategories">
            <?php
                if(sizeof($url) > 1) {
                    $childCategories = $dbman->getCategoriesByParent($url[sizeof($url)-2]);
                    foreach($childCategories as $child) {
                        echo '<a href="';
                        for($i = 0; $i < sizeof($url)-1; $i++) echo '/'.$url[$i];
                        echo $child['target'].'">'.$child['value'].'</a><br />';
                    }
                }
            ?>
        </div>
    </article>
    <?php
        $cat = $dbman->getCategoryByName($url[sizeof($url)-1]);
        $users = $dbman->getUsers();
        if($cat['isUploadCategory']) {
            if(isset($_GET['page']) && !empty($_GET['page'])) $fileList = $dbman->getFilesByCategory($cat['id'], ($_GET['page']-1)*25);
            else $fileList = $dbman->getFilesByCategory($cat['id']);
            ?>
            <article class="fileList">
                <div class="fileTableHeadline">
                    <span>Filename</span>
                    <span>Uploader</span>
                    <span>Upload Date</span>
                    <span>Filesize</span>
                </div>
                <div class="fileTableContent">
                    <?php
                        $tableBuilder = "";
                        foreach($fileList as $file) {
                            $tableBuilder .= '<div class="fileTableEntry">';
                            $tableBuilder .= '<div class="fileTableFileName"><a download href="/pages/get.php?f='.$file['id'].'">'.$file['filename'].'</a></div>';
                            if($users[$file['creatorid']-1]['nickname'] !== "") $tableBuilder .= '<div class="fileTableCreator">'.$users[$file['creatorid']-1]['nickname'].'</div>';
                            elseif($users[$file['creatorid']-1]['fullname'] !== "") $tableBuilder .= '<div class="fileTableCreator">'.$users[$file['creatorid']-1]['fullname'].'</div>';
                            else $tableBuilder .= '<div class="fileTableCreator">'.$users[$file['creatorid']-1]['username'].'</div>';
                            $tableBuilder .= '<div class="fileTableUploadDate">'.$file['created'].'</div>';
                            $tableBuilder .= '<div class="fileTableFileSize">'.number_format($file['filesize'], 0, ',', '.').' Bytes</div>';
                            $tableBuilder .= '</div>';
                        }
                        echo $tableBuilder;
                    ?>
                </div>
            </article>
        <?php } else {
            echo '<article class="subcategories"><span>Categories in '.$url[sizeof($url)-1].'</span>';
            $childCategories = $dbman->getCategoriesByParent($url[sizeof($url)-1]);
            echo '<div class="foldableCategrories">';
            foreach($childCategories as $child) {
                echo '<a href="';
                for($i = 0; $i <= sizeof($url)-1; $i++) echo '/'.$url[$i];
                echo $child['target'].'">'.$child['value'].'</a><br />';
            }
            echo '</div></article>';
        }
    ?>
</section>