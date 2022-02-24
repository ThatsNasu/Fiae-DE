<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('news.create')) {
        $builder .= 'permission news.create granted';
    }
    $builder .= '</article>';
?>