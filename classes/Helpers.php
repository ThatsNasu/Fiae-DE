<?php
    class Helpers {

        public static function getcategoryByID($categoryID, $categories) {
            foreach($categories as $category) if($category->getID() == $categoryID) return $category;
        }
    }
?>