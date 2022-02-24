<?php
    $permissionNodes = $dbman->getPermissionNodes();
    if(isset($_SESSION) && !empty($_SESSION['user'])) {
        $builder ='';
        $permissions = $dbman->getUserPermissions($_SESSION['user']->getUUID());
        foreach($permissions as $permission) {
            foreach($permissionNodes as $node) {
                if($node['id'] == $permission['permissionid']) $_SESSION['user']->grantPermission($node['node']);
            }
        }
        if($_SESSION['user']->getPermissionByNode("admin.access")) {
            $builder .= '<section>';
            foreach(scandir('pages/admin/') as $file) if($file != "." && $file != "..") require_once('pages/admin/'.$file);
            $builder .= '</section>';
        } else {
            header('refresh:3; url=/');
            $builder .= 'you dont have access to this page.';
        }

        echo $builder;
    }
    else {
        require_once('pages/Login.php');
    }
?>