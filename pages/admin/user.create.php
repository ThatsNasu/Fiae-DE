<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('user.create')) {
        $builder .= 'permission user.create granted';
    }
    $builder .= '</article>';
?>