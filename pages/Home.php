<?php
    $recentFiles = array();
    $filesResult = $dbman->getRecentUploads();
    $userlist = $dbman->getUsers();
    $newsResult = $dbman->getRecentNews();
    foreach($filesResult as $result) {
        array_push($recentFiles, new File($result['id'], $result['filename'], $result['filesize'], $result['creatorid'], $result['category']));
    }
    //var_dump($userlist);
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
                echo '<div class="recentFile">'.$userlist[$file->getCreatorID()-1]['username'].' uploaded <a href="/" target="_blank" rel="noopener">'.$file->getFilename().'</a> in category <a href="/" target="_blank" rel="noopener">'.$file->getCategory().'</a></div>';
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