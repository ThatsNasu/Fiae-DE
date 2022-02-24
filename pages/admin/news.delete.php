<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('news.delete')) {
        $builder .= 'permission news.delete granted';
    }
    $builder .= '</article>';
?>