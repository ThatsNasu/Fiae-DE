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
        if($dbman->getCategoryByName($url[sizeof($url)-1])['isUploadCategory']) { ?>
            <article class="fileList">
                <div class="fileTableHeadline">
                    <span>Filename</span>
                    <span>Uploader</span>
                    <span>Upload Date</span>
                    <span>Filesize</span>
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