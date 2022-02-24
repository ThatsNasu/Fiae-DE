<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('news.edit')) {
        $builder .= 'permission news.edit granted';
    }
    $builder .= '</article>';
?>