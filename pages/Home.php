<?php
    $recentFiles = array();
    $filesResult = $dbman->getRecentUploads();
    $userlist = $dbman->getUsers();
    $newsResult = $dbman->getRecentNews();
    
    
    foreach($filesResult as $result) {
        array_push($recentFiles, new File($result['id'], $result['filename'], $result['filesize'], $result['creatorid'], $result['category']));
    }
?>

<section>
    <article>
        If you have any suggestions or found a bug for / on this website, feel free to head over to the <a href="https://github.com/dasnasu/fiae-de" rel="_noopener" target="blank">git repository</a> and create an <a href="https://github.com/dasnasu/fiae-de/issues" rel="_noopener" target="blank">issue</a>. Any hints for improvements, feature requests or bugs are very much appreciated.
    </article>
</section>
<section>
    <article>
        <?php
            if(Helpers::isLoggedIn()) {
                echo 'Recent fileuploads:';
                foreach($recentFiles as $file) {
                    echo '<div class="recentFile">'.$userlist[$file->getCreatorID()-1]['username'].' uploaded <a download href="/pages/get.php?f='.$file->getID().'">'.$file->getFilename().'</a> in category <a href="'.Helpers::getFullPathByCategoryID($file->getCategory(), $categories).'" target="_blank" rel="noopener">'.Helpers::getCategoryByID($file->getCategory(), $categories)->getValue().'</a></div>';
                }
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