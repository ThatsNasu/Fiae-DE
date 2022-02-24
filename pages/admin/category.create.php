<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('category.create')) {
        $builder .= '<form><table><thead><tr><th>Parent</th><th>New Category</th><th>inMainNavigation</th><th>inFooter</th><th>isUploadCategory</th><th>requiresLogin</th></tr></thead><tbody>';
        $builder .= '<tr><td><select name="parent"><option>/</option>';
        foreach($categories as $category) {
            $builder .= '<option>'.$category->getValue().'</option>';
        }
        $builder .= '</select></td>';
        $builder .= '<td><input type="text" placeholder="new Category" name="categoryname" required /></td>';
        $builder .= '<td><input type="checkbox" name="inMainNavigation"></td>';
        $builder .= '<td><input type="checkbox" name="inFooter"></td>';
        $builder .= '<td><input type="checkbox" name="isUploadCategory"></td>';
        $builder .= '<td><input type="checkbox" name="requiresLogin"></td>';
        $builder .= '</tbody></table><input type="submit" value="Create" />';
        $builder .= '</form>';
    }
    $builder .= '</article>';
?>