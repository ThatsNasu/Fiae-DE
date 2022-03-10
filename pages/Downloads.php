<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    if(!Helpers::isLoggedIn()) {
        require_once('pages/Login.php');
        return;
    }
?>
<section id="downloads">
    <?php
        $catBuilder = '';
        $filetableBuilder = '';
        if(sizeof($url) >= 2) {
            $catBuilder .= '<article id="categories">';
            $catBuilder .= '<h2>Other Categories in <a href="';
            for($i = 0; $i <= sizeof($url)-2; $i++) {
                $catBuilder .= '/'.$url[$i];
            }
            $catBuilder .= '">'.$url[sizeof($url)-2].'</a></h2>';
            $catBuilder .= '<div class="foldableCategories">';
            $childCategories = $dbman->getCategoriesByParent($url[sizeof($url)-2]);
            foreach($childCategories as $child) {
                $catBuilder .= '<a href="';
                for($i = 0; $i < sizeof($url)-1; $i++) $catBuilder .= '/'.$url[$i];
                $catBuilder .= $child['target'].'">'.$child['label'].'</a>';
            }
            $catBuilder .= '</div>';
        }
        $cat = $dbman->getCategoryByName($url[sizeof($url)-1]);
        $users = $dbman->getUsers();
        if(!$cat['isUploadCategory']) {
            $catBuilder .= '<div id="subcategories"><h2>Categories in '.$url[sizeof($url)-1].'</h2>';
            $childCategories = $dbman->getCategoriesByParent($url[sizeof($url)-1]);
            $catBuilder .= '<div class="foldableCategories">';
            foreach($childCategories as $child) {
                $catBuilder .= '<a href="';
                for($i = 0; $i <= sizeof($url)-1; $i++) $catBuilder .= '/'.$url[$i];
                $catBuilder .= $child['target'].'">'.$child['label'].'</a>';
            }
            $catBuilder .= '</div></div>';
        } else {
            $itemcount = $dbman->getFileCountByCategory($cat['id']);
            if(isset($_GET['page']) && !empty($_GET['page'])) $fileList = $dbman->getFilesByCategory($cat['id'], ($_GET['page']-1)*25);
            else $fileList = $dbman->getFilesByCategory($cat['id']);
            $filetableBuilder .= '<article id="fileList">';
            $pages = 0;
            if($itemcount > 25) {
                $filetableBuilder .= '<div class="pageselector">';
                $pages = ceil($itemcount / 25);
                for($i = 0; $i < $pages; $i++) $filetableBuilder .= '<a href="?page='.($i+1).'">'.($i+1).'</a>';
                $filetableBuilder .= '</div>';
            }
            $filetableBuilder .= '<table><thead><tr><th>Filename</th><th>Uploader</th><th>Upload Date</th><th>Filesize</th></tr></thead>';
            $tableBuilder = '<tbody>';
            foreach($fileList as $file) {
                $tableBuilder .= '<tr>';
                $tableBuilder .= '<td><a download href="/pages/get.php?f='.$file['id'].'">'.$file['filename'].'</a></td>';
                if($users[$file['creatorid']-1]['nickname'] !== "") $tableBuilder .= '<td>'.$users[$file['creatorid']-1]['nickname'].'</td>';
                elseif($users[$file['creatorid']-1]['fullname'] !== "") $tableBuilder .= '<td>'.$users[$file['creatorid']-1]['fullname'].'</td>';
                else $tableBuilder .= '<td>'.$users[$file['creatorid']-1]['username'].'</td>';
                $tableBuilder .= '<td>'.$file['created'].'</td>';
                $tableBuilder .= '<td>'.number_format($file['filesize'], 0, ',', '.').' Bytes</td>';
                $tableBuilder .= '</tr>';
            }
            $filetableBuilder .= $tableBuilder.'</tbody></table>';
            if($itemcount > 25) {
                $filetableBuilder .= '<div class="pageselector">';
                $pages = ceil($itemcount / 25);
                for($i = 0; $i < $pages; $i++) $filetableBuilder .= '<a href="?page='.($i+1).'">'.($i+1).'</a>';
                $filetableBuilder .= '</div>';
            }
        }
        $catBuilder .= '</article>';
        $filetableBuilder .= '</article>';
        echo $catBuilder;
        echo $filetableBuilder;
    ?>
</section>
