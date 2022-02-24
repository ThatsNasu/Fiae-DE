<script>
    function triggered() {
        console.log('triggered');
    }
</script>

<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('category.edit')) {
        $builder .= '<form><table>';
        $builder .= '<thead><tr><th>Category</th><th>Rename Category</th><th>inMainNavigation</th><th>inFooter</th><th>isUploadCategory</th><th>requiresLogin</th></tr></thead><tbody>';
        foreach($categories as $category) {
            $builder .= '<tr onChange="triggered();"><td>'.$category->getValue().'</td>';
            $builder .= '<td><input type="text" placeholder="leave blank for no changes" name="categoryname" /></td>';
            $builder .= '<td><input type="checkbox" name="inMainNavigation"';
            if($category->inMainNavigation()) $builder .= 'checked';
            $builder .='></td>';
            $builder .= '<td><input type="checkbox" name="inFooter"';
            if($category->inFooter()) $builder .= 'checked';
            $builder .='></td>';
            $builder .= '<td><input type="checkbox" name="isUploadCategory"';
            if($category->isUploadCategory()) $builder .= 'checked';
            $builder .='></td>';
            $builder .= '<td><input type="checkbox" name="requiresLogin"';
            if($category->requiresLogin()) $builder .= 'checked';
            $builder .='></td>';
        }
        $builder .= '</tbody></table></form>';
    }
    $builder .= '</article>';
?>