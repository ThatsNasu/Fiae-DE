<?php
    $permissionPrefixes = array();
    $permissionNodes = $dbman->getPermissionNodes();
    if(isset($_SESSION) && !empty($_SESSION['user'])) {
        $builder ='';
        $permissions = $dbman->getUserPermissions($_SESSION['user']->getUUID());
        foreach($permissions as $permission) {
            foreach($permissionNodes as $node) {
                if($node['id'] == $permission['permissionid']) {
                    $_SESSION['user']->grantPermission($node['node']);
                    if(!in_array(explode('.', $node['node'])[0], $permissionPrefixes)) array_push($permissionPrefixes, explode('.', $node['node'])[0]);
                }
            }
        }
        if($_SESSION['user']->getPermissionByNode("Admin.Access")) {
            if(sizeof($url) < 2) foreach($permissionPrefixes as $prefix) if($prefix != 'Admin') {
                $url[1] = $prefix;
                break;
            }
            $builder = '<div id="adminnav">';
            for($i = 1; $i < sizeof($permissionPrefixes); $i++) $builder .= '<a href="/Admin/'.$permissionPrefixes[$i].'">'.$permissionPrefixes[$i].'</a>';
            $builder .= '</div>';
            if(in_array($url[1], $permissionPrefixes)) {
                if(file_exists('pages/admin/'.$url[1].'.php')) require_once('pages/admin/'.$url[1].'.php');
                else require_once('pages/404.html');
            } else require_once('pages/admin/permissionDenied.html');
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