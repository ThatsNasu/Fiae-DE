<?php
    $categoryBuilder = '';

    // -------------------- CATEGORY CREATE --------------------
    if($_SESSION['user']->getPermissionByNode('Category.Create')) {
        $categoryBuilder .= '<article>';
        if(isset($_POST['newCategoryParent']) && !empty($_POST['newCategoryParent']) && isset($_POST['newCategoryName']) && !empty($_POST['newCategoryName']) && isset($_POST['newCategoryTarget']) && !empty($_POST['newCategoryTarget'])) {
            $inMainNavigation = (isset($_POST['newCategoryinMainNavigation']) && $_POST['newCategoryinMainNavigation'] == 'on') ? 1 : 0;
            $inFooter = (isset($_POST['newCategoryinFooter']) && $_POST['newCategoryinFooter'] == 'on') ? 1 : 0;
            $isUploadCategory = (isset($_POST['newCategoryisUploadCategory']) && $_POST['newCategoryisUploadCategory'] == 'on') ? 1 : 0;
            $requiresLogin = (isset($_POST['newCategoryrequiresLogin']) && $_POST['newCategoryrequiresLogin'] == 'on') ? 1 : 0;
            $category = new Category(-1, $_POST['newCategoryParent'], $_POST['newCategoryName'], $_POST['newCategoryTarget'], $inMainNavigation, $inFooter, $isUploadCategory, $requiresLogin);
            if($dbman->insertNewCategory($category)) {
                header("Location: /Admin/Category");
                exit;
            }
        }
        $categoryBuilder .= '<form method="post"><table><thead><tr><th>Parent</th><th>New Category</th><th>Target</th><th>inMainNavigation</th><th>inFooter</th><th>isUploadCategory</th><th>requiresLogin</th></tr></thead><tbody>';
        $categoryBuilder .= '<tr><td><select name="newCategoryParent"><option>/</option>';
        foreach($categories as $category) {
            $categoryBuilder .= '<option>'.$category->getLabel().'</option>';
        }
        $categoryBuilder .= '</select></td>';
        $categoryBuilder .= '<td><input type="text" placeholder="new Category" name="newCategoryName" required /></td>';
        $categoryBuilder .= '<td><input type="text" placeholder="Target" name="newCategoryTarget" required /></td>';
        $categoryBuilder .= '<td><input type="checkbox" name="newCategoryinMainNavigation"></td>';
        $categoryBuilder .= '<td><input type="checkbox" name="newCategoryinFooter"></td>';
        $categoryBuilder .= '<td><input type="checkbox" name="newCategoryisUploadCategory"></td>';
        $categoryBuilder .= '<td><input type="checkbox" name="newCategoryrequiresLogin"></td>';
        $categoryBuilder .= '</tbody></table><input type="submit" value="Create" />';
        $categoryBuilder .= '</form>';
        $categoryBuilder .= '</article>';
    }
    
    // -------------------- CATEGORY DELETE --------------------
    if($_SESSION['user']->getPermissionByNode('Category.Delete')) {
        if(isset($_POST['category']) && isset($_POST['categoryname']) && $_POST['categoryname'] == Helpers::getCategoryByID($_POST['category'], $categories)->getLabel()) {
            if($dbman->deleteCategory(Helpers::getCategoryByID($_POST['category'], $categories))) {
                header("Location: /Admin/Category");
                exit;
            }
        }
        $categoryBuilder .= '<article>';
        $categoryBuilder .= '<form method="post">';
        $categoryBuilder .= '<label>Category:</label><select name="category">';
        foreach($categories as $category) {
            $categoryBuilder .= '<option value="'.$category->getID().'">'.$category->getLabel().'</option>';
        }
        $categoryBuilder .= '</select>';
        $categoryBuilder .= '<input type="text" placeholder="Confirm Category" name="categoryname" required />';
        $categoryBuilder .= '<input type="submit" value="Delete" />';
        $categoryBuilder .= '</form>';
        $categoryBuilder .= '</article>';
    }
    
    // -------------------- CATEGORY EDIT --------------------
    /*if($_SESSION['user']->getPermissionByNode('Category.Edit')) {
        $categoryBuilder .= '<article>';
        $categoryBuilder .= '<form><table>';
        $categoryBuilder .= '<thead><tr><th>Category</th><th>Rename Category</th><th>inMainNavigation</th><th>inFooter</th><th>isUploadCategory</th><th>requiresLogin</th></tr></thead><tbody>';
        foreach($categories as $category) {
            $categoryBuilder .= '<tr onChange="triggered();"><td>'.$category->getLabel().'</td>';
            $categoryBuilder .= '<td><input type="text" placeholder="leave blank for no changes" name="categoryname" /></td>';
            $categoryBuilder .= '<td><input type="checkbox" name="inMainNavigation"';
            if($category->inMainNavigation()) $categoryBuilder .= ' checked ';
            $categoryBuilder .='></td>';
            $categoryBuilder .= '<td><input type="checkbox" name="inFooter"';
            if($category->inFooter()) $categoryBuilder .= ' checked ';
            $categoryBuilder .='></td>';
            $categoryBuilder .= '<td><input type="checkbox" name="isUploadCategory"';
            if($category->isUploadCategory()) $categoryBuilder .= ' checked ';
            $categoryBuilder .='></td>';
            $categoryBuilder .= '<td><input type="checkbox" name="requiresLogin"';
            if($category->requiresLogin()) $categoryBuilder .= ' checked ';
            $categoryBuilder .='></td>';
        }
        $categoryBuilder .= '</tbody></table></form>';
        $categoryBuilder .= '</article>';
    }*/
    
    //definitve output print
    if($categoryBuilder != '') {
        $builder .= '<section >'.$categoryBuilder.'</section>';
    }
?>