<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('user.delete')) {
        $builder .= 'permission user.delete granted';
    }
    $builder .= '</article>';
?>