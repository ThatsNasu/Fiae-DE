<?php
    $recentFiles = array();
    $categories = array();
    $filesResult = $dbman->getRecentUploads();
    $catResult = $dbman->getCategories();
    $userlist = $dbman->getUsers();
    $newsResult = $dbman->getRecentNews();
    
    
    foreach($filesResult as $result) {
        array_push($recentFiles, new File($result['id'], $result['filename'], $result['filesize'], $result['creatorid'], $result['category']));
    }
    foreach($catResult as $cat) {
        $categories[$cat['id']] =  new Category($cat['id'], $cat['parent'], $cat['value'], $cat['target'], $cat['isUploadCategory']);
    }


    function getFullTarget($catID, $categories) {
        if($categories[$catID]->getParent() != 0) {
            return getFullTarget($categories[$catID]->getParent(), $categories).$categories[$catID]->getTarget();
        } else {
            return $categories[$catID]->getTarget();
        }
    }
?>

<section>
    <article>
        If you have any suggestions or found a bug for / on this website, feel free to head over to the git repository and create an issue. Any hints for improvements, feature requests or bugs are very much appreciated.
    </article>
</section>
<section>
    <article>
        Recent fileuploads:
        <?php
            foreach($recentFiles as $file) {
                echo '<div class="recentFile">'.$userlist[$file->getCreatorID()-1]['username'].' uploaded <a href="'.getFullTarget($file->getCategory(), $categories).'/'.$file->getFilename().'" target="_blank" rel="noopener">'.$file->getFilename().'</a> in category <a href="'.getFullTarget($file->getCategory(), $categories).'" target="_blank" rel="noopener">'.$categories[$file->getCategory()]->getValue().'</a></div>';
            }
        ?>
    </article>
</section>
<section>
    News:
    <?php
        foreach($newsResult as $news) {
            echo '<article class="news"><div class="newsContent">'.$news['content'].'</div><div class="newsRelease">'.$news['released'].'</div></article>';
        }
    ?>
</section>