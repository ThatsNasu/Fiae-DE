<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
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
        <?php
            if(Helpers::isLoggedIn()) {
                echo 'Recent fileuploads:';
                foreach($recentFiles as $file) {
                    if($userlist[$file->getCreatorID()-1]['nickname'] != '') $creator = $userlist[$file->getCreatorID()-1]['nickname'];
                    elseif($userlist[$file->getCreatorID()-1]['fullname'] != '') $creator = $userlist[$file->getCreatorID()-1]['fullname'];
                    else $creator = $userlist[$file->getCreatorID()-1]['username'];
                    echo '<div class="recentFile">'.$creator.' uploaded <a download href="/pages/get.php?f='.$file->getID().'">'.$file->getFilename().'</a> in category <a href="'.Helpers::getFullPathByCategoryID($file->getCategory(), $categories).'" target="_blank" rel="noopener">'.Helpers::getCategoryByID($file->getCategory(), $categories)->getValue().'</a></div>';
                }
            }
        ?>
    </article>
</section>