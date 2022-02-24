<?php
    $builder .= '<article>';
    if($_SESSION['user']->getPermissionByNode('category.delete')) {
        $builder .= '<form>';
        $builder .= '<label>Category:</label><select name="category">';
        foreach($categories as $category) {
            $builder .= '<option>'.$category->getValue().'</option>';
        }
        $builder .= '</select>';
        $builder .= '<input type="text" placeholder="Confirm Category" name="categoryname" required />';
        $builder .= '<input type="submit" value="Delete" />';
        $builder .= '</form>';
    }
    $builder .= '</article>';
?>