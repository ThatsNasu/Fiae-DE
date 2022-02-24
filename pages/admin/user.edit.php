<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('user.edit')) {
        $builder .= 'permission user.edit granted';
    }
    $builder .= '</article>';
?>